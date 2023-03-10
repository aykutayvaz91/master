@extends('layouts.app-master')

@section('customcss')

<meta name="csrf-token" content="{{ csrf_token() }}" />

@endsection

@section('content')
    <div class="bg-light p-3 rounded">
       <a href="{{route('home.index')}}">Anasayfaya Dön</a>

       <div id='calendar'></div>
        


    </div>
@endsection
@section('customjs')
    <script src="{!! url('assets/bootstrap/js/fullcalendar.min.js') !!}"></script>
    <script src="{!! url('assets/bootstrap/js/custom2.js') !!}"></script>
    <script>
        var performsaveurl= "{{ URL::route("appoint.save") }}";
    </script>
@endsection

@section('footer')

@endsection
