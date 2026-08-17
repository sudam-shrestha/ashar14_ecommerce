<x-frontend-layout>
    <div class="max-w-7xl mx-auto py-8 px-4">
        <!-- Page Header -->
        <div class="flex items-center justify-between mb-8">
            <div>
                <h1 class="text-3xl font-heading font-bold text-[#1F2937]">Shopping Cart</h1>
                <p class="text-[#4B5563] mt-1" id="total-items-text">{{ $totalItems }} items in your cart</p>
            </div>
            <a href="{{ route('home') }}" class="text-[#642671] hover:text-[#54205F] font-medium flex items-center gap-2">
                <i class="fas fa-arrow-left"></i> Continue Shopping
            </a>
        </div>

        @if ($carts->count() > 0)
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
                <!-- Cart Items -->
                <div class="lg:col-span-2 space-y-6" id="cart-items-container">
                    @foreach ($groupedCarts as $dokanId => $items)
                        @php
                            $dokan = $items->first()->dokan;
                            $vendorSubtotal = $items->sum(function ($item) {
                                $price =
                                    $item->product->discount > 0
                                        ? $item->product->price -
                                            ($item->product->price * $item->product->discount) / 100
                                        : $item->product->price;
                                return $price * $item->qty;
                            });
                        @endphp

                        <!-- Vendor Group -->
                        <div class="bg-white border border-[#E5E7EB] rounded-2xl shadow-brand overflow-hidden vendor-group"
                            data-dokan-id="{{ $dokanId }}">
                            <!-- Vendor Header -->
                            <div
                                class="bg-[#F8F6FA] border-b border-[#E5E7EB] px-6 py-4 flex items-center justify-between">
                                <div class="flex items-center gap-3">
                                    <div
                                        class="w-10 h-10 bg-[#642671]/10 rounded-full flex items-center justify-center">
                                        <i class="fas fa-store text-[#642671]"></i>
                                    </div>
                                    <div>
                                        <h3 class="font-semibold text-[#1F2937]">
                                            {{ $dokan->dokan_name ?? 'Unknown Vendor' }}</h3>
                                        <p class="text-xs text-[#4B5563] vendor-item-count">{{ $items->count() }} items
                                        </p>
                                    </div>
                                </div>
                                <span class="text-sm font-medium text-[#1F2937] vendor-subtotal"
                                    data-vendor-subtotal="{{ $vendorSubtotal }}">
                                    Subtotal: NRs. {{ number_format($vendorSubtotal, 2) }}
                                </span>
                            </div>

                            <!-- Vendor Items -->
                            <div class="divide-y divide-[#E5E7EB]">
                                @foreach ($items as $item)
                                    @php
                                        $product = $item->product;
                                        $discountedPrice =
                                            $product->discount > 0
                                                ? $product->price - ($product->price * $product->discount) / 100
                                                : $product->price;
                                        $itemTotal = $discountedPrice * $item->qty;
                                    @endphp
                                    <div class="p-4 flex items-center gap-4 cart-item"
                                        id="cart-item-{{ $item->id }}" data-cart-id="{{ $item->id }}"
                                        data-price="{{ $discountedPrice }}">
                                        <!-- Product Image -->
                                        <div class="w-24 h-24 bg-[#F8F6FA] rounded-xl overflow-hidden flex-shrink-0">
                                            @if ($product->images && count($product->images) > 0)
                                                <img src="{{ asset('storage/' . $product->images[0]) }}"
                                                    alt="{{ $product->name }}" class="w-full h-full object-cover">
                                            @else
                                                <div
                                                    class="w-full h-full flex items-center justify-center text-[#642671]/30">
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
                                                        <span
                                                            class="text-xs bg-[#F8F6FA] text-[#4B5563] px-2 py-0.5 rounded-full">#{{ $tag }}</span>
                                                    @endforeach
                                                </div>
                                            @endif
                                            <div class="flex items-center gap-3 mt-2">
                                                <span class="text-lg font-bold text-[#1F2937]">NRs.
                                                    {{ number_format($discountedPrice, 2) }}</span>
                                                @if ($product->discount > 0)
                                                    <span class="text-sm text-[#4B5563] line-through">NRs.
                                                        {{ number_format($product->price, 2) }}</span>
                                                    <span
                                                        class="text-xs bg-[#0F766E]/10 text-[#0F766E] px-2 py-0.5 rounded-full">-{{ $product->discount }}%</span>
                                                @endif
                                            </div>
                                        </div>

                                        <!-- Quantity & Actions -->
                                        <div class="flex flex-col items-end gap-2">
                                            <!-- Quantity Selector -->
                                            <div
                                                class="flex items-center border border-[#E5E7EB] rounded-lg overflow-hidden">
                                                <button onclick="updateQuantity({{ $item->id }}, -1)"
                                                    class="px-3 py-1 bg-[#F8F6FA] hover:bg-[#E5E7EB] transition-colors text-[#1F2937]">
                                                    <i class="fas fa-minus text-xs"></i>
                                                </button>
                                                <span id="qty-{{ $item->id }}"
                                                    class="px-4 py-1 text-[#1F2937] font-medium min-w-[30px] text-center">
                                                    {{ $item->qty }}
                                                </span>
                                                <button onclick="updateQuantity({{ $item->id }}, 1)"
                                                    class="px-3 py-1 bg-[#F8F6FA] hover:bg-[#E5E7EB] transition-colors text-[#1F2937]">
                                                    <i class="fas fa-plus text-xs"></i>
                                                </button>
                                            </div>

                                            <!-- Item Total & Remove -->
                                            <div class="flex items-center gap-3">
                                                <span class="text-sm font-medium text-[#1F2937]">
                                                    NRs. <span
                                                        id="item-total-{{ $item->id }}">{{ number_format($itemTotal, 2) }}</span>
                                                </span>
                                                <button onclick="removeItem({{ $item->id }})"
                                                    class="text-red-500 hover:text-red-700 transition-colors">
                                                    <i class="fas fa-trash-alt"></i>
                                                </button>
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
                    <div class="bg-white border border-[#E5E7EB] rounded-2xl shadow-brand p-6 sticky top-24"
                        id="cart-summary">
                        <h3 class="text-lg font-heading font-bold text-[#1F2937] mb-4">Order Summary</h3>

                        <div class="space-y-3 text-sm">
                            <div class="flex justify-between">
                                <span class="text-[#4B5563]">Subtotal (<span
                                        id="summary-items-count">{{ $totalItems }}</span> items)</span>
                                <span class="font-medium text-[#1F2937]" id="summary-subtotal">NRs.
                                    {{ number_format($subtotal, 2) }}</span>
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
                                    <span class="text-[#642671]" id="summary-total">NRs.
                                        {{ number_format($subtotal, 2) }}</span>
                                </div>
                            </div>
                        </div>

                        <!-- Checkout Button -->
                        <button onclick="proceedToCheckout()"
                            class="w-full mt-6 bg-[#642671] hover:bg-[#54205F] text-white font-medium py-3 px-4 rounded-xl shadow-lg shadow-[#642671]/20 transition-all duration-200 flex items-center justify-center gap-2">
                            <i class="fas fa-lock"></i> Proceed to Checkout
                        </button>

                        <!-- Clear Cart -->
                        <button onclick="clearCart()"
                            class="w-full mt-3 text-red-500 hover:text-red-700 font-medium text-sm transition-colors">
                            <i class="fas fa-trash-alt mr-1"></i> Clear Cart
                        </button>

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

    <!-- Toast Notification -->
    <div id="toast"
        class="fixed top-20 right-4 z-50 transform transition-all duration-300 translate-x-full opacity-0">
        <div class="bg-white border rounded-xl shadow-lg p-4 max-w-sm flex items-center gap-3" id="toast-content">
            <div id="toast-icon" class="w-8 h-8 rounded-full flex items-center justify-center"></div>
            <div>
                <p class="font-medium text-[#1F2937]" id="toast-title">Success</p>
                <p class="text-sm text-[#4B5563]" id="toast-message">Operation completed</p>
            </div>
            <button onclick="hideToast()" class="text-[#4B5563] hover:text-[#1F2937]">
                <i class="fas fa-times"></i>
            </button>
        </div>
    </div>

    @push('scripts')
        <script>
            let toastTimeout;

            // Show notification
            function showNotification(type, message) {
                const toast = document.getElementById('toast');
                const toastContent = document.getElementById('toast-content');
                const toastIcon = document.getElementById('toast-icon');
                const toastTitle = document.getElementById('toast-title');
                const toastMessage = document.getElementById('toast-message');

                // Reset classes
                toastContent.className = 'bg-white border rounded-xl shadow-lg p-4 max-w-sm flex items-center gap-3';

                if (type === 'success') {
                    toastIcon.className =
                    'w-8 h-8 rounded-full flex items-center justify-center bg-[#0F766E]/10 text-[#0F766E]';
                    toastIcon.innerHTML = '<i class="fas fa-check-circle text-xl"></i>';
                    toastTitle.textContent = 'Success';
                    toastTitle.className = 'font-medium text-[#0F766E]';
                } else if (type === 'error') {
                    toastIcon.className = 'w-8 h-8 rounded-full flex items-center justify-center bg-red-100 text-red-500';
                    toastIcon.innerHTML = '<i class="fas fa-exclamation-circle text-xl"></i>';
                    toastTitle.textContent = 'Error';
                    toastTitle.className = 'font-medium text-red-500';
                } else {
                    toastIcon.className = 'w-8 h-8 rounded-full flex items-center justify-center bg-blue-100 text-blue-500';
                    toastIcon.innerHTML = '<i class="fas fa-info-circle text-xl"></i>';
                    toastTitle.textContent = 'Info';
                    toastTitle.className = 'font-medium text-blue-500';
                }

                toastMessage.textContent = message;

                // Show toast
                toast.classList.remove('translate-x-full', 'opacity-0');
                toast.classList.add('translate-x-0', 'opacity-100');

                // Auto hide after 5 seconds
                clearTimeout(toastTimeout);
                toastTimeout = setTimeout(hideToast, 5000);
            }

            function hideToast() {
                const toast = document.getElementById('toast');
                toast.classList.remove('translate-x-0', 'opacity-100');
                toast.classList.add('translate-x-full', 'opacity-0');
            }

            // Update quantity
            function updateQuantity(cartId, change) {
                const qtyElement = document.getElementById(`qty-${cartId}`);
                let currentQty = parseInt(qtyElement.textContent);
                let newQty = Math.max(1, currentQty + change);

                fetch('{{ route('cart.update') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            cart_id: cartId,
                            qty: newQty
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Update quantity display
                            qtyElement.textContent = newQty;

                            // Update item total
                            document.getElementById(`item-total-${cartId}`).textContent = data.item_total;

                            // Update summary totals
                            document.getElementById('summary-subtotal').textContent = 'NRs. ' + data.subtotal;
                            document.getElementById('summary-total').textContent = 'NRs. ' + data.subtotal;
                            document.getElementById('summary-items-count').textContent = data.total_items;
                            document.getElementById('total-items-text').textContent = data.total_items +
                                ' items in your cart';

                            // Update vendor subtotal
                            const cartItem = document.getElementById(`cart-item-${cartId}`);
                            const vendorGroup = cartItem.closest('.vendor-group');
                            if (vendorGroup) {
                                const vendorSubtotalElement = vendorGroup.querySelector('.vendor-subtotal');
                                // Recalculate vendor subtotal from visible items
                                const items = vendorGroup.querySelectorAll('.cart-item');
                                let vendorTotal = 0;
                                items.forEach(item => {
                                    const price = parseFloat(item.dataset.price);
                                    const qty = parseInt(item.querySelector('.quantity-display').textContent);
                                    vendorTotal += price * qty;
                                });
                                vendorSubtotalElement.textContent = 'Subtotal: NRs. ' + Number(vendorTotal).toFixed(2);
                            }

                            // Update header cart count
                            updateHeaderCartCount(data.cart_count);

                            showNotification('success', data.message);
                        } else {
                            showNotification('error', data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showNotification('error', 'Something went wrong. Please try again.');
                    });
            }

            // Remove item from cart
            function removeItem(cartId) {
                if (!confirm('Are you sure you want to remove this item?')) return;

                fetch('{{ route('cart.remove') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        },
                        body: JSON.stringify({
                            cart_id: cartId
                        })
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            // Remove item from DOM
                            const itemElement = document.getElementById(`cart-item-${cartId}`);
                            const vendorGroup = itemElement.closest('.vendor-group');
                            itemElement.remove();

                            // Update vendor item count
                            const remainingItems = vendorGroup.querySelectorAll('.cart-item');
                            const itemCountElement = vendorGroup.querySelector('.vendor-item-count');
                            itemCountElement.textContent = remainingItems.length + ' items';

                            // If no items left in vendor group, remove the whole group
                            if (remainingItems.length === 0) {
                                vendorGroup.remove();
                            } else {
                                // Update vendor subtotal
                                const vendorSubtotalElement = vendorGroup.querySelector('.vendor-subtotal');
                                let vendorTotal = 0;
                                remainingItems.forEach(item => {
                                    const price = parseFloat(item.dataset.price);
                                    const qty = parseInt(item.querySelector('.quantity-display').textContent);
                                    vendorTotal += price * qty;
                                });
                                vendorSubtotalElement.textContent = 'Subtotal: NRs. ' + Number(vendorTotal).toFixed(2);
                            }

                            // Update summary totals
                            document.getElementById('summary-subtotal').textContent = 'NRs. ' + data.subtotal;
                            document.getElementById('summary-total').textContent = 'NRs. ' + data.subtotal;
                            document.getElementById('summary-items-count').textContent = data.total_items;
                            document.getElementById('total-items-text').textContent = data.total_items +
                                ' items in your cart';

                            // Update header cart count
                            updateHeaderCartCount(data.cart_count);

                            showNotification('success', data.message);

                            // Reload page if cart is empty
                            if (data.total_items === 0) {
                                location.reload();
                            }
                        } else {
                            showNotification('error', data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showNotification('error', 'Something went wrong. Please try again.');
                    });
            }

            // Clear cart
            function clearCart() {
                if (!confirm('Are you sure you want to clear your entire cart?')) return;

                fetch('{{ route('cart.clear') }}', {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': '{{ csrf_token() }}'
                        }
                    })
                    .then(response => response.json())
                    .then(data => {
                        if (data.success) {
                            updateHeaderCartCount(0);
                            showNotification('success', data.message);
                            location.reload();
                        } else {
                            showNotification('error', data.message);
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        showNotification('error', 'Something went wrong. Please try again.');
                    });
            }

            // Proceed to checkout
            function proceedToCheckout() {
                // Check if user is logged in
                @if (!Auth::check())
                    showNotification('error', 'Please login to proceed to checkout.');
                    setTimeout(() => {
                        window.location.href = '{{ route('login') }}';
                    }, 2000);
                    return;
                @endif

                showNotification('info', 'Checkout feature coming soon!');
            }

            // Update header cart count
            function updateHeaderCartCount(count) {
                const cartBadge = document.querySelector('a[href*="cart"] .rounded-full');
                if (cartBadge) {
                    cartBadge.textContent = count;
                }
            }
        </script>
    @endpush
</x-frontend-layout>
