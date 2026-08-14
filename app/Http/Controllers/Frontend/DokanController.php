<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Mail\DokanRegistrationNotification;
use App\Models\Admin;
use App\Models\Dokan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Sudam\SudamSweetAlert\Facades\SudamSweetAlert;

class DokanController extends Controller
{
    public function index()
    {
        return view('frontend.dokan_registration');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:dokans,email'],
            'contact' => ['required', 'string', 'max:20', 'regex:/^[0-9+\-\s()]+$/'],
            'dokan_name' => ['required', 'string', 'max:255', 'unique:dokans,dokan_name'],
            'pan_no' => ['required', 'string', 'max:50', 'unique:dokans,pan_no', 'regex:/^[0-9]+$/'],
            'terms' => ['required', 'accepted'],
        ]);

        $dokan = Dokan::create([
            'name' => $request->name,
            'email' => $request->email,
            'contact' => $request->contact,
            'dokan_name' => $request->dokan_name,
            'pan_no' => $request->pan_no
        ]);

        $admin = Admin::first();
        Mail::to($admin->email)->send(new DokanRegistrationNotification($dokan));

        SudamSweetAlert::toast('success', 'Request Sent!');

        return redirect()->route('dokan.index');
    }
}
