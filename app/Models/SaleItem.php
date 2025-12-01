<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SaleItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'sale_id',
        'menu_id',
        'quantity',
        'price',
        'subtotal',
        'note'
    ];

    protected $casts = [
        'price' => 'integer',
        'subtotal' => 'integer',
    ];

    // Relationships
    public function sale()
    {
        return $this->belongsTo(Sale::class);
    }

    public function menu()
    {
        return $this->belongsTo(Menu::class);
    }

    public function addons(): HasMany
    {
        return $this->hasMany(SaleItemAddon::class);
    }

}