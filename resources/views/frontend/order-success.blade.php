<x-frontend-layout>
    <div class="max-w-2xl mx-auto py-16 px-4 text-center">
        <div class="bg-white border border-[#E5E7EB] rounded-2xl shadow-brand p-8 md:p-12">
            <div class="w-20 h-20 bg-[#0F766E]/10 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-check-circle text-4xl text-[#0F766E]"></i>
            </div>
            <h1 class="text-2xl md:text-3xl font-heading font-bold text-[#1F2937] mb-3">
                Order Placed Successfully! 🎉
            </h1>
            <p class="text-[#4B5563] mb-2">
                Your order has been placed and is being processed.
            </p>
            <p class="text-sm text-[#4B5563] mb-6">
                Order #{{ str_pad($order->id, 6, '0', STR_PAD_LEFT) }}
            </p>

            <div class="bg-[#F8F6FA] rounded-xl p-4 text-left mb-6">
                <div class="flex justify-between py-2 border-b border-[#E5E7EB]">
                    <span class="text-[#4B5563]">Vendor</span>
                    <span class="font-medium text-[#1F2937]">{{ $order->dokan->dokan_name ?? 'Unknown Vendor' }}</span>
                </div>
                <div class="flex justify-between py-2 border-b border-[#E5E7EB]">
                    <span class="text-[#4B5563]">Total Amount</span>
                    <span class="font-bold text-[#642671]">NRs. {{ number_format($order->total_amount, 2) }}</span>
                </div>
                <div class="flex justify-between py-2">
                    <span class="text-[#4B5563]">Payment Method</span>
                    <span class="font-medium text-[#1F2937] capitalize">{{ $order->payment_method }}</span>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('order.details', $order->id) }}"
                   class="bg-[#642671] hover:bg-[#54205F] text-white px-6 py-2.5 rounded-full font-medium transition-colors">
                    View Order Details
                </a>
                <a href="{{ route('home') }}"
                   class="text-[#642671] hover:text-[#54205F] font-medium">
                    Continue Shopping
                </a>
            </div>
        </div>
    </div>
</x-frontend-layout>
