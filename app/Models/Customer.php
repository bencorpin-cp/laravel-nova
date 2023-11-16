<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $casts = [
        "birthdate" => "date",
    ];

    public function phones()
    {
        return $this->hasMany(Phone::class);
    }
}
