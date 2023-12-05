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
                <li class="flex items-center text-blue-600 dark:text-blue-500">
                    <span class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-blue-600 rounded-full shrink-0 dark:border-blue-500">
                        2
                    </span>
                    Cart
                    <svg class="w-3 h-3 ms-2 sm:ms-4 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 12 10">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m7 9 4-4-4-4M1 9l4-4-4-4"/>
                    </svg>
                </li>
                <li class="flex items-center">
                    <span class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                        3
                    </span>
                    Checkout
                </li>
            </ol>

            <div class="grid gap-4 grid-cols-2 sm:grid-cols-3 sm:gap-6">
                @foreach($carts as $cart)
                    {{--                    <form action="{{ route('cart.store') }}" method="POST">--}}
                    {{--                        @csrf--}}
                    {{--                        <input type="hidden" name="product_id" value="{{ $cart->product->id }}">--}}
                    <div class="p-4 border rounded-lg">
                        <div class="flex flex-col gap-y-2 flex-wrap">
                            <div class="flex flex-wrap items-center gap-3 sm:gap-4">
                                <img src="{{ asset('storage/' . $cart->product->image) }}" class="w-full sm:w-20 h-20 rounded object-center object-cover" alt="">
                                <div>
                                    <div class="text-lg font-medium">{{ $cart->product->name }}</div>
                                    <div class="text-base mt-1 text-primary-600">
                                        Rp. {{ $cart->product->price * $cart->qty }}
                                    </div>
                                </div>
                            </div>
                            <div class="mt-3 flex-1 flex flex-wrap sm:flex-nowrap items-center justify-end gap-x-4 gap-y-3 sm:gap-y-0">
                                <div>
                                    <label
                                        for="quantity-input-{{ $cart->id }}"
                                        class="sr-only block text-sm font-medium text-gray-900 dark:text-white">
                                        Choose quantity:
                                    </label>
                                    <div class="relative flex items-center w-full sm:max-w-[8rem]">
                                        <form action="{{ route('cart.update', $cart) }}" method="POST">
                                            @csrf
                                            @method('PATCH')

                                            <input type="hidden" name="qty_action" value="decrease">
                                            <button type="submit" {{ $cart->qty == 1 ? 'disabled' : null }} id="decrement-button-{{ $cart->id }}" {{--onclick="decrement('{{ 'quantity-input-' . $cart->id }}')"--}} data-input-counter-decrement="quantity-input" class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-s-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                                <svg class="w-3 h-3 {{ $cart->qty == 1 ? 'text-gray-300' : 'text-gray-900 dark:text-white' }}" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 2">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 1h16"/>
                                                </svg>
                                            </button>
                                        </form>

                                        <input type="text" name="qty_action" id="quantity-input-{{ $cart->id }}" data-input-counter aria-describedby="helper-text-explanation" class="bg-gray-50 border-x-0 border-gray-300 h-11 text-center text-gray-900 text-sm focus:ring-blue-500 focus:border-blue-500 block w-full dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="1" value="{{ $cart->qty }}" required>

                                        <form action="{{ route('cart.update', $cart) }}" method="POST">
                                            @csrf
                                            @method('PATCH')

                                            <input type="hidden" name="qty" value="increase">
                                            <button type="submit" id="increment-button-{{ $cart->id }}" {{--onclick="increment('{{ 'quantity-input-' . $cart->id }}')"--}} data-input-counter-increment="quantity-input" class="bg-gray-100 dark:bg-gray-700 dark:hover:bg-gray-600 dark:border-gray-600 hover:bg-gray-200 border border-gray-300 rounded-e-lg p-3 h-11 focus:ring-gray-100 dark:focus:ring-gray-700 focus:ring-2 focus:outline-none">
                                                <svg class="w-3 h-3 text-gray-900 dark:text-white" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 18 18">
                                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 1v16M1 9h16"/>
                                                </svg>
                                            </button>
                                        </form>
                                    </div>
                                </div>

                                <form action="{{ route('cart.destroy', $cart) }}" method="POST" class="w-full sm:w-auto">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center px-5 py-2.5 text-sm font-medium text-center border border-red-700 text-red-700 rounded-lg focus:ring-4 focus:ring-red-200 dark:focus:ring-red-900 hover:bg-gray-50">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="flex items-center gap-x-2">
                <a href="{{ route('cart.create') }}" class="w-full sm:w-auto inline-flex justify-center items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center border border-primary-700 text-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-gray-50">
                    Add items
                </a>
                <a href="{{ route('transaction.create') }}" class="w-full sm:w-auto justify-center inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white border border-primary-700 bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                    Next Step: Checkout
                </a>
            </div>
        </div>
    </section>
@endsection

{{--@push('script')--}}
{{--    <script>--}}
{{--        function increment(inputId) {--}}
{{--            let inputElement = document.getElementById(inputId);--}}
{{--            let currentValue = parseInt(inputElement.value) || 0;--}}
{{--            inputElement.value = currentValue + 1;--}}
{{--        }--}}

{{--        function decrement(inputId) {--}}
{{--            let inputElement = document.getElementById(inputId);--}}
{{--            let currentValue = parseInt(inputElement.value) || 0;--}}
{{--            inputElement.value = Math.max(1, currentValue - 1);--}}
{{--        }--}}
{{--    </script>--}}
{{--@endpush--}}
