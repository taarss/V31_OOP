document.querySelector(".addCategoriesBtn").onclick = e => {
    let adp_underlay = document.createElement('div');
    adp_underlay.className = 'adp-underlay';
    document.body.appendChild(adp_underlay);
    let adp = document.createElement('div');
    adp
    adp.className = 'adp';
    adp.innerHTML = `
    <button class="adpBtn w-25 button bg-danger text-light border-0">X</button>
    <h3>Create category</h3>
    <form enctype="multipart/form-data" class="postForm d-flex flex-column"  action="include/ajaxCall.inc.php" method="post" id="createCategory">
        <input id="createCategoryImg" type="file" name="post_img" required><br>
        <input id="createCategoryName" type="text" name="post_name" placeholder="Category name" required>
        <input type="text" name="createCategory" style="display: none">
        <select id="createCategoryHeader" name="category_header"  required>
        </select>
        <input type="submit">
    </form>
    `;
    $.ajax({
        type: "POST",
        url: 'include/ajaxCall.inc.php',
        data: {
            "getHeadCategories": 1,
        },
        success: function(data) {
            console.log(data);
            JSON.parse(data).forEach(element => {
                let option = document.createElement("option");
                option.setAttribute("value", element["id"]);
                option.innerHTML = element["name"];
                document.querySelector("#createCategoryHeader").appendChild(option);
            });
        }
    });
    document.body.appendChild(adp);
    document.querySelector(".adpBtn").onclick = e => {
        e.preventDefault();
        document.body.removeChild(adp_underlay);
        document.body.removeChild(adp);
    }

}
$("#createCategory").submit(function(event) {
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