<!-- drawer init and show -->
<div class="text-center pt-2">
    <button
        class="text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm px-5 py-2.5 dark:bg-green-600 dark:hover:bg-green-700 focus:outline-none dark:focus:ring-green-800 justify-start flex mb-2"
        type="button" data-drawer-target="drawer-navigation" data-drawer-show="drawer-navigation"
        aria-controls="drawer-navigation">
        <i class="fa-solid fa-bars"></i>
    </button>
</div>
<div class="">@yield('content')</div>
<!-- drawer component -->
<div id="drawer-navigation"
    class="fixed top-0 left-0 z-40 w-64 h-screen p-4 overflow-y-auto transition-transform -translate-x-full bg-white dark:bg-gray-800"
    tabindex="-1" aria-labelledby="drawer-navigation-label">
    <h5 id="drawer-navigation-label" class="text-base font-semibold text-gray-500 uppercase dark:text-gray-400">Menu
    </h5>
    <button type="button" data-drawer-hide="drawer-navigation" aria-controls="drawer-navigation"
        class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 absolute top-2.5 end-2.5 inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white">
        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20"
            xmlns="http://www.w3.org/2000/svg">
            <path fill-rule="evenodd"
                d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z"
                clip-rule="evenodd"></path>
        </svg>
        <span class="sr-only">Close menu</span>
    </button>
    <div class="py-4 overflow-y-auto">
        <ul class="flex flex-col justify-between h-full space-y-2 font-medium">
            <div>
                <li class="{{ Request::is('admin') ? 'bg-green-500 rounded-lg' : '' }}">
                    <a href="/admin"
                        class="{{ Request::is('admin') ? 'text-white' : '' }} flex items-center p-2 text-gray-900 rounded-lg dark:text-white group">
                        <svg class="{{ Request::is('admin') ? 'text-white' : '' }} w-5 h-5 text-gray-500 transition duration-75 dark:text-gray-400"
                            aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor"
                            viewBox="0 0 22 21">
                            <path
                                d="M16.975 11H10V4.025a1 1 0 0 0-1.066-.998 8.5 8.5 0 1 0 9.039 9.039.999.999 0 0 0-1-1.066h.002Z" />
                            <path
                                d="M12.5 0c-.157 0-.311.01-.565.027A1 1 0 0 0 11 1.02V10h8.975a1 1 0 0 0 1-.935c.013-.188.028-.374.028-.565A8.51 8.51 0 0 0 12.5 0Z" />
                        </svg>
                        <span class="ms-3">Dashboard</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/produk', 'admin/produk/*') ? 'bg-green-500 rounded-lg' : '' }}">
                    <a href="/admin/produk"
                        class="{{ Request::is('admin/produk', 'admin/produk/*') ? 'text-white' : '' }} flex items-center p-2 text-gray-900 rounded-lg dark:text-white group">
                        <i class="fa-solid fa-store"></i>
                        <span class="ms-3">Produk</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/pos') ? 'bg-green-500 rounded-lg' : '' }}">
                    <a href="/admin/pos"
                        class="{{ Request::is('admin/pos') ? 'text-white' : '' }} flex items-center p-2 text-gray-900 rounded-lg dark:text-white group">
                        <i class="fa-solid fa-cash-register"></i>
                        <span class="ms-3">POS</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/jastip') ? 'bg-green-500 rounded-lg' : '' }}">
                    <a href="/admin/jastip"
                        class="{{ Request::is('admin/jastip') ? 'text-white' : '' }} flex items-center p-2 text-gray-900 rounded-lg dark:text-white group">
                        <i class="fa-solid fa-motorcycle"></i>
                        <span class="ms-3">Jastip</span>
                    </a>
                </li>
                <li class="{{ Request::is('admin/data-transaksi') ? 'bg-green-500 rounded-lg' : '' }}">
                    <a href="/admin/data-transaksi"
                        class="{{ Request::is('admin/data-transaksi') ? 'text-white' : '' }} flex items-center p-2 text-gray-900 rounded-lg dark:text-white group">
                        <i class="fa-solid fa-file-invoice"></i>
                        <span class="ms-3">Data Transaksi</span>
                    </a>
                </li>
            </div>
            <div class="">

                <li class="{{ Request::is('admin/logout') ? 'bg-green-500 rounded-lg' : '' }}">
                    <button data-modal-target="modal-logout-{{ $user->id }}"
                        data-modal-toggle="modal-logout-{{ $user->id }}" type="button"
                        class="{{ Request::is('admin/logout') ? 'text-white' : '' }} flex items-center p-2 text-gray-900 rounded-lg dark:text-white group">
                        <i class="fa-solid fa-arrow-right-from-bracket"></i>
                        <span class="ms-3">Logout</span>
                    </button>
                </li>

            </div>

        </ul>
    </div>
</div>
<div id="modal-logout-{{ $user->id }}" tabindex="-1"
    class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="relative p-4 w-full max-w-md max-h-full">
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <button type="button"
                class="absolute top-3 end-2.5 text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white"
                data-modal-hide="modal-logout-{{ $user->id }}">
                <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none"
                    viewBox="0 0 14 14">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6" />
                </svg>
                <span class="sr-only">Close modal</span>
            </button>
            <div class="p-4 md:p-5 text-center">
                <svg class="mx-auto mb-4 text-gray-400 w-12 h-12 dark:text-gray-200" aria-hidden="true"
                    xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M10 11V6m0 8h.01M19 10a9 9 0 1 1-18 0 9 9 0 0 1 18 0Z" />
                </svg>
                <h3 class="mb-5 text-lg font-normal text-gray-500 dark:text-gray-400">Apakah anda yakin
                    untuk logout?</h3>
                <div class="flex">
                    <div class="w-full">
                        <form class="" action="{{ route('admin.logout') }}" method="POST">
                            @csrf
                            <button data-modal-hide="modal-logout-{{ $user->id }}" type="submit"
                                class="text-white  bg-red-600 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-red-300 dark:focus:ring-red-800 font-medium rounded-lg text-sm inline-flex items-center px-5 py-2.5 text-center">
                                Yes, I'm sure
                            </button>
                        </form>
                    </div>
                    <div class="w-full">
                        <button data-modal-hide="modal-logout-{{ $user->id }}" type="button"
                            class=" py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">No,
                            cancel</button>
                    </div>

                </div>

            </div>
        </div>
    </div>
</div>
