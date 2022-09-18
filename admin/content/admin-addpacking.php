<?php
// GET DATA 
$sql_selectpacking = "SELECT * FROM packing ORDER BY ID ASC";
$list_packing = executeResult($sql_selectpacking);


if (isset($_POST['add'])) {
    $errors = [];
    $namepacking = $_POST['addpacking'];

    $sql_checknamepacking = "SELECT * FROM packing WHERE type = '$namepacking'";
    $result = $conn->query($sql_checknamepacking);
    $row = mysqli_num_rows($result);

    if (empty(trim($namepacking))) {
        $errors['name'] = 'Name cannot empty !';
    }elseif ($row > 0 ){
        $errors['name'] = 'Duplicate type packing !';
    }

    if (empty($errors) && isset($_POST['add'])) {
        $sql_addpacking = "INSERT INTO packing(type) VALUES (N'$namepacking')";
        $conn->query($sql_addpacking);
        echo '
            <script>
                window.location="?admin=addpacking"
            </script>
        ';
        $success = 'true';
    }
}

?>
<title>Admin-Addpacking</title>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Add Packing</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <section class="content">
        <div class="container-fluid">
            <div style="width: 500px ; margin: auto ;">
                <?php
                if (isset($success)) {
                    echo '<div class="alert alert-success" role="alert">
                                Add success !
                            </div>';
                }
                ?>
                <form method="POST">
                    <div class="form-group">
                        <label>Name</label>
                        <input type="text" class="form-control" name="addpacking" value="<?php if(isset($_POST['addpacking'])){echo $_POST['addpacking'];} ?>">
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
                    <h1 class="m-0">List Packing</h1>
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
                foreach ($list_packing as $val_packing) {
                    echo '<tr>';
                    echo '<td>' . $val_packing['id'] . '</td>';
                    echo '<td>' . $val_packing['type'] . '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>