<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    public function phones()
    {
        return $this->hasMany(Phone::class);
    }

    public function variants()
    {
        return $this->hasMany(Variant::class);
    }
}
