<?php

namespace App\Livewire;

use Livewire\Component;

class ProductType extends Component
{
    public $types, $name, $description, $editId;
    public $showModal = false;



    protected $rules = [
        'name' => 'required',
        'description' => 'required',
    ];

    public function mount()
    {
        $this->types = \App\Models\ProductType::all();
    }

    public function openModal()
    {
        $this->reset(['name','description','editId']);

        $this->resetErrorBag();     // ✅ ADD THIS
        $this->resetValidation();   // ✅ ADD THIS

        $this->showModal = true;
    }

    public function edit($id)
    {

        $data = \App\Models\ProductType::find($id);

        $this->editId = $id;
        $this->name = $data->name;
        $this->description = $data->description;

        $this->showModal = true;
    }

    public function save()
    {
        // ✅ validation apply
        $this->validate();

        \App\Models\ProductType::create([
            'name' => $this->name,
            'description' => $this->description,
        ]);

        // $this->dispatch('toast', [
        //     'message' => 'Product Type Added Successfully'
        // ]);

         $this->dispatch('toast', 'Product Type Added Successfully');

        $this->closeModal();
    }

    public function update()
    {
        $this->validate();

        \App\Models\ProductType::find($this->editId)->update([
            'name' => $this->name,
            'description' => $this->description,
        ]);

    //    $this->dispatch('toast', [
    //         'message' => 'Product Type Updated Successfully'
    //     ]);

        $this->dispatch('toast', 'Product Type Updated Successfully');

        $this->closeModal();
    }

    public function closeModal()
    {
        $this->reset(['name','description','editId']);
        $this->types = \App\Models\ProductType::all();

        $this->resetErrorBag();     // ✅ ADD THIS
        $this->resetValidation();   // ✅ ADD THIS

        $this->showModal = false;
    }

    // public function render()
    // {
    //     return view('livewire.product-type');
    // }
}
