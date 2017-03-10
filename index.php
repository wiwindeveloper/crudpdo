<?php
include 'include/config.php'; //include file configuration to database
include_once 'classes/ClassProduct.php'; //include class Product
$cProduct = new ClassProduct($connect); 

//number format
$decimal_number         = "2";
$decimal_separator      = ",";
$thousands_separator    = ".";

/*
* Delete process
*/
if (isset($_GET['delete_id'])) 
{
    $id = $_GET['delete_id'];

    $stmt_destroy = $cProduct->destroy($id);

    if (!$stmt_destroy) 
    {
        $msg = "<div class='alert alert-danger'>
                  <span>
                    <strong>Sorry!!!</strong>
                      Failed to delete data
                  </span>
                </div>";
    }
    else
    {
        $msg = "<div class='alert alert-success'>
                  <span>
                    <strong>Success!!!</strong>
                      Data has been deleted
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
            <h1>Data Products</h1>
        </div>

        <!--Alert-->
        <div class="col-md-12">
          <?php
            if (isset($msg)) 
            {
              echo $msg;
            }
          ?>
        </div>
        <!-- /.Alert-->

        <div class="row">
            <div class="col-md-12">
                <a type="button" class="btn btn-primary" href="addProduct.php">
                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                    Add
                </a>
            </div>
            <div class="col-md-12">
                <table class="table">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Stock</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                        $stmt = $cProduct->index();

                        $no = 0;

                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) 
                        {
                            $no++;
                            $row['description'];
                        ?>
                            <tr>
                                <td><?php echo $no;?></td>
                                <td><?php echo $row['name'];?></td>
                                <td><?php echo $row['category'];?></td>
                                <td><?php echo $row['stock'];?></td>
                                <td><?php echo "Rp ".(number_format($row['price'],$decimal_number, $decimal_separator, $thousands_separator));?></td>
                                <td>
                                    <a href ="editProduct.php?edit_id=<?php echo $row['id'];?>" type="button" class="btn btn-sm btn-info">
                                        <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span>
                                         Edit
                                    </a>
                                    <a href="?delete_id=<?php echo $row['id'];?>" type="button" class="btn btn-sm btn-danger" onClick="return confirm('Sure to delete this data?')">
                                        <span class="glyphicon glyphicon-trash" aria-hidden="true"></span>
                                        Delete
                                    </a>
                                </td>
                            </tr>
                        <?php    
                        }
                    ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
  </body>
</html>