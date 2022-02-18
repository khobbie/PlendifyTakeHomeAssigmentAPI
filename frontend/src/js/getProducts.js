$(document).ready(function() {
    setTimeout(function() {
        getProduct("");
    }, 1000);

    function getProduct(product_id) {
        let search_text = $("#search_text").val();
        if (search_text.length > 1) {
            searchProduct();
            return false;
        }

        $("#loading_div").css("display", "block");
        $("#display_div").css("display", "none");

        let url = base_url + "/product";
        if (product_id.trim() == "") {} else {
            url = url + "/" + product_id;
        }

        $.ajax({
            type: "GET",
            url: base_url + "/product",

            success: function(res) {
                console.log(res);

                if (res.code == "000") {
                    $("#loading_div").css("display", "none");
                    $("#display_div").css("display", "block");
                    $("#display_div").html("");

                    let products = res.data;
                    console.log(products);
                    if (products.length > 0) {
                        products.map((product) => {
                            $("#display_div").append(`

                                  <div class="col-md-12">
                                    <div class="card mt-2 mb-3" style="">
                                        <div class="card-body">

                                            <h6 class="card-subtitle mb-2 text-muted">${product.name}</h6>
                                            <p class="card-text">
                                                ${product.description}
                                            </p>
                                            <a href="#" class="card-link text-primary edit_product_btn" data-bs-toggle="modal"
                            data-bs-target="#updateModal" data-edit_product_uuid="${product.product_uuid}" data-edit_product_name="${product.name}"  data-edit_product_description="${product.description}"  data-edit_product_price="${product.price}">Edit</a>
                                            <a href="#" class="card-link text-danger delete_product_btn" data-bs-toggle="modal"
                            data-bs-target="#deleteModal" data-delete_product_uuid="${product.product_uuid}" data-delete_product_name="${product.name}"  data-delete_product_description="${product.description}"  data-delete_product_price="${product.price}">Delete</a>
                                        </div>
                                    </div>
                                </div>
                                `);
                        });
                    } else {
                        $("#display_div").html(`<h2 class="text-center">No data fond</h2>`);
                    }
                } else {}
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                alert("some error");
                $("#save_button").prop("disabled", false);
                $("#save_button").text("Add Product");
            },
        });
    }
});