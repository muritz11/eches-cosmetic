<?php
include_once 'conn.php';

function test_inputs($data) {
    global $conn;

    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    $data = mysqli_real_escape_string($conn, $data);
    return $data;
}

//query db for matching/same $value
function dbCheck($value, $column, $table='admin_users'){

    global $conn;

    $sql = "SELECT * FROM $table WHERE $column = '$value' ";
    $res = mysqli_query($conn, $sql);
    while ($row = mysqli_fetch_assoc($res)){
        if (count($row) > 0){
            return $data = true;
        } else {
            return $data = false;
        }
    }
}

//a session creator
function createSession($index, $value){
    $_SESSION[$index] = $value;
    return $_SESSION[$index];
}


function prx($arr){
    echo '<pre>';
    print_r($arr);
    die(); //bitch
}

//get product tables
function get_product($limit='', $cat_id='', $product_id=''){

    global $conn;

    $sql = "SELECT product.*,categories.categories FROM product, categories WHERE product.status=1 ";
    if ($cat_id != ''){
        $sql.= " and product.categories_id=$cat_id";
    }
    if ($product_id != ''){
        $sql.= "  and product.id=$product_id";
    }

    $sql.= "  and product.categories_id=categories.id";
    $sql.= " order by product.id desc";

    if ($limit != ''){
        $sql.= " limit $limit";
    }

    $res = mysqli_query($conn, $sql);
    $data = array();
    while ($row = mysqli_fetch_assoc($res)){
        $data[] = $row;
    }

    return $data;

}

//get categories
function get_cats(){

    global $conn;

    $sql = "SELECT * FROM categories WHERE status=1 ";
    $res = mysqli_query($conn, $sql);
    $data = array();
    while ($row = mysqli_fetch_assoc($res)){
        $data[] = $row;
    }

    return $data; //osiso osiso

}

//get table
function get_table($table, $where='', $asterix='*'){

    global $conn;

    $sql = "SELECT $asterix FROM $table $where";
    $res = mysqli_query($conn, $sql);
    $data = array();
    while ($row = mysqli_fetch_assoc($res)){
        $data[] = $row;
    }

    return $data; //osiiso osiiso

}

