<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $title = 'Manage Cart';
        $carts = Cart::query()
            ->with('product')
            ->get();

        return view('pages.cart.index', compact('title', 'carts'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $title = 'Choose product';
        $products = Product::query()
            ->withCount('carts')
            ->paginate(20)
            ->withQueryString();

        return view('pages.cart.create', compact('title', 'request', 'products'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => ['required', Rule::exists(Product::class, 'id'), Rule::unique(Cart::class, 'product_id')],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            Cart::query()->create(array_merge(
                $validator->validated(),
                [
                    'qty' => 1
                ]
            ));

            return to_route('cart.create')->with('success', 'Item added to cart!');
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Cart $cart)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Cart $cart)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Cart $cart)
    {
        $validator = Validator::make($request->all(), [
            'product_id' => ['nullable', Rule::exists(Product::class, 'id'), Rule::unique(Cart::class, 'product_id')->ignore($cart->id)],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $cart->update([
                'qty' => $request->qty_action === 'decrease' ? $cart->qty - 1 : $cart->qty + 1
            ]);

            return to_route('cart.index')->with('success', 'Cart updated!');
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage())->withInput();
        }

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Cart $cart)
    {
        try {
            $cart->delete();

            return to_route('cart.index')->with('success', 'Cart item deleted!');
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage())->withInput();
        }
    }
}
