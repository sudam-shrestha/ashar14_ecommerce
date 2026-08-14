<header class="bg-white border-b border-[#E5E7EB] shadow-sm sticky top-0 z-50">
    <div class="container mx-auto px-4 lg:px-6 py-3 flex items-center justify-between flex-wrap gap-3">
        <!-- logo -->
        <div class="flex items-center gap-2">
            <span class="text-2xl font-heading font-bold text-[#1F2937] tracking-tight">
                <span class="text-[#642671]">CodeIT</span> Dokan
            </span>
            <span
                class="hidden md:inline-block text-xs bg-[#642671]/10 text-[#642671] px-3 py-0.5 rounded-full font-medium">multi-vendor</span>
        </div>

        <!-- search (desktop) -->
        <div class="hidden md:flex flex-1 max-w-md mx-4 relative">
            <input type="text" placeholder="Search products, vendors..."
                class="w-full pl-4 pr-10 py-2 rounded-full border border-[#E5E7EB] bg-[#F8F6FA] focus:ring-2 focus:ring-[#642671]/30 focus:border-[#642671] outline-none text-sm">
            <i class="fas fa-search absolute right-4 top-1/2 -translate-y-1/2 text-[#4B5563] text-sm"></i>
        </div>

        <!-- nav links + actions -->
        <div class="flex items-center gap-4 text-sm font-medium">
            <a href="{{route('dokan.index')}}"
                class="text-[#4B5563] hover:text-[#642671] transition-colors hidden sm:inline-block">Become a
                vendor</a>
            <a href="#" class="text-[#4B5563] hover:text-[#642671] transition-colors hidden sm:inline-block">Track
                order</a>
            <div class="flex items-center gap-3">
                <a href="#" class="relative text-[#4B5563] hover:text-[#642671] transition-colors">
                    <i class="fas fa-heart text-lg"></i>
                    <span
                        class="absolute -top-1 -right-2 bg-[#0F766E] text-white text-[10px] px-1.5 py-0.5 rounded-full">3</span>
                </a>
                <a href="#" class="relative text-[#4B5563] hover:text-[#642671] transition-colors">
                    <i class="fas fa-shopping-bag text-lg"></i>
                    <span
                        class="absolute -top-1 -right-2 bg-[#642671] text-white text-[10px] px-1.5 py-0.5 rounded-full">2</span>
                </a>
            </div>
            <div class="border-l border-[#E5E7EB] pl-3 flex items-center gap-2">
                <i class="fas fa-user-circle text-2xl text-[#642671]"></i>
                <span class="hidden sm:inline-block text-[#1F2937] font-medium">Account</span>
            </div>
            <button class="md:hidden text-[#4B5563] hover:text-[#642671]">
                <i class="fas fa-bars text-xl"></i>
            </button>
        </div>
    </div>
    <!-- mobile search (visible on small) -->
    <div class="md:hidden px-4 pb-3">
        <div class="relative">
            <input type="text" placeholder="Search..."
                class="w-full pl-4 pr-10 py-2 rounded-full border border-[#E5E7EB] bg-[#F8F6FA] focus:ring-2 focus:ring-[#642671]/30 text-sm">
            <i class="fas fa-search absolute right-4 top-1/2 -translate-y-1/2 text-[#4B5563] text-sm"></i>
        </div>
    </div>
</header>
