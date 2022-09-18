<?php
if (!isset($_GET['id'])) {
    echo '
            <script>
                window.location="?admin=product"
            </script>
        ';
    exit;
}

// GET DATA 
$sql_selectcategory = "SELECT * FROM category";
$sql_selectpacking = "SELECT * FROM packing";

$list_category = executeResult($sql_selectcategory);
$list_packing = executeResult($sql_selectpacking);

$id = $_GET['id'];
$sql_selectproduct = "SELECT * FROM products WHERE id = '$id'";

$product = executeResult($sql_selectproduct);
foreach ($product as $val_product) {
    $name_product = $val_product['name'];
    $price_product = $val_product['price'];
    $quantity_product = $val_product['quantity'];
    $category_product = $val_product['cateid'];
    $packing_product = $val_product['packingid'];
    $img_product = $val_product['products_image'];
    $detail_product = $val_product['detail'];
    $sale_product = $val_product['sale'];
}
// END GET DATA

// POST DATA
$errors = [];
if (isset($_POST['save'])) {
    $name = $_POST['editname'];
    $price = $_POST['editprice'];
    $quantity = $_POST['editquantity'];
    $category = $_POST['editcategory'];
    $packing = $_POST['editpacking'];
    $detail = $_POST['editdetail'];
    $sale = $_POST['editsale'];
    // PROCESS IMAGE
    if (!empty($_FILES['file']['name'])) {
        $file = $_FILES['file'];
        $file_name = $_FILES['file']['name'];
        $file_tmpname = $_FILES['file']['tmp_name'];
        $file_size = $_FILES['file']['size'];
        $file_error = $_FILES['file']['error'];
        $file_type = $_FILES['file']['type'];

        $file_ext = explode('.', $file_name);
        $file_actuaext = strtolower(end($file_ext));

        $allowed = array('jpg', 'jpeg', 'png', 'pdf');

        if (in_array($file_actuaext, $allowed)) {
            if ($file_error === 0) {
                if ($file_size < 1000000) {
                    $file_namenew = uniqid('', true) . "." . $file_actuaext;
                    $file_destination = '../images/' . $file_namenew;
                    move_uploaded_file($file_tmpname, $file_destination);
                    $path = '../images/' . $img_product;
                    unlink($path);
                } else {
                    $errors['file'] = 'Your file is too big';
                }
            } else {
                $errors['file'] = 'There was an error uploading your file';
            }
        } else {
            $errors['file'] = 'You cannot upload file of this type';
        }
    } else {
        $file_namenew = $img_product;
        $file_error = 0;
    }
    //END PROCESS IMAGE
    if (empty($name)) {
        $errors['name'] = 'Name cannot empty !';
    } elseif (strlen(trim($name)) < 3) {
        $errors['name'] = 'Name is too short !';
    }

    if (empty($price)) {
        $errors['price'] = 'Price cannot empty !';
    }

    if (empty($quantity)) {
        $errors['quantity'] = 'Quantity cannot empty !';
    }

    if (empty($detail)) {
        $errors['detail'] = 'Detail cannot empty !';
    }

    // POST DATA -> DATABASE
    if (empty($errors) && $file_error === 0) {
        $update = "UPDATE products SET name = '$name', price ='$price', quantity = '$quantity', cateid = '$category', packingid ='$packing', products_image ='$file_namenew', detail ='$detail', sale = '$sale' WHERE id = $id";
        $conn->query($update);
        echo '
            <script>
                window.location="?admin=product&success=editproduct";
            </script>
        ';
    }
}
// END POST DATA
?>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Edit Products</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div style="width: 40% ;margin: auto;">
                <form method="POST" enctype="multipart/form-data">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="editname" value="<?php echo $name_product; ?>">
                    </div>
                    <div class="form-group">
                        <label>Price</label>
                        <input type="number" class="form-control" name="editprice" value="<?php echo $price_product; ?>">
                    </div>
                    <div class="form-group">
                        <label>Quantity</label>
                        <input type="number" class="form-control" name="editquantity" value="<?php echo $quantity_product; ?>">
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Category</label>
                            <select class="custom-select" name="editcategory">
                                <?php
                                foreach ($list_category as $val_category) {
                                    if ($val_category['id'] == $category_product) {
                                        echo '<option value="' . $val_category['id'] . '" selected>' . $val_category['name'] . '</option>';
                                    } else {
                                        echo '<option value="' . $val_category['id'] . '">' . $val_category['name'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Packing</label>
                            <select class="custom-select" name="editpacking">
                                <?php
                                foreach ($list_packing as $val_packing) {
                                    if ($val_packing['id'] == $packing_product) {
                                        echo '<option value="' . $val_packing['id'] . '" selected>' . $val_packing['type'] . '</option>';
                                    } else {
                                        echo '<option value="' . $val_packing['id'] . '">' . $val_packing['type'] . '</option>';
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Sale (%)</label>
                            <input type="number" class="form-control" name="editsale" min="0" value="<?php echo $sale_product; ?>">
                        </div>
                    </div>
                    <div>
                        <label>Image</label>
                        <br>
                        <div class="mb-6">
                            <img src="../images/<?php echo $img_product ?>" style="width: 20.5rem;height: 20.5rem;">
                        </div>
                        <br>
                        <input type="file" name="file">
                    </div>
                    <div class="mb-3">
                        <?php
                        if (isset($errors['file'])) {
                            echo '<span class="text-danger">' . $errors['file'] . '</span>';
                        }
                        ?>
                    </div>
                    <div>
                        <label>Detail</label>
                        <textarea name="editdetail" cols="70" rows="10"><?php echo $detail_product; ?></textarea>
                    </div>
                    <div>
                        <button class="btn btn-success" name="save">Save</button>
                    </div>
                </form>
            </div>
        </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->