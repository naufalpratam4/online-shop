@extends('welcome')
@section('content')
    {{-- header --}}
    @include('template.user.navbarUser')
    @if (session('success'))
        @include('template.alerts.success')
    @endif
    @include('user.jumbotron')
    @include('user.hero')

    <div class="pt-3 px-2">@include('user.produk')</div>
@endsection
