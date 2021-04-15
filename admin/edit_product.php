<?php
include_once 'assets/serverside/funcs.php';

if (isset($_GET['editId'])) {

    extract($_GET);
    $sql = "SELECT * FROM product WHERE id='$editId'";
    $data = $conn->query($sql);
    $product = $data->fetch_assoc();
    extract($product);

}

?>

<?php if (isset($_GET['editId'])): ?>
<h4 class="p-2">Edit product: <?= $name ?></h4>
    <h5 id="add-cat" class="p-2">
        <a href="product.php"><span><i class="fa fa-chevron-circle-left"></i> Back</span></a>
    </h5>

<!--    Edit product form    -->
<div class="form" id="form" style="display: block">
    <form action="assets/serverside/ajax-handler.php" method="post" id="frmProduct">
        <div class="form-group">
            <label for="selectCat">Category:</label>
            <select name="selectCat" class="form-control">
                <?php
                $sql = mysqli_query($conn, "SELECT id, categories FROM categories");

                while ($cats = mysqli_fetch_assoc($sql)){

                    extract($cats);
                    echo "<option";
                    echo " value='$id'";
                    echo $id == $categories_id ? 'selected >' : '>';
                    echo $categories;
                    echo "</option>";

                }
                ?>
            </select>
        </div>

        <div class="form-group">
            <label for="prodName">Product name:</label>
            <input type="text" class="form-control" name="product_name" value="<?php echo $name;?>" required>
            <input type="hidden" value="<?= $editId ?>" name="edit_id">
        </div>

        <div class="form-group">
            <label for="mrp">Mrp:</label>
            <input type="text" class="form-control" name="mrp" value="<?php echo $mrp;?>" required>
        </div>

        <div class="form-group">
            <label for="price">Price:</label>
            <input type="text" class="form-control" name="price" value="<?php echo $price;?>" required>
        </div>

        <div class="form-group">
            <label for="qty">Quantity:</label>
            <input type="text" class="form-control" name="qty" value="<?php echo $qty;?>" required>
        </div>

<!--        non-editable-->
        <div class="form-group">
            <label for="shortDesc">Short description:</label>
            <textarea name="short_desc" class="form-control animate__animated" required><?php echo $short_desc;?></textarea>
        </div>

        <div class="form-group">
            <label for="desc">Description:</label>
            <textarea name="desc" class="form-control animate__animated" required><?php echo $descrip;?></textarea>
        </div>

        <div class="form-group">
            <label for="meta_desc">Meta description:</label>
            <textarea name="meta_desc" class="form-control animate__animated" required><?php echo $meta_desc;?></textarea>
        </div>

        <div class="form-group">
            <label for="meta_title">Meta title:</label>
            <textarea name="meta_title" class="form-control animate__animated" required><?php echo $meta_title;?></textarea>
        </div>

        <div class="form-group">
            <label for="meta_key">Meta keyword:</label>
            <textarea name="meta_key" class="form-control animate__animated" required><?php echo $meta_keyword;?></textarea>
        </div>
        <input type="submit" class="btn btn-success" name="productEdit" value="Save">
    </form>
</div>

<?php endif; ?>