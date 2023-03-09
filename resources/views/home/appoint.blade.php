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
    <script src="{!! url('assets/bootstrap/js/custom.js') !!}"></script>
    <script>

            $(function() {
            var calendarEl = document.getElementById('calendar');
            var tdyDate = new Date();
            var mxDate = new Date();
            mxDate.setDate(mxDate.getDate() + 7);
            var calendar = new FullCalendar.Calendar(calendarEl, { 
                validRange: {
                    start: tdyDate,
                    end: mxDate
                },   
                eventSources: [{
                    events:[{
                            id: 'a',
                            title: 'my event',
                            start: '2023-03-02'
                            }]
                        }],
                dateClick: function(info) {
                    alert(info.dateStr);
                },
                
            });
            calendar.render();
            });

        </script>
    <script>
        // Use PHP tags for json_encode()
       
       
       
       
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
