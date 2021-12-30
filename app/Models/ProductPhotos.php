<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductPhotos extends Model
{
    use HasFactory;

    protected $fillable = ['image'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
