<?php 
include 'include/config.php'; //include file configuration to database
include_once 'classes/ClassProduct.php'; //include class Product
$cProduct = new ClassProduct($connect); 

//Process insert data to database
if (isset($_POST['submit'])) 
{
  $pName      = $_POST['productName'];
  $pCategory  = $_POST['productCategory'];
  $pStock     = $_POST['productStock'];
  $pPrice     = $_POST['productPrice'];
  $pDescrip   = $_POST['productDesc'];

  $stmtInsert = $cProduct->insert($pName,$pCategory,$pStock,$pPrice,$pDescrip); //function for add data to database

  if (!$stmtInsert) 
  {
    $msg = "<div class='alert alert-danger'>
              <span>
                <strong>Sorry!!!</strong>
                  Failed to insert data
              </span>
            </div>";
  }
  else
  {
    $msg = "<div class='alert alert-success'>
              <span>
                <strong>Success!!!</strong>
                  Data has been inserted
              </span>
            </div>";
  }
}

include_once 'header.php';
?>
  <body>
    <?php include_once 'navbar.php';?>
    <div class="container">
        <div class="page-header">
            <h1>
              Add Products
            </h1>
        </div>

        <!--Alert-->
        <div class="col-md-12">
          <?php
            if (isset($_POST['submit'])) 
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
                      <input type="text" class="form-control" name="productName" placeholder="Type product name here...." required>
                    </div>
                  </div>
                  <div class="col-md-6">
                    <div class="form-group">
                      <label for="productCategory">
                        Category
                      </label>
                      <select class="form-control" name="productCategory" required>
                        <option value="">
                          -Select a category-
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
                      <input type="number" class="form-control" name="productStock" required>
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
                          <input type="number" class="form-control" name="productPrice" required>
                        <div class="input-group-addon">
                          .00
                        </div>
                      </div>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <label>
                        Product Description
                      </label>
                      <textarea class="form-control" rows="6" name="productDesc" required></textarea>
                    </div>
                  </div>
                  <div class="col-md-12">
                    <div class="form-group">
                      <input type="submit" class="btn btn-primary" value="Submit" name="submit">
                    </div>
                  </div>
                </form>
            </div>
        </div>
    </div>
  </body>
</html>