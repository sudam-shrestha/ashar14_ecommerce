<?php

return [
    // Modal alert defaults
    'position' => 'center',
    'timer' => null,
    'show_confirm_button' => true,

    // Toast defaults
    'toast_position' => 'top-end',
    'toast_timer' => 3000,

    // Design — applies to both modals and toasts
    'show_close_button' => true,
    'confirm_button_color' => '#3085d6',
    'cancel_button_color' => '#d33',
    'background' => null,      // e.g. '#1a1a2e' for dark mode
    'text_color' => null,      // e.g. '#f5f5f5' for dark mode
    'buttons_styling' => true, // false if you want to style buttons yourself via custom_class
    'custom_class' => [
        // 'popup' => 'rounded-2xl shadow-xl',
        // 'confirmButton' => 'px-4 py-2 rounded-lg',
    ],

    'cdn' => 'https://cdn.jsdelivr.net/npm/sweetalert2@11',
];
