<x-frontend-layout>
    <div class="max-w-4xl mx-auto py-8 px-4">
        <!-- Page Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-heading font-bold text-[#1F2937]">Checkout</h1>
                <p class="text-[#4B5563] mt-1">Review your order and complete payment</p>
            </div>
            <a href="{{ route('cart.index') }}"
                class="text-[#642671] hover:text-[#54205F] font-medium flex items-center gap-2">
                <i class="fas fa-arrow-left"></i> Back to Cart
            </a>
        </div>

        @if (session('success'))
            <div class="bg-[#0F766E]/10 border border-[#0F766E] text-[#0F766E] px-4 py-3 rounded-xl mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if (session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mb-6">
                {{ session('error') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Order Items -->
            <div class="lg:col-span-2 space-y-6">
                <!-- Vendor Info -->
                <div class="bg-white border border-[#E5E7EB] rounded-2xl shadow-brand overflow-hidden">
                    <div class="bg-[#F8F6FA] border-b border-[#E5E7EB] px-6 py-4 flex items-center gap-3">
                        <div class="w-10 h-10 bg-[#642671]/10 rounded-full flex items-center justify-center">
                            <i class="fas fa-store text-[#642671]"></i>
                        </div>
                        <div>
                            <h3 class="font-semibold text-[#1F2937]">{{ $dokan->dokan_name ?? 'Unknown Vendor' }}</h3>
                            <p class="text-xs text-[#4B5563]">{{ $totalItems }} items</p>
                        </div>
                    </div>

                    <div class="divide-y divide-[#E5E7EB]">
                        @foreach ($cartItems as $item)
                            @php
                                $product = $item->product;
                                $discountedPrice =
                                    $product->discount > 0
                                        ? $product->price - ($product->price * $product->discount) / 100
                                        : $product->price;
                                $itemTotal = $discountedPrice * $item->qty;
                            @endphp
                            <div class="p-4 flex items-center gap-4">
                                <!-- Product Image -->
                                <div class="w-20 h-20 bg-[#F8F6FA] rounded-xl overflow-hidden flex-shrink-0">
                                    @if ($product->images && count($product->images) > 0)
                                        <img src="{{ asset('storage/' . $product->images[0]) }}"
                                            alt="{{ $product->name }}" class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-[#642671]/30">
                                            <i class="fas fa-image text-2xl"></i>
                                        </div>
                                    @endif
                                </div>

                                <!-- Product Details -->
                                <div class="flex-1">
                                    <h4 class="font-medium text-[#1F2937]">{{ $product->name }}</h4>
                                    <div class="flex items-center gap-3 mt-1">
                                        <span class="text-sm font-bold text-[#1F2937]">NRs.
                                            {{ number_format($discountedPrice, 2) }}</span>
                                        @if ($product->discount > 0)
                                            <span class="text-xs text-[#4B5563] line-through">NRs.
                                                {{ number_format($product->price, 2) }}</span>
                                        @endif
                                        <span class="text-xs text-[#4B5563]">× {{ $item->qty }}</span>
                                    </div>
                                </div>

                                <!-- Item Total -->
                                <span class="font-medium text-[#1F2937]">NRs. {{ number_format($itemTotal, 2) }}</span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white border border-[#E5E7EB] rounded-2xl shadow-brand p-6 sticky top-24">
                    <h3 class="text-lg font-heading font-bold text-[#1F2937] mb-4">Order Summary</h3>

                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-[#4B5563]">Subtotal ({{ $totalItems }} items)</span>
                            <span class="font-medium text-[#1F2937]">NRs. {{ number_format($subtotal, 2) }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-[#4B5563]">Shipping</span>
                            <span class="font-medium text-[#1F2937]">Free</span>
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

                    <!-- Place Order Form -->
                    <form action="{{ route('order.place') }}" method="POST" class="mt-6">
                        @csrf
                        <input type="hidden" name="dokan_id" value="{{ $dokanId }}">

                        <!-- Payment Method -->
                        <div class="mb-4">
                            <label class="block text-sm font-medium text-[#1F2937] mb-3">Payment Method</label>
                            <div class="space-y-2">
                                <label
                                    class="flex items-center gap-3 p-3 border border-[#E5E7EB] rounded-xl cursor-pointer hover:bg-[#F8F6FA] transition-colors">
                                    <input type="radio" name="payment_method" value="cod" checked
                                        class="w-4 h-4 text-[#642671]">
                                    <div class="flex-1">
                                        <span class="font-medium text-[#1F2937]">Cash on Delivery</span>
                                        <p class="text-xs text-[#4B5563]">Pay when you receive your order</p>
                                    </div>
                                    <i class="fas fa-money-bill-wave text-xl text-[#0F766E]"></i>
                                </label>
                                <label
                                    class="flex items-center gap-3 p-3 border border-[#E5E7EB] rounded-xl cursor-pointer hover:bg-[#F8F6FA] transition-colors">
                                    <input type="radio" name="payment_method" value="khalti" class="w-4 h-4">
                                    <div class="flex-1">
                                        <span class="font-medium text-[#1F2937]">Khalti</span>
                                        <p class="text-xs text-[#4B5563]">Coming soon</p>
                                    </div>
                                    <i class="fas fa-wallet text-xl text-[#4B5563]"></i>
                                </label>
                            </div>
                            @error('payment_method')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>

                        <button type="submit"
                            class="w-full bg-[#642671] hover:bg-[#54205F] text-white font-medium py-3 px-4 rounded-xl shadow-lg shadow-[#642671]/20 transition-all duration-200 flex items-center justify-center gap-2">
                            <i class="fas fa-check-circle"></i> Place Order
                        </button>
                    </form>

                    <p class="text-center text-xs text-[#4B5563] mt-3">
                        By placing order, you agree to our terms and conditions
                    </p>
                </div>
            </div>
        </div>
    </div>
</x-frontend-layout>
