<x-layouts.user>

<div class="max-w-7xl mx-auto px-4 py-10">

    <div class="grid grid-cols-1 md:grid-cols-2 gap-10">

       <div class="relative">

		    <!-- 🔥 ZOOM CONTAINER -->
		    <div id="imageContainer"
		        class="w-full h-[450px] bg-gray-100 rounded-2xl overflow-hidden shadow relative">

		        <img id="mainImage"
		            src="{{ $product->images[0]->image ?? '' }}"
		            class="w-full h-full object-cover">

		    </div>

		    <!-- 🔥 THUMBNAILS -->
		    <div class="flex gap-3 mt-4">
		        @foreach ($product->images as $img)
		            <img src="{{ $img->image }}"
		                onmouseover="changeImage('{{ $img->image }}')"
		                class="w-16 h-16 rounded-xl object-cover cursor-pointer border hover:border-blue-500 hover:scale-110 transition">
		        @endforeach
		    </div>

		</div>

        <!-- 🔥 RIGHT: PRODUCT INFO -->
        <div class="flex flex-col justify-between">

            <div>

                <!-- CATEGORY -->
                <span class="text-sm text-blue-600 font-medium uppercase tracking-wide">
                    {{ $product->type->name ?? 'Category' }}
                </span>

                <!-- TITLE -->
                <h1 class="text-3xl font-bold text-gray-900 mt-2 mb-4">
                    {{ $product->name }}
                </h1>

                <!-- PRICE -->
                <div class="text-3xl font-bold text-gray-900 mb-4">
                    ₹ {{ $product->price }}
                </div>

                <!-- SIZE -->
                <div class="text-gray-500 mb-6">
                    Size: {{ $product->card_width }} × {{ $product->card_height }}
                </div>

                <!-- DESCRIPTION -->
                <p class="text-gray-600 leading-relaxed mb-6">
                    {{ $product->description ?? 'No description available.' }}
                </p>

                <!-- TAGS -->
               <!--  <div class="flex gap-2 mb-6 flex-wrap">
                    <span class="px-3 py-1 bg-gray-100 rounded-full text-sm">Premium</span>
                    <span class="px-3 py-1 bg-gray-100 rounded-full text-sm">Trending</span>
                    <span class="px-3 py-1 bg-gray-100 rounded-full text-sm">Best Seller</span>
                </div> -->

            </div>

            <!-- 🔥 ACTION BUTTONS -->
            <div class="flex gap-4 mt-8">

                <button
                    class="flex-1 bg-gradient-to-r from-blue-600 to-indigo-600 text-white py-3 rounded-xl font-semibold hover:opacity-90 transition shadow-lg">
                    Add to Cart
                </button>

                <button
                    class="px-6 py-3 border rounded-xl hover:bg-gray-100 transition">
                    ❤️
                </button>

            </div>

        </div>

    </div>

</div>

<script>
   
    const container = document.getElementById('imageContainer');
    const img = document.getElementById('mainImage');

    function changeImage(src) {
        img.src = src;
    }

    container.addEventListener('mousemove', function (e) {
        const rect = container.getBoundingClientRect();

        const x = ((e.clientX - rect.left) / rect.width) * 100;
        const y = ((e.clientY - rect.top) / rect.height) * 100;

        img.style.transform = "scale(2)";
        img.style.transformOrigin = `${x}% ${y}%`;
    });

    container.addEventListener('mouseleave', function () {
        img.style.transform = "scale(1)";
    });

</script>

</x-layouts.user>