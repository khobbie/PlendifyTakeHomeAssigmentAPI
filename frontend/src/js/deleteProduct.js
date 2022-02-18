$(document).ready(function() {
    $("#display_div").on("click", "a.delete_product_btn", function() {
        let product_uuid = $(this).data("delete_product_uuid");
        let product_name = $(this).data("delete_product_name");

        $("#delete_id").val(product_uuid);
        $("#delete_name").text(product_name);
    });

    $("#delete_form").submit(function(e) {
        e.preventDefault();

        $("#delete_button").prop("disabled", true);
        $("#delete_button").text("Processing...");

        console.log("ready!");

        let product_uuid = $("#delete_id").val();

        $.ajax({
            type: "DELETE",
            url: base_url + "/product/" + product_uuid,

            success: function(res) {
                if (res.code == "000") {
                    $("#delete_button").prop("disabled", false);
                    $("#delete_button").text("Delete Product");
                    $("#delete_form").trigger("reset");
                    showAlert("success", res.message);
                    $("#deleteModal").modal("hide");
                    getProduct("");
                } else {
                    showAlert("error", res.message);
                    $("#delete_button").prop("disabled", false);
                    $("#delete_button").text("Delete Product");
                }
                console.log(res);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                showAlert("error", "Server error");
                $("#delete_button").prop("disabled", false);
                $("#delete_button").text("Delete Product");
            },
        });
    });
});