<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['name', 'description', 'price', 'image'];

    public function addons()
    {
        return $this->hasMany(ProductAddon::class);
    }
}

