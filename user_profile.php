<?php

include_once 'php/db_connect.php';
include_once 'php/functions.php';

sec_session_start();

if(isset($_POST["ProfileUpdate"])) {
    $bUpdate = ($_POST["ProfileUpdate"] == "Update");
    if ($bUpdate) {
        foreach ($_POST as $key => $value) error_log($key . '=' . $value);
        updateProfile($mysqli);
    }
}
$result=getUserProfile($mysqli);
$userProfile=$result->fetch_assoc();
//check if already in the DB

?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>MuLogin: Profile</title>
        <link rel="stylesheet" href="css/error.css" />
    </head>
    <body>
    <?php include_once 'index.php'; ?>
        <?php if (login_check($mysqli) == true) : ?>
        <p>Welcome <?php echo htmlentities($_SESSION['email']); ?>!</p>
            <p>
                <form class="cd-form" action="user_profile.php" method="post" name="user_profile_form" id="user_profile_form">
                    <p class="top-spacer"></p>
                    <!-- change this to a pulldown/selection -->
                    <label for="name-set">Name:</label>
                    <p id="name-set">
<!--                        <label class="image-replace" for="profile-salutation">Salutation</label>-->
                        <input class="left-padding has-border" id="profile-salutation" name="profile-salutation" value="<?php echo $userProfile['salutation'] ?>" type="text" maxlength="5" size="9" placeholder="Salutation">

<!--                        <label class="image-replace" for="profile-firstname">First Name</label>-->
                        <input class="left-padding has-border" id="profile-firstname" name="profile-firstname" value="<?php echo $userProfile['first_name'] ?>" type="text" size="22" placeholder="First Name">

<!--                        <label class="image-replace" for="profile-middle-initial">MI</label>-->
                        <input class="left-padding has-border" id="profile-middle-initial" name="profile-middle-initial"  value="<?php echo $userProfile['middle_initial'] ?>" maxlength="1" size="2" type="text" placeholder="MI">

<!--                        <label class="image-replace" for="profile-lastname">Last Name</label>-->
                        <input class="left-padding has-border" id="profile-lastname" name="profile-lastname"  value="<?php echo $userProfile['last_name'] ?>" type="text" size="22" placeholder="Last Name">

<!--                        <label class="image-replace" for="profile-suffix">Suffix</label>-->
                        <input class="left-padding has-border" id="profile-suffix" name="profile-suffix" value="<?php echo $userProfile['suffix'] ?>" type="text" maxlength="4" size="5" placeholder="Suffix">
                    </p>
                    <p class="top-spacer"></p>
                    <label style="margin-top:30px" for="addess-set:">Address:</label>
                    <p id="addess-set">
                        <p><input class="left-padding has-border" id="profile-address-1" name="profile-address-1" value="<?php echo $userProfile['address_1'] ?>" type="text" maxlength="50" size="52" placeholder="Address"></p>
                        <p><input class="left-padding has-border" id="profile-address-2" name="profile-address-2" value="<?php echo $userProfile['address_2'] ?>" type="text" maxlength="50" size="52" placeholder="Address"></p>
                        <p><input class="left-padding has-border" id="profile-unit-no" name="profile-unit-no" value="<?php echo $userProfile['unit_no'] ?>" type="text" maxlength="7" size="9" placeholder="Apt/Unit"></p>
                        <p>
                        <input class="left-padding has-border" id="profile-city" name="profile-city" value="<?php echo $userProfile['city'] ?>" type="text" placeholder="City">
                        <input class="left-padding has-border" id="profile-state" name="profile-state" value="<?php echo $userProfile['state'] ?>" type="text" maxlength="2" size="4" placeholder="State">
                        <input class="left-padding has-border" id="profile-zip-code" name="profile-zip-code" value="<?php echo $userProfile['zip_code'] ?>" type="text" maxlength="10" size="12" placeholder="Zip">
                        </p>
                    </p>

<!--
                    <p class="fieldset">
                        <input type="checkbox" id="accept-terms">
                        <label for="accept-terms">I agree to the <a href="#0">Terms</a></label>
                    </p>
-->

                    <p class="fieldset">
                        <input class="has-padding" type="submit" value="Update" name="ProfileUpdate" id="ProfileUpdate" style="width:200px">
                    </p>
                </form>
            </p>
        <?php else : ?>
            <p>
                <span class="error">You are not authorized to access this page.</span> Please <a href="index.php">login</a>.
            </p>
        <?php endif; ?>
    </body>
</html>
