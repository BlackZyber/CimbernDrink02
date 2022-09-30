<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Drink extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'barcode',
        'price',
        'picture',
    ];

    public function users(){
        return $this->hasMany(User::class);
    }

}
