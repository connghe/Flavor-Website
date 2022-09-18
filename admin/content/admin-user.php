<title>Admin - User Managerment</title>
<div class="content-wrapper">
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">User</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <section class="content">
        <div class="content-fluid">
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Username</th>
                        <th>Name</th>
                        <th>Address</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Verify</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $sql_selectuser = "SELECT * FROM users";
                    $result_selectuser = executeResult($sql_selectuser);
                    foreach ($result_selectuser as $val_selectuser) :
                    ?>
                        <tr>
                            <td><?php echo $val_selectuser['id'] ?></td>
                            <td><?php echo $val_selectuser['username'] ?></td>
                            <td><?php echo $val_selectuser['firstname'].$val_selectuser['lastname'] ?></td>
                            <td><?php echo $val_selectuser['address'] ?></td>
                            <td><?php echo $val_selectuser['phone'] ?></td>
                            <td><?php echo $val_selectuser['email'] ?></td>
                            <td><?php if($val_selectuser['email_verified_at'] != NULL){echo '<i class="bi bi-check-circle text-success" style="font-size:20px"></i>' ;}else{echo '<i class="bi bi-x-circle text-danger" style="font-size:20px"></i>';} ?></td>
                        </tr>
                    <?php endforeach ?>
                </tbody>
            </table>
        </div>
    </section>
</div>