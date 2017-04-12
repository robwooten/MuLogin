/* 
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

function formhash(form, password) {
    // Create a new element input, this will be our hashed password field.

    if(form.find('#signin-email').is(':invalid'))
    {
        alert('Please use valid email format');
        return false;
    }
//    var p = document.createElement("input");
//    var email = document.createElement("input");
    // Add the new element to our form
    form.append('<input type="hidden" name="p" value="'+hex_sha512(password.val())+'" />');
    form.append('<input type="hidden" name="email" value="'+ $('#signin-email').val()+'" />');

    // Make sure the plaintext password doesn't get sent.
    password.val("");
    // Finally submit the form.

    form.submit();
}

function regformhash(form, _username, _email, _password, _confirmPassword, _conf) {

    // Check each field has a value
    if (_username.val() == '' || _email.val() == '' || _password.val() == '' || _confirmPassword.val() == '' || _conf.val() == '') {
        alert('You must provide all the requested details. Please try again');
        return false;
    }
    // Check the username
    re = /^\w+$/;
    if (!re.test(_username.val())) {
        alert("Username must contain only letters, numbers and underscores. Please try again");
        _username.focus();
        return false;
    }

    //Check valid email format
    if(_email.is(':invalid'))
    {
        alert('Please use valid email format');
        return false;
    }

    // Check that the password is sufficiently long (min 6 chars)
    // The check is duplicated below, but this is included to give more
    // specific guidance to the user
    if (_password.val().length < 6) {
        alert('Passwords must be at least 6 characters long.  Please try again');
        _password.focus();
        return false;
    }

    // At least one number, one lowercase and one uppercase letter 
    // At least six characters 
    var re = /(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{6,}/;
    if (!re.test(_password.val())) {
        alert('Passwords must contain at least one number, one lowercase and one uppercase letter.  Please try again');
        return false;
    }

    // Check password and confirmation are the same
    if (_password.val() != _confirmPassword.val()) {
        alert('Your password and confirmation do not match. Please try again');
        _password.focus();
        return false;
    }
/*
    if
    {
        alert('Must accept terms');
        accept-terms.focus();
    }
*/
    form.append('<input type="hidden" name="p" value="'+ hex_sha512(_password.val())+'" />');
    form.append('<input type="hidden" name="email" value="'+ _email.val()+'" />');
    form.append('<input type="hidden" name="username" value="'+ _username.val()+'" />');

/*
    // Create a new element input, this will be our hashed password field.
    var p = document.createElement("input");
    var email = document.createElement("input");
    var username = document.createElement("input");

    // Add the new element to our form. 
    form.append(p);
    p.name = "p";
    p.type = "hidden";
    p.value = hex_sha512(_password.val());

    form.append(email);
    email.name = "email";
    email.type = "hidden";
    email.value = _email.val();

    form.append(username);
    username.name = "username";
    username.type = "hidden";
    username.value = _username.val();
    */

    // Make sure the plaintext password doesn't get sent.
    _email.val("");
    _password.val("");
    _conf.val("");
    // Finally submit the form.
    //alert('email:' + email.value + ' username:' + username.value + ' password:' + p.value);
    form.submit();
}
