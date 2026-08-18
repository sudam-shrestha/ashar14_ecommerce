<x-frontend-layout>
    <div class="max-w-4xl mx-auto py-8 px-4">
        <!-- Page Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-heading font-bold text-[#1F2937]">Order Details</h1>
                <p class="text-[#4B5563] mt-1">Order #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</p>
            </div>
            <div class="flex items-center gap-4">
                <a href="{{ route('orders.index') }}" class="text-[#642671] hover:text-[#54205F] font-medium flex items-center gap-2">
                    <i class="fas fa-arrow-left"></i> Back to Orders
                </a>
            </div>
        </div>

        @if(session('success'))
            <div class="bg-[#0F766E]/10 border border-[#0F766E] text-[#0F766E] px-4 py-3 rounded-xl mb-6">
                {{ session('success') }}
            </div>
        @endif

        <!-- Order Status -->
        <div class="bg-white border border-[#E5E7EB] rounded-2xl shadow-brand overflow-hidden mb-6">
            <div class="bg-[#F8F6FA] border-b border-[#E5E7EB] px-6 py-4">
                <h3 class="text-lg font-heading font-bold text-[#1F2937]">Order Status</h3>
            </div>
            <div class="p-6">
                <div class="flex items-center gap-6 flex-wrap">
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-full bg-[#642671]/10 flex items-center justify-center">
                            <i class="fas fa-check-circle text-[#642671] text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-[#4B5563]">Order Status</p>
                            <p class="font-semibold text-[#1F2937] capitalize">{{ $order->status }}</p>
                        </div>
                    </div>
                    <div class="w-px h-10 bg-[#E5E7EB]"></div>
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-full bg-[#0F766E]/10 flex items-center justify-center">
                            <i class="fas fa-money-bill-wave text-[#0F766E] text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-[#4B5563]">Payment</p>
                            <p class="font-semibold text-[#1F2937] capitalize">
                                {{ $order->payment_method }}
                                @if($order->payment_status)
                                    <span class="text-green-600 text-sm font-normal">(Paid)</span>
                                @else
                                    <span class="text-yellow-600 text-sm font-normal">(Pending)</span>
                                @endif
                            </p>
                        </div>
                    </div>
                    <div class="w-px h-10 bg-[#E5E7EB]"></div>
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 rounded-full bg-blue-100 flex items-center justify-center">
                            <i class="fas fa-calendar-day text-blue-500 text-xl"></i>
                        </div>
                        <div>
                            <p class="text-sm text-[#4B5563]">Order Date</p>
                            <p class="font-semibold text-[#1F2937]">{{ $order->created_at->format('M d, Y') }}</p>
                        </div>
                    </div>
                </div>

                <!-- Progress Bar -->
                <div class="mt-6">
                    <div class="flex items-center justify-between mb-2">
                        <span class="text-xs text-[#4B5563]">Order Placed</span>
                        <span class="text-xs text-[#4B5563]">Processing</span>
                        <span class="text-xs text-[#4B5563]">Delivered</span>
                    </div>
                    <div class="w-full bg-[#F8F6FA] rounded-full h-2 overflow-hidden">
                        <div class="h-2 rounded-full transition-all duration-500
                            @if($order->status == 'pending') w-1/3 bg-yellow-400
                            @elseif($order->status == 'processing') w-2/3 bg-blue-400
                            @elseif($order->status == 'delivered') w-full bg-green-500
                            @else w-0 bg-gray-300 @endif">
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
            <!-- Order Items -->
            <div class="lg:col-span-2">
                <div class="bg-white border border-[#E5E7EB] rounded-2xl shadow-brand overflow-hidden">
                    <div class="bg-[#F8F6FA] border-b border-[#E5E7EB] px-6 py-4 flex items-center justify-between">
                        <h3 class="text-lg font-heading font-bold text-[#1F2937]">Order Items</h3>
                        <span class="text-sm text-[#4B5563]">{{ $order->order_items->count() }} items</span>
                    </div>

                    <div class="divide-y divide-[#E5E7EB]">
                        @foreach($order->order_items as $item)
                            @php
                                $product = $item->product;
                                $discountedPrice = $product->discount > 0
                                    ? $product->price - ($product->price * $product->discount / 100)
                                    : $product->price;
                                $itemTotal = $discountedPrice * $item->qty;
                            @endphp
                            <div class="p-4 flex items-center gap-4">
                                <!-- Product Image -->
                                <div class="w-20 h-20 bg-[#F8F6FA] rounded-xl overflow-hidden flex-shrink-0">
                                    @if($product->images && count($product->images) > 0)
                                        <img src="{{ asset('storage/' . $product->images[0]) }}"
                                             alt="{{ $product->name }}"
                                             class="w-full h-full object-cover">
                                    @else
                                        <div class="w-full h-full flex items-center justify-center text-[#642671]/30">
                                            <i class="fas fa-image text-2xl"></i>
                                        </div>
                                    @endif
                                </div>

                                <!-- Product Details -->
                                <div class="flex-1">
                                    <a href="{{ route('product.details', $product->slug) }}"
                                       class="font-medium text-[#1F2937] hover:text-[#642671] transition-colors">
                                        {{ $product->name }}
                                    </a>
                                    @if($product->tags && count($product->tags) > 0)
                                        <div class="flex flex-wrap gap-1 mt-1">
                                            @foreach(array_slice($product->tags, 0, 2) as $tag)
                                                <span class="text-xs bg-[#F8F6FA] text-[#4B5563] px-2 py-0.5 rounded-full">#{{ $tag }}</span>
                                            @endforeach
                                        </div>
                                    @endif
                                    <div class="flex items-center gap-3 mt-1">
                                        <span class="text-sm font-bold text-[#1F2937]">NRs. {{ number_format($discountedPrice, 2) }}</span>
                                        @if($product->discount > 0)
                                            <span class="text-xs text-[#4B5563] line-through">NRs. {{ number_format($product->price, 2) }}</span>
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

                <!-- Vendor Info -->
                <div class="bg-white border border-[#E5E7EB] rounded-2xl shadow-brand overflow-hidden mt-6">
                    <div class="bg-[#F8F6FA] border-b border-[#E5E7EB] px-6 py-4">
                        <h3 class="text-lg font-heading font-bold text-[#1F2937]">Vendor Information</h3>
                    </div>
                    <div class="p-6">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-14 bg-[#642671]/10 rounded-full flex items-center justify-center">
                                <i class="fas fa-store text-[#642671] text-2xl"></i>
                            </div>
                            <div>
                                <p class="font-semibold text-[#1F2937]">{{ $order->dokan->dokan_name ?? 'Unknown Vendor' }}</p>
                                <p class="text-sm text-[#4B5563]">
                                    <i class="fas fa-envelope mr-1"></i> {{ $order->dokan->email ?? 'N/A' }}
                                </p>
                                <p class="text-sm text-[#4B5563]">
                                    <i class="fas fa-phone mr-1"></i> {{ $order->dokan->contact ?? 'N/A' }}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="lg:col-span-1">
                <div class="bg-white border border-[#E5E7EB] rounded-2xl shadow-brand p-6 sticky top-24">
                    <h3 class="text-lg font-heading font-bold text-[#1F2937] mb-4">Order Summary</h3>

                    <div class="space-y-3 text-sm">
                        <div class="flex justify-between">
                            <span class="text-[#4B5563]">Subtotal</span>
                            <span class="font-medium text-[#1F2937]">NRs. {{ number_format($order->total_amount, 2) }}</span>
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
                                <span class="text-[#642671]">NRs. {{ number_format($order->total_amount, 2) }}</span>
                            </div>
                        </div>
                    </div>

                    <div class="mt-6 space-y-2 text-sm">
                        <div class="flex justify-between">
                            <span class="text-[#4B5563]">Payment Method</span>
                            <span class="font-medium text-[#1F2937] capitalize">{{ $order->payment_method }}</span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-[#4B5563]">Payment Status</span>
                            <span class="font-medium text-[#1F2937]">
                                @if($order->payment_status)
                                    <span class="text-green-600">Paid</span>
                                @else
                                    <span class="text-yellow-600">Pending</span>
                                @endif
                            </span>
                        </div>
                        <div class="flex justify-between">
                            <span class="text-[#4B5563]">Order Status</span>
                            <span class="font-medium text-[#1F2937] capitalize">{{ $order->status }}</span>
                        </div>
                    </div>

                    @if($order->status == 'pending')
                        <div class="mt-6 p-4 bg-yellow-50 border border-yellow-200 rounded-xl">
                            <p class="text-sm text-yellow-800">
                                <i class="fas fa-clock mr-2"></i>
                                Your order is being processed. You will receive a confirmation soon.
                            </p>
                        </div>
                    @elseif($order->status == 'delivered')
                        <div class="mt-6 p-4 bg-green-50 border border-green-200 rounded-xl">
                            <p class="text-sm text-green-800">
                                <i class="fas fa-check-circle mr-2"></i>
                                Your order has been delivered. Thank you for shopping with us!
                            </p>
                        </div>
                    @endif

                    <a href="{{ route('products') }}"
                       class="block text-center mt-6 text-[#642671] hover:text-[#54205F] font-medium text-sm transition-colors">
                        <i class="fas fa-shopping-bag mr-1"></i> Continue Shopping
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-frontend-layout>
