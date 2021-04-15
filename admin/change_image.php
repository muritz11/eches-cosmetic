<?php
include_once 'assets/serverside/funcs.php';

//$msg = '';

if (isset($_GET['editId'])) {

    extract($_GET);
    $sql = "SELECT * FROM product WHERE id='$editId'";
    $data = $conn->query($sql);
    $result = $data->fetch_assoc();
    extract($result);

}


if (isset($_POST['imgUpload'])){

    extract($_POST);
    $target_dir = "assets/images/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
    //basename() returns the name of the file
    //& pathinfo() returns info abt the path and the element required(ie. extnsion in this case)

    //check if image is an actual image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check !== false) {
        $msg =  "file is an image - ". $check["mime"] . ".";
        $uploadOk = 1;
    }else {
        $msg =  "file is not an image.";
        $uploadOk = 0;
    }

    //check if file already exist
    //limit file size
    //limit file type
    //check if $uploadok is set to 0 by an error
    if (file_exists($target_file)) {

        $msg =  "<br> Sorry, file already exists.";
        $uploadOk = 0;

    } elseif ($_FILES["image"]["size"] > 500000) {

        $msg =  "<br> Sorry, file is too large.";
        $uploadOk = 0;

    } elseif ($imageFileType != "jpg" &&  $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {

        $msg =  "<br> Sorry, only JPG, PNG, JPEG and GIF files are allowed.";
        $uploadOk = 0;

    } elseif ($uploadOk == 0) {

        $msg =  "<br> Sorry, your file was not uploaded.";

        //once everything is ok,try to upload the file
    } else {
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            $msg =  "<br><h2> The file ". basename($_FILES["image"]["tmp_name"]). " has been uploaded.</h2>";

            $sql = "UPDATE product SET image='$target_file' WHERE id='$editId'";

            if ($conn->query($sql)){

                header("location:product.php");

            } else {
                $msg =  'Error updating product <br>';
                $msg =  ($conn->error);
            }

        } else {

            $msg =  "<br> Sorry, there was an error uploading your file.";

        }
    }





    //adding some restrictions


}

?>

<?php if (isset($_GET['editId'])): ?>
    <h4 class="p-2">Upload image: <span style="font-weight: 400"><?= $name ?></span></h4>
    <h5 id="add-cat" class="p-2">
        <a href="product.php"><span><i class="fa fa-chevron-circle-left"></i> Back</span></a>
    </h5>

    <!--    change image    -->
    <div class="form" id="form" style="display: block">
        <form action="change_image.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="image">Image:</label>
                <input type="file" class="form-control" name="image" required>
                <input type="hidden" value="<?= $editId ?>" name="editId">
            </div>

            <input type="submit" class="btn btn-success" name="imgUpload" value="Save">
        </form>
    </div>

<?php endif; ?>


<?php if (isset($_POST['imgUpload'])): ?>

    <div class="alert alert-danger">
        <?= $msg ?>
    </div>

<?php endif; ?>
