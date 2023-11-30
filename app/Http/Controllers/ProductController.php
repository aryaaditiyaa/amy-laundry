<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Manage Product';
        $datasets = Product::query()
            ->when($request->filled('keyword'), function ($query) use ($request) {
                return $query->where('name', 'like', '%' . $request->keyword . '%');
            })
            ->paginate(5);

        return view('pages.product.index', compact('title', 'datasets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Create Product';
        return view('pages.product.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', Rule::unique(Product::class, 'name')],
            'unit' => ['nullable', 'string'],
            'image' => ['required', 'image', 'max:2048'],
            'price' => ['required', 'numeric', 'digits_between:1,10'],
            'description' => ['nullable', 'string'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $image = $request->file('image')
                ? Storage::disk('public')->putFile('products', $request->file('image'))
                : null;

            Product::query()->create(array_merge($validator->validated(), [
                'code' => 'P-' . now()->format('dmYHis'),
                'image' => $image
            ]));

            return to_route('product.index')->with('success', 'Product created!');
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Product $product)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        $title = 'Edit Product';
        return view('pages.product.edit', compact('title', 'product'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', Rule::unique(Product::class, 'name')->ignore($product->id)],
            'unit' => ['nullable', 'string'],
            'image' => [Rule::requiredIf($product->image == null), 'image', 'max:2048'],
            'price' => ['required', 'numeric', 'digits_between:1,10'],
            'description' => ['nullable', 'string'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $image = $request->file('image')
                ? Storage::disk('public')->putFile('products', $request->file('image'))
                : $product->image;

            $product->query()->update(array_merge($validator->validated(), [
                'image' => $image
            ]));

            return to_route('product.index')->with('success', 'Product updated!');
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        try {
            $product->delete();

            return to_route('product.index')->with('success', 'Product deleted!');
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage())->withInput();
        }
    }
}
