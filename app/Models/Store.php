<?php

namespace App\Models;

use App\Notifications\StoreReceiveNewOrder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Store extends Model
{
    /*
    Por padrão o laravel busca no banco o nome da model no plural.
    Caso o nome da tabela fosse diferente, bastaria sobreescrever utilizando o método abaixo:
        - protected $table = 'tb_lojas';
    */
    use HasFactory, HasSlug;

    /**
     * Get the options for generating the slug.
     */
    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('name')
            ->saveSlugsTo('slug');
    }

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
        //possui vários
        return $this->hasMany(Product::class);
    }

    public function orders()
    {
        //model - nome da tabela no banco - nome da chave
        return $this->belongsToMany(UserOrder::class, 'order_store', 'store_id', 'order_id');
    }

    public function notifyStoreOwners(array $storesId = [])
    {
        $stores = $this->whereIn('id', $storesId)->get();

        $stores->map(function ($store) {
            return $store->user;
        })->each->notify(new StoreReceiveNewOrder());
    }
}
