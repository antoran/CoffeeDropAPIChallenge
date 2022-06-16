<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int $id
 * @property string $name
 * @property array $prices
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 */
class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'prices',
    ];

    protected $casts = [
        'prices' => 'array',
    ];

    /**
     * Calculate the cashback due for this product.
     *
     * @param int $quantity The quantity of the product.
     *
     * @return int|float
     */
    public function calculateCashback(int $quantity): int|float
    {
        if ($quantity > 500) {
            return $this->prices['501'] * $quantity;
        }

        if ($quantity > 50) {
            return $this->prices['51'] * $quantity;
        }

        return $this->prices['0'] * $quantity;
    }
}
