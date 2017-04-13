<?php

include_once 'db_connect.php';
include_once 'psl-config.php';

$error_msg = "";
if (isset($_POST['email'])) {
    // Sanitize and validate the data passed in
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $email = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Not a valid email
        $error_msg .= '<p class="error">The email address you entered is not valid</p>';
    }

    // Username validity and password validity have been checked client side.
    // This should should be adequate as nobody gains any advantage from
    // breaking these rules.
    //

    $prep_stmt = "SELECT user_id FROM users WHERE email = ? LIMIT 1";
    $stmt = $mysqli->prepare($prep_stmt);

    if ($stmt) {
        $stmt->bind_param('s', $email);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows == 1) {
            // A user with this email address already exists
            $error_msg .= '<p class="error">A user with this email address already exists.</p>';
        }
    } else {
        $error_msg .= '<p class="error">Database error</p>';
    }

    // TODO:
    // We'll also have to account for the situation where the user doesn't have
    // rights to do registration, by checking what type of user is attempting to
    // perform the operation.

    if (empty($error_msg)) {
        //generate random password
        $random_pass = "test";

        // Create a random salt
        $random_salt = hash('sha512', uniqid(openssl_random_pseudo_bytes(16), TRUE));

        // Create salted password
        $password = hash('sha512', $random_pass . $random_salt);
        //update with randomPass, set newPass to 1 to force user to update password
        if ($update_stmt = $mysqli->prepare("UPDATE users set password='" . $password . "', salt='" . $random_salt . "' where email='" . $email . "'" )) {
//            $insert_stmt->bind_param('ssss', $username, $email, $password, $random_salt);
            // Execute the prepared query.
            if (! $update_stmt->execute()) {
                header('Location: error.php?err=Registration failure: INSERT');
                exit();
            }
        }

        //email randomPass to user
        mail($email,"MuLogin Password Reset","your temp password is:" . $random_pass, "From:rob@murznik.com\r\n");

        header('Location: ../index.php');
        exit();
    }
    else
    {
        echo $error_msg;
    }
}
else
{
    error_log("End of register.inc");
}