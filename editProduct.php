<?php 
include 'include/config.php'; //include file configuration to database
include_once 'classes/ClassProduct.php'; //include class Product
$cProduct = new ClassProduct($connect); 

if (isset($_POST['update'])) 
{
  $id       = $_GET['edit_id'];
  $pName    = $_POST['productName'];
  $pCat     = $_POST['productCategory'];
  $pStock   = $_POST['productStock'];
  $pPrice   = $_POST['productPrice'];
  $pDesc    = $_POST['productDesc'];

  $stmt_update =  $cProduct->update($id,$pName,$pCat,$pStock,$pPrice,$pDesc);

  if (!$stmt_update) 
  {
    $msg = "<div class='alert alert-danger'>
              <span>
                <strong>Sorry!!!</strong>
                  Failed to update data
              </span>
            </div>";
  }
  else
  {
    $msg = "<div class='alert alert-success'>
              <span>
                <strong>Success!!!</strong>
                  Data has been updated
              </span>
            </div>";
  }
}

if (isset($_GET['edit_id'])) 
{
  $id = $_GET['edit_id'];
  extract($cProduct->getId($id));
}

include_once 'header.php';
?>
  <body>
    <?php include_once 'navbar.php';?>
    <div class="container">
        <div class="page-header">
            <h1>Edit Products</h1>
        </div>

        <!--Alert-->
        <div class="col-md-12">
          <?php
            if (isset($_POST['update'])) 
            {
              echo $msg;
            }
          ?>
        </div>
        <!-- /.Alert-->
        
        <div class="row">
            <div class="col-md-12">
            	<form method="POST">
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="productName">
                        Product Name
                      </label>
                      <input type="text" class="form-control" name="productName" value="<?php echo $name;?>" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="productCategory">
                        Category
                      </label>
                      <select class="form-control" name="productCategory" required>
                        <option value="<?php echo $category;?>">
                          <?php echo $category;?>
                        </option>
                        <option value="Accessories">
                          Accessories
                        </option>
                        <option value="Handphone">
                          Handphone
                        </option>
                        <option value="Modem">
                          Modem
                        </option>
                        <option value="Phablet">
                          Phablet
                        </option>
                        <option value="Tablet">
                          Tablet
                        </option>
                        <option value="Wearable Device">
                          Wearable Device
                        </option>
                      </select>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="productStock">
                        Stock
                      </label>
                      <input type="number" class="form-control" name="productStock" value="<?php echo $stock;?>" required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="productPrice">
                        Price
                      </label>
                      <div class="input-group">
                        <div class="input-group-addon">
                          Rp
                        </div>
                          <input type="number" class="form-control" name="productPrice" value="<?php echo $price;?>" required>
                        <div class="input-group-addon">
                          .00
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label for="productDesc">
                        Description
                      </label>
                      <textarea class="form-control" rows="6" name="productDesc"><?php echo $description;?></textarea>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <input type="submit" class="btn btn-default" value="Update" name="update" onClick="return confirm('Sure to update this product?')">
                    </div>
                  </div>
                </form>
            </div>
        </div>
    </div>
  </body>
</html>