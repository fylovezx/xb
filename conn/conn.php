<?php
$conn = new mysqli("106.15.90.17","cjcx","1234","lovezx");
#$conn = new mysqli("127.0.0.1","cjcx","1234","lovezx");
echo mysqli_connect_error();
$conn->query("set names utf8");
?>