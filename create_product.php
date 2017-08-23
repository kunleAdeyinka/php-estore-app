<?php
      // include database and object files
      include_once 'config/database.php';
      include_once 'objects/product.php';
      include_once 'objects/category.php';

      //get a database connection
      $database = new Database();
      $db = $database->getConnection();

      //pass connection to objects
      $product = new Product($db);
      $category = new Category($db);

      // set page headers
      $page_title = "Create Product";
      include_once "header.php";

      echo "<div class='right-button-margin'>";
          echo "<a href='index.php' class='btn btn-default pull-right'>Read Products</a>";
      echo "</div>";
      // if the form was submitted
      if($_POST){
        //set product property values
        $product->name = $_POST['name'];
        $product->price = $_POST['price'];
        $product->description = $_POST['description'];
        $product->category_id = $_POST['category_id'];

        //create the product
        if($product->create()){
          echo "<div class='alert alert-success'>Product was created.</div>";
        }else{
          echo "<div class='alert alert-danger'>Unable to create product.</div>";
        }
      }

      echo "<form action='' method='post'>";
                    echo "<table class='table table-hover table-responsive table-bordered'>";
                            echo "<tr><td>Name</td><td><input type='text' name='name' class='form-control' /></td></tr>";
                            echo "<tr><td>Price</td><td><input type='text' name='price' class='form-control' /></td></tr>";
                            echo "<tr><td>Description</td><td><textarea name='description' class='form-control'></textarea></td></tr>";
                            echo "<tr><td>Category</td><td><!-- categories from database will be here --></td></tr>";
                            echo "<tr><td></td><td><button type='submit' class='btn btn-primary'>Create</button></td></tr>";
                    echo "</table>";
      echo "</form>";

      include_once "footer.php";
?>
