@extends('layouts.app')

@section('content')
    <section class="p-4 sm:ml-64">
        <div class="p-0 md:p-2 mt-14">
            <h1 class="font-bold text-xl md:text-2xl mb-6 md:mb-8">{{ $title }}</h1>


            <ol class="flex items-center w-full space-x-2 mb-6 md:mb-8 text-sm font-medium text-center text-gray-500 bg-white dark:text-gray-400 sm:text-base dark:bg-gray-800 sm:space-x-4 rtl:space-x-reverse">
                <li class="flex items-center">
                    <span class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                        1
                    </span>
                    Product
                    <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 9 4-4-4-4M1 9l4-4-4-4"/>
                    </svg>
                </li>
                <li class="flex items-center">
                    <span class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                        2
                    </span>
                    Cart
                    <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 9 4-4-4-4M1 9l4-4-4-4"/>
                    </svg>
                </li>
                <li class="flex items-center text-primary-600 dark:text-primary-500">
                    <span class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-primary-600 rounded-full shrink-0 dark:border-primary-500">
                        3
                    </span>
                    Checkout
                </li>
            </ol>


            <form action="{{ route('transaction.store') }}" method="POST">
                @csrf
                <div class="grid gap-4 sm:grid-cols-1 sm:gap-6">
                    <div class="w-full">
                        <label for="user_id" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Select customer
                        </label>
                        <select id="user_id" name="user_id" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option selected disabled>Choose a customer</option>
                            @foreach($customers as $customer)
                                <option value="{{ $customer->id }}">{{ $customer->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="w-full">
                        <div class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Order List</div>
                        <div class="flex flex-col space-y-2">
                            @foreach($carts as $cart)
                                <div class="text-xs sm:text-sm grid grid-cols-5 gap-2 p-3 border rounded-lg">
                                    <div class="col-span-3">{{ $cart->product->name }}</div>
                                    <div>x{{ $cart->qty }}</div>
                                    <div>Rp. {{ $cart->product->price * $cart->qty }}</div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    <div class="w-full">
                        <label for="payment_method" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">
                            Select payment method
                        </label>
                        <select id="payment_method" name="payment_method" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-primary-500 focus:border-primary-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-primary-500 dark:focus:border-primary-500">
                            <option selected disabled>Choose payment method</option>
                            <option value="cash">Cash</option>
                            <option value="debit">Debit</option>
                            <option value="other">Other</option>
                        </select>
                    </div>
                </div>
                <div class="flex items-center space-x-2">
                    <a href="{{ route('cart.index') }}" class="w-full sm:w-auto inline-flex justify-center items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center border border-primary-700 text-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-gray-50">
                        Back
                    </a>
                    <button type="submit" class="w-full sm:w-auto inline-flex justify-center items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                        Make an order
                    </button>
                </div>
            </form>
        </div>
    </section>
@endsection
