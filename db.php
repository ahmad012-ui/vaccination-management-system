<?php
$conn = mysqli_connect('localhost','root','','mysql');
if($conn){
    echo  "connected";
}else{
    echo "not connected" ;
}
?>


