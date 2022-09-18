<?php
// GET DATA 
$sql_selectcategory = "SELECT * FROM category ORDER BY ID ASC";
$list_category = executeResult($sql_selectcategory);

if (isset($_POST['add'])) {
    $errors = [];
    $namecategory = $_POST['addcategory'];
    $sql_checknamecategory = "SELECT * FROM category WHERE name = '$namecategory'";
    $result = $conn->query($sql_checknamecategory);
    $row = mysqli_num_rows($result);

    if (empty(trim($namecategory))) {
        $errors['name'] = 'Name cannot empty !';
    }elseif($row > 0){
        $errors['name'] = 'Duplicate name category !';
    }

    if (empty($errors) && isset($_POST['add'])) {
        $sql_addcategory = "INSERT INTO category(name) VALUES (N'$namecategory')";
        $conn->query($sql_addcategory);
        echo '
            <script>
                window.location="?admin=addcategory&success=true"
            </script>
        ';
    }
}

?>
<title>Admin-Addcategory</title>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Add Category</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <div style="width: 500px ; margin: auto ;">
                <?php
                if (isset($_GET['success']) && $_GET['success'] == 'true') {
                    echo '<div class="alert alert-success" role="alert">
                                Add success !
                            </div>';
                }
                ?>
                <form method="POST">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="addcategory" value="<?php if(isset($_POST['addcategory'])){echo $_POST['addcategory'];} ?>">
                    </div>
                    <div class="mb-3">
                        <?php
                        if (isset($errors['name'])) {
                            echo '<span class="text-danger">' . $errors['name'] . '</span>';
                        }
                        ?>
                    </div>
                    <div>
                        <button class="btn btn-success" name="add">Add</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">List Category</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div style="width: 500px ; margin: auto ;">
        <table class="table text-center">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($list_category as $val_category) {
                    echo '<tr>';
                    echo '<td>' . $val_category['id'] . '</td>';
                    echo '<td>' . $val_category['name'] . '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>