<?php

namespace App\Models;

use App\Models\Addon;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'sku_code',
        'stock',
        'unit_price',
    ];

    // Relationships
    public function menuIngredients()
    {
        return $this->hasMany(MenuIngredient::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'menu_ingredients')
                    ->withPivot('quantity', 'unit')
                    ->withTimestamps();
    }

    public function addons(): HasMany
    {
        return $this->hasMany(Addon::class);
    }
}