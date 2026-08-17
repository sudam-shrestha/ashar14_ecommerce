<header class="bg-white border-b border-[#E5E7EB] shadow-sm sticky top-0 z-50">
    <div class="container mx-auto px-4 lg:px-6 py-3 flex items-center justify-between flex-wrap gap-3">
        <!-- logo -->
        <a href="{{ route('home') }}" class="flex items-center gap-2">
            <span class="text-2xl font-heading font-bold text-[#1F2937] tracking-tight">
                <span class="text-[#642671]">CodeIT</span> Dokan
            </span>
            <span
                class="hidden md:inline-block text-xs bg-[#642671]/10 text-[#642671] px-3 py-0.5 rounded-full font-medium">multi-vendor</span>
        </a>

        <!-- search (desktop) -->
        <div class="hidden md:flex flex-1 max-w-md mx-4 relative">
            <form action="{{ route('products') }}" method="get" class="w-full">
                <input type="text" name="q" placeholder="Search products, vendors..."
                    class="w-full pl-4 pr-10 py-2 rounded-full border border-[#E5E7EB] bg-[#F8F6FA] focus:ring-2 focus:ring-[#642671]/30 focus:border-[#642671] outline-none text-sm">
                <button type="submit" class="absolute right-4 top-1/2 -translate-y-1/2">
                    <i class="fas fa-search text-[#4B5563] text-sm"></i>
                </button>
            </form>
        </div>

        <!-- nav links + actions -->
        <div class="flex items-center gap-4 text-sm font-medium">
            <!-- Show different links based on authentication -->
            @if (Auth::user() || Auth::guard('dokan')->user())
                <!-- Vendor Dashboard Link (if user is a vendor) -->
                @if (Auth::guard('dokan')->user())
                    <a href="{{ route('filament.dokan.pages.dashboard') }}"
                        class="text-[#4B5563] hover:text-[#642671] transition-colors hidden sm:inline-block">
                        <i class="fas fa-store mr-1"></i> Dashboard
                    </a>
                @else
                    <a href="{{ route('dokan.index') }}"
                        class="text-[#4B5563] hover:text-[#642671] transition-colors hidden sm:inline-block">
                        Become a vendor
                    </a>
                @endif

                @if (Auth::user())
                    <!-- Orders Link -->
                    <a href=""
                        class="text-[#4B5563] hover:text-[#642671] transition-colors hidden sm:inline-block">
                        <i class="fas fa-box mr-1"></i> Orders
                    </a>

                    <!-- Wishlist -->
                    <a href="" class="relative text-[#4B5563] hover:text-[#642671] transition-colors">
                        <i class="fas fa-heart text-lg"></i>
                        <span
                            class="absolute -top-1 -right-2 bg-[#0F766E] text-white text-[10px] px-1.5 py-0.5 rounded-full">
                            {{ Auth::user()->wishlist_count ?? 0 }}
                        </span>
                    </a>

                    <!-- Cart -->
                    <a href="{{route('cart.index')}}" class="relative text-[#4B5563] hover:text-[#642671] transition-colors">
                        <i class="fas fa-shopping-bag text-lg"></i>
                        <span
                            class="absolute -top-1 -right-2 bg-[#642671] text-white text-[10px] px-1.5 py-0.5 rounded-full">
                            {{ Auth::user()->cart_count ?? 0 }}
                        </span>
                    </a>

                    <!-- User Dropdown -->
                    <div class="border-l border-[#E5E7EB] pl-3 flex items-center gap-2 relative group">
                        <div class="flex items-center gap-2 cursor-pointer">
                            <span class="hidden sm:inline-block text-[#1F2937] font-medium">
                                {{ Auth::user()->name }}
                            </span>
                            <i class="fas fa-chevron-down text-xs text-[#4B5563] hidden sm:inline-block"></i>
                        </div>

                        <!-- Dropdown Menu -->
                        <div
                            class="absolute right-0 top-full mt-2 w-48 bg-white rounded-xl shadow-lg border border-[#E5E7EB] py-2 hidden group-hover:block">
                            <a href=""
                                class="block px-4 py-2 text-sm text-[#4B5563] hover:bg-[#F8F6FA] hover:text-[#642671] transition-colors">
                                <i class="fas fa-user mr-2"></i> My Profile
                            </a>
                            <a href=""
                                class="block px-4 py-2 text-sm text-[#4B5563] hover:bg-[#F8F6FA] hover:text-[#642671] transition-colors">
                                <i class="fas fa-box mr-2"></i> My Orders
                            </a>
                            <a href=""
                                class="block px-4 py-2 text-sm text-[#4B5563] hover:bg-[#F8F6FA] hover:text-[#642671] transition-colors">
                                <i class="fas fa-heart mr-2"></i> Wishlist
                            </a>

                            <div class="border-t border-[#E5E7EB] my-2"></div>
                            <form method="POST" action="{{route('logout')}}">
                                @csrf
                                <button type="submit"
                                    class="w-full text-left block px-4 py-2 text-sm text-red-600 hover:bg-[#F8F6FA] transition-colors">
                                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                                </button>
                            </form>
                        </div>
                    </div>
                @endif
            @else
                <!-- Guest Links -->
                <a href="{{ route('dokan.index') }}"
                    class="text-[#4B5563] hover:text-[#642671] transition-colors hidden sm:inline-block">
                    Become a vendor
                </a>
                <a href="#" class="text-[#4B5563] hover:text-[#642671] transition-colors hidden sm:inline-block">
                    Track order
                </a>

                <!-- Guest Icons (non-functional or redirect to login) -->
                <a href="" class="relative text-[#4B5563] hover:text-[#642671] transition-colors">
                    <i class="fas fa-heart text-lg"></i>
                    <span
                        class="absolute -top-1 -right-2 bg-[#0F766E] text-white text-[10px] px-1.5 py-0.5 rounded-full">0</span>
                </a>
                <a href="" class="relative text-[#4B5563] hover:text-[#642671] transition-colors">
                    <i class="fas fa-shopping-bag text-lg"></i>
                    <span
                        class="absolute -top-1 -right-2 bg-[#642671] text-white text-[10px] px-1.5 py-0.5 rounded-full">0</span>
                </a>

                <!-- Login/Register Buttons -->
                <div class="border-l border-[#E5E7EB] pl-3 flex items-center gap-2">
                    <a href="{{ route('login') }}"
                        class="text-[#642671] hover:text-[#54205F] font-medium transition-colors">
                        Login
                    </a>
                    <span class="text-[#E5E7EB]">|</span>
                    <a href="{{ route('register') }}"
                        class="bg-[#642671] hover:bg-[#54205F] text-white px-4 py-1.5 rounded-full text-sm transition-colors">
                        Register
                    </a>
                </div>
            @endif

            <!-- Mobile Menu Toggle -->
            <button id="mobileMenuToggle" class="md:hidden text-[#4B5563] hover:text-[#642671]">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </div>
    </div>

    <!-- mobile search (visible on small) -->
    <div class="md:hidden px-4 pb-3">
        <div class="relative">
            <form action="{{ route('products') }}" method="get">
                <input type="text" name="q" placeholder="Search..."
                    class="w-full pl-4 pr-10 py-2 rounded-full border border-[#E5E7EB] bg-[#F8F6FA] focus:ring-2 focus:ring-[#642671]/30 text-sm">
                <button type="submit" class="absolute right-4 top-1/2 -translate-y-1/2">
                    <i class="fas fa-search text-[#4B5563] text-sm"></i>
                </button>
            </form>
        </div>
    </div>

    <!-- Mobile Menu (hidden by default) -->
    <div id="mobileMenu" class="hidden md:hidden bg-white border-t border-[#E5E7EB] px-4 py-3 space-y-2">
        @auth
            <div class="flex items-center gap-3 pb-3 border-b border-[#E5E7EB]">
                @if (Auth::user()->profile_photo)
                    <img src="{{ asset('storage/' . Auth::user()->profile_photo) }}" alt="{{ Auth::user()->name }}"
                        class="w-10 h-10 rounded-full object-cover">
                @else
                    <div class="w-10 h-10 rounded-full bg-[#642671]/10 flex items-center justify-center">
                        <i class="fas fa-user text-[#642671]"></i>
                    </div>
                @endif
                <div>
                    <p class="font-medium text-[#1F2937]">{{ Auth::user()->name }}</p>
                    <p class="text-xs text-[#4B5563]">{{ Auth::user()->email }}</p>
                </div>
            </div>
            <a href="" class="block py-2 text-[#4B5563] hover:text-[#642671] transition-colors">
                <i class="fas fa-user mr-2"></i> My Profile
            </a>
            <a href="" class="block py-2 text-[#4B5563] hover:text-[#642671] transition-colors">
                <i class="fas fa-box mr-2"></i> My Orders
            </a>
            <a href="" class="block py-2 text-[#4B5563] hover:text-[#642671] transition-colors">
                <i class="fas fa-heart mr-2"></i> Wishlist
            </a>
            @if (Auth::guard('dokan')->user())
                <a href="{{ route('filament.dokan.pages.dashboard') }}"
                    class="block py-2 text-[#4B5563] hover:text-[#642671] transition-colors">
                    <i class="fas fa-store mr-2"></i> Vendor Dashboard
                </a>
            @endif
            <form method="POST" action="{{route('logout')}}" class="pt-2 border-t border-[#E5E7EB]">
                @csrf
                <button type="submit" class="w-full text-left py-2 text-red-600 hover:text-red-700 transition-colors">
                    <i class="fas fa-sign-out-alt mr-2"></i> Logout
                </button>
            </form>
        @else
            <a href="{{ route('login') }}"
                class="block py-2 text-[#642671] hover:text-[#54205F] font-medium transition-colors">
                <i class="fas fa-sign-in-alt mr-2"></i> Login
            </a>
            <a href="{{ route('register') }}" class="block py-2 text-[#4B5563] hover:text-[#642671] transition-colors">
                <i class="fas fa-user-plus mr-2"></i> Register
            </a>
            <a href="{{ route('dokan.index') }}"
                class="block py-2 text-[#4B5563] hover:text-[#642671] transition-colors">
                <i class="fas fa-store mr-2"></i> Become a Vendor
            </a>
        @endauth
    </div>
</header>

@push('scripts')
    <script>
        // Mobile menu toggle
        document.getElementById('mobileMenuToggle')?.addEventListener('click', function() {
            const menu = document.getElementById('mobileMenu');
            menu.classList.toggle('hidden');
            menu.classList.toggle('block');
        });

        // Close mobile menu on outside click
        document.addEventListener('click', function(event) {
            const menu = document.getElementById('mobileMenu');
            const toggle = document.getElementById('mobileMenuToggle');
            if (menu && !menu.classList.contains('hidden')) {
                if (!menu.contains(event.target) && !toggle.contains(event.target)) {
                    menu.classList.add('hidden');
                    menu.classList.remove('block');
                }
            }
        });
    </script>
@endpush
