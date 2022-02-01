<?php require_once 'include/db_connect.php';?>
<?php require_once 'include/db_operations.php';?>
<?php require_once 'include/session.php';?>
<?php require_once 'include/function.php';?>
<?php require_once 'telegram.php';?>
<?php
$_SESSION["TrackingURL"] = $_SERVER["PHP_SELF"];
confirm_login();

$getid = $_GET['id'];

if (isset($_POST["Submit"])) {
    imageupload();
    $update = new Operation();

    if (!empty($_FILES["image"]["name"])) {
        $update->deleteimage("products", $getid);
        $data = [
            'uz' => $_POST["uz"],
            'ru' => $_POST["ru"],
            'categoryId' => $_POST["category"],
            'price' => $_POST["price"],
            'photoUrl' => $_FILES["image"]["name"],
        ];
        $update->update("products", $data, $getid, "product updated successfully", "Something wrong", "products");

    } else {

        $data = [
            'uz' => $_POST["uz"],
            'ru' => $_POST["ru"],
            'categoryId' => $_POST["category"],
            'price' => $_POST["price"],

        ];
        $update->update("products", $data, $getid, "product updated successfully", "Something wrong", "products");
    }
}
?>
<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <meta name="author" content="Bdtask">
    <title>Dashboard: Edit Post</title>
    <!-- App favicon -->
    <link rel="shortcut icon" href="assets/dist/img/favicon.png">
    <!--Global Styles(used by all pages)-->
    <link href="assets/plugins/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/plugins/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="assets/plugins/fontawesome/css/all.min.css" rel="stylesheet">
    <link href="assets/plugins/typicons/src/typicons.min.css" rel="stylesheet">
    <link href="assets/plugins/themify-icons/themify-icons.min.css" rel="stylesheet">
    <!--Third party Styles(used by this page)-->
    <link href="assets/plugins/summernote/summernote.css" rel="stylesheet">
    <link href="assets/plugins/summernote/summernote-bs4.css" rel="stylesheet">
    <link href="assets/plugins/jquery.sumoselect/sumoselect.min.css" rel="stylesheet">
    <!--Start Your Custom Style Now-->
    <link href="assets/dist/css/style.css" rel="stylesheet">
</head>

<body>
    <!-- Page loader -->
    <?php require_once 'page-section/loader.php'?>

    <div class="wrapper">
        <!-- Sidebar  -->
        <?php $page = 'products';require_once 'page-section/sidebar.php'?>

        <div class="content-wrapper">
            <div class="main-content">
                <!-- Header -->
                <?php require_once 'page-section/header.php'?>

                <div class="content-header row align-items-center m-0">

                    <div class="col-sm-8 header-title p-0">
                        <div class="media">
                            <div class="header-icon text-success mr-3"><i class="typcn typcn-puzzle-outline"></i></div>
                            <div class="media-body">
                                <h1 class="font-weight-bold">Edit Product</h1>
                                <small>In this page, you can edit product</small>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="body-content">

                <div class="row">
                        <div class="col-md-12 col-lg-10 mx-auto">
                            <div class="card mb-4">
                                <div class="card-header">
                                    <div>
                                        <h6 class="fs-17 font-weight-600 mb-0">Editting Product</h6>
                                    </div>

                                </div>
                                <div class="card-body">
                                <?php
$get = new Operation();
$stmt = $get->selectbyid("products", $getid);
while ($rows = $stmt->fetch()) {
    $id = $rows["id"];
    $uz = $rows["uz"];
    $ru = $rows["ru"];
    $category = $rows["categoryId"];
    $price = $rows["price"];
    $image = $rows["photoUrl"];

}
?>
                                    <form action="edit_product.php?id=<?php echo $getid; ?>" method="post" enctype="multipart/form-data">

                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="font-weight-600">Name in uzbek language:</label>
                                            <input name="uz" type="text" class="form-control mt-2" value ="<?php echo $uz; ?>"
                                                placeholder="Type name here" required>
                                        </div>


                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="font-weight-600">Name in russian language:</label>
                                            <input name="ru" type="text" class="form-control mt-2" value ="<?php echo $ru; ?>"
                                                placeholder="Type name here" required>
                                        </div>

                                        <div class="form-group">
                                            <label for="exampleInputEmail1" class="font-weight-600">Price:</label>
                                            <input name="price" type="text" class="form-control mt-2" value ="<?php echo $price; ?>"
                                                placeholder="Type price here" required>
                                        </div>

                                        <div class="form-group mb-4">


                                        <label for="exampleInputEmail1" class="font-weight-600">Category</label>
                                                <select name="category" class="testselect1 SumoUnder"
                                                    onclick="console.log($(this).val())"
                                                    onchange="console.log('change is firing')" tabindex="-1" required>
                                                    <?php
$obj = new Operation();
$stmt = $obj->selectbyid("categories", $category);
while ($rows = $stmt->fetch()) {
    $id = $rows["id"];
    $cat = $rows["uz"];
}
?>

                                                    <option selected="selected"
                                                        value="<?php echo $id ?>"><?php echo $cat ?></option>

                                                    <!--placeholder-->
                                                    <?php
$obj = new Operation();
$stmt = $obj->selectall("categories");
while ($rows = $stmt->fetch()) {
    $id = $rows["id"];
    $category = $rows["uz"];
    

    ?>
                                                              <option value="<?php echo $id ?>"><?php echo $category ?></option>
                                                <?php }?>
                                                </select>

</div>

                                        <div class="form-group mb-4">
                                        <div class="text-muted">
                                        Existed Image:
                                        <img class="mb-2" src="../photos/<?php echo $image; ?>" width="100px"; height="70px"; >
                                        </div>
                                        <input type="file" name="image" id="file-2"
                                            class="custom-input-file custom-input-file--2 "
                                            data-multiple-caption="{count} files selected" multiple="">
                                        <label for="file-2">
                                            <i class="fa fa-upload"></i>
                                            <span>Choose a image…</span>
                                        </label>
                                        </div>
                                    <div class="container">
                                    <div class="row">
                                            <div class="col-lg-6">
                                                    <button type="submit" name="Submit" class="btn btn-primary btn-block mt-5">Change</button>
                                            </div>
                                            <div class="col-lg-6">
                                            <a href="products.php" class="btn btn-warning btn-block text-white mt-5" > Back to Table</a>
                                            </div>


                                     </div>
                                     </div>
                                        </div>



                                    </form>
                                </div>
                            </div>
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
    <script src="assets/plugins/jQuery/jquery-3.4.1.min.js"></script>
        <script src="assets/dist/js/popper.min.js"></script>
        <script src="assets/plugins/bootstrap/js/bootstrap.min.js"></script>
        <script src="assets/plugins/metisMenu/metisMenu.min.js"></script>
        <script src="assets/plugins/perfect-scrollbar/dist/perfect-scrollbar.min.js"></script>
        <script src="assets/dist/js/sidebar.js"></script>
        <!-- Third Party Scripts(used by this page)-->
        <script src="assets/plugins/summernote/summernote.min.js"></script>
        <script src="assets/plugins/summernote/summernote-bs4.min.js"></script>
        <script src="assets/plugins/jquery.sumoselect/jquery.sumoselect.min.js"></script>
        <script src="assets/dist/js/pages/demo.jquery.sumoselect.js"></script>
        <!--Page Active Scripts(used by this page)-->
        <script src="assets/plugins/summernote/summernote.active.js"></script>

        <!--Page Active Scripts(used by this page)-->
        <script src="assets/dist/js/pages/forms-basic.active.js"></script>

        <script>
       $('#summernote').find('.note-editable').focus();
       </script>
</body>

</html>