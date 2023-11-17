<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;

    protected $casts = [
        'sold_at' => 'datetime',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function variant()
    {
        return $this->belongsTo(Variant::class);
    }

    public function phone()
    {
        return $this->belongsTo(Phone::class);
    }

    public function sales()
    {
        return $this->belongsToMany(Sale::class)
            ->withPivot([
                "quantity",
                "sold_at",
            ]);
    }
}
