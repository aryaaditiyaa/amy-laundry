@extends('layouts.app')

@section('content')
    <section class="bg-white dark:bg-gray-900">
        <div class=" px-4 py-8 max-w-screen-xl mx-auto lg:py-16">
            <h1 class="font-bold text-xl md:text-3xl mb-4 md:mb-6">{{ $title }}</h1>

            <div class="space-y-8 grid grid-cols-2 sm:grid-cols-3 gap-4 xl:gap-10 lg:space-y-0">
                @foreach($products as $product)
                    <div class="p-4 border rounded-lg">
                        <div class="flex flex-col gap-y-2 flex-wrap">
                            <div class="flex flex-wrap items-center gap-3 sm:gap-4">
                                <img src="{{ asset('storage/' . $product->image) }}" class="w-full sm:w-20 h-20 rounded object-center object-cover" alt="">
                                <div>
                                    <div class="text-lg font-medium">{{ $product->name }}</div>
                                    <div class="text-sm text-gray-500 line-clamp-1">{{ $product->description }}</div>
                                    <div class="text-base mt-1 text-primary-600">
                                        Rp. {{ $product->price }} {{ $product->unit ? ' / ' . $product->unit: null }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>

            <div class="mt-4">
                {{ $products->links() }}
            </div>
        </div>
    </section>
@endsection
