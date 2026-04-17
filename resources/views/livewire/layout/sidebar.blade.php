<div class="p-4 space-y-2">

    <a href="{{ route('dashboard') }}"
        class="block px-4 py-2 rounded
   {{ request()->routeIs('dashboard') ? 'bg-gray-800' : 'hover:bg-gray-700' }}">
        Dashboard
    </a>

    @if(auth()->user()->role=="admin")

     <a href="{{ route('product-type') }}"
        class="block px-4 py-2 rounded
        {{ request()->routeIs('product-type') ? 'bg-gray-800' : 'hover:bg-gray-700' }}">
        Product Type
    </a>

    <a href="{{ route('admin.vendor') }}"
        class="block px-4 py-2 rounded
    {{ request()->routeIs('admin.vendor') ? 'bg-gray-800' : 'hover:bg-gray-700' }}">
            Vendor
    </a>
    
    @endif

     <a href="{{ route('product') }}"
        class="block px-4 py-2 rounded
   {{ request()->routeIs('product') ? 'bg-gray-800' : 'hover:bg-gray-700' }}">
        Product Mgmt
    </a>

</div>
