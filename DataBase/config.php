<?php 
    define('DB_SERVER' , 'localhost' );
    define('DB_USERNAME' , 'root' );
    define('DB_PASSWORD' , '' );
    define('DB_NAME' , 'flavordtb' );

    // CHECK CONNECTION

    $conn = mysqli_connect(DB_SERVER , DB_USERNAME , DB_PASSWORD , DB_NAME);

    if($conn === false) {
        die("ERROR: Could not connect" . mysqli_connect_error());
    }

    function executeResult($sql){
        $conn = mysqli_connect(DB_SERVER , DB_USERNAME , DB_PASSWORD , DB_NAME);
        $resultset = mysqli_query($conn, $sql);
        $list = [];
        while ($row = mysqli_fetch_array($resultset, 1)) {
            $list[] = $row;
        }
        mysqli_close($conn);
        return $list;
    }

?>