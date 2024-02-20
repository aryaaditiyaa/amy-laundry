<?php

namespace App\Http\Controllers;

use App\Models\Transaction;
use App\Models\TransactionComplaint;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class TransactionComplaintController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $validator = Validator::make($request->all(), [
            'transaction_id' => ['required', Rule::exists(Transaction::class, 'id')],
            'description' => ['required', 'string'],
            'proof_of_complaint' => ['nullable', 'image'],
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }
        try {
            $image = $request->file('proof_of_complaint')
                ? Storage::disk('public')->putFile('complaints', $request->file('proof_of_complaint'))
                : null;

            TransactionComplaint::query()
                ->create(array_merge($validator->validated(), [
                    'proof_of_complaint' => $image
                ]));

            return back()->with('success', 'Complaint created!');
        } catch (\Exception $exception) {
            return back()->with('error', $exception->getMessage())->withInput();
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(TransactionComplaint $transactionComplaint)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(TransactionComplaint $transactionComplaint)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, TransactionComplaint $transactionComplaint)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(TransactionComplaint $transactionComplaint)
    {
        //
    }
}
