<?php

namespace App\Models;

use App\Models\Addon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Menu extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category',
        'price',
        'is_active',
        'description',
        'image',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    // Relationships
    public function menuIngredients()
    {
        return $this->hasMany(MenuIngredient::class);
    }

    public function saleItems()
    {
        return $this->hasMany(SaleItem::class);
    }

    public function products()
    {
        return $this->belongsToMany(Product::class, 'menu_ingredients')
                    ->withPivot('quantity', 'unit')
                    ->withTimestamps();
    }
    
    public function addons(): BelongsToMany
    {
        return $this->belongsToMany(Addon::class, 'menu_addons');
    }
}