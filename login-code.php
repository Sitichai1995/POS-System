<?php

require "./admin/config/function.php";

if (isset($_POST['loginBtn'])) {

    $email = validate($_POST['email']);
    $password = validate($_POST['password']);

    if ($email != '' && $password != '') {
        $query = "SELECT * FROM admins WHERE email = '$email' limit 1";
        $result = mysqli_query($conn, $query);
        if ($result) {

            if (mysqli_num_rows($result) == 1) {

                $row = mysqli_fetch_assoc($result);
                $hashedPassword = $row['password'];

                if (!password_verify($password, $hashedPassword)) {
                    redirect('login.php', 'password is invalid.');
                }

                if ($row['is_ban'] == 1) {
                    redirect('login.php', 'Your account is banned.');

                }

                $_SESSION['loggedIn'] = true;
                $_SESSION['loggedInUser'] = [
                    'user_id' => $row['id'],
                    'name' => $row['name'],
                    'password' => $row['password'],
                    'email' => $row['email']
                ];

                redirect('admin/index.php', 'Logged In successfully.');
            } else {
                redirect('login.php', 'email is invalid.');
            }
        } else {
            redirect('login.php', 'Something went wrong.');
        }
    } else {
        redirect('login.php', 'email or password invalid.');
    }
}
