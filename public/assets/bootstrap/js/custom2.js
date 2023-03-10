
(function( $ ){


    $.fn.myCalender = function() {
        
        $(function() {
            var calendarEl = document.getElementById('calendar');
            var tdyDate = new Date();
            var mxDate = new Date();
            mxDate.setDate(mxDate.getDate() + 7);
            //$(".fc-today-button").prop('disabled', false); 
            var calendar = new FullCalendar.Calendar(calendarEl, {      
                buttonText: {
                    //Here I make the button show French date instead of a text.
                    today: "bugün",

                },
                locale: 'tr',
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
                    //alert(info.dateStr);
                    bootbox.confirm({
                        size: 'small',
                        message: info.dateStr+' tarihli yemek randevusu oluşturmak istiyor musunuz?',
                        closeButton: false,
                        callback: function(index){
                            if(index)
                            {
                                $.ajax({
                                    url: "/appoint/save",
                                    type: "POST",
                                    data : {
                                        meal_date : info.dateStr,
                                        meal_time : "00:00-23:59"
                                    },
                                    headers: {
                                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                    },
                                    success: function(data) {
                                        //console.log("eşleştirildi");//ajax eşleştir post
                                        console.log(JSON.stringify(data));
                                        var arr_data_meal = JSON.parse(JSON.stringify(data));
                                        if(arr_data_meal["success"])
                                        {
                                            bootbox.alert({
                                                size: 'small',
                                                message: arr_data_meal["result"],
                                                closeButton: false,
                                                callback: function(result) { /* result is a boolean; true = OK, false = Cancel*/ 
                                                }
                                            }).find('.modal-content').css({'background-color': '#00ff00', color: '#007200'});
                                        }
                                        else
                                        {
                                            bootbox.alert({
                                                size: 'small',
                                                message: arr_data_meal["result"],
                                                closeButton: false,
                                                callback: function(result) { /* result is a boolean; true = OK, false = Cancel*/ 
                                                }
                                            }).find('.modal-content').css({'background-color': '#f99', color: '#F00'} );
                                        }

                                        
                                    },
                                    error: function(xhr, ajaxOptions, thrownError) {
                                        // Handle any errors that occur during the request
                                        bootbox.alert({
                                            size: 'small',
                                            message: 'Başarısız! Ajax Error hatası',
                                            closeButton: false,
                                            callback: function(result) { /* result is a boolean; true = OK, false = Cancel*/ 
                                            }
                                        });
                                    }
                                }).done(function(){
                                    /*setTimeout(function(){
                                        window.location.reload();
                                     }, 2000);*/
                                });
                            }
                        }
                    });

                    }
                    
                });
                
            calendar.render();
        });
       return this;
    }; 
 })( jQuery );

 $(function() {
    $.fn.myCalender();
});


