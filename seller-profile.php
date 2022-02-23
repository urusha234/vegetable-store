<?php //this pg is product.php
//include 'uploaded.php';
//isAdmin();

//this condition makes seller see their products only
//$condition = '';
//$condition1 = '';
//if($_SESSION['s_role'] == 1){
    //$condition = " and images.added_by='".$_SESSION['s_id']."'";
    //$condition1 = " and images.added_by='".$_SESSION['s_id']."'";
//}
session_start();

if(!isset($_SESSION["s_username"])){
    
    header("location:login-s.php");
}
?>

<?php include "db_conn.php"; ?> 

<!DOCTYPE html>
<html lang="en">

<head>
    <title>seller-profile</title>
       
    <link rel="stylesheet" type="text/css" href="sel.css">
    <script src="https://kit.fontawesome.com/7dd0b8b9ba.js" crossorigin="anonymous"></script>
    
            </head>
 
<body> 
 <header class="bg">
        
        <div class="row">


            <div class="logo">
                
            </div>
    
            <div class="menu-icon">
                        <ul class="main-nav">
            

            <li><a href="shop.php"><b>SHOP</b></a></li>
            <li><a href="view_order.php"><b>ORDERS</b></a></li>
            <li><a href="logout.php"><b>LOGOUT</b></a></li>

            <!--?php if($_SESSION['s_role']!=1){
                yo part admin le matra chalauna paucha    
           }?>-->

            </ul>   
         
            </div>
        </div>

        <div class="container">

             <div class="upfoto">
                <h1><?php echo "Welcome " . $_SESSION['s_username']; ?></h1>
                 <h2>Seller-profile</h2>
                    <div class= "bbb">
                        <ul class = "edit/update">
                            <li><a href="add-product.php">Upload your product</a></li>
                            <!--<li>
                                <form action="uploaded.php" method="post">
                                <button type="submit" name="delete_mulitple_data" class="btn">Delete muliple products</button></li>-->
                        </ul>             
                    </div>
                        
                        <h2 class="ss">Product Posted:</h2>
             </div>
        </div>

</header>
  
<div class = "tb">
   
                
<?php

    //copy ma red pen le lekheko code  ;
    $sql ="SELECT * FROM images ORDER BY id ASC" ;
    $res = mysqli_query($conn, $sql);

    if(mysqli_num_rows($res) > 0)
    {

?>

<table >
    <thead>
        <tr>
            <!--<th>CHECK</th>-->
            <th>ID</th>
            <th>PRODUCT NAME</th>
            <th>PRICE</th>
            <th>WEIGHT</th>
            <th>IMAGE</th>
            <th>EDIT</th>
            <th>DELETE</th>
        </tr>
    </thead>

    <tbody>

    <?php  

         while ($images = mysqli_fetch_assoc($res)) 
        { 

    ?>

        <tr>
   
         <!--<input type="checkbox" onclick="toggleCheckbox(this)" value="<?php echo $images['id'] ?> "<?php echo $images['visible'] == 1 ? "checked" : ""?>></td>-->

            <td><?php echo $images['id'];?></td>
            <td><?php echo $images['product_name'];?></td>
            <td><?php echo $images['price'];?></td>
            <td><?php echo $images['weight'];?></td>

            <td> <?php echo '<img src = "uploads/' .$images['image_url'].'" 
                width = "100px;" height = "100px;" >'?> </td>

            <td> <form action="product_edit.php" method="post">
             <input type ="hidden" name="edit_id" value="<?php echo $images['id'] ?>">
             <button type="submit" name = "edit_data_btn" >Update</a>
            </button>
                    </form></td>

            <td> <form action = "uploaded.php" method="post">
                    
            <input type ="hidden" name="del_id" value="<?php echo $images['id'] ?>">
             <button name = "del_data_btn" >Delete</a>
            </button></form>
                    </td>
        </tr>

    <?php
               
            } 
        ?>

        

    </tbody>
       <!--displaying the uploaded files-->
 </table>
   
 <?php 
        }
        else
        {
            echo "NO record found";
        }
  ?>
    

<!--
<script>

    function toggleCheckbox(boo)
    {
        var id = $(boo).attr('value');//checkbox value of id then passes to visible field in db

        if ($(boo).prop("checked") == true) 
        {
            var visible = 1;

        }
        else{
            var visible = 0;
        }

        var data = {
            "search_data" : 1,
            "id": id,
            "visible": visible
        };



        $.ajax({
            type: "POST",
            url: "uploaded.php",
            data: data,
            success: function (response){
                alert("Data Checked");

            }
        });
    }
</script>-->

<script src="dist/js/jquery-3.3.1.min.js"></script>
<script src="dist/bootstrap/js/bootstrap.min.js"></script>
<script src="dist/js/all.js"></script>
<script src="dist/fontawesome/js/all.min.js"></script>
<script src="dist/js/nicEdit.js"></script>
</body>
</html>