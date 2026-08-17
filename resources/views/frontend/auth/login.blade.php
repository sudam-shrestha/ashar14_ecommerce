<x-frontend-layout>
    <div class="min-h-[80vh] flex items-center justify-center py-12 px-4">
        <div class="max-w-md w-full">
            <!-- Logo/Header -->
            <div class="text-center mb-8">
                <a href="{{ route('home') }}" class="inline-block">
                    <span class="text-3xl font-heading font-bold text-[#1F2937] tracking-tight">
                        <span class="text-[#642671]">CodeIT</span> Dokan
                    </span>
                </a>
                <h2 class="mt-4 text-2xl font-heading font-bold text-[#1F2937]">Welcome Back</h2>
                <p class="mt-2 text-sm text-[#4B5563]">Sign in to your account to continue</p>
            </div>

            <!-- Login Card -->
            <div class="bg-white border border-[#E5E7EB] rounded-2xl shadow-brand p-6 md:p-8">
                <!-- Google Login Button -->
                <a href="{{route('google.redirect')}}"
                   class="w-full flex items-center justify-center gap-3 bg-white border border-[#E5E7EB] hover:bg-[#F8F6FA] text-[#1F2937] font-medium py-3 px-4 rounded-xl transition-all duration-200">
                    <svg class="w-5 h-5" viewBox="0 0 48 48">
                        <path fill="#FFC107" d="M43.611,20.083H42V20H24v8h11.303c-1.649,4.657-6.08,8-11.303,8c-6.627,0-12-5.373-12-12c0-6.627,5.373-12,12-12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C12.955,4,4,12.955,4,24c0,11.045,8.955,20,20,20c11.045,0,20-8.955,20-20C44,22.659,43.862,21.35,43.611,20.083z"/>
                        <path fill="#FF3D00" d="M6.306,14.691l6.571,4.819C14.655,15.108,18.961,12,24,12c3.059,0,5.842,1.154,7.961,3.039l5.657-5.657C34.046,6.053,29.268,4,24,4C16.318,4,9.656,8.337,6.306,14.691z"/>
                        <path fill="#4CAF50" d="M24,44c5.166,0,9.86-1.977,13.409-5.192l-6.19-5.238C29.211,35.091,26.715,36,24,36c-5.202,0-9.619-3.317-11.283-7.946l-6.522,5.025C9.505,39.556,16.227,44,24,44z"/>
                        <path fill="#1976D2" d="M43.611,20.083H42V20H24v8h11.303c-0.792,2.237-2.231,4.166-4.087,5.571c0.001-0.001,0.002-0.001,0.003-0.002l6.19,5.238C36.971,39.205,44,34,44,24C44,22.659,43.862,21.35,43.611,20.083z"/>
                    </svg>
                    <span>Continue with Google</span>
                </a>

                <!-- Divider -->
                <div class="relative my-6">
                    <div class="absolute inset-0 flex items-center">
                        <div class="w-full border-t border-[#E5E7EB]"></div>
                    </div>
                    <div class="relative flex justify-center text-sm">
                        <span class="px-4 bg-white text-[#4B5563]">Or continue with</span>
                    </div>
                </div>

                <!-- Login Form -->
                <form action="{{ route('login.submit') }}" method="POST" class="space-y-5">
                    @csrf

                    <!-- Email -->
                    <div>
                        <label for="email" class="block text-sm font-medium text-[#1F2937] mb-1.5">
                            Email Address <span class="text-red-500">*</span>
                        </label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}"
                               class="w-full px-4 py-3 rounded-xl border border-[#E5E7EB] bg-[#F8F6FA] focus:ring-2 focus:ring-[#642671]/30 focus:border-[#642671] outline-none transition-colors text-[#1F2937] placeholder:text-[#9CA3AF]"
                               placeholder="you@example.com" required>
                        @error('email')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Password -->
                    <div>
                        <div class="flex items-center justify-between mb-1.5">
                            <label for="password" class="block text-sm font-medium text-[#1F2937]">
                                Password <span class="text-red-500">*</span>
                            </label>
                        </div>
                        <div class="relative">
                            <input type="password" id="password" name="password"
                                   class="w-full px-4 py-3 rounded-xl border border-[#E5E7EB] bg-[#F8F6FA] focus:ring-2 focus:ring-[#642671]/30 focus:border-[#642671] outline-none transition-colors text-[#1F2937] placeholder:text-[#9CA3AF]"
                                   placeholder="••••••••" required>
                            <button type="button" onclick="togglePassword('password')"
                                    class="absolute right-3 top-1/2 -translate-y-1/2 text-[#4B5563] hover:text-[#642671] transition-colors">
                                <i class="fas fa-eye"></i>
                            </button>
                        </div>
                        @error('password')
                            <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
                        @enderror
                    </div>

                    <!-- Remember Me -->
                    <div class="flex items-center justify-between">
                        <label class="flex items-center gap-2 cursor-pointer">
                            <input type="checkbox" name="remember" id="remember"
                                   class="w-4 h-4 rounded border-[#E5E7EB] text-[#642671] focus:ring-[#642671]/30 focus:ring-2">
                            <span class="text-sm text-[#4B5563]">Remember me</span>
                        </label>
                    </div>

                    <!-- Submit Button -->
                    <button type="submit"
                            class="w-full bg-[#642671] hover:bg-[#54205F] text-white font-medium py-3 px-4 rounded-xl shadow-lg shadow-[#642671]/20 transition-all duration-200 flex items-center justify-center gap-2">
                        <i class="fas fa-sign-in-alt"></i> Sign In
                    </button>
                </form>

                <!-- Register Link -->
                <p class="mt-6 text-center text-sm text-[#4B5563]">
                    Don't have an account?
                    <a href="{{ route('register') }}" class="text-[#642671] hover:text-[#54205F] font-medium transition-colors">
                        Create one now
                    </a>
                </p>
            </div>

            <!-- Demo Credentials -->
            <div class="mt-6 bg-[#F8F6FA] rounded-xl p-4 border border-[#E5E7EB] text-center">
                <p class="text-xs text-[#4B5563] font-medium">Demo Credentials</p>
                <p class="text-xs text-[#4B5563] mt-1">
                    <span class="font-semibold">Email:</span> demo@example.com
                    <span class="mx-2">|</span>
                    <span class="font-semibold">Password:</span> password
                </p>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
        function togglePassword(inputId) {
            const input = document.getElementById(inputId);
            const icon = input.nextElementSibling.querySelector('i');
            if (input.type === 'password') {
                input.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                input.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        }
    </script>
    @endpush
</x-frontend-layout>
