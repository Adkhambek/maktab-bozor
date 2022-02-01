<?php require_once 'include/db_connect.php';?>
<?php require_once 'include/db_operations.php';?>
<?php require_once 'include/session.php';?>
<?php require_once 'include/function.php';?>
<?php require_once 'telegram.php';?>
<?php
$_SESSION["TrackingURL"] = $_SERVER["PHP_SELF"];
confirm_login();

$getid = $_GET['order'];

if (isset($_POST["Submit"])) {

    $obj = new Operation();
    $stmt = $obj->selectbyid("orderproduct", $getid);

    while ($rows = $stmt->fetch()) {
        $latitude = $rows["latitude"];
        $lat = str_replace(',', '.', $latitude);
        $longitude = $rows["longitude"];
        $long = str_replace(',', '.', $longitude);

    }
    send($lat, $long);

}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="author" content="Bdtask">
    <title>Ordered Products</title>
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/dist/img/favicon.png">
    <!--Global Styles(used by all pages)-->
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="assets/plugins/fontawesome/css/all.min.css" rel="stylesheet">
    <link href="assets/plugins/typicons/src/typicons.min.css" rel="stylesheet">
    <link href="assets/plugins/themify-icons/themify-icons.min.css" rel="stylesheet">
    <!--Third party Styles(used by this page)-->
    <link href="assets/plugins/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
    <!--Start Your Custom Style Now-->
    <link href="assets/dist/css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Page loader -->
    <?php require_once 'page-section/loader.php'?>

    <div class="wrapper">
        <!-- Sidebar  -->
        <?php $page = 'orders';require_once 'page-section/sidebar.php'?>

        <div class="content-wrapper">
            <div class="main-content">
                <!-- Header -->
                <?php require_once 'page-section/header.php'?>

                <div class="content-header row align-items-center m-0">

                    <div class="col-sm-8 header-title p-0">
                        <div class="media">
                            <div class="header-icon text-success mr-3"><i class="typcn typcn-puzzle-outline"></i></div>
                            <div class="media-body">
                                <h1 class="font-weight-bold">Ordered Products</h1>
                                <small>In this page, you can see ordered products</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="body-content">
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="fs-17 font-weight-600 mb-0">Client Details</h6>
                                </div>

                            </div>
                        </div>
                        <div class="card-body">

                            <?php
$get = new Operation();
$stmt = $get->selectbyid("orderproduct", $getid);
while ($rows = $stmt->fetch()) {
    $username = $rows["username"];
    $name = $rows["name"];
    $tel = $rows["tel"];
    $latitude = $rows["latitude"];
    $lat = str_replace(',', '.', $latitude);
    $longitude = $rows["longitude"];
    $long = str_replace(',', '.', $longitude);
    $product = $rows["product"];
    $overallprice = $rows["overallprice"];
    $date = $rows["date"];
}
?>
                            <b>Name:</b> <?php echo $name; ?> <br>
                            <b>Username:</b> <a
                                href="https://t.me/<?php echo $username; ?>"><?php echo '@' . $username; ?></a> <br>
                            <b>Phone number:</b> <i><?php echo '+' . $tel; ?></i> <br>
                            <b>Date:</b> <?php echo $date; ?> <br>

                        </div>
                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="fs-17 font-weight-600 mb-0">Products:</h6>
                                </div>

                            </div>
                        </div>
                        <div class="card-body">
                            <ul>
                                <?php echo $product ?>
                            </ul>
                            <hr>
                            <b>Jami: </b><?php echo number_format($overallprice, 0, "", " ") . ' so\'m'; ?>
                        </div>



                    </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="fs-17 font-weight-600 mb-0">Google Map:</h6>
                                </div>

                            </div>
                        </div>
                        <div class="card-body">
                        <iframe src="https://maps.google.com/maps?q=<?php echo $lat . ',' . $long; ?>&hl=en&z=14&amp;output=embed" width="100%" height="400" frameborder="0" style="border:0" allowfullscreen></iframe>
                        </div>



                    </div>



                    <form action="product.php?order=<?php echo $getid; ?>" method="post">

                                    <div class="row">
                                            <div class="col-lg-6">
                                                    <button type="submit" name="Submit" class="btn btn-primary btn-block mt-2"><i class="fas fa-paper-plane"></i> Send Location</button>
                                            </div>
                                            <div class="col-lg-6">
                                            <a href="orders.php" class="btn btn-warning btn-block text-white mt-2" ><i class="fas fa-long-arrow-alt-left"></i> Back to Table</a>
                                            </div>



                                     </div>
                    </form>







                </div>

            </div>
        </div>
    </div>

    </div>
    <!--Footer-->
    <?php require_once 'page-section/footer.php'?>

    <div class="overlay"></div>
    </div>

    </div>

    <!--Global script(used by all pages)-->
    <script data-cfasync="false" src="cdn-cgi/scripts/5c5dd728/cloudflare-static/email-decode.min.js"></script>
    <script src="assets/plugins/jQuery/jquery-3.4.1.min.js"></script>
    <script src="assets/dist/js/popper.min.js"></script>
    <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
    <script src="assets/plugins/metisMenu/metisMenu.min.js"></script>
    <script src="assets/plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js"></script>

    <!-- Third Party Scripts(used by this page)-->
    <script src="assets/plugins/datatables/dataTables.min.js"></script>
    <script src="assets/plugins/datatables/dataTables.bootstrap4.min.js"></script>
    <!--Page Active Scripts(used by this page)-->
    <script src="assets/plugins/datatables/data-basic.active.js"></script>
    </section>
    <script>
        $(document).ready(function () {
            $('#example').DataTable({

                responsive: true,
                'columnDefs': [{
                    'targets': [3, 4],
                    'orderable': false,
                }]

            });

        });
    </script>
    <script src="assets/dist/js/sidebar.js"></script>
</body>

</html>