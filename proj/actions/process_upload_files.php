<?php
include_once('../database/access_database.php');

function upload_user_photo($path)
{
    $extention = $_FILES['profile_photo']['type'];

    if ($extention == 'image/jpeg'){
        $originalFileName = $path . "/profile_original.jpg";
        $photoFileName = $path . "/profile.jpg";
        $thumbnailFileName = $path . "/thumbnail.jpg";
    }
    else if ($extention == 'image/png'){
        $originalFileName = $path . "/profile_original.png";
        $photoFileName = $path . "/profile.png";
        $thumbnailFileName = $path . "/thumbnail.png";
    } 

    if (file_exists($originalFileName))
        unlink($originalFileName);

    if (file_exists($photoFileName))
        unlink($photoFileName);

    move_uploaded_file($_FILES['profile_photo']['tmp_name'], $originalFileName);

    echo $extention;

    if ($extention == 'image/jpeg'){
        $original = imagecreatefromjpeg($originalFileName);
    }
    else if ($extention == 'image/png')
        $original = imagecreatefrompng($originalFileName);

    $original_width = imagesx($original);
    $original_height = imagesy($original);
    $min_original = min($original_width, $original_height);

    $newwidth = 0;
    $newheight = 0;
    $newwidth_tb = 0;
    $newheight_tb = 0;

    if ($original_width > $original_height) {
        $newheight = 150;
        $newwidth = 150 * $original_width / $original_height;
        $newheight_tb = 50;
        $newwidth_tb = 50 * $original_width / $original_height;
    } else if ($original_width < $original_height) {
        $newwidth = 150;
        $newheight = 150 * $original_width / $original_height;
        $newwidth_tb = 50;
        $newheight_tb = 50 * $original_width / $original_height;      
    }
    
    $scaledOriginal = imagescale($original, $newwidth, $newheight);
    $min_scaledoriginal = min($newwidth, $newheight);

    $scaledOriginalThumbnail = imagescale($original, $newwidth_tb, $newheight_tb);
    $min_scaledoriginal_tb = min($newwidth_tb, $newheight_tb);

    $src_x = 0;
    $src_y = 0;

    if ($newwidth > $newheight) {
        $src_x = ($newwidth - $newheight) / 2;
    } else if ($newwidth < $newheight) {
        $src_y = ($newheight - $newwidth) / 2;
    }

    $squared = imagecreatetruecolor(150, 150);
    if($scaledOriginal != false){
        imagecopyresampled($squared, $scaledOriginal, 0, 0, $src_x, $src_y, 150, 150, $min_scaledoriginal, $min_scaledoriginal);
    }
    imagejpeg($squared, $photoFileName, 100);

    if ($newwidth_tb > $newheight_tb) {
        $src_x = ($newwidth_tb - $newheight_tb) / 2;
    } else if ($newwidth_tb < $newheight_tb) {
        $src_y = ($newheight_tb - $newwidth_tb) / 2;
    }

    $thumbnail = imagecreatetruecolor(50, 50);
    imagecopyresampled($thumbnail, $scaledOriginalThumbnail, 0, 0, $src_x, $src_y, 50, 50, $min_scaledoriginal_tb, $min_scaledoriginal_tb);
    imagejpeg($thumbnail, $thumbnailFileName, 100);

    roundCorners($photoFileName);
    roundCorners($thumbnailFileName);

    if ($extention == 'image/jpeg'){
        unlink($photoFileName);
        unlink($thumbnailFileName);
    }
}

function roundCorners($filename)
{
    $image_s = imagecreatefromstring(file_get_contents($filename));

    $width = imagesx($image_s);
    $height = imagesy($image_s);

    $newwidth = $width;
    $newheight = $height;

    $image = imagecreatetruecolor($newwidth, $newheight);
    imagealphablending($image, true);
    imagecopyresampled($image, $image_s, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);

    //create masking
    $mask = imagecreatetruecolor($newwidth, $newheight);
    $transparent = imagecolorallocate($mask, 255, 0, 0);
    imagecolortransparent($mask, $transparent);
    imagefilledellipse($mask, $newwidth / 2, $newheight / 2, $newwidth, $newheight, $transparent);
    $red = imagecolorallocate($mask, 0, 0, 0);
    imagecopymerge($image, $mask, 0, 0, 0, 0, $newwidth, $newheight, 100);
    imagecolortransparent($image, $red);
    imagefill($image, 0, 0, $red);

    //output, save and free memory
    $newFileName = substr_replace($filename, 'png', -3, 3);
    imagepng($image, $newFileName, 0);
    imagedestroy($image);
    imagedestroy($mask);
}

function set_profile_photo()
{
    $username = $_SESSION['username'];
    $path = "../resources/users/$username";

    insert_user_photo($username, $path);

    if (!empty($_FILES["profile_photo"]["name"]))
        upload_user_photo($path);
}

function update_profile_photo()
{
    $username = $_SESSION['username'];
    $path = "../resources/users/$username";

    if (!empty($_FILES["profile_photo"]["name"]))
        upload_user_photo($path);
}

// Place files
function update_place_photos($place_id) {
    delete_place_photos($place_id);
    set_place_photos($place_id);
}
    
function set_place_photos($place_id){
    $path = "../resources/places/$place_id";    
    print_r($_FILES);   
        
    for($i = 0; $i < count($_FILES['place_pic']['name']); $i++){
        if(move_uploaded_file($_FILES['place_pic']['tmp_name'][$i], "$path/$i.jpg")){
            // inserir na base de dados aqui;
            $target = "$path/$i.jpg";
            insert_place_photo($place_id, $target);
        }
        else {$_SESSION['messages'] = "Photo not saved"; }
    }
}
?>
