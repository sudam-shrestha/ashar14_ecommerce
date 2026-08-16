<x-frontend-layout>
    <div class="max-w-7xl mx-auto py-8 px-4">
        @if ($q)
            <div class="flex items-center justify-between mb-6">
                <h1 class="text-3xl font-heading font-bold text-[#1F2937] mb-8">Search Results for: <span
                        class="text-[#642671]">"{{ $q }}"</span></h1>
                <a href="{{ route('products') }}"
                    class="text-[#642671] hover:text-[#54205F] text-sm font-medium flex items-center gap-1">
                    all products <i class="fas fa-arrow-right text-xs"></i>
                </a>
            </div>
        @else
            <h1 class="text-3xl font-heading font-bold text-[#1F2937] mb-8">All Products</h1>
        @endif

        @if (count($products) > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach ($products as $product)
                    <x-product-card :product="$product" />
                @endforeach
            </div>
        @else
            <!-- No Products Message -->
            <div class="bg-white border border-[#E5E7EB] rounded-xl shadow-brand p-12 text-center">
                <i class="fas fa-box-open text-6xl text-[#642671]/20 mb-4"></i>
                <h3 class="text-xl font-heading font-semibold text-[#1F2937] mb-2">No Products Available</h3>
                <p class="text-[#4B5563]">Be the first vendor to list a product on CodeIT Dokan!</p>
                <a href="{{ route('dokan.index') }}"
                    class="inline-block mt-4 bg-[#642671] hover:bg-[#54205F] text-white px-6 py-2.5 rounded-full font-medium transition-colors">
                    Start Selling Now
                </a>
            </div>
        @endif

        <div class="mt-8">
            {{ $products->links() }}
        </div>
    </div>
</x-frontend-layout>
