@extends('layouts.app')

@section('content')
    <section class="p-4 sm:ml-64">
        <div class="p-0 md:p-2 mt-14">
            <h1 class="font-bold text-xl md:text-2xl mb-4 md:mb-6">{{ $title }}</h1>

            <div class="bg-white dark:bg-gray-800 relative overflow-hidden">
                <div class="flex flex-col md:flex-row items-center justify-between space-y-3 md:space-y-0 md:space-x-4 p-4 border sm:rounded-lg">
                    <div class="w-full md:w-1/2">
                        <form action="{{ route('transaction.index') }}" method="GET" class="flex items-center">
                            <label for="simple-search" class="sr-only">Search</label>
                            <div class="relative w-full">
                                <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
                                    <svg aria-hidden="true" class="w-5 h-5 text-gray-500 dark:text-gray-400" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" d="M8 4a4 4 0 100 8 4 4 0 000-8zM2 8a6 6 0 1110.89 3.476l4.817 4.817a1 1 0 01-1.414 1.414l-4.816-4.816A6 6 0 012 8z" clip-rule="evenodd"/>
                                    </svg>
                                </div>
                                <input name="keyword" value="{{ old('keyword') ?? request()->keyword }}" type="text" id="simple-search" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full pl-10 p-2 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500" placeholder="Search">
                            </div>
                        </form>
                    </div>
                    <div class="w-full md:w-auto flex flex-col md:flex-row space-y-2 md:space-y-0 items-stretch md:items-center justify-end md:space-x-3 flex-shrink-0">
                        <a href="{{ route('cart.create') }}" class="flex items-center justify-center text-white bg-primary-700 hover:bg-primary-800 focus:ring-4 focus:ring-primary-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-primary-600 dark:hover:bg-primary-700 focus:outline-none dark:focus:ring-primary-800">
                            <svg class="h-3.5 w-3.5 mr-2" fill="currentColor" viewbox="0 0 20 20" xmlns="http://www.w3.org/2000/svg" aria-hidden="true">
                                <path clip-rule="evenodd" fill-rule="evenodd" d="M10 3a1 1 0 011 1v5h5a1 1 0 110 2h-5v5a1 1 0 11-2 0v-5H4a1 1 0 110-2h5V4a1 1 0 011-1z"/>
                            </svg>
                            Add transaction
                        </a>
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
                                        <form class="p-4 md:p-5" action="{{ route('transaction.index') }}" method="GET">
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
                                                <a href="{{ route('transaction.index') }}" class="text-primary-700 border border-primary-700 inline-flex items-center bg-white focus:ring-4 focus:outline-none focus:ring-primary-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-primary-600 dark:hover:bg-primary-700 dark:focus:ring-primary-800">
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
                        <a href="{{ route('transaction.export', [request()->getQueryString()]) }}" class="w-full md:w-auto flex items-center justify-center py-2 px-4 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-primary-700 focus:z-10 focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700" type="button">
                            <svg class="h-4 w-4 mr-2 text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20">
                                <path d="M14.707 7.793a1 1 0 0 0-1.414 0L11 10.086V1.5a1 1 0 0 0-2 0v8.586L6.707 7.793a1 1 0 1 0-1.414 1.414l4 4a1 1 0 0 0 1.416 0l4-4a1 1 0 0 0-.002-1.414Z"/>
                                <path d="M18 12h-2.55l-2.975 2.975a3.5 3.5 0 0 1-4.95 0L4.55 12H2a2 2 0 0 0-2 2v4a2 2 0 0 0 2 2h16a2 2 0 0 0 2-2v-4a2 2 0 0 0-2-2Zm-3 5a1 1 0 1 1 0-2 1 1 0 0 1 0 2Z"/>
                            </svg>
                            Download Report
                        </a>
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
                                    <div class="{{ $transaction->status == 'paid' ? 'bg-green-100 text-green-800 dark:bg-green-900 dark:text-green-300' : 'bg-yellow-100 text-yellow-800 dark:bg-yellow-900 dark:text-yellow-300' }} text-xs font-medium px-2.5 py-0.5 rounded-full">
                                        {{ \Illuminate\Support\Str::upper($transaction->status) }}
                                    </div>
                                    <div class="bg-purple-100 text-purple-800 text-xs font-medium px-2.5 py-0.5 rounded-full dark:bg-purple-900 dark:text-purple-300">
                                        {{ \Illuminate\Support\Str::ucfirst($transaction->payment_method) }}
                                    </div>
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
                                <div class="font-bold text-base sm:text-lg">Rp. {{ $transaction->total_price }}</div>
                                <div class="flex items-center gap-x-2">

                                        <div>
                                            <button data-modal-target="updateModal{{ $transaction->id }}" data-modal-toggle="updateModal{{ $transaction->id }}" type="button" class="inline-flex justify-center items-center px-5 py-2.5 text-sm font-medium text-center border border-green-700 text-green-700 rounded-lg focus:ring-4 focus:ring-green-200 dark:focus:ring-green-900 hover:bg-gray-50">
                                                Manage Status
                                            </button>
                                            <div id="updateModal{{ $transaction->id }}" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 items-center w-full md:inset-0 h-modal md:h-full">
                                                <div class="flex items-center relative p-4 w-full sm:max-w-4xl h-full md:h-auto">
                                                    <div class="w-full relative p-4 bg-white rounded-lg shadow dark:bg-gray-800 sm:p-5">
                                                        <button type="button" class="text-gray-400 absolute top-2.5 right-2.5 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="updateModal{{ $transaction->id }}">
                                                            <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                                                                <path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path>
                                                            </svg>
                                                            <span class="sr-only">Close modal</span>
                                                        </button>
                                                        <form action="{{ route('transaction.update', $transaction) }}" method="POST">
                                                            @csrf
                                                            @method('PATCH')
                                                            <div class="my-4">
                                                                <div class="grid gap-4 sm:grid-cols-1 sm:gap-6">
                                                                    <div class="w-full">
                                                                        <label for="status" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                                                                            Select status
                                                                        </label>
                                                                        <select id="status" name="status" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                                                                            <option value="unpaid" {{ $transaction->status == 'unpaid' ? 'selected' : null }} disabled>
                                                                                Unpaid
                                                                            </option>
                                                                            <option value="pending" {{ $transaction->status == 'pending' ? 'selected' : null }} disabled>
                                                                                Pending
                                                                            </option>
                                                                            <option value="paid" {{ $transaction->status == 'finish' ? 'disabled' : null }}>
                                                                                Paid
                                                                            </option>
                                                                            @if($transaction->status == 'paid')
                                                                                <option value="finish">
                                                                                    Finish
                                                                                </option>
                                                                            @endif
                                                                        </select>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="flex items-center space-x-4">
                                                                <button type="submit" class="py-2 px-3 text-sm font-medium text-center text-white bg-primary-600 rounded-lg hover:bg-primary-700 focus:ring-4 focus:outline-none focus:ring-primary-300 dark:bg-primary-500 dark:hover:bg-primary-600 dark:focus:ring-primary-900">
                                                                    Update
                                                                </button>
                                                            </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    <a href="{{ route('transaction.show', $transaction) }}" class="inline-flex justify-center items-center px-5 py-2.5 text-sm font-medium text-center border border-primary-700 text-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-gray-50">
                                        Detail
                                    </a>
                                </div>
                            </div>
                        </div>
                    @empty

                    @endforelse
                </div>
            </div>

            <div class="mt-4">
                {{ $transactions->links() }}
            </div>
        </div>
    </section>

@endsection
