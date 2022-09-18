<title>Admin - Order Management</title>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">List orders</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="container-fluid">
            <div class="card text-center">
                <?php
                $sql_selectorder = "SELECT * FROM orders ";
                $result_selectorder = executeResult($sql_selectorder);
                foreach ($result_selectorder as $id => $val_selectorder) :
                ?>
                    <div class="card mt-3 ml-3 mr-3">
                        <div class="row">
                            <div class="col-md-1">
                                <div class="text-warning">
                                    Serial
                                </div>
                                <?php echo $id + 1 ?>
                                <div class="mt-2">
                                    <button class="btn btn-warning" data-toggle="modal" data-target="#exampleModal<?php echo $val_selectorder['id'] ?>">Detail</button>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="text-warning">
                                    Infomation
                                </div>
                                <div>
                                    Order ID :<?php echo $val_selectorder['id'] ?>
                                </div>
                                <div>
                                    Name : <?php echo $val_selectorder['rec_name'] ?>
                                </div>
                                <div>
                                    Phone : <?php echo $val_selectorder['rec_phone'] ?>
                                </div>
                                <div>
                                    Address : <?php echo $val_selectorder['rec_address'] ?>
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="text-warning">
                                    Date
                                </div>
                                <?php echo $val_selectorder['date'] ?>
                            </div>
                            <div class="col-md-2">
                                <div class="text-warning">
                                    Total money
                                </div>
                                <?php echo $val_selectorder['total_order'] ?>
                            </div>
                            <div class="col-md-3">
                                <div class="text-warning">
                                    Status
                                </div>
                                <?php echo $val_selectorder['status'] ?>
                            </div>
                        </div>
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="exampleModal<?php echo $val_selectorder['id'] ?>" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Order detail</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <div class="row text-warning">
                                        <div class="col-md-1">

                                        </div>
                                        <div class="col-md-5">
                                            Product
                                        </div>
                                        <div class="col-md-3">
                                            Quantity
                                        </div>
                                        <div class="col-md-3">
                                            Price
                                        </div>
                                    </div>
                                    <?php
                                    $orderdetail_id = $val_selectorder['id'];
                                    $sql_selectorderdetail = "SELECT products.products_image , orderdetail.quantity , orderdetail.price FROM orderdetail JOIN products ON products.id = orderdetail.product_id WHERE order_id = '$orderdetail_id'";
                                    $result_selectorderdetail = executeResult($sql_selectorderdetail);
                                    foreach ($result_selectorderdetail as $id => $val_selectorderdetail) :
                                    ?>
                                        <div class="row mb-3">
                                            <div class="col-md-1">
                                                <?php echo $id + 1 ?>
                                            </div>
                                            <div class="col-md-5">
                                                <img src="../images/<?php echo $val_selectorderdetail['products_image'] ?>" alt="" style="width: 50px ;height: 50px ;">
                                            </div>
                                            <div class="col-md-3">
                                                <?php echo $val_selectorderdetail['quantity'] ?>
                                            </div>
                                            <div class="col-md-3">
                                                <?php echo $val_selectorderdetail['price'] ?>
                                            </div>
                                        </div>
                                    <?php endforeach ?>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach ?>
            </div>
        </div>
    </section>
</div>