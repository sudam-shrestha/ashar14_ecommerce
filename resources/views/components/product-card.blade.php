@props(['product'])
<div
    class="bg-white border border-[#E5E7EB] rounded-xl shadow-brand overflow-hidden hover:shadow-xl transition-shadow group">
    <!-- Product Image -->
    <div class="h-48 bg-[#F8F6FA] flex items-center justify-center overflow-hidden relative">
        @if ($product->images && count($product->images) > 0)
            <a href="{{ route('product.details', $product->slug) }}">
                <img src="{{ asset('storage/' . $product->images[0]) }}" alt="{{ $product->name }}"
                    class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-300">
            </a>
        @else
            <i class="fas fa-image text-5xl text-[#642671]/30"></i>
        @endif

        <!-- Discount Badge -->
        @if ($product->discount > 0)
            <span class="absolute top-2 right-2 bg-[#0F766E] text-white text-xs font-bold px-2 py-1 rounded-full">
                -{{ $product->discount }}%
            </span>
        @endif
    </div>

    <div class="p-4">
        <!-- Product Name -->
        <h3 class="font-heading font-semibold text-[#1F2937] hover:text-[#642671] transition-colors line-clamp-1">
            <a href="{{ route('product.details', $product->slug) }}">{{ $product->name }}</a>
        </h3>

        <!-- Tags -->
        @if ($product->tags && count($product->tags) > 0)
            <div class="flex flex-wrap gap-1 mt-1">
                @foreach (array_slice($product->tags, 0, 2) as $tag)
                    <span
                        class="text-xs bg-[#F8F6FA] text-[#4B5563] px-2 py-0.5 rounded-full">{{ $tag }}</span>
                @endforeach
                @if (count($product->tags) > 2)
                    <span class="text-xs text-[#4B5563]">+{{ count($product->tags) - 2 }}</span>
                @endif
            </div>
        @endif

        <!-- Rating Placeholder -->
        <div class="flex items-center gap-1 text-sm text-yellow-400 mt-1">
            <i class="fas fa-star"></i><i class="fas fa-star"></i><i class="fas fa-star"></i><i
                class="fas fa-star"></i><i class="fas fa-star-half-alt"></i>
            <span class="text-[#4B5563] text-xs ml-1">({{ rand(5, 50) }})</span>
        </div>

        <!-- Price -->
        <div class="flex items-center gap-2 mt-1">
            @if ($product->discount > 0)
                @php
                    $discountedPrice = $product->price - ($product->price * $product->discount) / 100;
                @endphp
                <span class="text-lg font-bold text-[#1F2937]">NRs. {{ number_format($discountedPrice, 2) }}</span>
                <span class="text-sm text-[#4B5563] line-through">NRs. {{ number_format($product->price, 2) }}</span>
                <span
                    class="text-xs bg-[#0F766E]/10 text-[#0F766E] px-2 py-0.5 rounded-full">-{{ $product->discount }}%</span>
            @else
                <span class="text-lg font-bold text-[#1F2937]">NRs. {{ number_format($product->price, 2) }}</span>
            @endif
        </div>

        <!-- Vendor & Add to Cart -->
        <div class="flex items-center justify-between mt-3">
            <span class="text-xs text-[#4B5563]">
                <i class="fas fa-store mr-1"></i>
                {{ $product->dokan->dokan_name ?? 'Unknown Vendor' }}
            </span>
            <button onclick="addToCart({{ $product->id }})"
                class="bg-[#642671] hover:bg-[#54205F] text-white text-sm px-4 py-1.5 rounded-full transition-colors flex items-center gap-1">
                <i class="fas fa-shopping-cart text-xs"></i> Add
            </button>
        </div>
    </div>
</div>
