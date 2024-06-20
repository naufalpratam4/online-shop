@extends('welcome')
@section('content')
    {{-- header --}}
    @include('template.user.navbarUser')
    <div class="pb-2" style="background: url('assets/1.PNG') no-repeat center center; background-size: cover; height:300px">
    </div>
    @include('user.hero')

    <div class="pt-3 px-2">@include('user.produk')</div>
@endsection
