<x-frontend-layout>
    <!-- ===== TERMS OF SERVICE PAGE ===== -->
    <div class="max-w-4xl mx-auto py-8 px-4">
        <!-- Page Header -->
        <div class="mb-8 text-center">
            <span
                class="inline-block bg-[#642671]/10 text-[#642671] text-xs font-semibold px-3 py-1 rounded-full mb-3">📋
                Legal</span>
            <h1 class="text-3xl md:text-4xl font-heading font-bold text-[#1F2937]">Terms of <span
                    class="text-[#642671]">Service</span></h1>
            <p class="text-[#4B5563] mt-2">Last updated: August 13, 2026</p>
        </div>

        <!-- Content Card -->
        <div class="bg-white border border-[#E5E7EB] rounded-2xl shadow-brand overflow-hidden">
            <div class="p-6 md:p-8 space-y-6 text-[#4B5563] leading-relaxed">
                <!-- Introduction -->
                <div>
                    <h2 class="text-xl font-heading font-semibold text-[#1F2937] mb-3">1. Introduction</h2>
                    <p>Welcome to <strong>CodeIT Dokan</strong>. By using our multi-vendor e-commerce platform, you
                        agree to comply with and be bound by the following terms and conditions. Please read these Terms
                        of Service carefully before using our platform.</p>
                    <p class="mt-2">These Terms apply to all users, including vendors, customers, and visitors. If you
                        do not agree with any part of these terms, you must not use our services.</p>
                </div>

                <!-- Vendor Terms -->
                <div>
                    <h2 class="text-xl font-heading font-semibold text-[#1F2937] mb-3">2. Vendor Terms</h2>
                    <ul class="list-disc pl-5 space-y-2">
                        <li>Vendors must provide accurate and complete information during registration, including valid
                            PAN number and contact details.</li>
                        <li>All products listed must be legal, authentic, and comply with applicable laws and
                            regulations.</li>
                        <li>Vendors are responsible for product quality, pricing, shipping, and customer service for
                            their orders.</li>
                        <li>CodeIT Dokan reserves the right to suspend or terminate vendor accounts that violate these
                            terms.</li>
                        <li>A commission fee applies to each successful sale, as specified in the vendor agreement.</li>
                    </ul>
                </div>

                <!-- Customer Terms -->
                <div>
                    <h2 class="text-xl font-heading font-semibold text-[#1F2937] mb-3">3. Customer Terms</h2>
                    <ul class="list-disc pl-5 space-y-2">
                        <li>Customers must provide accurate shipping and billing information when placing orders.</li>
                        <li>All payments are processed securely through our payment partners.</li>
                        <li>Customers may request cancellations or refunds within 7 days of purchase, subject to vendor
                            policies.</li>
                        <li>Reviews and feedback should be honest and constructive.</li>
                        <li>Customers are responsible for maintaining the confidentiality of their account credentials.
                        </li>
                    </ul>
                </div>

                <!-- Platform Rules -->
                <div>
                    <h2 class="text-xl font-heading font-semibold text-[#1F2937] mb-3">4. Platform Rules</h2>
                    <ul class="list-disc pl-5 space-y-2">
                        <li>Users must not engage in fraudulent activities, including fake reviews or manipulated
                            ratings.</li>
                        <li>Any form of harassment, abuse, or discrimination is strictly prohibited.</li>
                        <li>Users must respect intellectual property rights and not upload copyrighted content without
                            permission.</li>
                        <li>CodeIT Dokan may collect and use data as described in our Privacy Policy.</li>
                        <li>We reserve the right to modify these terms at any time. Users will be notified of
                            significant changes.</li>
                    </ul>
                </div>

                <!-- Limitation of Liability -->
                <div>
                    <h2 class="text-xl font-heading font-semibold text-[#1F2937] mb-3">5. Limitation of Liability</h2>
                    <p>CodeIT Dokan provides the platform "as is" and makes no warranties regarding the availability,
                        reliability, or suitability of the services. We are not liable for any direct, indirect,
                        incidental, or consequential damages arising from the use of our platform.</p>
                    <p class="mt-2">Vendors and customers are responsible for their own transactions and interactions.
                        CodeIT Dokan acts as a facilitator only and is not a party to any purchase agreements.</p>
                </div>

                <!-- Termination -->
                <div>
                    <h2 class="text-xl font-heading font-semibold text-[#1F2937] mb-3">6. Termination</h2>
                    <p>We reserve the right to suspend or terminate user accounts at our sole discretion, without prior
                        notice, for conduct that violates these Terms or is harmful to other users or the platform.</p>
                </div>

                <!-- Governing Law -->
                <div>
                    <h2 class="text-xl font-heading font-semibold text-[#1F2937] mb-3">7. Governing Law</h2>
                    <p>These Terms shall be governed by and construed in accordance with the laws of Nepal. Any disputes
                        shall be subject to the exclusive jurisdiction of the courts in Kathmandu, Nepal.</p>
                </div>

                <!-- Contact -->
                <div class="bg-[#F8F6FA] rounded-xl p-4 border border-[#E5E7EB]">
                    <h2 class="text-xl font-heading font-semibold text-[#1F2937] mb-2">8. Contact Us</h2>
                    <p>If you have any questions about these Terms, please contact us at:</p>
                    <div class="mt-2 text-sm">
                        <p><i class="fas fa-envelope text-[#642671] w-5"></i> support@codeitdokan.com</p>
                        <p><i class="fas fa-phone text-[#642671] w-5"></i> +977 1 1234567</p>
                        <p><i class="fas fa-map-marker-alt text-[#642671] w-5"></i> Kathmandu, Nepal</p>
                    </div>
                </div>

                <!-- Last updated -->
                <p class="text-xs text-[#4B5563] italic border-t border-[#E5E7EB] pt-4">These Terms of Service were last
                    updated on August 13, 2026.</p>
            </div>
        </div>

        <!-- Back link -->
        <div class="mt-6 text-center">
            <a href="{{ route('home') }}"
                class="text-[#642671] hover:text-[#54205F] font-medium inline-flex items-center gap-2">
                <i class="fas fa-arrow-left text-sm"></i> Back to Home
            </a>
        </div>
    </div>
</x-frontend-layout>
