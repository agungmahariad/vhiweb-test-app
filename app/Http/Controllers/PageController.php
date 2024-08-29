<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function vendor()
    {
        $vendors = User::role('Vendor')->get();
        return view('vendor.index', compact('vendors'));
    }

    public function buyer()
    {
        $buyers = User::role('Buyer')->get();
        return view('buyer.index', compact('buyers'));
    }

    public function vendorVerify($id)
    {
        $user = User::find($id);
        $user->update(['email_verified_at' => now()]);
        $user->save();
        return redirect()->route('vendor');
    }
}
