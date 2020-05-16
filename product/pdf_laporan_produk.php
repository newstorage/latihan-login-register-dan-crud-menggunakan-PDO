<?php

session_start();

// check user login
if (empty($_SESSION['user_id'])) {
    header("Location: ../index");
}
// core.php holds pagination variables
include_once '../database/core.php';
include_once '../database/database.php';

include_once '../controller/product.php';
include_once '../controller/category.php';

// Database connection

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);
$category = new Category($db);

$page_title = "Print Products";
include_once "../layout_header.php";
// query products
$stmt = $product->readAll($from_record_num, $records_per_page);


// specify the page where paging is used
$page_url = "pdf_laporan_produk.php?";

// count total rows - used for pagination
$total_rows = $product->countAll();

// read products button
echo "<div class='noprint'>";
echo "<div class='right-button-margin'>";
echo "<a href='read_template' class='btn btn-primary pull-right'>";
echo "<span class='glyphicon glyphicon-list'></span> Read Products";
echo "</a>";
echo "</div>";
echo "</div>";
// display the products if there are any
if ($total_rows > 0) {

    echo "<table class='table table-hover table-responsive table-bordered'>";
    echo "<tr>";
    echo "<th>No.</th>";
    echo "<th>Product</th>";
    echo "<th>Price</th>";
    echo "<th>Description</th>";
    echo "<th>Category</th>";

    echo "</tr>";
    $no = 1;
    while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

        extract($row);

        echo "<tr>";
        echo "<td>{$no}</td>";
        echo "<td>{$name}</td>";
        echo "<td>{$price}</td>";
        echo "<td>{$description}</td>";
        echo "<td>";
        $category->id = $category_id;
        $category->readName();
        echo $category->name;
        echo "</td>";
        echo "</tr>";
        $no++;
    }

    echo "</table>";
    // paging buttons

    include_once '../product/paging.php';
}

echo  "<script> window.print(); </script>";
