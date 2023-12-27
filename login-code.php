<?php 

require "./admin/config/function.php";

if (isset($_POST['loginBtn'])) {

    $email = validate($_POST['email']);
    $password = validate($_POST['password']);

    if ($email != '' && $password != '') {
        $query = "SELECT * FROM admins WHERE email = '$email' limit 1";
        $result = mysqli_query($conn, $query);

        if ($result) {
            
            if (mysqli_num_rows($result)==1) {
                
                $row = mysqli_fetch_assoc($result);
                $hashedPassword = $row['password'];
            } else {
                redirect('login.php','email is invalid.');
            }
            
        }else{
            redirect('login.php','Something went wrong.');
        }
        
    }else{
        redirect('login.php','email or password invalid.');
    }
}
?>