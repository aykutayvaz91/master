
(function( $ ){


    $.fn.myfunction = function() {

        $(this).attr('disabled', true);

        var searchResultArray = [];
        resData.forEach(function(entry) {
            //console.log(entry["gks_id"]);
            if(entry["gks_id"]!="0")
            {
                searchResultArray.push(String((entry["gks_id"])));
                console.log("gks_id"+entry["gks_id"]);
            }
        });
        var currentRow=$(this).closest("tr"); 
        var gks_id = String($(this).parent().siblings(":first").text());
        var itempostarray = [];
        currentRow.children("td").each(function(index){
            itempostarray.push($(this).text());
        });

       

       //var fullname = String($(this).parent().siblings(":third").text());
       //var department = String($(this).parent().siblings(":fourth").text());
       //var position = String($(this).parent().siblings(":fifth").text());
       if(searchResultArray.includes(gks_id))
       bootbox.alert({
        size: 'small',
        message: 'Bu kullanıcı daha önce eşleştirilmiş!',
        closeButton: false,
        callback: function(result) { /* result is a boolean; true = OK, false = Cancel*/ 
            console.log("zaten eşleştirilmiş.");
        }
       
      
            })
        else
        bootbox.confirm({
            size: 'small',
            message: 'Bu kullanıcı eşleştirilecek onaylıyor musunuz?',
            closeButton: false,
            callback: function(result) { /* result is a boolean; true = OK, false = Cancel*/ 
                if(result)
                {
                   
                    $.ajax({
                        url: "/home/performsync",
                        type: "POST",
                        data : {
                            gks_id:gks_id,
                            registernumber : itempostarray[1],
                            fullname : itempostarray[2],
                            position : itempostarray[3],
                            department: itempostarray[4],
                        },
                        headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(data) {
                            //console.log("eşleştirildi");//ajax eşleştir post
                            console.log(JSON.stringify(data));
                            bootbox.alert({
                                size: 'small',
                                message: 'Eşleştirme Başarılı!',
                                closeButton: false,
                                callback: function(result) { /* result is a boolean; true = OK, false = Cancel*/ 
                                }
                            });
                        },
                        error: function(xhr, ajaxOptions, thrownError) {
                            // Handle any errors that occur during the request
                            bootbox.alert({
                                size: 'small',
                                message: 'Başarısız Eşleştirme!',
                                closeButton: false,
                                callback: function(result) { /* result is a boolean; true = OK, false = Cancel*/ 
                                }
                            });
                            alert("ajax error");
                        }
                    }).done(function(){
                        setTimeout(function(){
                            window.location.reload();
                         }, 2000);
                    });

                }
            }
           
            });
            $(this).attr('enabled', true);
       return this;
    }; 
 })( jQuery );


$(function(){

    

    //$('.toast').toast('show');


    var APP_KEY = "9e42fnYQmaxp7xBQMQrHMY7mMRGB4R4j";

    $("#btnajax_apisearchby").click(function(){
        var s = $("#searchby").val();
        if(s != "")
        {   
            var item = {};
            item ["api_key"] = APP_KEY.toString();
            item ["search"] = s.toString();
            var x = JSON.stringify(item);
            /*$.ajax("http://192.168.210.5/api/personnel/searchby",{
                'data': JSON.stringify(item), //{action:'x',params:['a','b','c']}
                'dataType':'jsonp',
                'method': 'POST',
                cors: true ,
                secure: true,
                'contentType': 'application/json', //typically 'application/x-www-form-urlencoded', but the service you are calling may expect 'text/json'... check with the service to see what they expect as content-type in the HTTP header.
                headers: {
                    'Access-Control-Allow-Origin': '*',
                  },
                success: function(data) {
                    // Do something with the data returned by the server
                    alert("Details saved successfully!!!");
                    alert(data);
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    // Handle any errors that occur during the request
                    alert(xhr.status + " ajax error");
                }
            
            });*/
           /* jsonObj = [];  
            item = {}
            item ["api_key"] = APP_KEY;
            item ["search"] = s;
           
            jsonObj.push(item);
            jsonString = JSON.stringify(jsonObj[0]);*/
            //var post_data = JSON.parse('{"api_key": APP_KEY,"search":'+$s+"}");
            //alert(jsonString);

                            //contentType: "application/json",
                           /* var settings = {
                                'cache': false,
                                'dataType': "jsonp",
                                "async": true,
                                "crossDomain": true,
                                "url": "http://192.168.210.5/api/personnel/searchby",
                                "method": "POST",
                                "headers": {
                                    "accept": "application/json",
                                    "Access-Control-Allow-Origin":"*"
                                }
                            }
                      
                            $.ajax(settings).done(function (response) {
                                console.log(response);
                      
                            });*/
           $.ajax({
                url: "http://192.168.210.5/api/personnel/searchby",
                type: "POST",
                crossDomain: true,
                data : JSON.stringify(item),
                dataType: "json",
                headers: {
                    'Content-Type': 'application/json',
                    "accept": "application/json",
                    //'Access-Control-Allow-Origin': '*',
                },
                success: function(data) {
                    $('#myTable').dataTable().fnDestroy();
                    $('#myTable').removeClass("d-none");
                    $('#myTable').dataTable( {
                        "responsive": true,
                        "aaData": data["result"],
                        "language": {
                            "emptyTable": "Kullanıcı bulunamadı",
                          },
                        "columns": [
                            { "data": "gks_id"},
                            { "data": "registration_number" },
                            { "data": "fullname" },
                            { "data": "department" },
                            { "data": "position" },
                            { 'data': null, title: 'Eşleştir', 
                            "render": function (data, type, row, meta) { 
                               
                                    return '<button type="button" class="btn btn-light place" onclick="$(this).myfunction()" >Eşleştir</button>';
                                      
                                } },
                        ],                   
                    });


                    
                },
                error: function(xhr, ajaxOptions, thrownError) {
                    // Handle any errors that occur during the request
                    alert("ajax error");
                }
            });
        }
        else
        {
            alert("bos girilemez");
        }
    });
  
    $('.place').on('click', function () {
        alert("blade");
    })
});
