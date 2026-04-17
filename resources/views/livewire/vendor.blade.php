 <div>

    <!-- Add Button -->
    <button wire:click="openModal" class="bg-blue-600 text-white px-4 py-2 rounded mb-4">
        + Add Vendor
    </button>

    <!-- TABLE -->
    <table class="w-full border text-center">
        <thead class="bg-gray-200">
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>Email</th>
                <th>Mobile</th>
                <th>Role</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>
            @foreach($vendor as $key=>$data)
            <tr>
                <td>{{++$key}}</td>
                <td>{{ @$data->name }}</td>
                <td>{{ @$data->email }}</td>
                <td>{{ @$data->mobile }}</td>
                <td>{{ @$data->role }}</td>
                <td>

                    <button wire:click="edit({{ $data->id }})" class="bg-yellow-500 px-2 py-1 text-white rounded">
                            Edit
                        </button>

                        <button wire:click="delete({{ $data->id }})" class="bg-red-600 px-2 py-1 text-white rounded">
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
                        {{ $editId ? 'Edit Vendor' : 'Add Vendor' }}
                    </h2>

                    <button wire:click="closeModal" class="text-gray-500 hover:text-black text-xl">
                        ✕
                    </button>
                </div>

                <!-- FORM -->
                <div class="space-y-4">

                    <!-- Name -->
                    <div>
                        <label class="text-sm text-gray-600">Name</label>
                        <input type="text" wire:model="name"
                            class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
                        @error('name')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                    </div>

                    <!-- Email -->
                    <div>
                        <label class="text-sm text-gray-600">Email</label>
                        <input type="email" wire:model="email"
                            class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
                        @error('email')
                            <span class="text-red-600 text-xs">{{ $message }}</span>
                        @enderror
                    </div>


                     <!-- Mobile -->
                    <div>
                        <label class="text-sm text-gray-600">Mobile</label>
                        <input type="text" wire:model="mobile"
                            class="w-full border rounded-lg p-2 focus:ring-2 focus:ring-blue-500">
                        @error('mobile')
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

