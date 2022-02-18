<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Product</title>

    <style>
        #display_div {
            display: none;
        }

    </style>
</head>

<body class="bg-light">


    <br><br>
    <div class="container ">
        <div class="row">
            <div class="col-md-3"></div>

            <div class="col-md-6 ">
                <div class="row ">

                    <div class="col-md-8">
                        <form action="/" method="post" id="search_form" autocomplete="off" aria-autocomplete="off">
                            <div class="input-group">
                                <input type="search" class="form-control" id="search_text" placeholder="Type here ..."
                                    required>
                                <button class="btn btn-sm btn-outline-secondary" type="submit">Search</button>
                                &nbsp;&nbsp;
                                <button class="btn btn-sm btn-outline-secondary" id="get_all_product_btn"
                                    type="button">All Products</button>

                            </div>
                        </form>
                    </div>

                    <div class="col-md-3 col-sm-12">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary float-right" data-bs-toggle="modal"
                            data-bs-target="#createModal">
                            New product
                        </button>


                    </div>

                </div>
                <hr>

                <div class="row " id="loading_div">

                    <div class="text-center">
                        <div class="spinner-border" role="status">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </div>

                </div>

                <div class="row">

                    <div id="display_div"></div>
                    {{-- <div class="col-md-6">
                        <div class="card mt-2 mb-3" style="">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                                <p class="card-text">Some quick example text to build on the card title and make up
                                    the bulk
                                    of the cards content.</p>
                                <a href="#" class="card-link text-primary">Edit</a>
                                <a href="#" class="card-link text-danger">Delete</a>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6">
                        <div class="card mt-2 mb-3" style="">
                            <div class="card-body">
                                <h5 class="card-title">Card title</h5>
                                <h6 class="card-subtitle mb-2 text-muted">Card subtitle</h6>
                                <p class="card-text">Some quick example text to build on the card title and make up
                                    the bulk
                                    of the cards content.</p>
                                <a href="#" class="card-link text-primary">Edit</a>
                                <a href="#" class="card-link text-danger">Delete</a>
                            </div>
                        </div>
                    </div> --}}

                </div>






            </div>

            <div class="col-md-3"></div>
        </div>
    </div>


    <!--Creating Modal -->
    <div class="modal fade" id="createModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="/" id="save_form" autocomplete="off" aria-autocomplete="off">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Create new product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description
                                textarea</label>
                            <textarea class="form-control" id="description" rows="3" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Price (Base currency USD)</label>
                            <input type="text" class="form-control" id="price" required
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')">
                        </div>

                    </div>
                    <div class="modal-footer">


                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-success" id="save_button">Add Product</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!--End Creating Modal -->


    <!-- Updating Modal -->
    <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <form action="/" id="update_form" autocomplete="off" aria-autocomplete="off">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Edit product</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="hidden" class="form-control" id="update_id" required>
                            <input type="text" class="form-control" id="update_name" required>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description
                                textarea</label>
                            <textarea class="form-control" id="update_description" rows="3" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="price" class="form-label">Price (Base currency USD)</label>
                            <input type="text" class="form-control" id="update_price" required
                                oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1')">
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary" id="update_button">Update Product</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- End Updating Modal -->




    <!-- Deleting Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-md">
            <form action="/" id="delete_form" autocomplete="off" aria-autocomplete="off">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title text-danger" id="exampleModalLabel">Are you sure, DELETE ?</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <h4 id="delete_name"></h4>

                        <div class="mb-3">

                            <input type="hidden" class="form-control" id="delete_id" required>
                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-danger" id="delete_button">Delete Product</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- End Deleting Modal -->


    <!--End Modal -->

    <!-- Optional JavaScript; choose one of the two! -->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js"
        integrity="sha384-IQsoLXl5PILFhosVNubq5LC7Qb9DXgDA9i+tQ8Zj3iwWAwPtgFTxbJ8NT4GN1R8p" crossorigin="anonymous">
    </script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"
        integrity="sha384-cVKIPhGWiC2Al4u+LWgxfKTRIcfu0JTxR+EQDz/bgldoEyl4H0zUF0QKbrJ0EcQF" crossorigin="anonymous">
    </script>
    -->

    <script>
        let base_url = "http://127.0.0.1:8000/api"

        $(document).ready(function() {




            function showAlert(icon, message) {
                Swal.fire({
                    position: 'top-end',
                    icon: icon,
                    title: message,
                    showConfirmButton: false,
                    timer: 1500
                })
            }

            $.ajaxSetup({
                timeout: 3000,
                retryAfter: 7000
            });

            setTimeout(function() {
                getProduct("");
            }, 1000)

            $("#close-modal").click(function() {
                $("#createModal").modal("hide")
            })

            $("#save_form").submit(function(e) {

                e.preventDefault();



                $("#save_button").prop('disabled', true);
                $("#save_button").text("Processing...");



                let name = $("#name").val();
                let description = $("#description").val();
                let price = $("#price").val();

                let data = {
                    name: name,
                    description: description,
                    price: price
                }


                $.ajax({
                    type: "POST",
                    url: base_url + "/product",
                    data: data,
                    success: function(res) {
                        if (res.code == '000') {

                            $("#save_button").prop('disabled', false);
                            $("#save_button").text("Add Product");

                            $("#save_form").trigger("reset");
                            showAlert('success', res.message)

                            $('#createModal').modal('hide');
                            getProduct('')
                        } else {
                            $("#save_button").prop('disabled', false);
                            $("#save_button").text("Add Product");
                            showAlert('error', res.message)
                        }
                        console.log(res)

                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        showAlert('error', "Server error");
                        $("#save_button").prop('disabled', false);
                        $("#save_button").text("Add Product");
                    }
                });

            });




            function getProduct(product_id) {

                let search_text = $('#search_text').val()
                if (search_text.length > 1) {
                    searchProduct()
                    return false
                }

                $("#loading_div").css("display", "block");
                $("#display_div").css("display", "none");

                let url = base_url + "/product";
                if (product_id.trim() == "") {

                } else {
                    url = url + "/" + product_id
                }

                $.ajax({
                    type: "GET",
                    url: base_url + "/product",

                    success: function(res) {
                        console.log(res)

                        if (res.code == '000') {
                            $("#loading_div").css("display", "none");
                            $("#display_div").css("display", "block");
                            $("#display_div").html("")

                            let products = res.data;
                            console.log(products)
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
                                `)
                                });

                            } else {
                                $("#display_div").html(`<h2 class="text-center">No data fond</h2>`)
                            }

                        } else {

                        }


                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        alert("some error");
                        $("#save_button").prop('disabled', false);
                        $("#save_button").text("Add Product");
                    }
                });


            }



            function searchProduct() {

                $("#loading_div").css("display", "block");
                $("#display_div").css("display", "none");

                let url = base_url + "/search-product";
                let search_text = $("#search_text").val()

                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        search_text: search_text
                    },
                    success: function(res) {
                        console.log(res)

                        if (res.code == '000') {
                            $("#loading_div").css("display", "none");
                            $("#display_div").css("display", "block");
                            $("#display_div").html("")

                            let products = res.data;
                            console.log(products)
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
                                `)
                                });

                            } else {
                                $("#display_div").html(`<h2 class="text-center">No data fond</h2>`)
                            }

                        } else {

                        }


                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        alert("some error");
                        $("#save_button").prop('disabled', false);
                        $("#save_button").text("Add Product");
                    }
                });


            }

            $("#display_div").on("click", "a.edit_product_btn", function() {

                let product_uuid = $(this).data("edit_product_uuid")
                let product_name = $(this).data("edit_product_name")
                let product_description = $(this).data("edit_product_description")
                let product_price = $(this).data("edit_product_price")


                $("#update_id").val(product_uuid)
                $("#update_name").val(product_name)
                $("#update_description").val(product_description)
                $("#update_price").val(product_price)
            });


            $("#display_div").on("click", "a.delete_product_btn", function() {

                let product_uuid = $(this).data("delete_product_uuid")
                let product_name = $(this).data("delete_product_name")


                $("#delete_id").val(product_uuid)
                $("#delete_name").text(product_name)
            })


            $("#search_form").submit(function(e) {

                e.preventDefault();
                searchProduct()
            })

            $("#get_all_product_btn").click(function(e) {

                e.preventDefault();
                $("#search_form").trigger("reset");
                getProduct("")
            })


            $("#delete_form").submit(function(e) {

                e.preventDefault();


                $("#delete_button").prop('disabled', true);
                $("#delete_button").text("Processing...");

                console.log("ready!");

                let product_uuid = $("#delete_id").val();


                $.ajax({
                    type: "DELETE",
                    url: base_url + "/product/" + product_uuid,

                    success: function(res) {
                        if (res.code == '000') {
                            $("#delete_button").prop('disabled', false);
                            $("#delete_button").text("Delete Product");
                            $("#delete_form").trigger("reset");
                            showAlert('success', res.message)
                            $('#deleteModal').modal('hide');
                            getProduct('')

                        } else {
                            showAlert('error', res.message)
                            $("#delete_button").prop('disabled', false);
                            $("#delete_button").text("Delete Product");
                        }
                        console.log(res)

                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        showAlert('error', "Server error")
                        $("#delete_button").prop('disabled', false);
                        $("#delete_button").text("Delete Product");
                    }
                });

            });




            $("#update_form").submit(function(e) {

                e.preventDefault();

                $("#update_button").prop('disabled', true);
                $("#update_button").text("Processing...");

                console.log("ready!");

                let product_uuid = $("#update_id").val();


                let name = $("#update_name").val();
                let description = $("#update_name").val();
                let price = $("#update_price").val();

                let data = {
                    name: name,
                    description: description,
                    price: price
                }

                $.ajax({
                    type: "PUT",
                    url: base_url + "/product/" + product_uuid,
                    data: data,
                    success: function(res) {
                        if (res.code == '000') {
                            $("#update_button").prop('disabled', false);
                            $("#update_button").text("Update Product");
                            $("#update_form").trigger("reset");
                            showAlert('success', res.message)
                            $('#deleteModal').modal('hide');
                            getProduct("");
                        } else {
                            showAlert('error', res.message)
                            $("#update_button").prop('disabled', false);
                            $("#update_button").text("Update Product");
                        }
                        console.log(res)

                    },
                    error: function(XMLHttpRequest, textStatus, errorThrown) {
                        showAlert('error', "Server error")
                        $("#update_button").prop('disabled', false);
                        $("#update_button").text("Update Product");
                    }
                });

            });


        });
    </script>
</body>

</html>
