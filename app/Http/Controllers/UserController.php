<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $title = 'Manage Admin';

        $datasets = User::query()
            ->when($request->filled('keyword'), function ($query) use ($request) {
                return $query->where('name', 'like', '%' . $request->keyword . '%');
            })
            ->admin()
            ->paginate(8);

        return view('pages.user.index', compact('title', 'datasets'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $title = 'Create Admin';
        return view('pages.user.create', compact('title'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'min:3'],
            'phone_number' => ['required', 'string'],
            'email' => ['required', 'email', Rule::unique(User::class, 'email')],
            'password' => ['required', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            User::query()->create(array_merge($validator->validated(), [
                'code' => 'A-' . now()->format('dmYHis'),
            ]));

            return to_route('user.index')->with('success', 'Admin created!');
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage())->withInput();
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        $title = 'Edit Admin';
        return view('pages.user.edit', compact('title', 'user'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, User $user)
    {
        $validator = Validator::make($request->all(), [
            'name' => ['required', 'string', 'min:3'],
            'phone_number' => ['required', 'string'],
            'email' => ['required', 'email', Rule::unique(User::class, 'email')->ignore($user->id)],
            'password' => ['required', 'confirmed'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        try {
            $user->update($validator->validated());

            return to_route('user.index')->with('success', 'Admin updated!');
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage())->withInput();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        try {
            $user->delete();

            return to_route('user.index')->with('success', 'Admin deleted!');
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage())->withInput();
        }
    }
}
