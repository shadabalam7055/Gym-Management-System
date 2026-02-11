<?php
$password = "admin123"; // जो password रखना है
$hash = password_hash($password, PASSWORD_DEFAULT);
echo $hash;