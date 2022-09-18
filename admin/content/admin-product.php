<?php
// $sql_selectproduct = "SELECT products.id, products.name, products.price, products.quantity, products.products_image, products.detail, products.update_date, packing.type, category.name AS catename 
//     FROM products 
//     JOIN category ON category.id = products.cateid 
//     JOIN packing ON packing.id = products.packingid;";
// $list_product = executeResult($sql_selectproduct);

//Get number of products
$sql_gettotal = "SELECT COUNT(id) as total FROM products";
$result = executeResult($sql_gettotal);
$total_records = $result[0]['total'];

//Limit products of each page and get current page
$current_page = isset($_GET['page']) ? $_GET['page'] : 1;
$limit = 4;

//Total pages
$total_page = ceil($total_records / $limit);

//Limit pages
if ($current_page > $total_page) {
    $current_page = $total_page;
} else if ($current_page < 1) {
    $current_page = 1;
}
//Display list
$start = ($current_page - 1) * $limit;
$result = "SELECT products.id, products.name, products.price, products.quantity, products.products_image, products.detail, products.sale, products.update_date, packing.type, category.name AS catename 
    FROM products 
    JOIN category ON category.id = products.cateid 
    JOIN packing ON packing.id = products.packingid
    ORDER BY products.id
    LIMIT $start, $limit;";
$list_product = executeResult($result);



if (isset($_POST['delete'])) {
    $id = $_POST['delete'];
    $sql_deleteproduct = "DELETE FROM products WHERE id = '$id'";
    $conn->query($sql_deleteproduct);
    echo '
            <script>
                window.location="?admin=product&success=deleteproduct";
            </script>
        ';
}
?>
<title>Admin-Product</title>

<!-- Content Wrapper. Contains page content -->
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">List Products</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid" style="display:flex; flex-direction:column; min-height: 80vh">
            <?php
            if (isset($_GET['success']) && $_GET['success'] == "editproduct") {
                echo '<div class="alert alert-success" role="alert">
                    Edit product success !
                </div>';
            } elseif (isset($_GET['success']) && $_GET['success'] == "addproduct") {
                echo '<div class="alert alert-success" role="alert">
                    Add product success !
                </div>';
            } elseif (isset($_GET['success']) && $_GET['success'] == "deleteproduct") {
                echo '<div class="alert alert-danger" role="alert">
                    Delete product success !
            </div>';
            }
            ?>
            <table class="table">
                <thead class="text-center">
                    <tr>
                        <th>ID</th>
                        <th>Image</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Packing</th>
                        <th>Category</th>
                        <th>Quantity</th>
                        <th>Date</th>
                        <th>Detail</th>
                        <th>Sale</th>
                        <th>Process</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($list_product as $val_product) {
                        echo '<tr>';
                        echo '<td>' . $val_product['id'] . '</td>';
                        echo '<td><img src="../images/' . $val_product['products_image'] . '" height="50px"></td>';
                        echo '<td>' . $val_product['name'] . '</td>';
                        echo '<td>' . $val_product['price'] . '</td>';
                        echo '<td>' . $val_product['type'] . '</td>';
                        echo '<td>' . $val_product['catename'] . '</td>';
                        echo '<td>' . $val_product['quantity'] . '</td>';
                        echo '<td>' . $val_product['update_date'] . '</td>';
                        echo '<td>' . $val_product['detail'] . '</td>';
                        echo '<td>' . $val_product['sale']. ' %</td>';
                        echo '<td>
                        <a href="?admin=editproduct&id=' . $val_product['id'] . '" class="btn btn-primary">Edit</a>
                        <button class="btn btn-danger" data-toggle="modal" data-target="#exampleModal' . $val_product['id'] . '">Delete</button>
                        <form method="POST">
                        <div class="modal fade" id="exampleModal' . $val_product['id'] . '" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Confirm delete PRODUCT</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <input type="text" value="' . $val_product['id'] . '" name="delete" class="d-none">
                                    Are you SURE ?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-danger">Sure</button>
                                </div>
                                </div>
                            </div>
                        </div>
                        </form>
                        </td>';
                    }
                    ?>
                </tbody>
            </table>
            <div class="mt-auto mb-2 d-flex justify-content-center">
                <?php
                //Page button
                echo '<div class="btn-toolbar" role="toolbar" aria-label="Toolbar with button groups">';
                echo '<div class="btn-group mr-2" role="group" aria-label="First group">';
                if ($current_page > 1 && $total_page > 1) {
                    echo '<a type="button" class="btn btn-secondary" href="?admin=product&page=' . ($current_page - 1) . '">Prev</a>';
                }
                echo '</div>';
                echo '<div class="btn-group mr-2" role="group" aria-label="Second group">';
                for ($i = 1; $i <= $total_page; $i++) {
                    if ($i == $current_page) {
                        echo '<button class="btn btn-secondary active">' . $i . '</button>';
                    } else {
                        echo '<a type="button" class="btn btn-secondary" href="?admin=product&page=' . $i . '">' . $i . '</a>';
                    }
                }
                echo '</div>';
                echo '<div class="btn-group" role="group" aria-label="Third group">';
                if ($current_page < $total_page && $total_page > 1) {
                    echo '<a type="button" class="btn btn-secondary" href="?admin=product&page=' . ($current_page + 1) . '">Next</a>';
                }
                echo '</div>';
                echo '</div>';
                ?>
            </div>
        </div>
        <!-- /.container-fluid -->
    </section>
    <!-- /.content -->
</div>
<!-- /.content-wrapper -->