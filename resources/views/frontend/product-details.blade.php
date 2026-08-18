<x-frontend-layout>
    <!-- ===== PRODUCT DETAILS PAGE ===== -->
    <div class="max-w-7xl mx-auto py-8 px-4">
        <!-- Breadcrumb -->
        <nav class="flex items-center gap-2 text-sm text-[#4B5563] mb-6">
            <a href="{{ route('home') }}" class="hover:text-[#642671] transition-colors">Home</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <a href="{{ route('products') }}" class="hover:text-[#642671] transition-colors">Products</a>
            <i class="fas fa-chevron-right text-xs"></i>
            <span class="text-[#1F2937] font-medium truncate">{{ $product->name }}</span>
        </nav>

        @if(session('success'))
            <div class="bg-[#0F766E]/10 border border-[#0F766E] text-[#0F766E] px-4 py-3 rounded-xl mb-6">
                {{ session('success') }}
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-xl mb-6">
                {{ session('error') }}
            </div>
        @endif

        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <!-- ===== LEFT COLUMN - PRODUCT IMAGES ===== -->
            <div class="space-y-4">
                <!-- Main Image -->
                <div class="bg-[#F8F6FA] border border-[#E5E7EB] rounded-2xl overflow-hidden relative group">
                    @if ($product->images && count($product->images) > 0)
                        <img id="mainImage" src="{{ asset('storage/' . $product->images[0]) }}"
                            alt="{{ $product->name }}"
                            class="w-full h-96 object-contain transition-transform duration-300 group-hover:scale-105">
                    @else
                        <div class="w-full h-96 flex items-center justify-center text-[#642671]/30">
                            <i class="fas fa-image text-8xl"></i>
                        </div>
                    @endif

                    <!-- Discount Badge -->
                    @if ($product->discount > 0)
                        <span
                            class="absolute top-4 left-4 bg-[#0F766E] text-white text-sm font-bold px-4 py-2 rounded-full shadow-lg">
                            -{{ $product->discount }}% OFF
                        </span>
                    @endif

                    <!-- Zoom Icon -->
                    <button onclick="openImageModal()"
                        class="absolute bottom-4 right-4 bg-white/90 hover:bg-white text-[#642671] p-2 rounded-full shadow-lg transition-all hover:scale-110">
                        <i class="fas fa-expand text-lg"></i>
                    </button>
                </div>

                <!-- Thumbnail Gallery -->
                @if ($product->images && count($product->images) > 1)
                    <div class="grid grid-cols-4 gap-3">
                        @foreach ($product->images as $index => $image)
                            <div class="bg-[#F8F6FA] border border-[#E5E7EB] rounded-xl overflow-hidden cursor-pointer hover:border-[#642671] transition-all hover:shadow-md"
                                onclick="changeMainImage('{{ asset('storage/' . $image) }}', this)">
                                <img src="{{ asset('storage/' . $image) }}"
                                    alt="{{ $product->name }} - Image {{ $index + 1 }}"
                                    class="w-full h-24 object-cover">
                            </div>
                        @endforeach
                    </div>
                @endif
            </div>

            <!-- ===== RIGHT COLUMN - PRODUCT INFO ===== -->
            <div class="space-y-6">
                <!-- Product Name & Tags -->
                <div>
                    <h1 class="text-3xl md:text-4xl font-heading font-bold text-[#1F2937]">{{ $product->name }}</h1>

                    @if ($product->tags && count($product->tags) > 0)
                        <div class="flex flex-wrap gap-2 mt-3">
                            @foreach ($product->tags as $tag)
                                <span
                                    class="text-sm bg-[#F8F6FA] text-[#4B5563] px-3 py-1 rounded-full border border-[#E5E7EB]">
                                    #{{ $tag }}
                                </span>
                            @endforeach
                        </div>
                    @endif
                </div>

                <!-- Rating -->
                <div class="flex items-center gap-3">
                    <div class="flex items-center gap-1 text-yellow-400">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star-half-alt"></i>
                    </div>
                    <span class="text-[#1F2937] font-medium">4.5</span>
                    <span class="text-[#4B5563] text-sm">({{ rand(50, 500) }} reviews)</span>
                </div>

                <!-- Price -->
                <div class="bg-[#F8F6FA] rounded-xl p-4 border border-[#E5E7EB]">
                    @if ($product->discount > 0)
                        @php
                            $discountedPrice = $product->price - ($product->price * $product->discount) / 100;
                        @endphp
                        <div class="flex items-center gap-3">
                            <span class="text-3xl font-bold text-[#1F2937]">NRs.
                                {{ number_format($discountedPrice, 2) }}</span>
                            <span class="text-lg text-[#4B5563] line-through">NRs.
                                {{ number_format($product->price, 2) }}</span>
                            <span class="bg-[#0F766E] text-white text-sm font-bold px-3 py-1 rounded-full">
                                Save {{ number_format($product->price - $discountedPrice, 2) }}
                            </span>
                        </div>
                        <div class="mt-2 text-sm text-[#0F766E]">
                            <i class="fas fa-tag mr-1"></i> You save {{ $product->discount }}% on this purchase
                        </div>
                    @else
                        <span class="text-3xl font-bold text-[#1F2937]">NRs.
                            {{ number_format($product->price, 2) }}</span>
                    @endif
                </div>

                <!-- Vendor Info -->
                <div class="bg-white border border-[#E5E7EB] rounded-xl p-4">
                    <h3 class="text-sm font-semibold text-[#1F2937] mb-2">Sold by</h3>
                    <div class="flex items-center gap-3">
                        <div class="w-12 h-12 bg-[#642671]/10 rounded-full flex items-center justify-center">
                            <i class="fas fa-store text-[#642671] text-xl"></i>
                        </div>
                        <div>
                            <p class="font-medium text-[#1F2937]">{{ $product->dokan->dokan_name ?? 'Unknown Vendor' }}
                            </p>
                            <p class="text-xs text-[#4B5563]">
                                <i class="fas fa-star text-yellow-400 mr-1"></i>
                                {{ number_format(rand(4.0, 5.0), 1) }} Vendor Rating
                            </p>
                        </div>
                    </div>
                </div>

                <!-- Quantity & Add to Cart -->
                <div class="space-y-4">
                    <form action="{{ route('cart.add') }}" method="POST" class="space-y-4">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">

                        <!-- Quantity Selector -->
                        <div class="flex items-center gap-4">
                            <label class="text-sm font-medium text-[#1F2937]">Quantity:</label>
                            <div class="flex items-center border border-[#E5E7EB] rounded-lg overflow-hidden">
                                <button type="button" onclick="updateQuantity(-1)"
                                    class="px-4 py-2 bg-[#F8F6FA] hover:bg-[#E5E7EB] transition-colors text-[#1F2937]">
                                    <i class="fas fa-minus"></i>
                                </button>
                                <span id="quantityDisplay"
                                    class="px-6 py-2 text-[#1F2937] font-medium min-w-[40px] text-center">1</span>
                                <button type="button" onclick="updateQuantity(1)"
                                    class="px-4 py-2 bg-[#F8F6FA] hover:bg-[#E5E7EB] transition-colors text-[#1F2937]">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                            <input type="hidden" name="qty" id="qtyInput" value="1">
                        </div>

                        <!-- Add to Cart Button -->
                        <button type="submit"
                            class="w-full bg-[#642671] hover:bg-[#54205F] text-white px-8 py-3 rounded-full font-medium shadow-lg shadow-[#642671]/20 transition-all flex items-center justify-center gap-2">
                            <i class="fas fa-shopping-cart"></i> Add to Cart
                        </button>
                    </form>
                </div>

                <!-- Product Meta Info -->
                <div class="bg-[#F8F6FA] rounded-xl p-4 border border-[#E5E7EB] space-y-2 text-sm">
                    <div class="flex justify-between">
                        <span class="text-[#4B5563]">Category:</span>
                        <span class="text-[#1F2937] font-medium">Electronics</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-[#4B5563]">SKU:</span>
                        <span
                            class="text-[#1F2937] font-medium">#{{ str_pad($product->id, 6, '0', STR_PAD_LEFT) }}</span>
                    </div>
                    <div class="flex justify-between">
                        <span class="text-[#4B5563]">Availability:</span>
                        <span class="text-[#0F766E] font-medium">
                            <i class="fas fa-check-circle mr-1"></i> In Stock
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <!-- ===== PRODUCT DESCRIPTION SECTION ===== -->
        <div class="mt-12">
            <div class="bg-white border border-[#E5E7EB] rounded-2xl shadow-brand overflow-hidden">
                <div class="border-b border-[#E5E7EB] px-6 py-4 bg-[#F8F6FA]">
                    <h2 class="text-xl font-heading font-bold text-[#1F2937]">
                        <i class="fas fa-align-left text-[#642671] mr-2"></i> Product Description
                    </h2>
                </div>
                <div class="p-6 md:p-8">
                    <div class="prose max-w-none text-[#4B5563] leading-relaxed space-y-4">
                        <p>
                            <strong>{{ $product->name }}</strong> is a premium quality product designed to meet your
                            daily needs.
                            Crafted with attention to detail and using high-quality materials, this product offers
                            exceptional
                            value and performance.
                        </p>

                        <h3 class="text-lg font-heading font-semibold text-[#1F2937] mt-6">Key Features:</h3>
                        <ul class="list-disc pl-5 space-y-2">
                            <li>High-quality construction for long-lasting durability</li>
                            <li>User-friendly design suitable for all skill levels</li>
                            <li>Premium materials ensuring reliability and performance</li>
                            <li>Backed by excellent customer support and warranty</li>
                            <li>Competitively priced for exceptional value</li>
                        </ul>

                        <h3 class="text-lg font-heading font-semibold text-[#1F2937] mt-6">Why Choose This Product?</h3>
                        <p>
                            Whether you're a professional or just starting out, this product from
                            <strong>{{ $product->dokan->dokan_name ?? 'our vendor' }}</strong> is designed to exceed
                            your expectations.
                            Join thousands of satisfied customers who have made this their top choice.
                        </p>

                        @if ($product->tags && count($product->tags) > 0)
                            <div class="mt-6 pt-4 border-t border-[#E5E7EB]">
                                <h4 class="text-sm font-semibold text-[#1F2937] mb-2">Related Tags:</h4>
                                <div class="flex flex-wrap gap-2">
                                    @foreach ($product->tags as $tag)
                                        <span
                                            class="text-sm bg-[#F8F6FA] text-[#642671] px-3 py-1 rounded-full border border-[#E5E7EB]">
                                            #{{ $tag }}
                                        </span>
                                    @endforeach
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <!-- Related Products -->
        @if ($related_products->count() > 0)
            <div class="mt-12">
                <h2 class="text-2xl font-heading font-bold text-[#1F2937] mb-6">
                    <i class="fas fa-th-large text-[#642671] mr-2"></i> More from this Vendor
                </h2>
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    @foreach ($related_products as $related_product)
                        <div
                            class="bg-white border border-[#E5E7EB] rounded-xl shadow-brand overflow-hidden hover:shadow-xl transition-shadow">
                            <div class="h-40 bg-[#F8F6FA] flex items-center justify-center overflow-hidden">
                                @if ($related_product->images && count($related_product->images) > 0)
                                    <a href="{{ route('product.details', $related_product->slug) }}">
                                        <img src="{{ asset('storage/' . $related_product->images[0]) }}"
                                            alt="{{ $related_product->name }}" class="w-full h-full object-cover">
                                    </a>
                                @else
                                    <i class="fas fa-image text-4xl text-[#642671]/30"></i>
                                @endif
                            </div>
                            <div class="p-4">
                                <h3
                                    class="font-heading font-semibold text-[#1F2937] hover:text-[#642671] transition-colors line-clamp-1">
                                    <a
                                        href="{{ route('product.details', $related_product->slug) }}">{{ $related_product->name }}</a>
                                </h3>
                                <div class="flex items-center gap-2 mt-1">
                                    <span class="text-lg font-bold text-[#1F2937]">NRs.
                                        {{ number_format($related_product->price, 2) }}</span>
                                    @if ($related_product->discount > 0)
                                        <span
                                            class="text-xs bg-[#0F766E]/10 text-[#0F766E] px-2 py-0.5 rounded-full">-{{ $related_product->discount }}%</span>
                                    @endif
                                </div>
                                <!-- Add to Cart Button for Related Product -->
                                <form action="{{ route('cart.add') }}" method="POST" class="mt-3">
                                    @csrf
                                    <input type="hidden" name="product_id" value="{{ $related_product->id }}">
                                    <input type="hidden" name="qty" value="1">
                                    <button type="submit"
                                        class="w-full bg-[#642671] hover:bg-[#54205F] text-white text-sm font-medium px-4 py-2 rounded-full transition-colors flex items-center justify-center gap-1">
                                        <i class="fas fa-shopping-cart text-xs"></i> Add to Cart
                                    </button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif
    </div>

    <!-- ===== IMAGE MODAL ===== -->
    <div id="imageModal" class="fixed inset-0 bg-black/90 z-50 hidden flex items-center justify-center p-4"
        onclick="closeImageModal()">
        <div class="relative max-w-4xl w-full" onclick="event.stopPropagation()">
            <button onclick="closeImageModal()"
                class="absolute -top-12 right-0 text-white hover:text-[#642671] text-3xl transition-colors">
                <i class="fas fa-times"></i>
            </button>
            <img id="modalImage" src="" alt="Product Image"
                class="w-full h-auto max-h-[80vh] object-contain rounded-lg">
        </div>
    </div>

    @push('scripts')
        <script>
            let quantity = 1;

            // Update quantity
            function updateQuantity(change) {
                quantity = Math.max(1, quantity + change);
                document.getElementById('quantityDisplay').textContent = quantity;
                document.getElementById('qtyInput').value = quantity;
            }

            // Change main image
            function changeMainImage(imageUrl, element) {
                document.getElementById('mainImage').src = imageUrl;

                // Remove active class from all thumbnails
                document.querySelectorAll('.grid .grid-cols-4 .border').forEach(el => {
                    el.classList.remove('border-[#642671]', 'shadow-md');
                });

                // Add active class to clicked thumbnail
                if (element) {
                    element.classList.add('border-[#642671]', 'shadow-md');
                }
            }

            // Open image modal
            function openImageModal() {
                const mainImage = document.getElementById('mainImage');
                document.getElementById('modalImage').src = mainImage.src;
                document.getElementById('imageModal').classList.remove('hidden');
                document.body.style.overflow = 'hidden';
            }

            // Close image modal
            function closeImageModal() {
                document.getElementById('imageModal').classList.add('hidden');
                document.body.style.overflow = 'auto';
            }

            // Close modal with Escape key
            document.addEventListener('keydown', function(e) {
                if (e.key === 'Escape') {
                    closeImageModal();
                }
            });
        </script>
    @endpush
</x-frontend-layout>
