<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'name',
        'description',
        'price',
        'quantity',
        'image'
    ];

    public function getImageUrlAttribute()
{
    return $this->image ? asset('storage/' . $this->image) : null;
}

}
