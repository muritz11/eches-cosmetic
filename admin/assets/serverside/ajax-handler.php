<?php
session_start();

require_once 'funcs.php';


/*
 *
 * Globals
 *
 * */

//processes all tables
if (isset($_POST['table'])){


    //process the categories table
    if ($_POST['table'] == 'categories'){

        $sql = "SELECT * FROM categories";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $i = 1;
            // output data of each row
            while($row = $result->fetch_assoc()) {

                extract($row);

                echo "<tr>";
                echo "<td>". $i++ ."</td>";
                echo "<td>". $id. "</td>";
                echo "<td>". $categories. "</td>";
                echo "<td class='text-center'>";
                echo $status == 1 ? "<a href='#' id='catStat' class='btn btn-success statusBtn' status='$status' statId='$id'>Active</a>" : "<a href='#' id='catStat' class='btn btn-dark' status='$status' statId='$id'>Deactive</a>";
                echo "</td>";
                echo "<td> <a href='#' id='catDel' class='btn btn-danger' delId='$id' delName='$categories'><i class='fa fa-trash'></i></a> ";
                echo "<a href='#' id='catEdit' class='btn btn-info' editId='$id'>Edit</a> </td>";
                echo "</tr>";


            }
        } else {
            echo "Nothing to show here";
        }

    }


    //process the contact table
    if ($_POST['table'] == 'contact_us'){

        $sql = "SELECT * FROM contact_us";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $i = 1;
            // output data of each row
            while($row = $result->fetch_assoc()) {

                extract($row);

                echo "<tr>";
                echo "<td>". $i++ ."</td>";
                echo "<td>". $id. "</td>";
                echo "<td>". $name. "</td>";
                echo "<td>". $email. "</td>";
                echo "<td>". $mobile. "</td>";
                echo "<td>". $comment. "</td>";
                echo "<td>". $added_on. "</td>";
                echo "<td> <a href='#' id='contDel' class='btn btn-danger' delId='$id' delName='$name'><i class='fa fa-trash'></i></a> </td>";
                echo "</tr>";


            }
        } else {
            echo "Nothing to show here";
        }

    }

    //process the product table
    if ($_POST['table'] == 'product'){

        $sql = "SELECT product.*,categories.categories FROM product, categories WHERE product.categories_id=categories.id";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $i = 1;
            // output data of each row
            while($row = $result->fetch_assoc()) {

                extract($row);

                echo "<tr>";
                echo "<td>". $i++ ."</td>";
                echo "<td>". $id. "</td>";
                echo "<td>". $categories. "</td>";
                echo "<td>". $name. "</td>";
                echo "<td>
                            <img src='$image' id='imgBtn' class='table-img rounded mx-auto' data-toggle=\"tooltip\" title='change image' editId='$id' alt='product image'>
                      </td>";
                echo "<td>". $mrp. "</td>";
                echo "<td>". $price. "</td>";
                echo "<td>". $qty. "</td>";
                echo "<td class='text-center'>";
                echo $status == 1 ? "<a href='#' id='prodStat' class='btn btn-success statusBtn' status='$status' statId='$id'>Active</a>" : "<a href='#' id='prodStat' class='btn btn-dark' status='$status' statId='$id'>Deactive</a>";
                echo "</td>";
                echo "<td> <a href='#' id='productDel' class='btn btn-danger' delId='$id' delName='$name'><i class='fa fa-trash'></i></a> ";
                echo "<a href='#' id='productEdit' class='btn btn-info marg' editId='$id'>Edit</a> </td>";
                echo "</tr>";


            }
        } else {
            echo "Nothing to show here";
        }

    }

    //process the users table
    if ($_POST['table'] == 'users'){

        $sql = "SELECT * FROM users";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            $i = 1;
            // output data of each row
            while($row = $result->fetch_assoc()) {

                extract($row);

                echo "<tr>";
                echo "<td>". $i++ ."</td>";
                echo "<td>". $id. "</td>";
                echo "<td>". $name. "</td>";
                echo "<td>". $email. "</td>";
                echo "<td>". $mobile. "</td>";
                echo "<td>". $added_on. "</td>";
                echo "<td> <a href='#' id='usDel' class='btn btn-danger' delId='$id' delName='$name'><i class='fa fa-trash'></i></a> </td>";
                echo "</tr>";


            }
        } else {
            echo "Nothing to show here";
        }

    }

}



