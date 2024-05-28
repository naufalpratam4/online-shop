@extends('welcome')
@section('content')
    {{-- header --}}
    <div class="pb-2"
        style="background: url('https://png.pngtree.com/thumb_back/fh260/background/20230818/pngtree-sunrise-mountain-scenery-wallpaper-desktop-for-pc-and-mobile-image_13040555.jpg') no-repeat center center; background-size: cover;">
        @include('template.user.navbarUser')
        @include('template.user.search')
        @include('user.hero')
    </div>
    <div class="pt-3 px-2">@include('user.produk')</div>
@endsection
