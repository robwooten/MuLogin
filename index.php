<?php
/**
 * Copyright (C) 2013 peredur.net
 *
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 * 
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 * 
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */
include_once 'php/db_connect.php';
include_once 'php/functions.php';

sec_session_start();

$bLogged = login_check($mysqli) ;
?>
<!DOCTYPE html>
<html>
    <head>
        <title>MuLogin</title>
        <link rel="stylesheet" href="css/error.css" />
        <link rel="stylesheet" href="css/reset.css"/>
        <link rel="stylesheet" href="css/style.css"/>
        <script type="text/JavaScript" src="js/sha512.js"></script> 
        <script type="text/JavaScript" src="js/forms.js"></script>
        <!-- <script type= "text/JavaScript" src="js/modernizr.js"></script> <!-- Modernizr -->
    </head>
    <body>
    <header role="banner">
        <!-- <div id="logo"><a href="#0"><img src="img/cd-logo.svg" alt="Logo"></a></div> -->

        <nav class="main-nav">
            <ul>
                <!-- insert more links here -->
                <li <?php if($bLogged): echo 'style="display:none;"'; endif; ?>><a class="cd-signin" href="#0" id="signin">Sign in</a></li>
                <li <?php if($bLogged): echo 'style="display:none;"'; endif; ?>><a class="cd-signup" href="#0" id="signup">Sign up</a></li>
                <li <?php if(!$bLogged): echo 'style="display:none;"'; endif; ?>><label id="cd-username"><?php if($bLogged) {echo htmlentities($_SESSION['username']);} ?></label></li>
                <li <?php if(!$bLogged): echo 'style="display:none;"'; endif; ?>><a class="cd-signout" href="#0" id="signout">Sign out</a></li>
            </ul>
        </nav>
    </header>
    <div class="cd-user-modal"> <!-- this is the entire modal form, including the background -->
        <div class="cd-user-modal-container"> <!-- this is the container wrapper -->
            <ul class="cd-switcher">
                <li><a href="#0">Sign in</a></li>
                <li><a href="#0">New account</a></li>
            </ul>

            <div id="cd-login"> <!-- log in form -->
                <form class="cd-form" action="php/process_login.php" method="post" name="login_form" id="login_form">
                    <p class="fieldset">
                        <label class="image-replace cd-email" for="signin-email">E-mail</label>
                        <input class="full-width has-padding has-border" id="signin-email" type="email" placeholder="E-mail">
                        <span class="cd-error-message">Error message here!</span>
                    </p>

                    <p class="fieldset">
                        <label class="image-replace cd-password" for="signin-password">Password</label>
                        <input class="full-width has-padding has-border" id="signin-password" type="password"  placeholder="Password">
                        <a href="#0" class="hide-password">Show</a>
                        <span class="cd-error-message">Error message here!</span>
                    </p>

                    <p class="fieldset">
                        <input type="checkbox" id="remember-me" checked>
                        <label for="remember-me">Remember me</label>
                    </p>

                    <p class="fieldset">
                        <input class="full-width" type="submit" value="Login">
                    </p>
                </form>

                <p class="cd-form-bottom-message"><a href="#0">Forgot your password?</a></p>
                <!-- <a href="#0" class="cd-close-form">Close</a> -->
            </div> <!-- cd-login -->

            <div id="cd-signup"> <!-- sign up form -->
                <form class="cd-form" action="php/process_register.php" method="post" name="signup_form" id="signup_form">
                    <p class="fieldset">
                        <label class="image-replace cd-username" for="signup-username">Username</label>
                        <input class="full-width has-padding has-border" id="signup-username" type="text" placeholder="Username">
                        <span class="cd-error-message">Error message here!</span>
                    </p>

                    <p class="fieldset">
                        <label class="image-replace cd-email" for="signup-email">E-mail</label>
                        <input class="full-width has-padding has-border" id="signup-email" type="email" placeholder="E-mail">
                        <span class="cd-error-message">Error message here!</span>
                    </p>

                    <p class="fieldset">
                        <label class="image-replace cd-password" for="signup-password">Password</label>
                        <input class="full-width has-padding has-border" id="signup-password" type="password"  placeholder="Password">
                        <a href="#0" class="hide-password">Show</a>
                        <span class="cd-error-message">Error message here!</span>
                    </p>

                    <p class="fieldset">
                        <label class="image-replace cd-password" for="confirm-signup-password">Password</label>
                        <input class="full-width has-padding has-border" id="confirm-signup-password" type="password"  placeholder="Confirm Password">
                        <a href="#0" class="hide-password">Show</a>
                        <span class="cd-error-message">Error message here!</span>
                    </p>

                    <p class="fieldset">
                        <input type="checkbox" id="accept-terms">
                        <label for="accept-terms">I agree to the <a href="#0">Terms</a></label>
                    </p>

                    <p class="fieldset">
                        <input class="full-width has-padding" type="submit" value="Create account">
                    </p>
                </form>

                <!-- <a href="#0" class="cd-close-form">Close</a> -->
            </div> <!-- cd-signup -->

            <div id="cd-reset-password"> <!-- reset password form -->
                <p class="cd-form-message">Lost your password? Please enter your email address. You will receive a link to create a new password.</p>

                <form class="cd-form" >
                    <p class="fieldset">
                        <label class="image-replace cd-email" for="reset-email">E-mail</label>
                        <input class="full-width has-padding has-border" id="reset-email" type="email" placeholder="E-mail">
                        <span class="cd-error-message">Error message here!</span>
                    </p>

                    <p class="fieldset">
                        <input class="full-width has-padding" type="submit" value="Reset password" id="mu-resetpassword">
                    </p>
                </form>

                <p class="cd-form-bottom-message"><a href="#0">Back to log-in</a></p>
            </div> <!-- cd-reset-password -->
            <a href="#0" class="cd-close-form">Close</a>
        </div> <!-- cd-user-modal-container -->
    </div> <!-- cd-user-modal -->
    <?php
        if (isset($_GET['error'])) {
            echo '<p class="error">Error Logging In!</p>';
        }
        elseif(isset($_GET['reg'])){
            echo '<p class="error">User:' . $_GET["reg"] . ' registered </p>';
        }
    ?>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script src="js/main.js"></script>
    </body>
</html>