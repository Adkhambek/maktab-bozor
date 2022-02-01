<?php require_once 'include/db_connect.php';?>
<?php require_once 'include/db_operations.php';?>
<?php require_once 'include/session.php';?>
<?php require_once 'include/function.php';?>
<?php
$_SESSION["TrackingURL"] = $_SERVER["PHP_SELF"];
confirm_login();
?>
<!doctype html>
<html lang="en">
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Bootstrap 4 Admin &amp; Dashboard Template">
    <meta name="author" content="Bdtask">
    <title>Main Page</title>
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/dist/img/favicon.png">
    <!--Global Styles(used by all pages)-->
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="assets/plugins/fontawesome/css/all.min.css" rel="stylesheet">
    <link href="assets/plugins/typicons/src/typicons.min.css" rel="stylesheet">
    <link href="assets/plugins/themify-icons/themify-icons.min.css" rel="stylesheet">
    <!--Start Your Custom Style Now-->
    <link href="assets/dist/css/style.css" rel="stylesheet">
</head>

<body>
 <!-- Page loader -->
<?php require_once 'page-section/header.php'?>

<div class="wrapper">
        <!-- Sidebar  -->
        <?php $page = 'dash';require_once 'page-section/sidebar.php'?>

        <div class="content-wrapper">
            <div class="main-content">
                <!-- Header -->
        <?php require_once 'page-section/header.php'?>

                <div class="content-header row align-items-center m-0">
                <nav aria-label="breadcrumb" class="col-sm-4 order-sm-last mb-3 mb-sm-0 p-0 ">
                        <ol class="breadcrumb d-inline-flex font-weight-600 fs-13 bg-white mb-0 float-sm-right">
                            <?php breadcrumb();?>
                        </ol>
                    </nav>
                    <div class="col-sm-8 header-title p-0">
                        <div class="media">
                            <div class="header-icon text-success mr-3"><i class="typcn typcn-puzzle-outline"></i></div>
                            <div class="media-body">
                                <h1 class="font-weight-bold">Statistics</h1>
                                <small>From now on you can see your bot statistics here.</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="body-content">
                <div class="row">
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                                <div class="card card-stats statistic-box mb-4">
                                    <div class="card-header card-header-warning card-header-icon position-relative border-0 text-right px-3 py-0">
                                        <div class="card-icon d-flex align-items-center justify-content-center">
                                            <i class="typcn typcn-user "></i>
                                        </div>
                                        <p class="card-category text-uppercase fs-10 font-weight-bold text-muted">All users:</p>
                                        <?php
$obj = new Operation();
$user = $obj->countitem("profile");
$product = $obj->countitem("products");
$category = $obj->countitem("categories");
$order = $obj->selectbystatuscount("orderproduct", 1);
?>
                                        <h3 class="card-title fs-18 font-weight-bold"><?php echo $user; ?></h3>
                                    </div>
                                    <div class="card-footer p-3">
                                        <div class="stats">

                                            <a href="users" class="warning-link">Users page</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                                <div class="card card-stats statistic-box mb-4">
                                    <div class="card-header card-header-success card-header-icon position-relative border-0 text-right px-3 py-0">
                                        <div class="card-icon d-flex align-items-center justify-content-center">
                                            <i class="typcn typcn-dropbox"></i>
                                        </div>
                                        <p class="card-category text-uppercase fs-10 font-weight-bold text-muted">All products:</p>
                                        <h3 class="card-title fs-21 font-weight-bold"><?php echo $product; ?></h3>
                                    </div>
                                    <div class="card-footer p-3">
                                        <div class="stats">

                                            <a href="products" class="warning-link">Products page</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                                <div class="card card-stats statistic-box mb-4">
                                    <div class="card-header card-header-danger card-header-icon position-relative border-0 text-right px-3 py-0">
                                        <div class="card-icon d-flex align-items-center justify-content-center">
                                            <i class="typcn typcn-folder-open"></i>
                                        </div>
                                        <p class="card-category text-uppercase fs-10 font-weight-bold text-muted">All categories:</p>
                                        <h3 class="card-title fs-21 font-weight-bold"><?php echo $category; ?></h3>
                                    </div>
                                    <div class="card-footer p-3">
                                        <div class="stats">

                                            <a href="category" class="warning-link">Category adding</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6">
                                <div class="card card-stats statistic-box mb-4">
                                    <div class="card-header card-header-info card-header-icon position-relative border-0 text-right px-3 py-0">
                                        <div class="card-icon d-flex align-items-center justify-content-center">
                                            <i class="typcn typcn-shopping-cart"></i>
                                        </div>
                                        <p class="card-category text-uppercase fs-10 font-weight-bold text-muted">Orders:</p>
                                        <h3 class="card-title fs-21 font-weight-bold"><?php echo $order; ?></h3>
                                    </div>
                                    <div class="card-footer p-3">
                                        <div class="stats">

                                            <a href="orders" class="warning-link">Orders page</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                </div>
                <!-- end one body -->
                <div class="body-content">

                    <div class="card mb-4">
                        <div class="card-header">
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <h6 class="fs-17 font-weight-600 mb-0">New Users:</h6>
                                </div>

                            </div>
                        </div>
                        <div class="card-body">
                   <div class="table-responsive">
                           <table id="example" class="table table-striped table-bordered" style="width:100%">
                                <thead>
                                    <tr>

                                        <th>#</th>
                                        <th>ChatID</th>
                                        <th>Name</th>
                                        <th>Username</th>
                                        <th>Date</th>




                                    </tr>
                                </thead>

                                <tbody>
                                <?php
$obj = new Operation();
$stmt = $obj->selectlimit("profile", "id", 10);
$num = 0;
while ($rows = $stmt->fetch()) {
    $chat_id = $rows["chat_id"];
    $username = $rows["username"];
    $first_name = $rows["first_name"];
    $date = $rows["date"];
    $num++;

    ?>
                                    <tr>
                                        <td><?php echo $num; ?></td>
                                        <td><?php echo $chat_id; ?></td>
                                        <td><?php echo $first_name; ?></td>
                                        <td><a href="https://t.me/<?php echo $username; ?>"><?php echo '@' . $username; ?></a></td>
                                        <td><?php echo $date ?></td>





                                    </tr>
                                    <?php }?>

                                </tbody>

                            </table>
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
    <script src="assets/dist/js/sidebar.js"></script>
</body>
</html>