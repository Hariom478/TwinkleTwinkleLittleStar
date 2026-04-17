<div>

    <!-- Add Button -->
    <button wire:click="openModal" class="bg-blue-600 text-white px-4 py-2 rounded mb-4">
        + Add Product
    </button>

    <!-- TABLE -->
    <table class="w-full border text-center">
        <thead class="bg-gray-200">
            <tr>
                <th>#</th>
                <th>Type</th>
                <th>Price</th>
                <th>Size</th>
                <th>Images</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach ($products as $index => $p)
                <tr>
                    <td>{{ $index + 1 }}</td>
                    <td>{{ $p->type->name ?? '' }}</td>
                    <td>{{ $p->price }}</td>
                    <td>{{ $p->card_width }} x {{ $p->card_height }}</td>

                    <td>
                        @foreach ($p->images as $keys => $img)
                            @if ($keys == 0)
                                <img src="{{ $img->image }}" class="w-10 inline h-40">
                            @endif
                        @endforeach
                    </td>

                    <td>
                        <button wire:click="edit({{ $p->id }})" class="bg-yellow-500 px-2 py-1 text-white rounded">
                            Edit
                        </button>

                        <button wire:click="delete({{ $p->id }})" class="bg-red-600 px-2 py-1 text-white rounded">
                            Delete
                        </button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>


    @if ($showModal)
        <div class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/40 backdrop-blur-sm"
            wire:click.self="closeModal">

            <div class="bg-white w-[500px] max-w-[90%] rounded-xl shadow-2xl p-6">

                <!-- HEADER -->
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-xl font-semibold text-gray-800">
                        {{ $editId ? 'Edit Product' : 'Add Product' }}
                    </h2>

                    <button wire:click="closeModal" class="text-gray-500 hover:text-black text-xl">
                        ✕
                    </button>
                </div>

                <!-- FORM -->
                <div class="space-y-4">

                    <!-- Type -->
                    <div>
                        <label class="text-sm text-gray-600">Product Type</label>
                        <select wire:model="type_id"
                            class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
                            <option value="">Select Type</option>
                            @foreach ($types as $t)
                                <option value="{{ $t->id }}">{{ $t->name }}</option>
                            @endforeach
                        </select>
                        @error('type_id')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Price -->
                    <div>
                        <label class="text-sm text-gray-600">Price</label>
                        <input type="text" wire:model="price"
                            class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
                        @error('price')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Quantity -->
                    <div>
                        <label class="text-sm text-gray-600">Quantity</label>
                        <input type="number" wire:model="quantity" min="1"
                            class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
                        @error('quantity')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- SIZE -->
                    <div class="grid grid-cols-2 gap-3">

                        <div>
                            <label class="text-sm text-gray-600">Width</label>
                            <input type="text" wire:model="card_width" class="w-full border rounded-lg p-2">
                            @error('card_width')
                                <span class="text-red-600 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                        <div>
                            <label class="text-sm text-gray-600">Height</label>
                            <input type="text" wire:model="card_height" class="w-full border rounded-lg p-2">
                            @error('card_height')
                                <span class="text-red-600 text-xs">{{ $message }}</span>
                            @enderror
                        </div>

                    </div>

                    <!-- Images -->
                    <div>
                        <label class="text-sm text-gray-600">Upload Images</label>
                        <input type="file" wire:model="card_images" multiple class="w-full border rounded-lg p-2">
                        @error('card_images.*')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Preview -->
                    {{-- @if ($card_images)
                        <div class="flex gap-2 flex-wrap">
                            @foreach ($card_images as $img)
                                <img src="{{ $img->temporaryUrl() }}" class="w-16 h-16 object-cover rounded border">
                            @endforeach
                        </div>
                    @endif --}}

                    <!-- Description -->
                    <div>
                        <label class="text-sm text-gray-600">Description</label>
                        <textarea wire:model="description" class="w-full border rounded-lg p-2"></textarea>
                        @error('description')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                </div>

                <!-- FOOTER -->
                <div class="flex justify-end gap-3 mt-6">

                    <button wire:click="closeModal" class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300">
                        Cancel
                    </button>

                    @if ($editId)
                        <button wire:click="update"
                            class="px-4 py-2 bg-green-600 text-white rounded-lg hover:bg-green-700">
                            Update
                        </button>
                    @else
                        <button wire:click="save" class="px-4 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                            Save
                        </button>
                    @endif

                </div>

            </div>
        </div>
    @endif

</div>