//Edit items/tables
if (isset($_POST['edit_id'])){

    //edit product
    if (isset($_POST['productEdit'])){

        extract($_POST);
        $product_name = test_inputs($product_name);
        $mrp = test_inputs($mrp);
        $price = test_inputs($price);
        $qty = test_inputs($qty);
        $short_desc = test_inputs($short_desc);
        $desc = test_inputs($desc);
        $meta_desc = test_inputs($meta_desc);
        $meta_title = test_inputs($meta_title);
        $meta_key = test_inputs($meta_key);

        $sql = "UPDATE product SET categories_id='$selectCat', name='$product_name', mrp='$mrp', price='$price', qty='$qty', short_desc='$short_desc', descrip='$desc', meta_title='$meta_title', meta_desc='$meta_desc', meta_keyword='$meta_key'  WHERE id=$edit_id";

        if ($conn->query($sql)){

            header("location:../../product.php");

        } else {
            echo 'Error updating product <br>';
            echo ($conn->error);
        }
    }

    //edit product
    if (isset($_POST['categoryEdit'])){

        extract($_POST);
        $category_update = test_inputs($category_update);

        $sql = "UPDATE categories SET categories='$category_update' WHERE id=$edit_id";

        if ($conn->query($sql)){

            header("location:../../index.php");

        } else {
            echo 'Error updating category <br>';
            echo ($conn->error);
        }
    }

}


//activating and deactivating
if (isset($_POST['status']) && isset($_POST['statId'])){

    extract($_POST);


    if ($statusTable == 'categories'){

        if ($status == 1){

            $sql = "UPDATE categories SET status='0' WHERE id='$statId'";
            if ($conn->query($sql)){

                echo 'ok';

            } else {
                echo 'Error Deactivating';
            }

        } else {

            $sql = "UPDATE categories SET status='1' WHERE id='$statId'";
            if ($conn->query($sql)){

                echo 'ok';

            } else {
                echo 'Error Activating';
            }

        }

    } elseif ($statusTable == 'product') {

        if ($status == 1){

            $sql = "UPDATE product SET status='0' WHERE id='$statId'";
            if ($conn->query($sql)){

                echo 'ok';

            } else {
                echo 'Error Deactivating';
            }

        } else {

            $sql = "UPDATE product SET status='1' WHERE id='$statId'";
            if ($conn->query($sql)){

                echo 'ok';

            } else {
                echo 'Error Activating';
            }

        }

    }

}



//deleting a category
if (isset($_POST['delId']) && !empty($_POST['delId'])){

    extract($_POST);
    $sql = "DELETE FROM $delTable WHERE id='$delId'";
    if ($conn->query($sql)){

        echo 'ok';

    } else {
        echo "Error deleting record: " . $conn->error;
    }

}


/*
 *
 * index.php request handler
 *
 * */


//inserts or adds category
if (isset($_POST['category'])){

    extract($_POST);
    $category = test_inputs($category);
    $category = strtolower($category);
    $check = "SELECT * FROM categories WHERE categories LIKE '$category'";
    $data = $conn->query($check);
    $row = $data->fetch_assoc();

    if (empty($category)){

        echo 'Check for empty input fields';

    } elseif ($row['categories'] == $category){

        echo 'Category already exist';

    } else {

        $run = "INSERT INTO categories (categories, status) VALUES ('$category', '1')";

        if ($conn->query($run) == true) {

            echo 'ok';


        } else {
            echo ($conn->error);
        }

    }
}


/*
 *
 * product.php request handler
 *
 *
 * */


// insert/create new product
if (isset($_POST['prodName'])){

    extract($_POST);

    if (empty($prodName) or empty($mrp) or empty($price) or empty($qty) or empty($short_desc) or empty($desc) or empty($meta_desc) or empty($meta_title) or empty($meta_key)){

        echo 'Check for empty input fields';

    }elseif ($selectCat == 'select category'){

        echo 'Please select a category';

    } else {

        $prodName = test_inputs($prodName);
        $mrp = test_inputs($mrp);
        $price = test_inputs($price);
        $qty = test_inputs($qty);
        $short_desc = test_inputs($short_desc);
        $desc = test_inputs($desc);
        $meta_desc = test_inputs($meta_desc);
        $meta_title = test_inputs($meta_title);
        $meta_key = test_inputs($meta_key);

        $run = "INSERT INTO product (categories_id, name, mrp, price, qty, short_desc, descrip, meta_title, meta_desc, meta_keyword, status) VALUES ('$selectCat', '$prodName', '$mrp', '$price', '$qty', '$short_desc', '$desc', '$meta_title', '$meta_desc', '$meta_key', '1')";

        if ($conn->query($run) == true) {

            echo 'ok';


        } else {
            echo ($conn->error);
        }
    }


}


