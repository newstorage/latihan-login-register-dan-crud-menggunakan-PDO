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

// Database connection  gunakan obyek function getConnection di database.php

$database = new Database();
$db = $database->getConnection();

$product = new Product($db);
$category = new Category($db);
include_once "../layout_navbar.php";
$page_title = "Read Products";
include_once "../layout_header.php";

// query products
if (!isset($_GET['s'])) {
    $stmt = $product->readAll($from_record_num, $records_per_page);
}

// specify the page where paging is used
$page_url = "read_template?";

// count total rows - used for pagination
$total_rows = $product->countAll();  //isi dengan obyek function countAll

// search form
echo "<form role='search' action='search.php'>";
    echo "<div class='input-group col-md-3 pull-left margin-right-1em'>";
        $search_value=isset($search_term) ? "value='{$search_term}'" : "";
        echo "<input type='text' class='form-control' placeholder='Type product name or description...' name='s' id='srch-term' required {$search_value} />";
        echo "<div class='input-group-btn'>";
            echo "<button class='btn btn-primary' type='submit'><i class='glyphicon glyphicon-search'></i></button>";
        echo "</div>";
    echo "</div>";
echo "</form>";
 
// create product button
echo "<div class='right-button-margin'>";

echo "<a href='pdf_laporan_produk' class='btn btn-success pull-right'>";
echo "<span class='glyphicon glyphicon-print'></span> Print ";
echo "</a>";
echo "<a href='pdf_laporan_produk_all' class='btn btn-warning pull-right'>";
echo "<span class='glyphicon glyphicon-print'></span> Print All ";
echo "</a>";
    echo "<ul><a href='create_product' class='btn btn-primary pull-right'>";
        echo "<span class='glyphicon glyphicon-plus'></span> Create Product";
    echo "</a>";
echo "</div>";
 
// display the products if there are any
if($total_rows>0){
 
    echo "<table class='table table-hover table-responsive table-bordered'>";
        echo "<tr>";
            echo "<th>Product</th>";
            echo "<th>Price</th>";
            echo "<th>Description</th>";
            echo "<th>Category</th>";
            echo "<th>Actions</th>";
        echo "</tr>";
 
        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)){
 
            extract($row);
 
            echo "<tr>";
                echo "<td>{$name}</td>";
                echo "<td>{$price}</td>";
                echo "<td>{$description}</td>";
                echo "<td>";
                    $category->id = $category_id;
                    $category->readName();
                    echo $category->name;
                echo "</td>";
 
                echo "<td>";
 
                    // read product button
                    echo "<a href='read_one?id={$id}' class='btn btn-primary left-margin'>";
                        echo "<span class='glyphicon glyphicon-list'></span> Read";
                    echo "</a>";
 
                    // edit product button
                    echo "<a href='update_product?id={$id}' class='btn btn-info left-margin'>";
                        echo "<span class='glyphicon glyphicon-edit'></span> Edit";
                    echo "</a>";
 
                    // delete product button
                    echo "<a delete-id='{$id}' class='btn btn-danger delete-object'>";
                        echo "<span class='glyphicon glyphicon-remove'></span> Delete";
                    echo "</a>";
 
                echo "</td>";
 
            echo "</tr>";
 
        }
 
    echo "</table>";
 
    // paging buttons
    include_once '../product/paging.php';
    include_once "../layout_footer.php";
}
 
// tell the user there are no products
else{
    echo "<div class='alert alert-danger'>No products found.</div>";
}
?>