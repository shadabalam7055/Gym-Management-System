<?php

    if(isset($_REQUEST['update_password'])) {
        include '../config/connection.php';

        $current_password = ($_REQUEST['current_password']);
        $new_password = ($_REQUEST['new_password']);

        $stmt = $conn -> prepare("SELECT * FROM admin WHERE password = ?");
        $stmt -> execute([$current_password]);
        $admin = $stmt -> fetch();

        if($admin) {
            $update_stmt = $conn -> prepare("UPDATE admin SET password = ? WHERE id = ?");
            $update_stmt -> execute([$new_password, $admin['id']]);
            $success_message = "Password updated successfully.";
        } else {
            $error_message = "Current password is incorrect.";
        }

        header("Location: settings.php?password_updated=1");
    }   

?>