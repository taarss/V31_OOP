let queryString = window.location.search;
let urlParams = new URLSearchParams(queryString);
let selectedId = urlParams.get('category');
let headCategory = urlParams.get('mainCategory');

        if (headCategory == null) {
            $.ajax({
                url: 'include/ajaxCall.inc.php',
                type: 'post',
                data: {
                    "getCategories": 1,
                },
                success: function(data) {
                    parseCategories(data);
                }
            });
        }
        else{
            $.ajax({
                url: 'include/ajaxCall.inc.php',
                type: 'post',
                data: {
                    "getCategoriesOfHead": 1,
                    "headCategory": headCategory
                },
                success: function(data) {
                    parseCategories(data);
                }
            });
        }
        
        function parseCategories(data){
                console.log(data);
                    JSON.parse(data).forEach(element => {
                        let option = document.createElement("option");
                        option.setAttribute("value", element["id"]);   
                        option.innerHTML = element["name"];
                        if (element["id"] == selectedId) {
                            option.selected = "selected";
                        }
                        document.querySelector(".productPageSearch").appendChild(option);                
                    });
                    document.querySelector(".productPageSearch").onchange = function(){
                        viewNewCategory(this.value);
                    };
        }
        document.querySelectorAll(".newHeadBtn").forEach(btn => 
            btn.addEventListener("click", function(){
                console.log("works");
                viewNewHeadCategory(this.querySelector("span").innerHTML);
              })
        )
        

          



        function viewNewCategory(newCategory) {
            var searchParams = new URLSearchParams(window.location.search);
            searchParams.set("category", newCategory);
            window.location.search = searchParams.toString()

        }
        function viewNewHeadCategory(newHeadCategory) {
            console.log("works2");
            var searchParams = new URLSearchParams(window.location.search);
            searchParams.set("mainCategory", newHeadCategory);
            window.location.search = searchParams.toString()
        }
        
        