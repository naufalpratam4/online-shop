@extends('welcome')
@section('content')
    <div style="height: 100vh;">
        <!-- https://play.tailwindcss.com/MIwj5Sp9pw -->
        <div class="py-16 pt-36">
            <form action="{{ route('login.user') }}" method="POST">
                @csrf
                <div class="flex bg-white rounded-lg shadow-lg overflow-hidden mx-auto max-w-2xl lg:max-w-4xl">
                    <div class="hidden lg:block lg:w-1/2 bg-cover"
                        style="background-image:url('https://images.unsplash.com/photo-1546514714-df0ccc50d7bf?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=667&q=80')">
                    </div>
                    <div class="w-full p-8 lg:w-1/2">
                        <h2 class="text-2xl font-semibold text-gray-700 text-center">Kejuku</h2>
                        <p class="text-xl text-gray-600 text-center">Welcome back!</p>


                        <div class="mt-4">
                            <label class="block text-gray-700 text-sm font-bold mb-2">Email Address</label>
                            <input type="email" id="email" name="email"
                                class="shadow-sm bg-yellow-50 border border-yellow-300 text-yellow-900 text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2.5 dark:bg-yellow-700 dark:border-yellow-600 dark:placeholder-yellow-400 dark:text-white dark:focus:ring-yellow-500 dark:focus:border-yellow-500 dark:shadow-sm-light"
                                placeholder="email@mail.com" required />
                            @error('email')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mt-4">
                            <div class="flex justify-between">
                                <label class="block text-gray-700 text-sm font-bold mb-2">Password</label>
                                <a href="#" class="text-xs text-gray-500">Forget Password?</a>
                            </div>
                            <input type="password" id="password" name="password"
                                class="shadow-sm bg-yellow-50 border border-yellow-300 text-yellow-900 text-sm rounded-lg focus:ring-yellow-500 focus:border-yellow-500 block w-full p-2.5 dark:bg-yellow-700 dark:border-yellow-600 dark:placeholder-yellow-400 dark:text-white dark:focus:ring-yellow-500 dark:focus:border-yellow-500 dark:shadow-sm-light"
                                placeholder="password" required />
                            @error('password')
                                <div class="text-red-500">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mt-8">
                            <button
                                class="bg-yellow-700 text-white font-bold py-2 px-4 w-full rounded hover:bg-yellow-500">Login</button>
                        </div>
                        <div class="mt-4 flex items-center justify-between">
                            <span class="border-b w-1/5 md:w-1/4"></span>
                            <a href="/register" class="text-xs text-gray-500 uppercase">or sign up</a>
                            <span class="border-b w-1/5 md:w-1/4"></span>
                        </div>
                    </div>
                </div>
            </form>

        </div>
    </div>
@endsection
