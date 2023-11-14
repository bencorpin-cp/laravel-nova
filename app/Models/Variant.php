<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Variant extends Model
{
    use HasFactory;

    protected $fillable = [
        "name", "release_date"
    ];

    protected $casts = [
        'release_date' => 'date',
    ];

    public function brand()
    {
        return $this->belongsTo(Brand::class);
    }

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }
}
