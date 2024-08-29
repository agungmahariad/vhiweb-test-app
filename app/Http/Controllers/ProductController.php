<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if (Auth::user()->roles->first()->name == 'Vendor') {
            $products = Product::where('user_id', Auth::id())->get();
            return view('product.vendor', compact('products'));
        } else {
            // search
            if (request()->has('search')) {
                $products = Product::where('name', 'like', '%' . request('search') . '%')->paginate('10');
            } else {
                $products = Product::paginate('10');
            }

            return view('product.buyer', compact('products'));
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Auth::user()->roles->first()->name == 'Vendor') {
            return abort(403);
        }
        $input = $request->except('_token');
        if ($request->hasFile('photo')) {
            $photo = $request->file('photo');
            $name = time() . '.' . $photo->getClientOriginalExtension();
            $photo->move(public_path('images'), $name);
            $input['photo'] = $name;
        }
        $input['user_id'] = Auth::id();
        Product::create($input);
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        if (!Auth::user()->roles->first()->name == 'Vendor') {
            return abort(403);
        }
        $product->delete();
        return redirect()->route('product.index');
    }
}
