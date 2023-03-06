
(function( $ ){


    $.fn.myfunction = function() {
        var searchResultArray = [];
        resData.forEach(function(entry) {
            //console.log(entry["gks_id"]);
            searchResultArray.push(String((entry["gks_id"])));
        });
       var id = String($(this).parent().siblings(":first").text());
       if(searchResultArray.includes(id))
            bootbox.confirm({
                size: 'small',
                message: 'Bu kullanıcı eşleştirilecek onaylıyor musunuz?',
                closeButton: false,
                callback: function(result) { /* result is a boolean; true = OK, false = Cancel*/ 
                    if(result)
                    {
                        console.log("eşleştirildi");//ajax eşleştir post
                    }
                }
            })
        else
            bootbox.alert({
                size: 'small',
                message: 'Bu kullanıcı daha önce eşleştirilmiş!',
                closeButton: false,
                callback: function(result) { /* result is a boolean; true = OK, false = Cancel*/ 
                    console.log("zaten eşleştirildi.");
            }
                
            });
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
                                //var gks_id = $(this).parent().siblings(":first").text();
                                //alert(gks_id);
                                /*gks_id_arr.forEach(x => {
                                
                                    //alert(x["gks_id"]);
                                    //alert($(".place").myfunction());
                                    //alert();
                                });*/

                               /* gks_id_arr.forEach(x => {
                                            if( x["gks_id"]==row["gks_id"])
                                            {
                                                //esleştirilmiş
                                                return '<p>Eşleştirilmiş</p>'
                                                console.log("esleşti bizim database"+x["gks_id"]+ "uzak database "+row["gks_id"])
                                            }
                                            else
                                            {
                                                return '<button type="button" class="btn btn-light place" onclick="$(this).myfunction()" >Eşleştir</button>';
                                            }
                                        });
                                    */
                                    return '<button type="button" class="btn btn-light place" onclick="$(this).myfunction()" >Eşleştir</button>';
                                      
                                //console.log(row["gks_id"]);
                                //return '<button type="button" class="btn btn-light place" onclick="$(this).myfunction()" >Eşleştir</button>';
                                //else
                                    //return '<button type="button" class="btn btn-light place" onclick="alert(\'blade\')">Eşleştir</button>';
                            } },
                        ],                   
                    });


                    // Do something with the data returned by the server
                    /*for (let i = 0; i < data["result"].length; i++) {
                        added_row = '<tr>'
                            + '<td>' + data["result"].id + '</td>'
                            + '<td>' + data["result"].workoutName + '</td>'
                            + '<td>' + data["result"].qryOrd + '</td>'
                            + '<td>' + data["result"].order + '</td>'
                     + '</tr>'
                           $("#myTable").append(added_row)
                           $("#myTable").ajax.reload();
                    }*/
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
