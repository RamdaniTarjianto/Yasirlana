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
        <link href="assets/css/fontawesome-all.min.css" rel="stylesheet"/>
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

            <!-- -->
            <!--search -->
            <div class="row d-flex justify-content-center">
                <div class="col-md-9">
                    <form action="" method="get" id="form1">
                        <input type="hidden" name="page" value="1">
                        <div class="p-4 mt-3">
                            <h3 class="heading mt-5 text-center">Hi! Search Your Rearch Paper Here</h3>
                            <div class="d-flex justify-content-center px-4">
                                <div class="search">
                                    <input
                                        type="text"
                                        id="search"
                                        class="search-input fa fa-search"
                                        placeholder="Type Keyword (e.g TMJ)..."
                                        name="research_name">

                                    <!-- <button type="submit" class="search-icon btn searchButton" name="submit">
                                    <i class="fa fa-search"></i> </button> -->
                                </div>
                            </div>
                            <div class="row mt-4 g-1 px-4 mb-5">
                                <div class="col-md-4">
                                    <div class="form-group" >
                                        <label style="font-size: 15px;">Select Database</label>
                                        <select
                                            class="form-control select2"
                                            name="databases[]"
                                            data-placeholder="Choose Database"
                                            id="databaseform">
                                            <option selected disabled value="" title="Pilih sumber database yang kamu inginkan"></option>
                                            <option value="IEEE">IEEE</option>
                                            <option value="Semantic Scholar">Semantic Scholar</option>
                                            <option value="EPC">Europe PubMed Central</option>
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label class="display-4" style="font-size: 15px;">Publication Year</label>
                                        <div class="input-group input-daterange">
                                            <input
                                                type="text"
                                                class="form-control"
                                                value=""
                                                name="startDate"
                                                id="startDate"
                                                required="required"
                                                placeholder="Start">
                                            <div class="input-group-addon">to</div>
                                            <input
                                                type="text"
                                                class="form-control"
                                                value=""
                                                name="finishDate"
                                                id="finishDate"
                                                required="required"
                                                placeholder="End">
                                            <input
                                                type="submit"
                                                class="btn btn-success ml-4 searchButton"
                                                name="submit"
                                                id="btnCari"
                                                value="Cari">
                                        </div>

                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="display-4" style="font-size: 15px;">Select Result</label>
                                        <div class="btn-group" data-toggle="buttons" id="resultform">
                                            <label class="btn btn-light d-flex" title="Jika kamu memilih label ini, maka akan menghasilkan paper-paper dengan hasil 'Included' sesuai dengan keyword kamu." style="background-color: white;">
                                                <input
                                                    type="checkbox"
                                                    style="margin-right: 10px;"
                                                    id="included"
                                                    name="result[]"
                                                    value="Included"
                                                    autocomplete="off">
                                                <label class="ml-auto my-auto">Included</label>
                                            </label>
                                            <label class="btn btn-light d-flex" title="Jika kamu memilih label ini, maka akan menghasilkan paper-paper dengan hasil 'Excluded' sesuai dengan keyword kamu." style="background-color: white;">
                                                <input
                                                    type="checkbox"
                                                    style="margin-right: 10px;"
                                                    id="excluded"
                                                    name="result[]"
                                                    value="Excluded"
                                                    autocomplete="off">
                                                <label class="ml-auto my-auto">Excluded</label>
                                            </label>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label style="font-size: 15px;">Select Model</label>
                                        <select class="form-control select2" data-placeholder="Choose Model" name="model" id="model">
                                            <option selected disabled value=""></option>
                                            <option>AI - TMJ</option>
                                            <option>AI - ECD</option>
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
                            <?php 
                                if($_GET['startDate'] > $_GET['finishDate']){
                                    $temp = $_GET['startDate'] ;
                                    $_GET['startDate'] = $_GET['finishDate'];
                                    $_GET['finishDate'] = $temp;
                                }
                            ?>
                            <?php echo "Database: " . $_GET['databases'][0] . " || Publication Year: " . $_GET['startDate'] . "-" . $_GET['finishDate'] . " || " . "Model: ". $_GET['model']?></medium>

                    <?php 
                            $notif = "";
                            $databases = $_GET['databases'][0];
                            if($databases == 'IEEE'){
                                $notif = "Anda hanya dapat melakukan export kedalam bentuk excel sebanyak 300 data pertama.";
                            }else if($databases == 'Semantic Scholar'){
                                $notif = "Anda hanya dapat melakukan export kedalam bentuk excel sebanyak 100 data pertama.";
                            }else{
                                $notif = "Anda hanya dapat melakukan export kedalam bentuk excel sebanyak 1000 data pertama.";
                            }
                        ?>
                        <div class="row d-flex justify-content-end mx-auto">
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLink">
                                <a
                                    class="dropdown-item"
                                    href="excelPage.php?<?php echo http_build_query($_GET); ?>"
                                    onclick="return confirm('Apakah Anda yakin ingin mengekspor halaman ini?')">Export This Page (.xls)</a>
                                <a
                                    class="dropdown-item"
                                    href="excel.php?<?php echo http_build_query($_GET); ?>"
                                    title="<?php echo $notif; ?>"
                                    onclick="return confirm('<?php echo $notif; ?> Ingin melanjutkan export?')">Export All Pages (.xls)
                                    <i class="fas fa-info-circle"></i>
                                </a>
                            </div>
                            <!-- </div> -->

                            <button
                                id="dropdownMenuLink"
                                class="btn btn-secondary float-right dropdown-toggle"
                                data-toggle="dropdown"
                                aria-haspopup="true"
                                aria-expanded="false"
                                disabled="disabled">
                                <i class="fa fa-file"></i>
                                Export Data</button>

                        </form>
                    </div>
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

            $("#btnCari").click(function () {
                localStorage.setItem("searchClicked", true);
                var searchInput = $("#search").val();
                localStorage.setItem("searchInput", searchInput);
                $("#dropdownMenuLink").prop("disabled", false);
            });

            $("#nextButon").click(function () {
                localStorage.setItem("nextClicked", true);
                var searchInput = $("#search").val();
                localStorage.setItem("searchInput", searchInput);
                $("#dropdownMenuLink").prop("disabled", false);
            });

            $("#go").click(function () {
                localStorage.setItem("goClicked", true);
                var searchInput = $("#search").val();
                localStorage.setItem("searchInput", searchInput);
                $("#dropdownMenuLink").prop("disabled", false);
            });

            $("#prev").click(function () {
                localStorage.setItem("prevClicked", true);
                var searchInput = $("#search").val();
                localStorage.setItem("searchInput", searchInput);
                $("#dropdownMenuLink").prop("disabled", false);
            });

            $(document).ready(function () {
                var searchClicked = localStorage.getItem("searchClicked");
                var nextClicked = localStorage.getItem("nextClicked");
                var goClicked = localStorage.getItem("goClicked");
                var prevClicked = localStorage.getItem("prevClicked");
                if (searchClicked === "true" || nextClicked === "true" || goClicked === "true" || prevClicked === "true") {
                    $("#dropdownMenuLink").prop("disabled", false);
                    var searchInput = localStorage.getItem("searchInput");
                    $("#dropdownMenuLink").removeClass("btn-secondary");
                    $("#dropdownMenuLink").addClass("btn-success");    
                    $("#search").val(searchInput);
                } else {
                    $("#dropdownMenuLink").prop("disabled", true);
                }

                if (!window.location.hash) {
                    localStorage.removeItem("searchClicked");
                    localStorage.removeItem("nextClicked");
                    localStorage.removeItem("searchInput");
                    localStorage.removeItem("goClicked");
                    localStorage.removeItem("prevClicked");
                    // $("#dropdownMenuLink").prop("disabled", true);
                }
            });

            $(document).ready(function () {
                $('.select2').select2();

                $('.searchButton').click(function () {
                    var keyword = document
                        .getElementById('search')
                        .value;
                    var model = document
                        .getElementById('model')
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

                    if (model === '') {
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

                    if (isNaN(startDate) || startDate.length != 4 || startDate <= 0) {
                        $("#alertDanger").removeClass("d-none");
                        $("#alertDanger").text(
                            "Input tahun harus merupakan angka dan terdiri dari 4 digit!"
                        );
                        return false;
                    }

                    if (isNaN(finishDate) || finishDate.length != 4 || finishDate <= 0) {
                        $("#alertDanger").removeClass("d-none");
                        $("#alertDanger").text(
                            "Input tahun harus merupakan angka dan terdiri dari 4 digit!"
                        );
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
                    // $("#dropdownMenuLink").removeAttr("disabled");
                    // $("#dropdownMenuLink").prop("disabled", false);
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