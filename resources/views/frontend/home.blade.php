<x-frontend-layout>
    <!-- ===== HERO SECTION ===== -->
    <section class="relative bg-white rounded-2xl shadow-brand border border-[#E5E7EB] overflow-hidden mb-10">
        <div class="grid md:grid-cols-2 items-center p-6 md:p-12 gap-8">
            <div>
                <span
                    class="inline-block bg-[#642671]/10 text-[#642671] text-xs font-semibold px-3 py-1 rounded-full mb-3">🔥
                    Vendor marketplace</span>
                <h1 class="text-3xl md:text-4xl lg:text-5xl font-heading font-bold text-[#1F2937] leading-tight">
                    Discover &amp; sell <br>
                    <span class="text-[#642671]">with CodeIT Dokan</span>
                </h1>
                <p class="text-[#4B5563] text-base md:text-lg mt-4 max-w-md">
                    Connect with thousands of vendors. Find unique products or start your own shop today.
                </p>
                <div class="flex flex-wrap items-center gap-4 mt-6">
                    <a href="{{route('dokan.index')}}"
                        class="bg-[#642671] hover:bg-[#54205F] text-white px-6 py-3 rounded-full font-medium shadow-lg shadow-[#642671]/20 transition-all flex items-center gap-2">
                        Start selling <i class="fas fa-arrow-right text-sm"></i>
                    </a>
                    <a href="#"
                        class="border border-[#642671] text-[#642671] hover:bg-[#642671]/5 px-6 py-3 rounded-full font-medium transition-colors">
                        Explore shops
                    </a>
                </div>
                <div class="flex items-center gap-6 mt-6 text-sm text-[#4B5563]">
                    <span><i class="fas fa-store text-[#0F766E] mr-1"></i> 200+ vendors</span>
                    <span><i class="fas fa-box text-[#0F766E] mr-1"></i> {{ $products->count() }}+ products</span>
                </div>
            </div>
            <div class="hidden md:flex justify-center relative">
                <div
                    class="w-72 h-72 bg-gradient-to-br from-[#642671]/10 to-[#0F766E]/10 rounded-full flex items-center justify-center">
                    <i class="fas fa-store-alt text-8xl text-[#642671]/30"></i>
                </div>
                <div class="absolute -bottom-4 -right-4 bg-white shadow-lg rounded-xl p-3 border border-[#E5E7EB]">
                    <div class="flex items-center gap-2">
                        <i class="fas fa-star text-yellow-400"></i>
                        <span class="font-bold text-[#1F2937]">4.8</span>
                        <span class="text-[#4B5563] text-xs">(1.2k)</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ===== DYNAMIC PRODUCT SECTION ===== -->
    <section class="mb-12">
        <div class="flex items-center justify-between mb-6">
            <h2 class="text-2xl font-heading font-bold text-[#1F2937]">✨ Featured Products</h2>
            <a href="{{route('products')}}" class="text-[#642671] hover:text-[#54205F] text-sm font-medium flex items-center gap-1">
                View all <i class="fas fa-arrow-right text-xs"></i>
            </a>
        </div>

        @if($products->count() > 0)
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                @foreach($products as $product)
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
    </section>

    <!-- ===== DOKAN REGISTRATION REQUEST SECTION ===== -->
    <section
        class="bg-white border border-[#E5E7EB] rounded-2xl shadow-brand p-8 md:p-12 grid md:grid-cols-5 gap-8 items-center">
        <div class="md:col-span-3">
            <span
                class="text-[#0F766E] text-sm font-semibold bg-[#0F766E]/10 px-3 py-1 rounded-full inline-block mb-2">🚀
                Become a vendor</span>
            <h2 class="text-2xl md:text-3xl font-heading font-bold text-[#1F2937]">Open your <span
                    class="text-[#642671]">Dokan</span> store</h2>
            <p class="text-[#4B5563] mt-2 max-w-xl">Join our multi-vendor community. Register your shop, list
                products, and start earning today.</p>
            <div class="flex flex-wrap gap-4 mt-5">
                <a href="{{route('dokan.index')}}"
                    class="bg-[#642671] hover:bg-[#54205F] text-white px-6 py-2.5 rounded-full font-medium shadow-md shadow-[#642671]/20 transition-all flex items-center gap-2">
                    Apply now <i class="fas fa-paper-plane text-sm"></i>
                </a>
                <a href="#" class="text-[#642671] hover:text-[#54205F] font-medium flex items-center gap-1">
                    Learn more <i class="fas fa-chevron-right text-xs"></i>
                </a>
            </div>
        </div>
        <div class="md:col-span-2 bg-[#F8F6FA] rounded-xl p-4 border border-[#E5E7EB] flex flex-col items-start gap-2">
            <div class="flex items-center gap-3 text-sm">
                <i class="fas fa-check-circle text-[#0F766E]"></i>
                <span>Easy registration</span>
            </div>
            <div class="flex items-center gap-3 text-sm">
                <i class="fas fa-check-circle text-[#0F766E]"></i>
                <span>PAN &amp; vendor verification</span>
            </div>
            <div class="flex items-center gap-3 text-sm">
                <i class="fas fa-check-circle text-[#0F766E]"></i>
                <span>Commission based</span>
            </div>
            <div class="flex items-center gap-3 text-sm">
                <i class="fas fa-check-circle text-[#0F766E]"></i>
                <span>Analytics &amp; support</span>
            </div>
            <div class="mt-2 w-full bg-[#642671]/5 rounded-full h-2 overflow-hidden">
                <div class="bg-[#642671] h-2 w-3/4 rounded-full"></div>
            </div>
            <span class="text-xs text-[#4B5563] mt-1">200+ vendors already on board</span>
        </div>
    </section>

    @push('scripts')
    <script>
        function addToCart(productId) {
            // Simple cart functionality - you can expand this
            alert('Product ' + productId + ' added to cart!');
            // You can implement AJAX cart functionality here
        }
    </script>
    @endpush
</x-frontend-layout>
