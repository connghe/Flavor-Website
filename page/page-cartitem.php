<?php
if (isset($_SESSION['cart']) && count($_SESSION['cart']) <= 0) {
    unset($_SESSION['cart']);
}
if (isset($_GET['del'])) {
    $del_name = $_GET['del']; 
    array_splice($_SESSION['cart'] ,$del_name,1);
    echo '
                    <script>
                        $(document).ready(function(){
                            window.location="?page=cartitem";
                        })
                    </script>
                ';
}

if (isset($_GET['up'])) {
    $up_name = $_GET['up'];
    for ($i = 0; $i < count($_SESSION['cart']); $i++) {
        if ($_SESSION['cart'][$i][1] == $up_name) {
            $up = 1;
            $newquantity = $_SESSION['cart'][$i][2] + $up;
            $_SESSION['cart'][$i][2] = $newquantity;
            echo '
                    <script>
                        $(document).ready(function(){
                            window.location="?page=cartitem";
                        })
                    </script>
                ';
        }
    }
}
if (isset($_GET['down'])) {
    $down_name = $_GET['down'];
    for ($i = 0; $i < count($_SESSION['cart']); $i++) {
        if ($_SESSION['cart'][$i][1] == $down_name && $_SESSION['cart'][$i][2] > 1) {
            $down = 1;
            $newquantity = $_SESSION['cart'][$i][2] - $down;
            $_SESSION['cart'][$i][2] = $newquantity;
            echo '
                    <script>
                        $(document).ready(function(){
                            window.location="?page=cartitem";
                        })
                    </script>
                ';
        } else {
            echo '
                    <script>
                        $(document).ready(function(){
                            window.location="?page=cartitem";
                        })
                    </script>
                ';
        }
    }
}
if (isset($_POST['proceedorder'])) {

    if (!isset($_SESSION['login'])) {
        exit('
            <div class="container">
                <h1 class="text-danger mb-3">You need login before Order</h1>
                <a class="btn btn-warning" href="?page=login">Login</a>
            </div>
        ');
    }

    $errors = [];

    $ordername = $_POST['ordername'];
    $orderphone = $_POST['orderphone'];
    $orderaddress = $_POST['orderaddress'];
    $ordertotal = $_POST['ordertotal'];
    $date = date("Ymd");
    $time = time();
    $orderid = $date . $time . $user_id;

    if (empty(trim($ordername))) {
        $errors['ordername'] = "Name cannot empty !";
    } elseif (strlen(trim($ordername)) < 3) {
        $errors['ordername'] = "Name is too short !";
    }

    if (empty(trim($orderphone))) {
        $errors['orderphone'] = "Phone cannot empty !";
    } elseif (strlen(trim($orderphone)) < 9) {
        $errors['orderphone'] = "Phone is too short !";
    }

    if (empty(trim($orderaddress))) {
        $errors['orderaddress'] = "Phone cannot empty !";
    }

    if (empty($errors)) {
        $sql_insertorder = "INSERT INTO orders(id , rec_name , rec_address , rec_phone , total_order , user_id) VALUES ('$orderid' , N'$ordername' , N'$orderaddress' , '$orderphone' , '$ordertotal' , '$user_id')";
        $conn->query($sql_insertorder);

        for ($i = 0; $i < count($_SESSION['cart']); $i++) {
            $orderdetail_productid = $_SESSION['cart'][$i][4];
            $orderdetail_quantity = $_SESSION['cart'][$i][2];
            $orderdetail_price = $_SESSION['cart'][$i][3];
            $sql_insertorderdetail = "INSERT INTO orderdetail(product_id , order_id , quantity , price) VALUES('$orderdetail_productid' , '$orderid' , '$orderdetail_quantity' , '$orderdetail_price')";
            $conn->query($sql_insertorderdetail);
            $sql_downquantity = "UPDATE products SET quantity = quantity - '$orderdetail_quantity' WHERE id = '$orderdetail_productid'";
            $conn->query($sql_downquantity);
        }

        unset($_SESSION['cart']);
        exit('
            <div class="container">
                <h1 class="text-success">Order Success</h1>
                <a href="?page=product" class="btn_product mr-2" >Shop now</a>
            </div>
        ');
    }
}
?>
<section style="display:flex; flex-direction:column; min-height: 85vh;">
    <div class="mt-5" style="margin:2rem;">
        <div class="row">
            <div class="col-md-7">
                <?php
                if (!isset($_SESSION['cart'])) {
                    exit('
                        <div class="container">
                            <h1 class="mb-3">Empty item in cart</h1>
                            <a href="?page=product" class="btn_product mr-2" >Shop now</a>
                        </div>
                    ');
                } else
                    foreach ($_SESSION['cart'] as $key=>$val_cartitem) :

                ?>
                    <div class="card text-center">
                        <div class="row ml-1 mt-1 mr-1 mb-1">
                            <div class="col-md-3">
                                <img src="images/<?php echo $val_cartitem[0] ?>" alt="" style="width: 5rem ;height: 5rem;">
                            </div>
                            <div class="col-md-5">
                                <span class="text-success">Product</span>
                                <div>
                                    <?php echo $val_cartitem[1] ?>
                                </div>
                                <div>
                                    <?php echo '$' . $val_cartitem[3] ?>
                                </div>
                            </div>
                            <div class="col-md-2">
                                <span class="text-success">Quantity</span>
                                <div>
                                    <a href="?page=cartitem&down=<?php echo $val_cartitem[1] ?>"><i class="bi bi-dash"></i></a>
                                    <?php echo $val_cartitem[2] ?>
                                    <a href="?page=cartitem&up=<?php echo $val_cartitem[1] ?>"><i class="bi bi-plus"></i></a>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <span class="text-success ">Total</span>
                                <div class="total">
                                    <?php echo $val_cartitem[2] * $val_cartitem[3] ?>
                                </div>
                            </div>
                            <div class="col-md-1">
                                <span class="text-success">Delete</span>
                                <div>
                                    <a href="?page=cartitem&del=<?php echo $key ?>"><i class="bi bi-trash3 text-danger"></i></a>
                                </div>
                            </div>
                        </div>
                    </div>

                <?php endforeach ?>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <h4 class="text-center text-warning mt-3 mb-3">Shipment Details</h4>
                    <form method="post" class="mr-5 ml-5">
                        <div>
                            <label>Your name</label>
                            <input type="text" class="form-control" name="ordername">
                        </div>
                        <div class="mb-3">
                            <?php
                            if (isset($errors['ordername'])) {
                                echo '
                                <span class="text-danger">' . $errors['ordername'] . '</span>
                            ';
                            }
                            ?>
                        </div>
                        <div>
                            <label>Phone</label>
                            <input type="number" class="form-control" name="orderphone">
                        </div>
                        <div class="mb-3">
                            <?php
                            if (isset($errors['orderphone'])) {
                                echo '
                                <span class="text-danger">' . $errors['orderphone'] . '</span>
                            ';
                            }
                            ?>
                        </div>
                        <div>
                            <label>Address</label>
                            <input type="text" class="form-control" name="orderaddress">
                        </div>
                        <div class="mb-3">
                            <?php
                            if (isset($errors['orderaddress'])) {
                                echo '
                                <span class="text-danger">' . $errors['orderaddress'] . '</span>
                            ';
                            }
                            ?>
                        </div>
                        <div class="mb-3">
                            <span class="font-weight-bold">Order details :</span>
                            <div>
                                Total products : <span class="text-warning "><?php if (isset($_SESSION['cart'])) {
                                                                                    echo count($_SESSION['cart']);
                                                                                } ?></span>
                            </div>
                            <div>
                                Total money :
                                <span class="text-warning total">
                                    <?php
                                    if (isset($_SESSION['cart'])) {
                                        $totalmoney = 0;
                                        for ($i = 0; $i < count($_SESSION['cart']); $i++) {
                                            $totalmoney = $totalmoney + ($_SESSION['cart'][$i][3] * $_SESSION['cart'][$i][2]);
                                        }
                                        echo $totalmoney;
                                    }
                                    ?>
                                </span>
                                <input type="hidden" name="ordertotal" value="<?php echo $totalmoney;  ?>">
                            </div>
                        </div>
                        <div class="mb-3 text-center">
                            <a href="?page=product" class="btn btn-success">Continue shopping</a>
                            <button class="btn btn-warning" name="proceedorder">Proceed to order</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>