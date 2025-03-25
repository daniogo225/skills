<?php

namespace App\Livewire\Product;

use App\Models\Product;
use Livewire\Component;

class Productaction extends Component
{
    public function render()
    {
        $products = Product::all();
        $products->load('customer');
        return view('livewire.product.productaction', compact('products'));
    }
}
