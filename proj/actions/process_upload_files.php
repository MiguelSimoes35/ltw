<?php
    include_once('../database/access_database.php');

    function upload_user_photo($path) {

        $originalFileName = $path . "/profile_original.jpg";
        $photoFileName = $path . "/profile.jpg";
        $thumbnailFileName = $path . "/thumbnail.jpg";

        if (file_exists($originalFileName))
            unlink($originalFileName);
        
        if (file_exists($photoFileName))
            unlink($photoFileName);

        move_uploaded_file($_FILES['profile_photo']['tmp_name'], $originalFileName);

        $original = imagecreatefromjpeg($originalFileName);

        $original_width = imagesx($original);
        $original_height = imagesy($original);
        $min_original = min($original_width, $original_height);

        $src_x = 0;
        $src_y = 0;

        if ($original_width > $original_height) {
            $src_x = ($original_width - $original_height) / 2;
        }
        else if ($original_width < $original_height) {
            $src_y = ($original_height - $original_width) / 2;
        }

        $squared = imagecreatetruecolor(150, 150);
        imagecopyresampled($squared, $original, 0, 0, $src_x, $src_y, 150, 150, $min_original, $min_original);
        imagejpeg($squared, $photoFileName);

        $thumbnail = imagecreatetruecolor(50, 50);
        imagecopyresampled($thumbnail, $original, 0, 0, $src_x, $src_y, 50, 50, $min_original, $min_original);
        imagejpeg($thumbnail, $thumbnailFileName);
    }

    function set_profile_photo() {
        $username = $_SESSION['username'];
        $path = "../resources/users/$username";

        insert_user_photo($username, $path);

        if (!empty($_FILES["profile_photo"]["name"]))
            upload_user_photo($path);
    }

    function update_profile_photo() {
        $username = $_SESSION['username'];
        $path = "../resources/users/$username";

        if (!empty($_FILES["profile_photo"]["name"]))
            upload_user_photo($path);
    }


?>