<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class Vendor extends Component
{
    use WithFileUploads;

    public $name, $email, $mobile, $vendor;
    public $editId, $showModal = false;

    protected function rules()
    {
        return [
            'name'   => 'required|string|max:255',
            'email'  => [
                'required',
                'email',
                Rule::unique('users')->ignore($this->editId),
            ],
            'mobile' => [
                'required',
                'digits:10',
                Rule::unique('users')->ignore($this->editId),
            ],
        ];
    }


        

    public function mount()
    {
        $this->vendor = User::WhereIn('role', ['user', 'vendor'])->orderBy('id', 'desc')->get();
    }


    public function openModal()
    {
        $this->reset(['name', 'email', 'mobile', 'editId']);
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();
        $product = User::create([
            'name' => $this->name,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'password' => Hash::make('123456'),
            'role' => 'vendor'
        ]);

        $this->closeModal();
    }

    public function edit($id)
    {
        $data = User::find($id);
        $this->editId = $id;
        $this->name = $data->name;
        $this->email = $data->email;
        $this->mobile = $data->mobile;
        $this->showModal = true;
    }

    public function update()
    {
        $this->validate();

        $product = User::find($this->editId);

        $product->update([
            'name' => $this->name,
            'email' => $this->email,
            'mobile' => $this->mobile,
        ]);

        $this->closeModal();
    }


    public function delete($id)
    {
        $product = User::find($id);
        $product->delete();
        $this->vendor = User::WhereIn('role', ['user', 'vendor'])->orderBy('id', 'desc')->get();
    }

    public function closeModal()
    {
        $this->reset(['name', 'email', 'mobile', 'editId']);
        $this->vendor = User::WhereIn('role', ['user', 'vendor'])->orderBy('id', 'desc')->get();
        $this->showModal = false;
    }

    // public function render()
    // {
    //     return view('livewire.vendor');
    // }
}
