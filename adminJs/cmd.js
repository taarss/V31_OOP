$(document).ready(function() {

    $('.footerDrawer .open').on('click', function() {
  
      $('.footerDrawer .cmdContent').slideToggle();
  
    });
  
  });

  $("#cmd").on('keyup', function (e) {
    if (e.key === 'Enter' || e.keyCode === 13) {
        let createP = document.createElement("p");
        createP.innerHTML = "> "+document.querySelector("#cmd").value;
        document.querySelector("#cmd").value = "";
        document.querySelector(".cmdContent .response").appendChild(createP);
        if (createP.innerHTML.includes("getLogs")) {
            let logSubString = createP.innerHTML.substring(
                createP.innerHTML.lastIndexOf("(") + 1, 
                createP.innerHTML.lastIndexOf(")")
            );
            $.ajax({
                url: 'include/ajaxCall.inc.php',
                type: 'post',
                data: {
                    "getLogs": 1,
                    "limit": logSubString,
                },
                success: function(data) { 
                    console.log(data);
                    JSON.parse(data).forEach(element => {
                        let createQueryResponse = document.createElement("p");
                        createQueryResponse.innerHTML = "> "+element["log"]+"   "+element['logDate'];
                        document.querySelector(".cmdContent .response").appendChild(createQueryResponse);
                    });
                }
            });
        }
        else if (createP.innerHTML.includes("clearConsole()")) {
            while (document.querySelector(".cmdContent .response").firstChild) {
                document.querySelector(".cmdContent .response").removeChild(document.querySelector(".cmdContent .response").lastChild);
              }
        }
        else{
            let createPresponse = document.createElement("p");
            createPresponse.innerHTML = "> unkown comand";
            document.querySelector(".cmdContent .response").appendChild(createPresponse);
        }
    }
});
