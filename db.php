<?php

$conn = mysqli_connect(
    'localhost',
    'root', // Database username
    '', // Database password            
    'e_project' // Database name
);

if (!$conn) {
    echo "Connection failed";
}

?>