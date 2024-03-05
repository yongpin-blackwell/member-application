<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function addressType()
    {
        return $this->belongsTo(AddressType::class);
    }

    public function document()
    {
        return $this->morphMany(Document::class, 'documentable');
    }
}
