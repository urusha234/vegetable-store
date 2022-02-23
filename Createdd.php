<?php


    
    // get product from the database
    function getData(){
        include'db_conn.php';
        $sql = "SELECT * FROM images";

        $result = mysqli_query($conn, $sql);

        if(mysqli_num_rows($result) > 0){
            return $result;
        }
    }
