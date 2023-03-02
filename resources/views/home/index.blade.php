@extends('layouts.app-master')


@section('content')

    <div class="bg-light p-3 rounded">
        @auth
        <h2>Home</h2>
        <hr/>
        @if(isset($users[0]['fullname']))
            <p>{{ $users[0]['fullname'] }}</p>
        @endif
        <p class="lead">Only authenticated users can access this section.</p>
        <div class="input-group mb-3">
            <div class="input-group-prepend">
                <div class="input-group-text">
                <svg width="24" height="37.6" fill="currentColor" class="bi bi-search" viewBox="0 0 16 16">
                    <path d="M11.742 10.344a6.5 6.5 0 1 0-1.397 1.398h-.001c.03.04.062.078.098.115l3.85 3.85a1 1 0 0 0 1.415-1.414l-3.85-3.85a1.007 1.007 0 0 0-.115-.1zM12 6.5a5.5 5.5 0 1 1-11 0 5.5 5.5 0 0 1 11 0z"/>
                </svg>
                </div>
            </div>
            <input type="text" id="searchby" class="form-control" placeholder="İsim,Soyisim veya Sicil No Giriniz" aria-label="Username" aria-describedby="basic-addon1">
            <a id="btnajax_apisearchby" class="btn btn-lg btn-primary" role="button">Ara</a>
        </div>
        
        
        @endauth

        @guest
        <h1>Homepage</h1>  
        <p class="lead">Your viewing the home page. Please login to view the restricted data.</p>
        @endguest
    </div>
@endsection
@section('customjs')
    <script src="{!! url('assets/bootstrap/js/custom.js') !!}"></script>
@endsection