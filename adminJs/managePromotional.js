document.querySelector(".editPromoteBtn").onclick = e => {
    let adp_underlay = document.createElement('div');
    adp_underlay.className = 'adp-underlay';
    document.body.appendChild(adp_underlay);
    let adp = document.createElement('div');
    adp
    adp.className = 'adp';
    adp.innerHTML = `
    <button class="adpBtn w-25 button bg-danger text-light border-0">X</button>
    <h3>Manage promotional material</h3>
    `;
    $.ajax({
        url: 'include/ajaxCall.inc.php',
        type: 'post',
        data: {
            "getSlideShowInfo": 1,
        },
        success: function(data) {
            console.log(data);
            let promotionalMaterial = JSON.parse(data);
            promotionalMaterial.forEach(element => {
                let form = document.createElement("form");
                let fileInput = document.createElement("input");
                let submitBtn = document.createElement("input");
                let image = document.createElement("img");
                let id = document.createElement("input");
                id.style.display = "none";
                id.setAttribute("type", "text");
                id.value = element['id'];
                id.setAttribute("name", "updatePromotionalSlideshow");
                form.appendChild(fileInput);
                form.appendChild(submitBtn);
                form.appendChild(image);
                form.appendChild(id);
                form.style.borderBottom = "gray solid thin";
                form.setAttribute("class", "p-3");
                form.setAttribute("enctype", "multipart/form-data");
                form.setAttribute("method", "post");
                form.setAttribute("action", "include/ajaxCall.inc.php")
                fileInput.setAttribute("type", "file");
                fileInput.setAttribute("name", "post_img");
                fileInput.setAttribute("class", "col-10");
                submitBtn.setAttribute("type", "submit");
                image.setAttribute("src", "uploads/" + element['img']);
                image.setAttribute("class", "promotionalSlideshowImg");
                form.addEventListener("submit", function(e){
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
                adp.appendChild(form);
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