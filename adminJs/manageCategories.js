document.querySelector(".manageCategoriesBtn").onclick = e => {
    let catagories;
    let adp_underlay = document.createElement('div');
    adp_underlay.className = 'adp-underlay';
    document.body.appendChild(adp_underlay);
    let adp = document.createElement('div');
    adp
    adp.setAttribute("class", "col-8 adp")
    adp.innerHTML = `
    <button class="adpBtn col-1 button bg-danger text-light border-0">X</button>
    <h3>Manage Categories</h3>
    <div class="manageCategoriesTable d-flex flex-wrap">
        <h4 class="col-2">Name</h4>
        <h4 class="col-3">Image</h4>
        <h4 class="col-3">Update/delete related products</h4>
        <h4 class="col-2">Head category</h4>
        <h4 class="col-2">Options</h4>
    </div>
    `;
    function getCategories(comboBox, selectedId) {
        $.ajax({
            url: 'include/ajaxCall.inc.php',
            type: 'post',
            data: {
                "getHeadCategories": 1,
            },
            success: function(data) {
                console.log(data)
                JSON.parse(data).forEach(element => {
                    let option2 = document.createElement("option");
                    let option = document.createElement("option");
                    option.setAttribute("value", element["id"]);   
                    option2.setAttribute("value", element["id"]);    
                    option.innerHTML = element["name"];
                    option2.innerHTML = element["name"];                                    
                    if (element["id"] == selectedId) {
                        option.selected = "selected";
                    }
                    comboBox.appendChild(option);         

                });
                addCategoriesOnce = false;
            }
        });
    }


    $.ajax({
        url: 'include/ajaxCall.inc.php',
        type: 'post',
        data: {
                "getCategories": 1,
            },
        success: function(data) {
            JSON.parse(data).forEach(element => {
                let rowForm = document.createElement("form");
                rowForm.setAttribute("enctype", "multipart/form-data");
                let dataTypeInput = document.createElement("input");
                dataTypeInput.setAttribute("name", "updateCategory");
                dataTypeInput.value = 1;
                dataTypeInput.style.display = "none";
                rowForm.appendChild(dataTypeInput);
                let nameInput = document.createElement("input");
                nameInput.setAttribute("type", "text");
                nameInput.setAttribute("value", element["name"]);
                nameInput.setAttribute("name", "name");
                nameInput.setAttribute("class", "col-2 categoryNameUpdateInput");
                rowForm.appendChild(nameInput);
                let imageInput = document.createElement("input");
                imageInput.setAttribute("type", "file");
                imageInput.setAttribute("class", "col-3 categoryImageUpdateInput");
                imageInput.setAttribute("name", "post_img");
                rowForm.appendChild(imageInput);
                let radio1 = document.createElement("input");
                radio1.setAttribute("type", "radio");
                radio1.setAttribute("name", "updateDelete");
                radio1.setAttribute("value", 1);
                let label1 = document.createElement("label");
                label1.innerHTML = "yes";
                label1.setAttribute("class", "col-1");
                let radio2 = document.createElement("input");
                radio2.setAttribute("type", "radio");
                radio2.setAttribute("name", "updateDelete");
                radio2.setAttribute("value", 0);
                let label2 = document.createElement("label");
                label2.innerHTML = "no";
                label2.setAttribute("class", "col-2");
                radio2.setAttribute("checked", "checked");
                rowForm.appendChild(radio1);
                rowForm.appendChild(label1);
                rowForm.appendChild(radio2);
                rowForm.appendChild(label2);
                let headcategoryInput = document.createElement("select");
                headcategoryInput.setAttribute("class", "col-1 mx-2 manageHeadCategoryInput");
                headcategoryInput.setAttribute("name", "headcategory");
                rowForm.appendChild(headcategoryInput);
                rowForm.setAttribute("action", "include/ajaxCall.inc.php")
                rowForm.setAttribute("method", "post")
                let saveChangesInput = document.createElement("input");
                saveChangesInput.setAttribute("type", "submit");
                saveChangesInput.setAttribute("class", "col-1");
                rowForm.appendChild(saveChangesInput);
                rowForm.setAttribute("class", "col-12 updateCategoryForm");
                let deleteData = document.createElement("button");
                deleteData.innerHTML = "delete";
                deleteData.setAttribute("class", "col-1 border border-dark bg-danger text-white");
                deleteData.addEventListener('click', function(){
                    deleteCategory(this.parentElement.querySelector(".categoryId").value,
                    this.parentElement.querySelector('input[name = "updateDelete"]:checked').value, 
                    );
                });
                rowForm.appendChild(deleteData);
                let categoryId = document.createElement("input");
                categoryId.setAttribute("type", "text");
                categoryId.setAttribute("name", "id");
                categoryId.value = element["id"];
                categoryId.style.visibility = "hidden";
                categoryId.style.position = "absolute";
                categoryId.setAttribute("class", "categoryId");
                rowForm.appendChild(categoryId);
                document.querySelector(".manageCategoriesTable").appendChild(rowForm);
                getCategories(headcategoryInput, element["headCategory"]);
            });
        }
    });
    

    $("#updateCategoryForm").submit(function(event) {
        event.preventDefault();
        var form = $(this);
        var url = form.attr('action');
        $.ajax({
            type: "POST",
            url: url,
            data: form.serialize(),
            success: function(data) {
                console.log(data);
            }
        });
    });

    function deleteCategory(id, productRealtion) {
        $.ajax({
            url: 'include/ajaxCall.inc.php',
            type: 'post',
            data: {
                "deleteCategory": 1,
                "productRealation": productRealtion,
                "id": id,
            },
            success: function(data) { 
                console.log(data);
            }
        });
        
    }


    document.body.appendChild(adp);
    document.querySelector(".adpBtn").onclick = e => {
        e.preventDefault();
        document.body.removeChild(adp_underlay);
        document.body.removeChild(adp);
    }

}