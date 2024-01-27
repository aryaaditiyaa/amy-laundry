@if(url()->current() == route('login'))

@elseif(auth()->check() && auth()->user()?->role == 'admin')
@else
    <footer class="p-4 bg-white md:p-8 lg:p-10 dark:bg-gray-800">
        <div class="mx-auto max-w-screen-xl text-center">
            <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© 2023 <a href="{{ route('home') }}" class="hover:underline">Home Laundry™</a>. All Rights Reserved.</span>
        </div>
    </footer>
@endif
