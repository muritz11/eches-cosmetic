<?php
include_once 'assets/serverside/funcs.php';

if (isset($_GET['editId'])) {

    extract($_GET);
    $sql = "SELECT * FROM categories WHERE id='$editId'";
    $data = $conn->query($sql);
    $result = $data->fetch_assoc();
    extract($result);

}

?>

<?php if (isset($_GET['editId'])): ?>
    <h4 class="p-2">Edit category: <span style="font-weight: 400"><?= $categories ?></span></h4>
    <h5 id="add-cat" class="p-2">
        <a href="index.php"><span><i class="fa fa-chevron-circle-left"></i> Back</span></a>
    </h5>

    <!--    add category form    -->
    <div class="form" id="form" style="display: block">
        <form action="assets/serverside/ajax-handler.php" method="post">
            <div class="form-group">
                <label for="category">Category name:</label>
                <input type="text" class="form-control" id="category" name="category_update"  value="<?php echo $categories;?>" required>
                <input type="hidden" value="<?= $editId ?>" name="edit_id">
            </div>
            <input type="submit" class="btn btn-success" name="categoryEdit" value="Save">
        </form>
    </div>

<?php endif; ?>