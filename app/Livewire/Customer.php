<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Products;
use App\Models\ProductType;

class Customer extends Component
{
    public $types;
    public $products = [];
    public $selectedType = null;

    public function mount()
    {
        $this->types = ProductType::all();

        // default first type
        if ($this->types->count()) {
            $this->selectedType = $this->types->first()->id;
            $this->loadProducts();
        }
    }

    public function selectType($id)
    {
        $this->selectedType = $id;
        $this->loadProducts();
    }

    public function loadProducts()
    {
        $this->products = Products::with('images')
            ->where('type_id', $this->selectedType)
            ->get();
    }


    // public function render()
    // {
    //     return view('livewire.customer');
    // }
}
