<?php

namespace App\Export;

use Maatwebsite\Excel\Concerns\FromArray;

class UsersExport implements FromArray
{
    protected $users;

    public function __construct(array $users)
    {
        $this->users = $users;
    }

    public function array(): array
    {
        return $this->users;
    }
}
