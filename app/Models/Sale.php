<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    use HasFactory;

    protected $casts = [
        "sold_at" => "datetime"
    ];

    public function phone()
    {
        return $this->belongsTo(Phone::class);
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function stock()
    {
        return $this->belongsTo(Stock::class);
    }
}
