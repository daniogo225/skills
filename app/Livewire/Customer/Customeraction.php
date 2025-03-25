<?php

namespace App\Livewire\Customer;

use App\Models\Customer;
use Livewire\Component;

class Customeraction extends Component
{
    public function render()
    {
        $customers = Customer::all();
        dd($customers);
        return view('livewire.customer.customeraction', compact('customers'));
    }
}
