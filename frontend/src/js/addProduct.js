$(document).ready(function() {
    $("#save_form").submit(function(e) {
        e.preventDefault();

        $("#save_button").prop("disabled", true);
        $("#save_button").text("Processing...");

        let name = $("#name").val();
        let description = $("#description").val();
        let price = $("#price").val();

        let data = {
            name: name,
            description: description,
            price: price,
        };

        $.ajax({
            type: "POST",
            url: "http://127.0.0.1:8000/api/product",
            data: data,
            success: function(res) {
                if (res.code == "000") {
                    $("#save_button").prop("disabled", false);
                    $("#save_button").text("Add Product");

                    $("#save_form").trigger("reset");
                    showAlert("success", res.message);

                    $("#createModal").modal("hide");
                    getProduct("");
                } else {
                    $("#save_button").prop("disabled", false);
                    $("#save_button").text("Add Product");
                    showAlert("error", res.message);
                }
                console.log(res);
            },
            error: function(XMLHttpRequest, textStatus, errorThrown) {
                showAlert("error", "Server error");
                $("#save_button").prop("disabled", false);
                $("#save_button").text("Add Product");
            },
        });
    });
});