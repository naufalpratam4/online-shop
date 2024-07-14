@extends('welcome')
@section('content')
    {{-- header --}}
    @include('template.user.navbarUser')
    @if (session('success'))
        @include('template.alerts.success')
    @endif
    @include('user.jumbotron')
    @include('user.hero')

    <div class="pt-3">@include('user.produk')</div>
    @include('template.footer.footer')
@endsection
