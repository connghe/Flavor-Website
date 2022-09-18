<?php
// GET DATA 
$sql_selectcategory = "SELECT * FROM category";
$sql_selectpacking = "SELECT * FROM packing";

$list_category = executeResult($sql_selectcategory);
$list_packing = executeResult($sql_selectpacking);

// ADD PRODUCT
if (isset($_POST['add'])) {
    $errors = [];

    $name = $_POST['addname'];
    $price = $_POST['addprice'];
    $quantity = $_POST['addquantity'];
    $category = $_POST['addcategory'];
    $packing = $_POST['addpacking'];
    $detail = $_POST['adddetail'];
    $sale = $_POST['sale'];
    // PROCESS IMG
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
                } else {
                    $errors['file'] = 'Your file is too big !';
                }
            } else {
                $errors['file'] = 'There was an error uploading your file !';
            }
        } else {
            $errors['file'] = 'You cannot upload file of this type !';
        }
    } else {
        $errors['file'] = 'File cannot empty !';
    }

    //PROCESS DATA
    $sql_checknameproduct = "SELECT * FROM products WHERE name = '$name'";
    $result = $conn->query($sql_checknameproduct);
    $row = mysqli_num_rows($result);
    if ($row > 0) {
        $errors['name'] = "Duplicate product name !";
    } elseif (empty(trim($name))) {
        $errors['name'] = 'Name cannot empty !';
    } elseif (strlen(trim($name)) < 3) {
        $errors['name'] = 'Name is too short !';
    }

    if (empty(trim($price))) {
        $errors['price'] = 'Price cannot empty !';
    } elseif ($price < 1) {
        $errors['price'] = 'Pls re-check Price !';
    }

    if (empty(trim($quantity))) {
        $errors['quantity'] = 'Quantity cannot empty !';
    } elseif ($quantity < 1) {
        $errors['quantity'] = 'Pls re-check Quantity !';
    }

    if (empty(trim($detail))) {
        $errors['detail'] = 'Detail cannot empty !';
    }

    if (empty($errors)) {
        $sql_addproduct = "INSERT INTO products(name , price , quantity , cateid , packingid , products_image , detail, sale) VALUES(N'$name' , '$price' , '$quantity' , '$category' , '$packing' , '$file_namenew' , N'$detail', '$sale')";
        $conn->query($sql_addproduct);
        echo '
            <script>
                window.location="?admin=product&success=addproduct"
            </script>
        ';
    }
}

?>
<title>Admin-Addproduct</title>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Add Products</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <div style="width: 40% ;margin: auto;">
                <form method="POST" enctype="multipart/form-data">
                    <div>
                        <label>Name</label>
                        <input type="text" class="form-control" name="addname" value="<?php if (isset($_POST['addname'])) {
                                                                                            echo $_POST['addname'];
                                                                                        } ?>">
                    </div>
                    <div class="mb-3">
                        <?php if (isset($errors['name'])) {
                            echo '<span class="text-danger">' . $errors['name'] . '</span>';
                        } ?>
                    </div>
                    <div>
                        <label>Price</label>
                        <input type="number" class="form-control" name="addprice" value="<?php if (isset($_POST['addprice'])) {
                                                                                                echo $_POST['addprice'];
                                                                                            } ?>">
                    </div>
                    <div class="mb-3">
                        <?php if (isset($errors['price'])) {
                            echo '<span class="text-danger">' . $errors['price'] . '</span>';
                        } ?>
                    </div>
                    <div>
                        <label>Quantity</label>
                        <input type="number" class="form-control" name="addquantity" value="<?php if (isset($_POST['addquantity'])) {
                                                                                                echo $_POST['addquantity'];
                                                                                            } ?>">
                    </div>
                    <div class="mb-3">
                        <?php if (isset($errors['quantity'])) {
                            echo '<span class="text-danger">' . $errors['quantity'] . '</span>';
                        } ?>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label>Category</label>
                            <select class="custom-select" name="addcategory">
                                <?php
                                foreach ($list_category as $val_category) {
                                    echo '<option value="' . $val_category['id'] . '">' . $val_category['name'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Packing</label>
                            <select class="custom-select" name="addpacking">
                                <?php
                                foreach ($list_packing as $val_packing) {
                                    echo '<option value="' . $val_packing['id'] . '">' . $val_packing['type'] . '</option>';
                                }
                                ?>
                            </select>
                        </div>
                        <div class="form-group col-md-4">
                            <label>Sale (%)</label>
                            <input  type="number" class="form-control" name="sale" min="0" value="0">
                        </div>
                    </div>
                    <div>
                        <label>Image</label>
                        <br>
                        <input type="file" name="file">
                    </div>
                    <div class="mb-3">
                        <?php if (isset($errors['file'])) {
                            echo '<span class="text-danger">' . $errors['file'] . '</span>';
                        } ?>
                    </div>
                    <div>
                        <label>Detail</label>
                        <textarea name="adddetail" class="form-control" cols="30" rows="10" value="<?php if (isset($_POST['adddetail'])) {
                                                                                                        echo $_POST['adddetail'];
                                                                                                    } ?>"></textarea>
                    </div>
                    <div class="mb-3">
                        <?php if (isset($errors['detail'])) {
                            echo '<span class="text-danger">' . $errors['detail'] . '</span>';
                        } ?>
                    </div>
                    <div>
                        <button class="btn btn-success" name="add">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
</div>