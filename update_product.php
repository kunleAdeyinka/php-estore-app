<?php
    // get ID of the product to be edited
    $id = isset($_GET['id']) ? $_GET['id'] : die('ERROR: missing ID.');

    // include database and object files
    include_once 'config/database.php';
    include_once 'objects/product.php';
    include_once 'objects/category.php';

    // get database connection
    $database = new Database();
    $db = $database->getConnection();

    // prepare objects
    $product = new Product($db);
    $category = new Category($db);

    // set ID property of product to be edited
    $product->id = $id;

    // read the details of product to be edited
    $product->readOne();

    //set page header
    $page_title = "Update Product";
    include_once "header.php";

    echo "<div class='right-button-margin'>";
      echo "<a href='index.php' class='btn btn-default pull-right'>Read Products</a>";
    echo "</div>";

    // if the form was submitted
    if($_POST){

        // set product property values
        $product->name = $_POST['name'];
        $product->price = $_POST['price'];
        $product->description = $_POST['description'];
        $product->category_id = $_POST['category_id'];

        // update the product
        if($product->update()){
            echo "<div class='alert alert-success alert-dismissable'>";
                echo "Product was updated.";
            echo "</div>";
        }

        // if unable to update the product, tell the user
        else{
            echo "<div class='alert alert-danger alert-dismissable'>";
                echo "Unable to update product.";
            echo "</div>";
        }
    }

    echo "<form action='' method='post'>";
                  echo "<table class='table table-hover table-responsive table-bordered'>";
                          echo "<tr><td>Name</td><td><input type='text' name='name' value='' class='form-control' /></td></tr>";
                          echo "<tr><td>Price</td><td><input type='text' name='price' value='' class='form-control' /></td></tr>";
                          echo "<tr><td>Description</td><td><textarea name='description' class='form-control'>'$product->description'</textarea></td></tr>";
                          echo "<tr><td>Category</td><td><!-- categories from database will be here --></td></tr>";
                          echo "<tr><td></td><td><button type='submit' class='btn btn-primary'>Create</button></td></tr>";
                  echo "</table>";
    echo "</form>";



    //set the page footer
    include_once "footer.php";
?>
