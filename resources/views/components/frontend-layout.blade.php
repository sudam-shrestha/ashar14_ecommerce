<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CodeIT Dokan · multi-vendor</title>
    <!-- Vite handles Tailwind 4 + Flowbite 4.0.2 -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <!-- Font Awesome 7 (optional, already in layout) -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.3.0/css/all.min.css"
        integrity="sha512-ApSLB1Pd3/bZN8fWB/RG9YhN/7bd9Hkf3AGaE2mPfebjrxagjuBtx2GcgdqIlJkUzwylBo61r9Xa9NmgBI0swA=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
    <!-- custom main.css (overwrites/extends) -->
    <link rel="stylesheet" href="{{ asset('frontend/main.css') }}">
    <style>
        /* additional inline tweaks – keep consistent with :root */
        .bg-brand-soft {
            background: #F8F6FA;
        }

        .text-brand {
            color: #642671;
        }

        .border-brand {
            border-color: #642671;
        }

        .hover\:bg-brand-hover:hover {
            background-color: #54205F;
        }

        .shadow-brand {
            box-shadow: 0 8px 20px rgba(100, 38, 113, 0.12);
        }
    </style>
</head>

<body class="bg-[#F8F6FA] font-body antialiased">

    <!-- ========== HEADER ========== -->
    <x-frontend-header />

    <!-- ========== MAIN CONTENT ========== -->
    <main class="min-h-[60vh] container mx-auto px-4 lg:px-6 py-6">

        {{ $slot }}

    </main>

    <!-- ========== FOOTER ========== -->
    <x-frontend-footer />

    <!-- stack scripts (if any) -->
    @stack('scripts')


    @include('sudam-sweet-alert::alert')   
</body>

</html>
