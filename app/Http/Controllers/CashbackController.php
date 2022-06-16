<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Resources\CashbackResource;
use App\Models\Product;
use Illuminate\Http\Request;

class CashbackController extends Controller
{
    public function __invoke(Request $request)
    {
        $coffee = $request->only(['Ristretto', 'Espresso', 'Lungo']);

        $coffee = collect($coffee)->map(function ($quantity, $product) {
            return Product::where('name', $product)->first()->calculateCashback($quantity);
        });

        return new CashbackResource($coffee);
    }
}
