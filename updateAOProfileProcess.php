<?php

session_start(); //start the session

require "connection.php"; //require the connection

if(isset($_SESSION["ao"])) {
    $email = $_SESSION["ao"]["email"]; //take the email from the session

    $fname = $_POST["fname"]; //take the first name
    $mname = $_POST["mname"]; //take the middle name
    $lname = $_POST["lname"]; //take the last name
    $mobile = $_POST["mobile"]; //take the mobile

    if(isset($_FILES["pimg"])) {
        $pimg = $_FILES["pimg"];

        $allowed_image_ex = array("image/jpg","image/jpeg","image/png","image/svg+xml"); //take the file type through the array
        $file_ex = $pimg["type"];

        if(!in_array($file_ex, $allowed_image_ex)){
            echo ("Please select a valid image.");
        } else {
            
            $new_file_ex; //create a file extention

            if($file_ex == "image/jpg"){
                $new_file_ex = ".jpg";
            } else if($file_ex == "image/jpeg"){
                $new_file_ex = ".jpeg";
            } else if($file_ex == "image/png"){
                $new_file_ex = ".png";
            } else if($file_ex == "image/svg+xml"){
                $new_file_ex = ".svg";
            }

            $file_name = "assets/images/".$email."_".uniqid().$new_file_ex; //create file new file name with email and unique id

            move_uploaded_file($pimg["tmp_name"],$file_name); //upload the file

            //search data from the tables 
            $pimg_rs = Database::search("SELECT * FROM `academic_officer_prifile_image` WHERE `academic_officer_registration_email`='".$email."'");
            $pimg_num = $pimg_rs->num_rows; //take the number of results

            if($pimg_num == 1){
                
                //update table
                Database::iud("UPDATE `academic_officer_prifile_image` SET `path`= '".$file_name."' WHERE
                `academic_officer_registration_email`='".$email."'");

            } else {
                
                //update table
                Database::iud("INSERT INTO `academic_officer_prifile_image` (`path`,`academic_officer_registration_email`) VALUES
                ('".$file_name."','".$email."')");

            }


            
        }
    }
    
    //update table
    Database::iud("UPDATE `academic_officer_registration` SET `first_name`='".$fname."',`middle_name`='".$mname."',`last_name`='".$lname."', `contact_no`= '".$mobile."' WHERE `email`='".$email."'");
    
    echo ("success");
    
} else {
    echo ("Please LogIn First");
}

?>