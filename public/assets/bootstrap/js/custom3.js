
(function( $ ){


    $.fn.myCalenderwl = function() {
        
        $(function() {
            var calendarEl = document.getElementById('mycalendar');
            //$(".fc-today-button").prop('disabled', false); 
            var calendar = new FullCalendar.Calendar(calendarEl, {      
                buttonText: {
                    //Here I make the button show French date instead of a text.
                    today: "bugün",

                },    
                locale: 'tr',  
                eventSources: [{
                    events:[{
                            id: '1',
                            title: 'yemek randevusu',
                            start: '2023-03-02',
                            color: "#010649",
                            textColor: "#fff",
                            //durationEditable: false,
                            //className: "free",
                            //additionalInfo: "A great event"
                            }]
                        }],    
                dateClick: function(info) {
                    //alert(info.dateStr);


                    }
                    
                });
                
            calendar.render();
        });
       return this;
    }; 
 })( jQuery );

 $(function() {
    $.fn.myCalenderwl();
});


