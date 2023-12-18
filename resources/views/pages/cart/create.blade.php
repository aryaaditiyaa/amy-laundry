@extends('layouts.app')

@section('content')
    <section class="p-4 sm:ml-64">
        <div class="p-0 md:p-2 mt-14">
            <h1 class="font-bold text-xl md:text-2xl mb-6 md:mb-8">{{ $title }}</h1>

            <ol class="flex items-center w-full space-x-2 mb-6 md:mb-8 text-sm font-medium text-center text-gray-500 bg-white dark:text-gray-400 sm:text-base dark:bg-gray-800 sm:space-x-4 rtl:space-x-reverse">
                <li class="flex items-center text-primary-600 dark:text-primary-500">
                    <span class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-primary-600 rounded-full shrink-0 dark:border-primary-500">
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
                <li class="flex items-center">
                    <span class="flex items-center justify-center w-5 h-5 me-2 text-xs border border-gray-500 rounded-full shrink-0 dark:border-gray-400">
                        3
                    </span>
                    Checkout
                </li>
            </ol>

            <div class="grid gap-4 grid-cols-2 sm:grid-cols-3 sm:gap-6">
                @foreach($products as $product)
                    <form action="{{ route('cart.store') }}" method="POST">
                        @csrf
                        <input type="hidden" name="product_id" value="{{ $product->id }}">
                        <div class="p-4 border rounded-lg">
                            <div class="flex flex-col gap-y-2 flex-wrap">
                                <div class="flex flex-wrap items-center gap-3 sm:gap-4">
                                    <img src="{{ asset('storage/' . $product->image) }}" class="w-full sm:w-20 h-20 rounded object-center object-cover" alt="">
                                    <div>
                                        <div class="text-lg font-medium">{{ $product->name }}</div>
                                        <div class="text-base mt-1 text-primary-600">
                                            Rp. {{ $product->price }} {{ $product->unit ? ' / ' . $product->unit: null }}
                                        </div>
                                    </div>
                                </div>
                                <div class="flex-1 flex items-center justify-end gap-x-4">
                                    @if($product->carts_count < 1)
                                        <button type="submit" class="w-full sm:w-auto inline-flex items-center justify-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center border border-primary-700 text-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-gray-50">
                                            Add to cart
                                        </button>
                                    @else
                                        <button type="button" disabled class="w-full sm:w-auto inline-flex items-center justify-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center border border-gray-700 text-gray-700 rounded-lg focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-900">
                                            Already in cart
                                        </button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </form>
                @endforeach
            </div>

            <div class="mt-4">
                {{ $products->links() }}
            </div>

            <div class="flex items-center gap-x-2">
                {{--<a href="{{ route('customer.create') }}" class="inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center border border-primary-700 text-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-gray-50">
                    Add customer
                </a>--}}
                <a href="{{ route('cart.index') }}" class="w-full sm:w-auto justify-center inline-flex items-center px-5 py-2.5 mt-4 sm:mt-6 text-sm font-medium text-center text-white bg-primary-700 rounded-lg focus:ring-4 focus:ring-primary-200 dark:focus:ring-primary-900 hover:bg-primary-800">
                    Next Step: Overview Cart
                </a>
            </div>
        </div>
    </section>
@endsection
