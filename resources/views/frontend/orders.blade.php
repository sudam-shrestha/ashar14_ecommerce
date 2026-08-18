<x-frontend-layout>
    <div class="max-w-7xl mx-auto py-8 px-4">
        <!-- Page Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-heading font-bold text-[#1F2937]">My Orders</h1>
                <p class="text-[#4B5563] mt-1">View all your orders and their status</p>
            </div>
            <a href="{{ route('home') }}" class="text-[#642671] hover:text-[#54205F] font-medium flex items-center gap-2">
                <i class="fas fa-arrow-left"></i> Continue Shopping
            </a>
        </div>

        @if(session('success'))
            <div class="bg-[#0F766E]/10 border border-[#0F766E] text-[#0F766E] px-4 py-3 rounded-xl mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if($orders->count() > 0)
            <div class="space-y-4">
                @foreach($orders as $order)
                    <div class="bg-white border border-[#E5E7EB] rounded-2xl shadow-brand overflow-hidden hover:shadow-lg transition-shadow">
                        <!-- Order Header -->
                        <div class="bg-[#F8F6FA] border-b border-[#E5E7EB] px-6 py-4 flex flex-wrap items-center justify-between gap-4">
                            <div class="flex items-center gap-4">
                                <div class="flex items-center gap-2">
                                    <span class="text-sm text-[#4B5563]">Order #</span>
                                    <span class="font-bold text-[#1F2937]">{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}</span>
                                </div>
                                <span class="text-xs text-[#4B5563]">|</span>
                                <div class="flex items-center gap-2">
                                    <i class="fas fa-store text-[#642671]"></i>
                                    <span class="text-sm font-medium text-[#1F2937]">{{ $order->dokan->dokan_name ?? 'Unknown Vendor' }}</span>
                                </div>
                            </div>
                            <div class="flex items-center gap-4 flex-wrap">
                                <span class="text-sm text-[#4B5563]">
                                    <i class="far fa-calendar-alt mr-1"></i>
                                    {{ $order->created_at->format('M d, Y') }}
                                </span>
                                <span class="text-sm text-[#4B5563]">
                                    <i class="far fa-clock mr-1"></i>
                                    {{ $order->created_at->format('g:i A') }}
                                </span>
                                <span class="text-sm font-medium text-[#1F2937]">
                                    NRs. {{ number_format($order->total_amount, 2) }}
                                </span>
                                <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium
                                    @if($order->status == 'pending') bg-yellow-100 text-yellow-800
                                    @elseif($order->status == 'processing') bg-blue-100 text-blue-800
                                    @elseif($order->status == 'delivered') bg-green-100 text-green-800
                                    @else bg-gray-100 text-gray-800 @endif">
                                    {{ ucfirst($order->status) }}
                                </span>
                                @if($order->payment_status)
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-green-100 text-green-800">
                                        <i class="fas fa-check-circle mr-1"></i> Paid
                                    </span>
                                @else
                                    <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-yellow-100 text-yellow-800">
                                        <i class="fas fa-clock mr-1"></i> Pending Payment
                                    </span>
                                @endif
                            </div>
                        </div>

                        <!-- Order Items Preview -->
                        <div class="p-6">
                            <div class="flex items-center justify-between">
                                <div class="flex items-center gap-4">
                                    @php
                                        $items = $order->order_items->take(3);
                                        $remaining = $order->order_items->count() - 3;
                                    @endphp
                                    @foreach($items as $item)
                                        <div class="w-16 h-16 bg-[#F8F6FA] rounded-xl overflow-hidden flex-shrink-0">
                                            @if($item->product->images && count($item->product->images) > 0)
                                                <img src="{{ asset('storage/' . $item->product->images[0]) }}"
                                                     alt="{{ $item->product->name }}"
                                                     class="w-full h-full object-cover">
                                            @else
                                                <div class="w-full h-full flex items-center justify-center text-[#642671]/30">
                                                    <i class="fas fa-image text-2xl"></i>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                    @if($remaining > 0)
                                        <div class="w-16 h-16 bg-[#F8F6FA] rounded-xl flex items-center justify-center text-sm font-medium text-[#4B5563]">
                                            +{{ $remaining }}
                                        </div>
                                    @endif
                                </div>
                                <div class="flex items-center gap-4">
                                    <span class="text-sm text-[#4B5563]">
                                        {{ $order->order_items->count() }} items
                                    </span>
                                    <a href="{{ route('order.details', $order->id) }}"
                                       class="bg-[#642671] hover:bg-[#54205F] text-white text-sm font-medium px-4 py-2 rounded-full transition-colors">
                                        View Details
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $orders->links() }}
            </div>
        @else
            <!-- Empty Orders -->
            <div class="bg-white border border-[#E5E7EB] rounded-2xl shadow-brand p-12 text-center">
                <div class="w-24 h-24 bg-[#F8F6FA] rounded-full flex items-center justify-center mx-auto mb-6">
                    <i class="fas fa-shopping-bag text-4xl text-[#642671]/40"></i>
                </div>
                <h2 class="text-2xl font-heading font-bold text-[#1F2937] mb-2">No orders yet</h2>
                <p class="text-[#4B5563] mb-6">You haven't placed any orders yet. Start shopping now!</p>
                <a href="{{ route('products') }}"
                   class="inline-block bg-[#642671] hover:bg-[#54205F] text-white font-medium px-8 py-3 rounded-xl shadow-lg shadow-[#642671]/20 transition-all duration-200">
                    <i class="fas fa-shopping-bag mr-2"></i> Start Shopping
                </a>
            </div>
        @endif
    </div>
</x-frontend-layout>
