<?php
error_reporting(0);
ini_set('display_errors', 0);
set_time_limit(10000);
// include "navbar.php";
?>
<!doctype html>
<html lang="en">

    <head>
        <title>YASIRLANA - Search</title>
        <!-- Required meta tags -->
        <meta charset="utf-8">
        <meta
            name="viewport"
            content="width=device-width, initial-scale=1, shrink-to-fit=no">

        <!-- Bootstrap CSS -->
        <link
            rel="stylesheet"
            href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
            integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T"
            crossorigin="anonymous">
        <link
            rel="stylesheet"
            href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="css/search.css">
        <!-- <link rel="stylesheet" href="css/paginasi.css"> -->
        <link
            href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css"
            rel="stylesheet"/>
        <link rel="stylesheet" href="css/select2.css">

        <link rel="shortcut icon" type="image/x-icon" href="images/icon.png">
        <link href="css/index.css" rel="stylesheet"/>

        <!-- Pagination -->
        <link
            rel="stylesheet"
            type="text/css"
            href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css">
        <script
            src="https://code.jquery.com/jquery-3.6.1.min.js"
            integrity="sha256-o88AwQnZB+VDvE9tvIXrMQaPlFFSUTR+nldQm1LuPXQ="
            crossorigin="anonymous"></script>
        <script
            type="text/javascript"
            charset="utf8"
            src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
    </head>

    <body>
        <div class="container mt-4">
            <!-- alert -->
            <div
                class="alert alert-danger alert-dismissible fade show d-none"
                role="alert"
                id="alertDanger">
                <strong>Oops!</strong>
                Ada form yang belum terisi.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <!--search -->
            <div class="row d-flex justify-content-center">
                <div class="col-md-9">
                    <form action="" method="get" id="form1">
                        <input type="hidden" name="page" value="1">
                        <div class="p-4 mt-3">
                            <h3 class="heading mt-5 text-center">Hi! Search Data in Here</h3>
                            <div class="d-flex justify-content-center px-4">
                                <div class="search">
                                    <input
                                        type="text"
                                        id="search"
                                        class="search-input"
                                        placeholder="Type Keyword ..."
                                        name="research_name">

                                    <!-- <button type="submit" class="search-icon btn searchButton" name="submit">
                                        <i class="fa fa-search"></i>
                                    </button> -->
                                </div>
                            </div>
                            <div class="row mt-4 g-1 px-4 mb-5">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Select Database</label>
                                        <select
                                            class="form-control select2"
                                            name="databases[]"
                                            data-placeholder="Database"
                                            id="databaseform">
                                            <option value="Semantic Scholar">Semantic Scholar</option>
                                            <option value="IEEE">IEEE</option>
                                            <option value="EPC">Europe PubMed Central</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label>Publication Year</label>
                                        <div class="input-group input-daterange">
                                            <input
                                                type="text"
                                                class="form-control"
                                                value=""
                                                name="startDate"
                                                id="startDate"
                                                required="required">
                                            <div class="input-group-addon">to</div>
                                            <input
                                                type="text"
                                                class="form-control"
                                                value=""
                                                name="finishDate"
                                                id="finishDate"
                                                required="required">
                                            <input type="submit" class="btn btn-success ml-4 searchButton" name="submit" id="btnCari" value="Cari">
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Select Result</label>
                                        <div class="btn-group" data-toggle="buttons" id="resultform">
                                            <label class="btn btn-light" style="background-color: white;">
                                                <input type="checkbox" id="included" name="result[]" value="Included" autocomplete="off">
                                                Included
                                            </label>
                                            <label class="btn btn-light" style="background-color: white;">
                                                <input type="checkbox" id="excluded" name="result[]" value="Excluded" autocomplete="off">
                                                Excluded
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Select Model</label>
                                        <select class="form-control select2" data-placeholder="Model" name="model">
                                            <option>AI - TMJ</option>
                                        </select>
                                    </div>

                                    <!-- <button name="export" id="export" class="btn btn-success float-right"
                                    onclick="submitForm('excel.php')"> <i class="fa fa-file"></i> Export
                                    Data</button> -->
                                </div>

                            </div>
                        </div>
                        <!-- </form> -->
                    </div>
                </div>

                <!--Result -->
                <div class="result mt-5 mb-5 ml-4">
                    <?php
            $key = $_GET['research_name'];
            $keyword = preg_replace('/\s+/', '+', $key);
            ?>
                    <div class="heading-result mb-3">Results found for :
                        <small class="text-success heading-result">
                            <?php echo $key ?></small>

                    </div>
                    <div class="mb-3">
                        <medium class="text-dark">
                            <?php echo "Database: " . $_GET['databases'][0] . " || Publication Year: " . $_GET['startDate'] . "-" . $_GET['finishDate'] . " || " . "Model: ". $_GET['model']?></medium>

                        <!-- <form action="" method="get" id="formExp"> -->

                        <!-- <div class="dropdown show"> -->
                        <!-- <a class="btn btn-secondary dropdown-toggle" href="#" role="button"
                        id="dropdownMenuLink" data-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false"> Export Option </a> -->

                        <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                            <a
                                class="dropdown-item"
                                href="excelPage.php?<?php echo http_build_query($_GET); ?>">Export This Page</a>
                            <a
                                class="dropdown-item"
                                href="excel.php?<?php echo http_build_query($_GET); ?>">Export All Pages</a>
                        </div>
                        <!-- </div> -->
                        <button
                            name="export"
                            id="dropdownMenuLink"
                            class="btn btn-success float-right dropdown-toggle"
                            onclick="submitForm('excel.php')"
                            data-toggle="dropdown"
                            aria-haspopup="true"
                            aria-expanded="false">
                            <i class="fa fa-file"></i>
                            Export Data</button>
                    </form>
                </div>
                <div class="card p-3 d-flex flex-column">
                    <div class="loading mt-3 mb-3 d-none">
                        <div class="d-flex justify-content-center">
                            <h4 class="text-success mr-3">Loading</h4>
                            <div class="spinner-grow text-success" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <div class="spinner-grow text-success" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <div class="spinner-grow text-success" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <div class="spinner-grow text-success" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                            <div class="spinner-grow text-success" role="status">
                                <span class="sr-only">Loading...</span>
                            </div>
                        </div>
                    </div>
                    <div id="myTable"><?php include 'result.php'; ?></div>
                </div>
            </div>
        </div>
        <!-- jQuery first, then Popper.js, then Bootstrap JS -->
        <script
            src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
            integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
            crossorigin="anonymous"></script>
        <script
            src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
            integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
            crossorigin="anonymous"></script>
        <script
            src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
            integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
            crossorigin="anonymous"></script>
        <script
            src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

        <!-- select2 -->
        <script>
            $(document).ready(function () {
                $('.select2').select2();

                $('.searchButton').click(function () {
                    var keyword = document
                        .getElementById('search')
                        .value;
                    var database = document
                        .getElementById('databaseform')
                        .value;
                    var result = document
                        .getElementById('resultform')
                        .value;
                    var included = document
                        .getElementById('included')
                        .checked;
                    var excluded = document
                        .getElementById('excluded')
                        .checked;

                    var startDate = document
                        .getElementById('startDate')
                        .value;

                    var finishDate = document
                        .getElementById('finishDate')
                        .value;

                    if (keyword === '') {
                        $("#alertDanger").removeClass("d-none");
                        return false;
                    }

                    if (database === '') {
                        $("#alertDanger").removeClass("d-none");
                        return false;
                    }

                    if (result === '') {
                        $("#alertDanger").removeClass("d-none");
                        return false;
                    }

                    if (!included && !excluded) {
                        $("#alertDanger").removeClass("d-none");
                        return false;
                    }

                    if (startDate === '') {
                        $("#alertDanger").removeClass("d-none");
                        return false;
                    }

                    if (finishDate === '') {
                        $("#alertDanger").removeClass("d-none");
                        return false;
                    }

                    $("#alertDanger").addClass("d-none");
                    $(".empty").addClass("d-none");
                    $(".card-body").addClass("d-none");
                    $(".loading").removeClass("d-none");
                })
            });
        </script>
        <script type="text/javascript">
            function submitForm(action) {
                var form = document.getElementById('form1');
                form.action = action;
                form.submit();
            }

            const urlSearchParams = new URLSearchParams(window.location.search);
            const params = Object.fromEntries(urlSearchParams.entries());

            console.log(params)

            // $(document).ready(function () {     $('#myTable').DataTable(); });
        </script>

    </body>

</html>