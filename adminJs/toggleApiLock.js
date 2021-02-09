$.ajax({
    url: 'include/ajaxCall.inc.php',
    type: 'post',
    data: {
        "getApiLock": 1,
    },success: function(data) {
        if(Boolean(Number(data))){
            console.log("checked");
           document.querySelector("#apiLockCheckBox").checked = true;
        }
        else{
            console.log("unchecked");
            document.querySelector("#apiLockCheckBox").checked = false;
        }
        document.querySelector("#apiLockCheckBox").addEventListener( 'change', function() {
            let checkboxInput;
            if(this.checked) {
                checkboxInput = 1;
            } else {
                checkboxInput = 0;
            }
            $.ajax({
                url: 'include/ajaxCall.inc.php',
                type: 'post',
                data: {
                    "updateApiLock": 1,
                    "bool": checkboxInput
                }, success: function(data){
                    console.log(data); 
                }
            });    
            
        });
    }});