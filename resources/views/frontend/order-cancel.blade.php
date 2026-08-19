<x-frontend-layout>
    <div class="max-w-2xl mx-auto py-16 px-4 text-center">
        <div class="bg-white border border-[#E5E7EB] rounded-2xl shadow-brand p-8 md:p-12">
            <div class="w-20 h-20 bg-red-100 rounded-full flex items-center justify-center mx-auto mb-6">
                <i class="fas fa-times-circle text-4xl text-red-500"></i>
            </div>
            <h1 class="text-2xl md:text-3xl font-heading font-bold text-[#1F2937] mb-3">
                Payment Cancelled 😞
            </h1>
            <p class="text-[#4B5563] mb-2">
                Your payment was not completed. No charges have been made.
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
                <div class="flex justify-between py-2 border-t border-[#E5E7EB]">
                    <span class="text-[#4B5563]">Status</span>
                    <span class="font-medium text-red-500">Cancelled</span>
                </div>
            </div>

            <div class="flex flex-col sm:flex-row items-center justify-center gap-4">
                <a href="{{ route('checkout', ['dokan_id' => $order->dokan_id]) }}"
                   class="bg-[#642671] hover:bg-[#54205F] text-white px-6 py-2.5 rounded-full font-medium transition-colors">
                    <i class="fas fa-redo mr-2"></i> Try Again
                </a>
                <a href="{{ route('cart.index') }}"
                   class="text-[#642671] hover:text-[#54205F] font-medium">
                    <i class="fas fa-shopping-cart mr-1"></i> Return to Cart
                </a>
            </div>
        </div>
    </div>
</x-frontend-layout>
