<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Manage Customer';

        $datasets = User::query()
            ->when($request->filled('keyword'), function ($query) use ($request) {
                return $query->where('name', 'like', '%' . $request->keyword . '%');
            })
            ->customer()
            ->latest()
            ->paginate(8)
            ->withQueryString();

        return view('pages.customer.index', compact('title', 'datasets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Create Customer';
        return view('pages.customer.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'min:3'],
            'email' => ['required', 'email', Rule::unique(User::class, 'email')],
            'phone_number' => ['required', 'string'],
            'address' => ['nullable', 'min:5'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            User::query()->create(array_merge($validator->validated(), [
                'role' => User::TYPE_CUSTOMER,
                'code' => 'C-' . now()->format('dmYHis'),
            ]));

            return to_route('customer.index')->with('success', 'Customer created!');
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage())->withInput();
        }

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $customer)
    {
        $title = 'Edit Customer';
        return view('pages.customer.edit', compact('title', 'customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $customer)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'min:3'],
            'phone_number' => ['required', 'string'],
            'email' => ['required', 'email', Rule::unique(User::class, 'email')->ignore($customer->id)],
            'address' => ['nullable', 'min:5'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $customer->update($validator->validated());

            return to_route('customer.index')->with('success', 'Customer updated!');
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $customer)
    {
        try {
            $customer->delete();

            return to_route('customer.index')->with('success', 'Customer deleted!');
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage())->withInput();
        }
    }
}