/*
 *
 * register/log admin user
 *
 *
 * */

if (isset($_POST['reg_username'])){

    extract($_POST);

    $username =  test_inputs($reg_username);
    $email = test_inputs($email);
    $toke = test_inputs($token);


    if (empty($reg_username) or empty($email) or empty($token) or empty($confirm_password)){
        echo 'Everything must be filled';
    }
    else if ($token != 'abuguja'){
        echo 'icorrect token';
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo 'Email address is invalid';
    }
    else if (!preg_match("/^[a-zA-Z0-9_]*$/",$reg_username)){
        echo 'Space or symbol not allowed in the username';
    }
    else  if ($passwd !== $confirm_password){
        echo 'Password do not match';
    }
    else if (dbCheck($username, 'username')){
        echo "Username:$username, already Exist";
    }
    else if (dbCheck($email, 'email')){
        echo 'Email address Already Exist';
    }
    else {
        $passwd = password_hash($passwd, PASSWORD_DEFAULT);
        $sql =  "INSERT INTO admin_users (username, password, email) VALUES ('$username', '$passwd', '$email')";

        if ($conn->query($sql)) {
            echo "ok";
        } else {
            echo($conn->error);
        }
    }

}

//admin login
if (isset($_POST['log_username'])){

    extract($_POST);
    $username = test_inputs($log_username);

    if (empty($username) || empty($passwd)){
        echo 'Check for empty fields';
    } else {

        if (dbCheck($username,'username')){
            $sql = "SELECT * FROM admin_users WHERE username='$username'";
            $res = $conn->query($sql);
            $row = mysqli_fetch_assoc($res);
            $dbPassword = $row['password'];
            if (password_verify($passwd, $dbPassword)){

                $_SESSION['logged_in'] = true;
                $_SESSION['logged_user'] = $username;

                echo 'ok';

            } else {
                echo 'Invalid details (wrong password)';
            }
        } else {
            echo 'Invalid username';
        }

    }

}








/*    main shopping site ajax requests   */

/*
 *
 * register/log user
 *
 *
 * */

//register store user
if (isset($_POST['userReg_name'])){

    extract($_POST);

    $name =  test_inputs($userReg_name);
    $email = test_inputs($email);
    $tel = test_inputs($user_tel);
    if (empty($name) or empty($email) or empty($tel) or empty($confirm_password)){
        echo 'Everything must be filled';
    }
    else if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
        echo 'Email address is invalid';
    }
    else  if ($passwd !== $confirm_password){
        echo 'Passwords do not match';
    }
    else if (dbCheck($email, 'email', 'users')){
        echo 'Email address Already Exist';
    }
    else if (dbCheck($tel, 'mobile', 'users')){
        echo 'Mobile number Already Exist';
    }
    else {
        $regTime = date("Y-m-d h:i:sa") ;
        $passwd = password_hash($passwd, PASSWORD_DEFAULT);
        $sql =  "INSERT INTO users (name, password, email, mobile, added_on) VALUES ('$name', '$passwd', '$email', '$tel', '$regTime')";

        if ($conn->query($sql)) {
            echo "ok";
        } else {
            echo($conn->error);
        }
    }

}



//user login
if (isset($_POST['userLog_email'])){

    extract($_POST);
    $email = test_inputs($userLog_email);

    if (empty($email) || empty($userPasswd)){
        echo 'Check for empty fields';
    } else {

        if (dbCheck($email,'email', 'users')){
            $sql = "SELECT * FROM users WHERE email='$email'";
            $res = $conn->query($sql);
            $row = mysqli_fetch_assoc($res);
            $dbPassword = $row['password'];
            if (password_verify($userPasswd, $dbPassword)){

                $_SESSION['userLogged_in'] = true;
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_email'] = $row['email'];

                echo 'ok';

            } else {
                echo 'Invalid details (wrong password)';
            }
        } else {
            echo 'Invalid email';
        }

    }

}

