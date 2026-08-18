<x-frontend-layout>
    <div class="max-w-7xl mx-auto py-8 px-4">
        <!-- Page Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-heading font-bold text-[#1F2937]">Shopping Cart</h1>
                <p class="text-[#4B5563] mt-1">{{ $totalItems }} items in your cart</p>
            </div>
            <a href="{{ route('home') }}" class="text-[#642671] hover:text-[#54205F] font-medium flex items-center gap-2">
                <i class="fas fa-arrow-left"></i> Continue Shopping
            </a>
        </div>

        @if ($carts->count() > 0)
            <div class="grid grid-cols-1 gap-8">
                <!-- Cart Items -->
                <div class="space-y-6">
                    @foreach ($groupedCarts as $dokanId => $items)
                        @php
                            $dokan = $items->first()->dokan;
                            $vendorSubtotal = $items->sum(function ($item) {
                                $price = $item->product->discount > 0
                                    ? $item->product->price - ($item->product->price * $item->product->discount / 100)
                                    : $item->product->price;
                                return $price * $item->qty;
                            });
                        @endphp

                        <!-- Vendor Group -->
                        <div class="bg-white border border-[#E5E7EB] rounded-2xl shadow-brand overflow-hidden">
                            <!-- Vendor Header -->
                            <div class="bg-[#F8F6FA] border-b border-[#E5E7EB] px-6 py-4 flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div class="w-10 h-10 bg-[#642671]/10 rounded-full flex items-center justify-center">
                                        <i class="fas fa-store text-[#642671]"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-[#1F2937]">
                                            {{ $dokan->dokan_name ?? 'Unknown Vendor' }}
                                        </h3>
                                        <p class="text-xs text-[#4B5563]">{{ $items->count() }} items</p>
                                    </div>
                                </div>
                                <div class="flex items-center gap-4">
                                    <span class="text-sm font-medium text-[#1F2937]">
                                        Subtotal: NRs. {{ number_format($vendorSubtotal, 2) }}
                                    </span>
                                    <!-- Checkout Button for this vendor -->
                                    <form action="{{ route('checkout') }}" method="GET">
                                        @csrf
                                        <input type="hidden" name="dokan_id" value="{{ $dokanId }}">
                                        <button type="submit"
                                                class="bg-[#0F766E] hover:bg-[#0D6B63] text-white text-sm font-medium px-4 py-2 rounded-full transition-colors flex items-center gap-1">
                                            <i class="fas fa-shopping-cart"></i> Checkout
                                        </button>
                                    </form>
                                </div>
                            </div>

                            <!-- Vendor Items -->
                            <div class="divide-y divide-[#E5E7EB]">
                                @foreach ($items as $item)
                                    @php
                                        $product = $item->product;
                                        $discountedPrice = $product->discount > 0
                                            ? $product->price - ($product->price * $product->discount / 100)
                                            : $product->price;
                                        $itemTotal = $discountedPrice * $item->qty;
                                    @endphp
                                    <div class="p-4 flex items-center gap-4">
                                        <!-- Product Image -->
                                        <div class="w-24 h-24 bg-[#F8F6FA] rounded-xl overflow-hidden flex-shrink-0">
                                            @if ($product->images && count($product->images) > 0)
                                                <img src="{{ asset('storage/' . $product->images[0]) }}"
                                                    alt="{{ $product->name }}" class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-[#642671]/30">
                                                    <i class="fas fa-image text-3xl"></i>
                                                </div>
                                            @endif
                                        </div>

                                        <!-- Product Details -->
                                        <div class="flex-1 min-w-0">
                                            <a href="{{ route('product.details', $product->slug) }}"
                                                class="text-[#1F2937] font-medium hover:text-[#642671] transition-colors line-clamp-1">
                                                {{ $product->name }}
                                            </a>
                                            @if ($product->tags && count($product->tags) > 0)
                                                <div class="flex flex-wrap gap-1 mt-1">
                                                    @foreach (array_slice($product->tags, 0, 2) as $tag)
                                                        <span class="text-xs bg-[#F8F6FA] text-[#4B5563] px-2 py-0.5 rounded-full">#{{ $tag }}</span>
                                                    @endforeach
                                                </div>
                                            @endif
                                            <div class="flex items-center gap-3 mt-2">
                                                <span class="text-lg font-bold text-[#1F2937]">NRs. {{ number_format($discountedPrice, 2) }}</span>
                                                @if ($product->discount > 0)
                                                    <span class="text-sm text-[#4B5563] line-through">NRs. {{ number_format($product->price, 2) }}</span>
                                                    <span class="text-xs bg-[#0F766E]/10 text-[#0F766E] px-2 py-0.5 rounded-full">-{{ $product->discount }}%</span>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Quantity & Actions -->
                                        <div class="flex flex-col items-end gap-2">
                                            <!-- Quantity Selector -->
                                            <form action="{{ route('cart.update') }}" method="POST" class="flex items-center">
                                                @csrf
                                                <input type="hidden" name="cart_id" value="{{ $item->id }}">
                                                <div class="flex items-center border border-[#E5E7EB] rounded-lg overflow-hidden">
                                                    <button type="submit" name="qty" value="{{ $item->qty - 1 }}"
                                                            class="px-3 py-1 bg-[#F8F6FA] hover:bg-[#E5E7EB] transition-colors text-[#1F2937]">
                                                        <i class="fas fa-minus text-xs"></i>
                                                    </button>
                                                    <span class="px-4 py-1 text-[#1F2937] font-medium min-w-[30px] text-center">
                                                        {{ $item->qty }}
                                                    </span>
                                                    <button type="submit" name="qty" value="{{ $item->qty + 1 }}"
                                                            class="px-3 py-1 bg-[#F8F6FA] hover:bg-[#E5E7EB] transition-colors text-[#1F2937]">
                                                        <i class="fas fa-plus text-xs"></i>
                                                    </button>
                                                </div>
                                            </form>

                                            <!-- Item Total & Remove -->
                                            <div class="flex items-center gap-3">
                                                <span class="text-sm font-medium text-[#1F2937]">
                                                    NRs. {{ number_format($itemTotal, 2) }}
                                                </span>
                                                <form action="{{ route('cart.remove') }}" method="POST" onsubmit="return confirm('Are you sure you want to remove this item?')">
                                                    @csrf
                                                    <input type="hidden" name="cart_id" value="{{ $item->id }}">
                                                    <button type="submit" class="text-red-500 hover:text-red-700 transition-colors">
                                                        <i class="fas fa-trash-alt"></i>
                                                    </button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Cart Summary -->
                <div class="lg:col-span-1">
                    <div class="bg-white border border-[#E5E7EB] rounded-2xl shadow-brand p-6">
                        <h3 class="text-lg font-heading font-bold text-[#1F2937] mb-4">Order Summary</h3>

                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between">
                                <span class="text-[#4B5563]">Subtotal ({{ $totalItems }} items)</span>
                                <span class="font-medium text-[#1F2937]">NRs. {{ number_format($subtotal, 2) }}</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-[#4B5563]">Shipping</span>
                                <span class="font-medium text-[#1F2937]">Calculated at checkout</span>
                            </div>
                            <div class="flex justify-between">
                                <span class="text-[#4B5563]">Tax</span>
                                <span class="font-medium text-[#1F2937]">Included</span>
                            </div>
                            <div class="border-t border-[#E5E7EB] pt-3 mt-3">
                                <div class="flex justify-between text-lg font-bold">
                                    <span class="text-[#1F2937]">Total</span>
                                    <span class="text-[#642671]">NRs. {{ number_format($subtotal, 2) }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Clear Cart -->
                        <form action="{{ route('cart.clear') }}" method="POST" onsubmit="return confirm('Are you sure you want to clear your entire cart?')">
                            @csrf
                            <button type="submit" class="w-full mt-3 text-red-500 hover:text-red-700 font-medium text-sm transition-colors">
                                <i class="fas fa-trash-alt mr-1"></i> Clear Cart
                            </button>
                        </form>

                        <!-- Continue Shopping -->
                        <a href="{{ route('products') }}"
                            class="block text-center mt-4 text-[#642671] hover:text-[#54205F] font-medium text-sm transition-colors">
                            <i class="fas fa-arrow-left mr-1"></i> Continue Shopping
                        </a>
                    </div>
                </div>
            </div>
        @else
            <!-- Empty Cart -->
            <div class="bg-white border border-[#E5E7EB] rounded-2xl shadow-brand p-12 text-center">
                <div class="w-24 h-24 bg-[#F8F6FA] rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-shopping-bag text-4xl text-[#642671]/40"></i>
                </div>
                <h2 class="text-2xl font-heading font-bold text-[#1F2937] mb-2">Your cart is empty</h2>
                <p class="text-[#4B5563] mb-6">Looks like you haven't added any items to your cart yet.</p>
                <a href="{{ route('products') }}"
                    class="inline-block bg-[#642671] hover:bg-[#54205F] text-white font-medium px-8 py-3 rounded-xl shadow-lg shadow-[#642671]/20 transition-all duration-200">
                    <i class="fas fa-shopping-bag mr-2"></i> Start Shopping
                </a>
            </div>
        @endif
    </div>
</x-frontend-layout>
