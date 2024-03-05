<?php

namespace App\Http\Controllers;

use App\Export\UsersExport;
use App\Models\Document;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;

class UserController extends Controller
{
    public function index()
    {
        $users = User::paginate(10);
        return response()->json($users);
    }

    public function show($user_id)
    {
        $user = User::with('address', 'documents')->findOrFail($user_id);
        return response()->json($user);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users',
            'document' => 'required|file|max:2048',
            'birthdate' => 'required|date|max:2048',
            'password' => 'required|min:8|alpha',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }
        $data = $request->all();
        unset($data['document']);
        $user = User::create($data);

        if ($request->hasFile('document')) {
            $file = $request->file('document');
            $filePath = $file->store('uploads');

            $extension = $file->getClientOriginalExtension();
            $documentableType = ($extension == 'pdf' || $extension == 'doc' || $extension == 'docx') ? 'document' : 'image';

            $document = new Document();
            $document->documentable_id = $user->id;
            $document->documentable_type = get_class($user);
            $document->file_path = $filePath;
            $document->save();
        }
        return response()->json(['message' => '用戶註冊成功'], 201);
    }

    public function update(Request $request, $user_id)
    {
        $user = User::findOrFail($user_id);

        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email|unique:users,email,' . $user_id,
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 422);
        }

        $user->update($validator->validated());
        return response()->json($user, 200);
    }

    public function destroy($user_id)
    {
        $user = User::findOrFail($user_id);
        $user->delete();
        return response()->json(null, 204);
    }

    public function export()
    {
        $columns = ['id', 'first_name', 'last_name', 'email', 'birthdate'];
        $users = User::select($columns)->get()->toArray();
        array_unshift($users, [$columns]);
        return Excel::download(new UsersExport($users), 'users.xlsx');
    }
}
