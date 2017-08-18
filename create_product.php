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
      <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>" method="post">
        <table class='table table-hover table-responsive table-bordered'>
              <tr>
                  <td>Name</td>
                  <td><input type='text' name='name' class='form-control' /></td>
              </tr>

              <tr>
                  <td>Price</td>
                  <td><input type='text' name='price' class='form-control' /></td>
              </tr>

              <tr>
                  <td>Description</td>
                  <td><textarea name='description' class='form-control'></textarea></td>
              </tr>

              <tr>
                  <td>Category</td>
                  <td>
                  <!-- categories from database will be here -->
                  <?php
                      $stmt = $category->read();

                      // put each category as an item in a drop down list
                      echo "<select class='form-control' name='category_id'>";
                           echo "<option>Select category...</option>";

                           while ($row_category = $stmt->fetch(PDO::FETCH_ASSOC)) {
                             extract($row_category);
                             echo "<option value='{$id}'>{$name}</option>";
                           }

                     echo "</select>";
                  ?>
                  </td>
              </tr>

              <tr>
                  <td></td>
                  <td>
                      <button type="submit" class="btn btn-primary">Create</button>
                  </td>
              </tr>
        </table>
      </form>


      // footer
      include_once "footer.php";
?>