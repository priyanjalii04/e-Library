<?php
$conn = mysqli_connect('localhost','root','','library',3307);

function generateToken(){
    return bin2hex(random_bytes(4));
}
?>
