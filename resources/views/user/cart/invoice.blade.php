@extends('welcome')
@section('content')
    <div class="container mx-auto p-8">
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h1 class="text-2xl font-bold mb-4">Checkout Complete</h1>
            <div class="border-b pb-4 mb-4">
                <h2 class="text-xl font-semibold">Customer Information</h2>
                <p class="mt-2"><strong>Name:</strong> John Doe</p>
                <p><strong>Address:</strong> 123 Main Street, Anytown, USA</p>
            </div>
            <div class="border-b pb-4 mb-4">
                <h2 class="text-xl font-semibold">Order Summary</h2>
                <ul class="mt-2">
                    <li class="flex justify-between py-2">
                        <span>Spicy Cheese Chicken Rice</span>
                        <span>$10.00</span>
                    </li>
                    <li class="flex justify-between py-2">
                        <span>Cheese Shrimp</span>
                        <span>$12.00</span>
                    </li>
                    <li class="flex justify-between py-2">
                        <span>Risoles</span>
                        <span>$5.00</span>
                    </li>
                </ul>
            </div>
            <div class="flex justify-between text-xl font-bold">
                <span>Total</span>
                <span>$27.00</span>
            </div>
        </div>
    </div>
@endsection
