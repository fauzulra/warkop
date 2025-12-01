<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class SaleItemAddon extends Model
{
    use HasFactory;
    protected $fillable = [
        'sale_item_id',
        'addon_id',
        'price_at_sale',
    ];

    public function saleItem(): BelongsTo
    {
        return $this->belongsTo(SaleItem::class);
    }
    public function addon(): BelongsTo
    {
        return $this->belongsTo(Addon::class);
    }
}