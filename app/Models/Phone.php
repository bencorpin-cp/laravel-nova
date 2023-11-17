<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Phone extends Model
{
    use HasFactory;

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function variant()
    {
        return $this->belongsTo(Variant::class);
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }

    public function sales()
    {
        return $this->belongsTo(Sale::class);
    }
}
