<?php
namespace App\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Products;
use App\Models\ProductType;
use App\Models\ProductImage;

class Product extends Component
{
    use WithFileUploads;

    public $products, $types;
    public $type_id, $price, $card_width, $card_height,$quantity,$description ;
    public $card_images ;
    public $editId, $showModal = false;

    protected $rules = [
        'type_id' => 'required',
        'price' => 'required|numeric',
        'card_width' => 'required',
        'card_height' => 'required',
        'card_images.*' => 'required',
        'quantity' => 'required|numeric',
        'description' => 'required',
    ];

    public function mount()
    {
        $this->products = Products::with('images','type')->get();
        $this->types = ProductType::all();
    }

    public function openModal()
    {
        $this->reset(['type_id','price','card_width','card_height','card_images','quantity','description','editId']);
        $this->showModal = true;
    }

    public function save()
    {
        $this->validate();

        $product = Products::create([
            'type_id' => $this->type_id,
            'price' => $this->price,
            'card_width' => $this->card_width,
            'card_height' => $this->card_height,
            'quantity' => $this->quantity,
            'description' => $this->description,
        ]);


        // ✅ Save images in separate table
        foreach ($this->card_images as $img)
        {
            $path = $img->store('products', 'public'); // ✅ correct
            ProductImage::create([
                'product_id' => $product->id,
                'image' => $path
            ]);
        }

        $this->closeModal();
    }

    public function edit($id)
    {
        $data = Products::find($id);

        $this->editId = $id;
        $this->type_id = $data->type_id;
        $this->price = $data->price;
        $this->card_width = $data->card_width;
        $this->card_height = $data->card_height;
        $this->quantity=$data->quantity;
        $this->description=$data->description;
        $this->showModal = true;
    }

    public function update()
    {
        $this->validate();

        $product = Products::find($this->editId);

        $product->update([
            'type_id' => $this->type_id,
            'price' => $this->price,
            'card_width' => $this->card_width,
            'card_height' => $this->card_height,
            'quantity' => $this->quantity,
            'description' => $this->description,
        ]);

        // ✅ Add new images
        if ($this->card_images)
        {
            foreach ($this->card_images as $img)
            {
                $filename = time().'_'.$img->getClientOriginalName();
                $img->move(public_path('products'), $filename);
                $path = 'products/'.$filename;

                ProductImage::create([
                    'product_id' => $product->id,
                    'image' => $path
                ]);
            }
        }

        $this->closeModal();
    }

    public function delete($id)
    {
        $product = Products::find($id);

        // delete images
        // foreach ($product->images as $img)
        // {
        //     \Storage::disk('public')->delete($img->image);
        //     $img->delete();
        // }

        $product->delete();

        $this->products = Products::with('images','type')->get();
    }

    public function closeModal()
    {
        $this->reset(['type_id','price','card_width','card_height','card_images','quantity','description','editId']);
        $this->products = Products::with('images','type')->get();
        $this->showModal = false;
    }

    // public function render()
    // {
    //     return view('livewire.product');
    // }
}
