<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    /*
    Por padrão o laravel busca no banco o nome da model no plural.
    Caso o nome da tabela fosse diferente, bastaria sobreescrever utilizando o método abaixo:
        - protected $table = 'tb_lojas';
    */
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'phone',
        'mobile_phone',
        'slug',
        'logo'
    ];

    public function user()
    {
        //pertence para ou pertence a
        return $this->belongsTo(User::class);
    }

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
