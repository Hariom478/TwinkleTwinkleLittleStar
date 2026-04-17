<div class="relative">

    <!-- Add Button -->
    <button wire:click="openModal"
        class="bg-blue-600 text-white px-4 py-2 rounded mb-4">
        + Add Product Type
    </button>
    <!-- Table -->
    <table class="w-full border text-center">
        <thead class="bg-gray-200">
            <tr>
                <th>Sr.No</th>
                <th>Name</th>
                <th>Description</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach($types as $index => $type)
            <tr>
                <td>{{ $index+1 }}</td>
                <td>{{ $type->name }}</td>
                <td>{{ $type->description }}</td>
                <td>
                    <button wire:click="edit({{ $type->id }})"
                        class="bg-amber-600 text-white px-2 py-1 rounded">
                        Edit
                    </button>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- Modal -->
    @if($showModal)
    <div
        class="fixed inset-0 z-[9999] flex items-center justify-center bg-black/50"
        wire:click.self="closeModal"
    >

        <div class="bg-white p-6 rounded-lg shadow-lg w-96 relative">

            <h2 class="text-lg font-bold mb-4">
                {{ $editId ? 'Edit Product Type' : 'Add Product Type' }}
            </h2>

            <input type="text" wire:model="name"
                placeholder="Name"
                class="w-full border p-2 mb-2 rounded">
                @error('name')
                    <span class="text-red-600 text-sm">{{ $message }}</span>
                @enderror

            <textarea wire:model="description"
                placeholder="Description"
                class="w-full border p-2 mb-4 rounded">
            </textarea>
            @error('description')
                <span class="text-red-600 text-sm">{{ $message }}</span>
            @enderror

            <div class="flex justify-end gap-2">

                <button wire:click="closeModal"
                    class="bg-red-600 text-white px-3 py-1 rounded">
                    Cancel
                </button>

                @if($editId)
                    <button wire:click="update"
                        class="bg-blue-600 text-white px-3 py-1 rounded">
                        Update
                    </button>
                @else
                    <button wire:click="save"
                        class="bg-blue-600 text-white px-3 py-1 rounded">
                        Save
                    </button>
                @endif

            </div>

        </div>

    </div>
    @endif

</div>
