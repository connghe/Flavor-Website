<?php
if (isset($_GET['received'])) {
    $received_id = $_GET['received'];
    $sql_received = "UPDATE orders SET status ='received' WHERE id = '$received_id'";
    $conn->query($sql_received);
}
?>
<section style="display:flex; flex-direction:column; min-height: 85vh">
    <div class="container">
        <div class="mx-auto" style="width: 50% ;">
            <h1>Profile</h1>
            <div class="mb-3">
                <a href="?page=changepassword" class="btn btn-warning">Change password</a>
                <button class="btn btn-warning" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">My order</button>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">First Name</span>
                </div>
                <input type="text" class="form-control" value="<?php echo $result_user['firstname'] ?>" disabled>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Last Name</span>
                </div>
                <input type="text" class="form-control" value="<?php echo $result_user['lastname'] ?>" disabled>
            </div>
            <div class="input-group">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Email</span>
                </div>
                <input type="text" class="form-control" value="<?php echo $result_user['email'] ?>" disabled>
            </div>
            <div class=" mb-3">
                <?php
                if ($result_user['email_verified_at'] == null) {
                    $email_verify = $result_user['email'];
                    echo '<span class="text-danger">Unverified email !</span>';
                    echo '<br>';
                    echo '
                        <a class="btn btn-success" href="?page=success&email=' . $email_verify . '" >Verification now !</a>
                    ';
                }
                ?>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Phone</span>
                </div>
                <input type="text" class="form-control" value="<?php echo $result_user['phone'] ?>" disabled>
            </div>
            <div class="input-group mb-3">
                <div class="input-group-prepend">
                    <span class="input-group-text" id="basic-addon1">Address</span>
                </div>
                <input type="text" class="form-control" value="<?php echo $result_user['address'] ?>" disabled>
            </div>
        </div>

        <?php
        $sql_selectmyorder = "SELECT * FROM orders WHERE user_id = '$user_id'";
        $result_myorder = executeResult($sql_selectmyorder);
        ?>
        <div class="collapse" id="collapseExample">
            <div class="card card-body">
                <Span class="text-success mb-3">You have : <?php echo count($result_myorder) ?> Order</Span>
                <?php
                foreach ($result_myorder as $val_myorder) :
                    $detail_id = $val_myorder['id'];
                ?>
                    <div class="card">
                        <div class="ml-5 mt-2 mb-2 mr-5">
                            <div>
                                Order code : <span class="text-warning"><?php echo $val_myorder['id'] ?></span>
                            </div>
                            <div>
                                Total money : <span class="text-warning">$<?php echo $val_myorder['total_order'] ?></span>
                            </div>
                            <div>
                                Status : <span class="text-<?php if ($val_myorder['status'] == "received") {
                                                                echo 'success';
                                                            } else {
                                                                echo 'warning';
                                                            } ?>"><?php echo $val_myorder['status'] ?></span>
                            </div>
                            <div>
                                <?php
                                if ($val_myorder['status'] == "delivering") {
                                    echo '
                                            <a class="btn btn-success" href="?page=profile&received=' . $detail_id . '">I have received the merchandise</a>
                                        ';
                                }
                                ?>
                            </div>
                            <div>
                                Order detai :
                            </div>
                            <div class="row text-center">
                                <div class="col-md-3 text-info">
                                    Serial
                                </div>
                                <div class="col-md-3 text-info">
                                    Product
                                </div>
                                <div class="col-md-3 text-info">
                                    Quantity
                                </div>
                                <div class="col-md-3 text-info">
                                    Price
                                </div>
                            </div>
                            <?php

                            $sql_selectmyorderdetail = "SELECT products.products_image , orderdetail.quantity , orderdetail.price FROM orderdetail INNER JOIN products ON products.id = orderdetail.product_id WHERE order_id = '$detail_id'";
                            $result_myorderdetail = executeResult($sql_selectmyorderdetail);
                            foreach ($result_myorderdetail as $key => $val_myorderdetail) :
                            ?>
                                <div class="card">
                                    <div class="row text-center mt-2 mb-2">
                                        <div class="col-md-3">
                                            <br>
                                            <?php echo $key+1 ; ?>
                                        </div>
                                        <div class="col-md-3">
                                            <img src="images/<?php echo $val_myorderdetail['products_image'] ?>" style="width:5rem;height: 5rem;" alt="">
                                        </div>
                                        <div class="col-md-3">
                                            <br>
                                            <?php echo $val_myorderdetail['quantity'] ?>
                                        </div>
                                        <div class="col-md-3">
                                            <br>
                                            <?php echo $val_myorderdetail['price'] ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endforeach ?>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </div>
</section>