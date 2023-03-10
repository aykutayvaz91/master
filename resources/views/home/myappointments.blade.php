@extends('layouts.app-master')

@section('customcss')

<meta name="csrf-token" content="{{ csrf_token() }}" />
<style src="{!! url('assets/bootstrap/css/custom.css') !!}"></style>

</style>
@endsection

@section('content')
    <div class="bg-light p-3 rounded">
       

       <div id='mycalendar'></div>
        


    </div>
@endsection
@section('customjs')
    <script src="{!! url('assets/bootstrap/js/fullcalendar.min.js') !!}"></script>
    <script src="{!! url('assets/bootstrap/js/custom3.js') !!}"></script>
    <script>
        
    </script>
@endsection

@section('footer')

@endsection
