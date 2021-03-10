console.log("test");
$.ajax({
    url: 'include/startSession.inc.php',
    type: 'post',
    data: {
        "checkIfSessionExists": 1,
    },
    success: function(data) {
        console.log(data);
        if (data == "false") {
            fetch(`https://ipgeolocation.abstractapi.com/v1/?api_key=6631189809904529adb8519c82233ecd`)
                .then(response => response.json())
                .then(geoData => {
                    let city = geoData['city'];
                    let region = geoData['region'];
                    console.log(city);
                    $.ajax({
                        url: 'include/startSession.inc.php',
                        type: 'post',
                        data: {
                            "setLocation": 1,
                            "city": city,
                            "region": region
                        }, success: function(data) {
                            console.log(data);
                        }
                    });
                });

            
        }  
    }
});