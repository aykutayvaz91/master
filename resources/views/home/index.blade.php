@extends('layouts.app-master')

@section('customcss')

<meta name="csrf-token" content="{{ csrf_token() }}" />

@endsection

@section('content')


    <div class="bg-light p-3 rounded">
    @auth

    @php
        $itemstring = "";
        foreach($searchResultQuery as $instance)
        {
            $itemstring = $instance["gks_id"].",".$itemstring;
           
        }
        
    @endphp
       <!-- <div class="container" style="position: relative;">
            <div class="toast" style="position: absolute; top: 0; right: 0;">
                <div class="toast-header">
                    Mesaj
                </div>
                <div class="toast-body">
                    Hoşgeldiniz.
                </div>
            </div>  
        </div>

        <div class="col-md-3 col-sm-3 col-xs-3 m-3">&nbsp;</div>-->

        <h2>Anasayfa</h2>
        <hr/>
        
        @if(isset($users[0]['fullname']))
            <p id="userfullname">Hoşgeldiniz {{ $users[0]['fullname'] }}</p>
            <p>Menü Listesi</p>
        @endif
        @if($users[0]['gks_id']=="0")
            <!-- eşleştirilmemiş kullanıcıları sorgulaçek -->
   
        <p class="lead">GKS sistemi ile eşleştirmek için sicil no veya isim-soyisim verileriyle arama yapınız</p>
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
        <hr/>
        <div class="container pt-3">
        <table id="myTable" class="d-none">
            <thead>
                <tr>
                    <th>gks_id</th>
                    <th>Sicil No</th>
                    <th>İsim Soyisim</th>
                    <th>Departman</th>
                    <th>Ünvan</th>
                    <th>Eşleştir</th>
                </tr>
            </thead>
            <tbody>
                
            </tbody>
        </table>
        

        </div>
        @else
            <a href="{{ route('appoint.index') }}" >Yemek Randevu Girişi için tıklayınız</a>
        @endif
        
        @endauth

        @guest
        <h1>Fides Yemek Randevu Sistemi</h1>  
        <!--<h2 class="lead">İşlemler İçin Giriş Yapınız</h2>-->
        <img src="{!! url('/images/reserve.jpg') !!}" class="img-fluid" alt="Responsive image">
        @endguest
        
    </div>
@endsection
@section('customjs')
    <script src="{!! url('assets/bootstrap/js/fullcalendar.min.js') !!}"></script>
    <script src="{!! url('assets/bootstrap/js/custom.js') !!}"></script>
    <script>
        // Use PHP tags for json_encode()
       
       
        var resData = {!! json_encode($searchResultQuery) !!};
        var performsyncurl = "{{ URL::route("home.performsync") }}";
       
        /*var results = [];
        json_encode($searchResultQuery)
        gks_id_arr.forEach(x => 
        {  if (x["gks_id"].includes("6")) 
                results.push(x["gks_id"]);
        });
        // alert((gks_id_arr[0]["gks_id"]));
        alert(results);*/
        //alert((gks_id_arr[0]["gks_id"]));
    </script>
@endsection

@section('footer')

@endsection
