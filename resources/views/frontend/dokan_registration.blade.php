<x-frontend-layout>
    <!-- ===== DOKAN REGISTRATION PAGE ===== -->
    <div class="max-w-4xl mx-auto py-8 px-4">
        <!-- Page Header -->
        <div class="mb-8 text-center">
            <span
                class="inline-block bg-[#642671]/10 text-[#642671] text-xs font-semibold px-3 py-1 rounded-full mb-3">🚀
                Become a Vendor</span>
            <h1 class="text-3xl md:text-4xl font-heading font-bold text-[#1F2937]">Start Your <span
                    class="text-[#642671]">Dokan</span> Journey</h1>
            <p class="text-[#4B5563] mt-2 max-w-2xl mx-auto">Fill in the details below to register your shop. Our team
                will review and activate your store within 24 hours.</p>
        </div>

        <!-- Registration Card -->
        <div class="bg-white border border-[#E5E7EB] rounded-2xl shadow-brand overflow-hidden">
            <!-- Progress Steps -->
            <div class="bg-[#F8F6FA] border-b border-[#E5E7EB] px-6 py-4 flex items-center justify-between">
                <div class="flex items-center gap-3 text-sm">
                    <span class="flex items-center gap-2">
                        <span
                            class="w-6 h-6 rounded-full bg-[#642671] text-white flex items-center justify-center text-xs font-bold">1</span>
                        <span class="text-[#1F2937] font-medium">Account</span>
                    </span>
                    <span class="text-[#E5E7EB]">—</span>
                    <span class="flex items-center gap-2">
                        <span
                            class="w-6 h-6 rounded-full bg-[#642671] text-white flex items-center justify-center text-xs font-bold">2</span>
                        <span class="text-[#1F2937] font-medium">Shop</span>
                    </span>
                    <span class="text-[#E5E7EB]">—</span>
                    <span class="flex items-center gap-2 opacity-50">
                        <span
                            class="w-6 h-6 rounded-full bg-[#E5E7EB] text-[#4B5563] flex items-center justify-center text-xs font-bold">3</span>
                        <span class="text-[#4B5563]">Verify</span>
                    </span>
                </div>
                <span class="text-xs text-[#4B5563]">Step 2 of 3</span>
            </div>

            <form action="{{ route('dokan.store') }}" method="POST" class="p-6 md:p-8 space-y-6">
                @csrf

                <!-- Personal Information -->
                <div>
                    <h3 class="text-lg font-heading font-semibold text-[#1F2937] mb-4 flex items-center gap-2">
                        <i class="fas fa-user-circle text-[#642671]"></i> Personal Information
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div>
                            <label for="name" class="block text-sm font-medium text-[#1F2937] mb-1">Full Name <span
                                    class="text-red-500">*</span></label>
                            <input type="text" id="name" name="name" value="{{ old('name') }}"
                                class="w-full px-4 py-2.5 rounded-lg border border-[#E5E7EB] bg-[#F8F6FA] focus:ring-2 focus:ring-[#642671]/30 focus:border-[#642671] outline-none transition-colors text-[#1F2937]"
                                placeholder="John Doe" required>
                            @error('name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="email" class="block text-sm font-medium text-[#1F2937] mb-1">Email Address
                                <span class="text-red-500">*</span></label>
                            <input type="email" id="email" name="email" value="{{ old('email') }}"
                                class="w-full px-4 py-2.5 rounded-lg border border-[#E5E7EB] bg-[#F8F6FA] focus:ring-2 focus:ring-[#642671]/30 focus:border-[#642671] outline-none transition-colors text-[#1F2937]"
                                placeholder="you@example.com" required>
                            @error('email')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                        <div>
                            <label for="contact" class="block text-sm font-medium text-[#1F2937] mb-1">Contact Number
                                <span class="text-red-500">*</span></label>
                            <input type="tel" id="contact" name="contact" value="{{ old('contact') }}"
                                class="w-full px-4 py-2.5 rounded-lg border border-[#E5E7EB] bg-[#F8F6FA] focus:ring-2 focus:ring-[#642671]/30 focus:border-[#642671] outline-none transition-colors text-[#1F2937]"
                                placeholder="+977 98XXXXXXXX" required>
                            @error('contact')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <hr class="border-[#E5E7EB]">

                <!-- Shop Details -->
                <div>
                    <h3 class="text-lg font-heading font-semibold text-[#1F2937] mb-4 flex items-center gap-2">
                        <i class="fas fa-store text-[#642671]"></i> Shop Details
                    </h3>
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                        <div class="md:col-span-2">
                            <label for="dokan_name" class="block text-sm font-medium text-[#1F2937] mb-1">Dokan/Shop
                                Name <span class="text-red-500">*</span></label>
                            <input type="text" id="dokan_name" name="dokan_name" value="{{ old('dokan_name') }}"
                                class="w-full px-4 py-2.5 rounded-lg border border-[#E5E7EB] bg-[#F8F6FA] focus:ring-2 focus:ring-[#642671]/30 focus:border-[#642671] outline-none transition-colors text-[#1F2937]"
                                placeholder="My Awesome Shop" required>
                            @error('dokan_name')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                            <p class="text-xs text-[#4B5563] mt-1">This will be your store's public name.</p>
                        </div>
                        <div>
                            <label for="pan_no" class="block text-sm font-medium text-[#1F2937] mb-1">PAN Number <span
                                    class="text-red-500">*</span></label>
                            <input type="text" id="pan_no" name="pan_no" value="{{ old('pan_no') }}"
                                class="w-full px-4 py-2.5 rounded-lg border border-[#E5E7EB] bg-[#F8F6FA] focus:ring-2 focus:ring-[#642671]/30 focus:border-[#642671] outline-none transition-colors text-[#1F2937]"
                                placeholder="123456789" required>
                            @error('pan_no')
                                <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>
                </div>

                <hr class="border-[#E5E7EB]">

                <!-- Terms & Submit -->
                <div class="flex flex-col md:flex-row items-start md:items-center justify-between gap-4 pt-2">
                    <div class="flex items-center gap-2">
                        <input type="checkbox" id="terms" name="terms" required
                            class="w-4 h-4 rounded border-[#E5E7EB] text-[#642671] focus:ring-[#642671]/30 focus:ring-2">
                        <label for="terms" class="text-sm text-[#4B5563]">
                            I agree to the <a href="{{ route('terms') }}" target="_blank"
                                class="text-[#642671] hover:text-[#54205F] font-medium">Terms of Service</a> and <a
                                href="{{ route('policy') }}" target="_blank"
                                class="text-[#642671] hover:text-[#54205F] font-medium">Privacy
                                Policy</a>
                        </label>
                    </div>
                    <div class="flex items-center gap-3 w-full md:w-auto">
                        <a href="{{ route('home') }}"
                            class="text-[#4B5563] hover:text-[#642671] px-6 py-2.5 rounded-full border border-[#E5E7EB] font-medium text-center transition-colors">
                            Cancel
                        </a>
                        <button type="submit"
                            class="bg-[#642671] hover:bg-[#54205F] text-white px-8 py-2.5 rounded-full font-medium shadow-md shadow-[#642671]/20 transition-all flex items-center gap-2 w-full md:w-auto justify-center">
                            Register Dokan <i class="fas fa-arrow-right text-sm"></i>
                        </button>
                    </div>
                </div>

                <!-- Extra Info -->
                <div
                    class="bg-[#F8F6FA] rounded-xl p-4 border border-[#E5E7EB] flex flex-col md:flex-row items-start md:items-center gap-3 text-sm text-[#4B5563]">
                    <i class="fas fa-shield-alt text-[#0F766E] text-lg"></i>
                    <span>Your information is secure. We'll review your application and get back to you within 24
                        hours.</span>
                </div>
            </form>
        </div>

        <!-- Already have an account? -->
        <div class="mt-6 text-center text-sm text-[#4B5563]">
            Already have a Dokan account?
            <a href="#" class="text-[#642671] hover:text-[#54205F] font-medium">Login here</a>
        </div>
    </div>
</x-frontend-layout>
