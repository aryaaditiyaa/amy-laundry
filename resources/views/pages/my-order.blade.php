@extends('layouts.app')

@section('content')
    <section class="bg-white dark:bg-gray-900">
        <div class=" px-4 py-8 max-w-screen-xl mx-auto lg:py-16">
            <h1 class="font-bold text-xl md:text-3xl mb-4 md:mb-6">{{ $title }}</h1>

            <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 sm:rounded-lg">
                <div class="w-full md:w-1/4">
                    <form action="{{ route('user.transaction.history') }}" method="GET" class="flex items-center">
                        <label for="simple-search" class="sr-only">Search</label>
                        <div class="relative w-full">
                            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                    <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/>
                                </svg>
                            </div>
                            <input name="keyword" value="{{ old('keyword') ?? request()->keyword }}" type="text" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Phone number or transaction code">
                        </div>
                    </form>
                </div>
                <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                    <div>
                        <button data-modal-target="filter-modal" data-modal-toggle="filter-modal" class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" type="button">
                            <svg xmlns="http://www.w3.org/2000/svg" aria-hidden="true" class="h-4 w-4 mr-2 text-gray-400" viewbox="0 0 20 20" fill="currentColor">
                                <path fill-rule="evenodd" d="M3 3a1 1 0 011-1h12a1 1 0 011 1v3a1 1 0 01-.293.707L12 11.414V15a1 1 0 01-.293.707l-2 2A1 1 0 018 17v-5.586L3.293 6.707A1 1 0 013 6V3z" clip-rule="evenodd"/>
                            </svg>
                            Filter
                        </button>

                        <div id="filter-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                            <div class="relative p-4 w-full max-w-md max-h-full">
                                <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                                    <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                        <h3 class="text-lg font-bold text-gray-900 dark:text-white">
                                            Filter
                                        </h3>
                                        <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="filter-modal">
                                            <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                            </svg>
                                            <span class="sr-only">Close modal</span>
                                        </button>
                                    </div>
                                    <form class="p-4 md:p-5" action="{{ route('user.transaction.history') }}" method="GET">
                                        <div class="grid gap-4 mb-4 grid-cols-2">
                                            <div class="col-span-2 sm:col-span-1">
                                                <label for="start_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Start
                                                    Date</label>
                                                <input type="date" name="start_date" value="{{ request()->start_date }}" id="start_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                            </div>
                                            <div class="col-span-2 sm:col-span-1">
                                                <label for="end_date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">End
                                                    Date</label>
                                                <input type="date" name="end_date" value="{{ request()->end_date }}" id="end_date" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-600 focus:border-primary-600 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                            </div>
                                            <div class="col-span-2">
                                                <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Status</label>
                                                <select id="status" name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-600 dark:border-gray-500 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                    <option selected disabled>--Select status--</option>
                                                    <option value="">All</option>
                                                    <option value="process" {{ request()->status == 'process' ? 'selected' : null }}>
                                                        Process
                                                    </option>
                                                    <option value="unpaid" {{ request()->status == 'unpaid' ? 'selected' : null }}>
                                                        Unpaid
                                                    </option>
                                                    <option value="paid" {{ request()->status == 'paid' ? 'selected' : null }}>
                                                        Paid
                                                    </option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="flex items-center gap-x-2">
                                            <a href="{{ route('user.transaction.history') }}" class="text-primary-700 border border-primary-700 inline-flex items-center bg-white focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                                Reset
                                            </a>
                                            <button type="submit" class="text-white inline-flex items-center bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
                                                Apply
                                            </button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mt-6 flex flex-col space-y-4">
                @forelse($transactions as $transaction)
                    <div class="p-3 border rounded-lg">
                        <div class="flex items-center justify-between mb-4">
                            <div class="flex items-center gap-x-2">
                                <span class="bg-gray-100 text-gray-800 text-xs font-medium inline-flex items-center px-2.5 py-0.5 rounded me-2 dark:bg-gray-700 dark:text-gray-400 border border-gray-500 ">
                                    <svg class="w-2.5 h-2.5 me-1.5" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                        <path d="M10 0a10 10 0 1 0 10 10A10.011 10.011 0 0 0 10 0Zm3.982 13.982a1 1 0 0 1-1.414 0l-3.274-3.274A1.012 1.012 0 0 1 9 10V6a1 1 0 0 1 2 0v3.586l2.982 2.982a1 1 0 0 1 0 1.414Z"/>
                                    </svg>
                                    {{ \Carbon\Carbon::parse($transaction->created_at)->format('d-m-Y') }}
                                </span>
                            </div>
                            <div class="flex items-center gap-x-2">
                                <div class="{{ $transaction->type == 'express' ? 'bg-blue-100 text-blue-800 dark:bg-blue-900 dark:text-blue-300' : 'bg-orange-100 text-orange-800 dark:bg-orange-900 dark:text-orange-300' }} text-xs font-medium px-2.5 py-0.5 rounded-full">
                                    {{ ucfirst(str_replace('_', ' ', $transaction->type)) }}
                                </div>
                                <div class="{{ $transaction->status == 'paid' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300' }} text-xs font-medium px-2.5 py-0.5 rounded-full">
                                    {{ \Illuminate\Support\Str::upper($transaction->status) }}
                                </div>
                                <div class="bg-purple-100 text-purple-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-purple-900 dark:text-purple-300">
                                    {{ \Illuminate\Support\Str::ucfirst($transaction->payment_method) }}
                                </div>
                                @if(isset($transaction->complaint))
                                    <div class="bg-red-100 text-red-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-red-900 dark:text-red-300">
                                        Complained
                                    </div>
                                @endif
                            </div>
                        </div>
                        @forelse($transaction->items as $item)
                            <div class="even:bg-gray-50 text-xs sm:text-sm grid grid-cols-5 gap-2 p-3 border rounded-lg">
                                <div class="col-span-3">{{ $item->product?->name }}</div>
                                <div class="text-right">x{{ $item->qty }}</div>
                            </div>
                        @empty
                        @endforelse
                        <div class="flex items-center justify-between gap-x-2 mt-4 lg:mt-6">
                            <div class="font-bold text-base sm:text-lg">
                                Rp. {{ $transaction->total_price + $transaction->delivery_fee }}</div>
                            <div class="flex items-center gap-x-2">
                                <div>
                                    <button data-modal-target="progressModal{{ $transaction->id }}" data-modal-toggle="progressModal{{ $transaction->id }}" type="button" class="inline-flex justify-center items-center px-5 py-2.5 text-sm font-medium text-center border border-green-700 text-green-700 rounded-lg focus:ring-4 focus:ring-green-200 dark:focus:ring-green-900 hover:bg-gray-50">
                                        View Progress
                                    </button>
                                    <div id="progressModal{{ $transaction->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 items-center w-full md:inset-0 h-modal md:h-full">
                                        <div class="flex items-center relative p-4 w-full sm:max-w-4xl h-full md:h-auto">
                                            <div class="w-full relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                                                <button type="button" class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="updateModal{{ $transaction->id }}">
                                                    <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                        <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                                    </svg>
                                                    <span class="sr-only">Close modal</span>
                                                </button>
                                                <div class="my-4">
                                                    <ol class="relative border-s border-gray-200 dark:border-gray-700">
                                                        @if(isset($transaction->complaint))
                                                            <li class="mb-10 ms-4">
                                                                <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -start-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
                                                                <time class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">
                                                                    {{ \Carbon\Carbon::parse($transaction->complaint?->created_at)->isoFormat('LLL') }}
                                                                </time>
                                                                <h3 class="capitalize text-lg font-medium text-gray-900 dark:text-white">
                                                                    you write a complaint
                                                                </h3>
                                                                @if($transaction->complaint?->proof_of_complaint)
                                                                    <img src="{{ asset('storage/' . $transaction->complaint?->proof_of_complaint) }}" class="w-1/4 object-cover object-center" alt="">
                                                                @else
                                                                    -
                                                                @endif
                                                                <p class="text-base font-normal text-gray-500 dark:text-gray-400">
                                                                    {{ $transaction->complaint?->description }}
                                                                </p>
                                                            </li>
                                                        @endif
                                                        @forelse($transaction->history as $history)
                                                            <li class="mb-10 ms-4">
                                                                <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -start-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
                                                                <time class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">
                                                                    {{ \Carbon\Carbon::parse($history->created_at)->isoFormat('LLL') }}
                                                                </time>
                                                                <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                                                                    Info
                                                                </h3>
                                                                <p class="text-base font-normal text-gray-500 dark:text-gray-400">
                                                                    {{ $history->description }}
                                                                </p>
                                                            </li>
                                                        @empty
                                                            <li class="mb-10 ms-4">
                                                                <div class="absolute w-3 h-3 bg-gray-200 rounded-full mt-1.5 -start-1.5 border border-white dark:border-gray-900 dark:bg-gray-700"></div>
                                                                <time class="mb-1 text-sm font-normal leading-none text-gray-400 dark:text-gray-500">
                                                                    {{ now()->isoFormat('LLL') }}
                                                                </time>
                                                                <h3 class="text-lg font-medium text-gray-900 dark:text-white">
                                                                    Info
                                                                </h3>
                                                                <p class="text-base font-normal text-gray-500 dark:text-gray-400">
                                                                    Wait for status update.
                                                                </p>
                                                            </li>
                                                        @endforelse
                                                    </ol>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if($transaction->status == 'unpaid')
                                    <div>
                                        <button data-modal-target="updateModal{{ $transaction->id }}" data-modal-toggle="updateModal{{ $transaction->id }}" type="button" class="inline-flex justify-center items-center px-5 py-2.5 text-sm font-medium text-center bg-green-700 border border-green-700 text-white rounded-lg focus:ring-4 focus:ring-green-200 dark:focus:ring-green-900 hover:bg-green-500">
                                            Pay
                                        </button>
                                        <div id="updateModal{{ $transaction->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 items-center w-full md:inset-0 h-modal md:h-full">
                                            <div class="flex items-center relative p-4 w-full sm:max-w-4xl h-full md:h-auto">
                                                <form action="{{ route('transaction.update', $transaction) }}" method="POST" enctype="multipart/form-data" class="w-full relative">
                                                    @csrf
                                                    @method('PATCH')
                                                    <div class="p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                                                        <button type="button" class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="updateModal{{ $transaction->id }}">
                                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                                            </svg>
                                                            <span class="sr-only">Close modal</span>
                                                        </button>
                                                        <div class="my-4">
                                                            <div class="grid gap-4 sm:grid-cols-1 sm:gap-6">
                                                                <div class="w-full">
                                                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input">Upload
                                                                        proof of payment</label>
                                                                    <input type="file" name="proof_of_payment" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 file:bg-gray-50" aria-describedby="file_input_help" id="file_input">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="flex items-center space-x-4 mt-6">
                                                            <button type="submit" class="w-full sm:w-auto py-2 px-3 text-sm font-medium text-center text-white bg-green-600 rounded-lg hover:bg-green-700 focus:ring-4 focus:outline-none focus:ring-green-300 dark:bg-green-500 dark:hover:bg-green-600 dark:focus:ring-green-900">
                                                                Proceed
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                @if($transaction->status == 'finish' && !isset($transaction->complaint))
                                    <div>
                                        <button data-modal-target="complaintModal{{ $transaction->id }}" data-modal-toggle="complaintModal{{ $transaction->id }}" type="button" class="inline-flex justify-center items-center px-5 py-2.5 text-sm font-medium text-red-600 bg-white border border-red-700 rounded-lg focus:ring-4 focus:ring-red-200 dark:focus:ring-red-900 hover:bg-gray-50">
                                            Complaint
                                        </button>
                                        <div id="complaintModal{{ $transaction->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 items-center w-full md:inset-0 h-modal md:h-full">
                                            <div class="flex items-center relative p-4 w-full sm:max-w-4xl h-full md:h-auto">
                                                <form action="{{ route('transaction-complaint.store') }}" method="POST" enctype="multipart/form-data" class="w-full relative">
                                                    @csrf

                                                    <input type="hidden" name="transaction_id" value="{{ $transaction->id }}"/>

                                                    <div class="p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                                                        <button type="button" class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="complaintModal{{ $transaction->id }}">
                                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                                            </svg>
                                                            <span class="sr-only">Close modal</span>
                                                        </button>
                                                        <div class="mb-4">
                                                            <div class="grid gap-4 sm:grid-cols-1 sm:gap-6">
                                                                <div class="w-full">
                                                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="file_input_complaint">
                                                                        Upload photo (optional)
                                                                    </label>
                                                                    <input type="file" name="proof_of_complaint" class="block w-full text-sm text-gray-900 border border-gray-300 rounded-lg cursor-pointer bg-gray-50 dark:text-gray-400 focus:outline-none dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 file:bg-gray-50" aria-describedby="file_input_help" id="file_input_complaint">
                                                                </div>
                                                                <div class="w-full">
                                                                    <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white" for="description">
                                                                        Description (required)
                                                                    </label>
                                                                    <textarea id="description" name="description" rows="4" class="block p-2.5 w-full text-sm text-gray-900 bg-gray-50 rounded-lg border border-gray-300 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Write your complaints here..."></textarea>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="flex items-center space-x-4 mt-6">
                                                            <button type="submit" class="w-full sm:w-auto py-2 px-3 text-sm font-medium text-center text-white bg-red-600 rounded-lg hover:bg-red-700 focus:ring-4 focus:outline-none focus:ring-red-300 dark:bg-red-500 dark:hover:bg-red-600 dark:focus:ring-red-900">
                                                                Complaint
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="p-4 my-4">
                        <x-empty-data
                            :message="!request()->filled('keyword') ? 'Search your order...' : 'No result for ' . request()->keyword"
                        ></x-empty-data>
                    </div>
                @endforelse
            </div>

            @if(!empty($transactions))
                <div class="mt-4">
                    {{ $transactions->links() }}
                </div>
            @endif
        </div>
    </section>
@endsection
