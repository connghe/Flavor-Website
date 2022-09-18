<?php
// GET DATA 
$sql_selectcontactmess = "SELECT * FROM contactus ORDER BY ID ASC";
$list_contactmess = executeResult($sql_selectcontactmess);
?>
<title>Contact List</title>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Contact message list</h1>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->
    <div style="margin: auto ;">
        <table class="table text-center">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Title</th>
                    <th>Message</th>
                    <th>Time</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($list_contactmess as $val_contactmess) {
                    echo '<tr>';
                    echo '<td>' . $val_contactmess['id'] . '</td>';
                    echo '<td>' . $val_contactmess['name'] . '</td>';
                    echo '<td>' . $val_contactmess['phone'] . '</td>';
                    echo '<td>' . $val_contactmess['email'] . '</td>';
                    echo '<td>' . $val_contactmess['title'] . '</td>';
                    echo '<td>' . $val_contactmess['message'] . '</td>';
                    echo '<td>' . $val_contactmess['date'] . '</td>';
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>
</div>