
$(function(){
    var APP_KEY = "9e42fnYQmaxp7xBQMQrHMY7mMRGB4R4j";

    $("#btnajax_apisearchby").click(function(){
        var s = $("#searchby").val();
        if(s != "")
        {   
            var item = {};
            item ["api_key"] = APP_KEY.toString();
            item ["search"] = s.toString();
            var x = JSON.stringify(item);
            alert(x);
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
                    // Do something with the data returned by the server
                    alert(data);
                    
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
});
