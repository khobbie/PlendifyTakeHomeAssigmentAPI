$(document).ready(function() {
    $("#display_div").on("click", "a.edit_product_btn", function() {
        let product_uuid = $(this).data("edit_product_uuid");
        let product_name = $(this).data("edit_product_name");
        let product_description = $(this).data("edit_product_description");
        let product_price = $(this).data("edit_product_price");

        $("#update_id").val(product_uuid);
        $("#update_name").val(product_name);
        $("#update_description").val(product_description);
        $("#update_price").val(product_price);
    });

    $("#update_form").submit(function(e) {
        e.preventDefault();

        $("#update_button").prop("disabled", true);
        $("#update_button").text("Processing...");

        console.log("ready!");

        let product_uuid = $("#update_id").val();

        let name = $("#update_name").val();
        let description = $("#update_name").val();
        let price = $("#update_price").val();

        let data = {
            name: name,
            description: description,
            price: price,
        };

        $.ajax({
            type: "PUT",
            url: "http://127.0.0.1:8000/api/product/" + product_uuid,
            data: data,
            success: function(res) {
                if (res.code == "000") {
                    $("#update_button").prop("disabled", false);
                    $("#update_button").text("Update Product");
                    $("#update_form").trigger("reset");
                    showAlert("success", res.message);
                    $("#deleteModal").modal("hide");
                    getProduct("");
                } else {
                    showAlert("error", res.message);
                    $("#update_button").prop("disabled", false);
                    $("#update_button").text("Update Product");
                }
                console.log(res);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                showAlert("error", "Server error");
                $("#update_button").prop("disabled", false);
                $("#update_button").text("Update Product");
            },
        });
    });
});