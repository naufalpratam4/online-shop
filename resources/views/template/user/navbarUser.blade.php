<nav class="bg-yellow-700 border-gray-200 dark:bg-gray-900">
    <div class="max-w-screen-xl flex items-center justify-between mx-auto p-4">
        <div class="font-bold">
            <a href="" class="text-white text-3xl fontbo">Kejuku</a>
        </div>
        <div class="w-9/12 hidden md:block">
            @include('template.user.search')
        </div>
        <div class=" md:block md:w-auto" id="navbar-default">
            <ul
                class="font-medium flex gap-4  p-4 md:p-0 mt-4  rounded-lg  md:flex-row md:space-x-8 rtl:space-x-reverse md:mt-0 md:border-0   dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
                <li class="relative">
                    <a href="/cart">
                        <i class="fa-solid fa-cart-shopping text-white text-3xl"></i>
                        @php
                            $cartItemCount = 1;
                        @endphp
                        @if ($cartItemCount > 0)
                            <span
                                class="absolute top-0 right-0 transform translate-x-1/2 -translate-y-1/2 bg-red-600 text-white rounded-full px-2 text-xs">
                                {{ $cartItemCount }}
                            </span>
                        @endif
                    </a>
                </li>
                <li>
                    <a href="/user-detail"> <i class="fa-solid fa-user text-white text-3xl"></i></a>

                </li>
            </ul>
        </div>
    </div>
</nav>
