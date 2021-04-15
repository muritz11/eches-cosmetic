<?php

require_once '../../admin/assets/serverside/conn.php';
require_once '../../admin/assets/serverside/funcs.php';

$output = '';
$sql = "SELECT * FROM product WHERE (name LIKE '%".$_POST["query"]."%' OR meta_keyword LIKE '%".$_POST["query"]."%') AND status=1";
$sql2 = "SELECT * FROM categories WHERE categories LIKE '%".$_POST["query"]."%' AND 
status=1";
$result = mysqli_query($conn, $sql);
$result2 = mysqli_query($conn, $sql2);

if (mysqli_num_rows($result2) > 0){

    while ($row2 = mysqli_fetch_assoc($result2)){

        $output .= "<a href='product.php?catId=".$row2['id']."'><h4 class='fetched_item text-left p-3 m-0'>
                        <span>". $row2['categories'] ."</span><br>
                        <p class='text-muted small'>category</p>
                    </h4></a>";

    }
}


if (mysqli_num_rows($result) > 0){
    while ($row = mysqli_fetch_assoc($result)){

        $output .= "<a href='shop-item.php?itemId=".$row['id']."'><h4 class='fetched_item text-left m-0'>
                        <img src='admin/".$row['image']."' alt='' class='table-img rounded mx-auto p-3'>
                        <span>". $row['name'] ."</span>
                        
                    </h4></a>";



    }

} else {

    $output .= '<h4 class="fetched_item pt-3">Data not found</h4>';

}

echo $output;