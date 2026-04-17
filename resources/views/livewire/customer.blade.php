<div>

    <!-- 🔥 CATEGORY SCROLL -->
    <div class="flex gap-3 overflow-x-auto pb-4 mb-10">
        @foreach ($types as $type)
            <button wire:click="selectType({{ $type->id }})"
                class="px-5 py-2 rounded-full text-sm font-medium whitespace-nowrap transition-all duration-300
                {{ $selectedType == $type->id
                    ? 'bg-gradient-to-r bg-blue-600 to-indigo-600 text-white shadow-lg scale-105'
                    : 'bg-white border hover:bg-blue-50 hover:border-blue-400' }}">
                {{ $type->name }}
            </button>
        @endforeach
    </div>

    <!-- 🔥 PRODUCTS GRID (IMPORTANT FIX) -->
    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-10">

        @foreach ($products as $product)
            <div
                class="bg-white rounded-2xl shadow-md hover:shadow-2xl transition duration-300 overflow-hidden group relative">

                <!-- 🔥 BADGE -->
                <div class="absolute top-3 left-3 bg-red-500 text-white text-xs px-2 py-1 rounded z-10">
                    NEW
                </div>

                <!-- 🔥 IMAGE -->
                <div class="w-full h-[320px] overflow-hidden bg-gray-100">
                    <img id="mainImage-{{ $product->id }}" src="{{ $product->images[0]->image ?? '' }}"
                        class="w-full h-full object-cover transition duration-500 group-hover:scale-110" height="100%" width="100%">
                </div>

                <!-- 🔥 CONTENT -->
                <div class="p-4">

                    <!-- PRICE -->
                    <div class="text-xl font-bold text-gray-900 mb-1">
                        ₹ {{ $product->price }}
                    </div>

                    <!-- SIZE -->
                    <div class="text-sm text-gray-500 mb-3">
                        {{ $product->card_width }} × {{ $product->card_height }}
                    </div>

                    <!-- 🔥 THUMBNAILS -->
                    <div class="flex gap-2 mb-4">
                        @foreach ($product->images as $img)
                            <img src="{{ $img->image }}"
                                onclick="changeImage('{{ $product->id }}','{{ $img->image }}')"
                                class="w-12 h-12 object-cover rounded-lg cursor-pointer border hover:scale-110 hover:border-blue-500 transition">
                        @endforeach
                    </div>

                    <!-- 🔥 BUTTON -->
                    <button
                        onclick="ViewButton('{{ encrypt($product->id) }}')"
                        class="w-full bg-gradient-to-r from-blue-600 to-indigo-600 text-white py-2.5 rounded-xl font-semibold hover:opacity-90 transition">
                        View Product
                    </button>

                </div>

            </div>
        @endforeach

    </div>

</div>

<script>
    function changeImage(productId, src) {
        const mainImg = document.getElementById('mainImage-' + productId);
        if (mainImg) {
            mainImg.src = src;
        }
    }

    function ViewButton(id)
    {
         window.location.href = "/product-details/" + id;
    }
</script>
