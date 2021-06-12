<?php
  include 'includes/accountmanager.php';
?>
<!-- New layout -->
<!Doctype html>
<html lang = en>
     <head>
          <title> Please sign in to access your tasks </title>

          <meta charset = "utf-8"/>
          <meta name = "viewport" content = "width=device-width, initial-scale=1.0"/>

          <!-- Link the Bootstrap 4 CDN CSS files -->
          <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
          <!-- Link the Bootstrap 4 CDN JS and jQuery files (must be in this order: jQuery, Popper, Bootstrap.js) -->
          <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
          <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
     </head>

     <body style = "background-color: lightgreen;">
          <div class = "container" style = "margin-top: 10%;">
               <div style = "background-color: white; border-radius: 5px; padding: 10px;">
                    <h3 style = "font-family: serif; text-align: center;"> Welcome to the myworkload </h3>
                    <p style = "font-family: serif; text-align: center;"> <em> Please log in to access your daily task list and daily task schedule </em> </p>

                    <!-- Login part -->
                    <form method = "POST" action = "index.php">
                         <div class = "form-group">
                              <input type = "text" name = "signup-uname" placeholder = "Enter Username" class = "form-control" style = "font-family: serif;"/>
                         </div>
                         <div class = "form-group">
                              <input type = "password" name = "signup-pwd" placeholder = "Enter Password" class = "form-control" style = "font-family: serif;"/>
                         </div>
                         <div class = "d-flex justify-content-center">
                              <input type = "submit" name = "submitButton" value = "Login" class = "btn btn-success"/>
                         </div>
                    </form>
                    <?php
                      if(isset($_POST['submitButton']))
                      {
                         $username = $_POST['signup-uname'];
                         $password = $_POST['signup-pwd'];

                         $login = new Login();
                         $login -> login($username, $password);
                      }
                    ?>

                    <!-- Forgot password part (if users forgot their password and need to reset it) -->
                    <!-- Link that will open the forgot password modal -->
                    <div class = "d-flex justify-content-center">
                         <a href = "#" data-toggle = "modal" data-target = "#forgotpwdwindow" style = "font-family: serif;"> Forgot password? Click here </a>
                    </div>
                    <!-- The forgot password modal -->
                    <div class = "modal fade" id = "forgotpwdwindow">
                         <div class = "modal-dialog">
                              <div class = "modal-content">
                                   <div class = "modal-header">
                                        <h3 class = "modal-title" style = "font-family: serif;"> <em> Reset Password here </em> </h3>
                                        <button type = "button" class = "close" data-dismiss = "modal"> &times; </button>
                                   </div>
                                   <div class = "modal-body">
                                        <form method = "POST" action = "index.php">
                                              <div class = "form-group">
                                                   <input type = "text" name = "acc-uname" class = "form-control" style = "font-family: serif;" placeholder = "Enter your Username"/>
                                              </div>
                                              <div class = "form-group">
                                                   <input type = "email" name = "acc-email" class = "form-control" style = "font-family: serif;" placeholder = "Enter your Email address"/>
                                              </div>
                                              <div class = "form-group">
                                                   <input type = "password" name = "new-pwd" class = "form-control" style = "font-family: serif;" placeholder = "Enter new password"/>
                                              </div>
                                              <div class = "d-flex justify-content-center">
                                                  <input type = "submit" class = "btn btn-success" name = "submitnewpwd" value = "Change password now"/>
                                              </div>
                                        </form>
                                        <?php
                                           if(isset($_POST['submitnewpwd']))
                                           {
                                              $accountuname = $_POST['acc-uname'];
                                              $accountuemail = $_POST['acc-email'];
                                              $newaccpwd = $_POST['new-pwd'];

                                              $changepwd = new ForgotPassword();
                                              $changepwd -> ChangePwd($accountuname, $accountuemail, $newaccpwd);
                                           }
                                        ?>
                                   </div>
                              </div>
                         </div>
                    </div>

                    <!-- Signup part -->
                    <!-- Link that will open the signup modal -->
                    <div class = "d-flex justify-content-center">
                         <a href = "#" data-toggle = "modal" data-target = "#signupwindow" style = "font-family: serif;"> Don't have an account yet? Click here to register for an account </a>
                    </div>
                    <!-- The signup modal -->
                    <div class = "modal fade" id = "signupwindow">
                         <div class = "modal-dialog">
                              <div class = "modal-content">
                                   <div class = "modal-header">
                                        <h3 class = "modal-title" style = "font-family: serif;"> <em> Register for a task manager account </em> </h3>
                                        <button type = "button" class = "close" data-dismiss = "modal"> &times; </button>
                                   </div>
                                   <div class = "modal-body">
                                        <form method = "POST" action = "index.php">
                                              <div class = "form-group">
                                                  <input type = "text" name = "fname" placeholder = "Enter First Name" class = "form-control" style = "font-family: serif;"/>
                                              </div>
                                              <div class = "form-group">
                                                  <input type = "text" name = "lname" placeholder = "Enter Second Name" class = "form-control" style = "font-family: serif;"/>
                                              </div>
                                              <div class = "form-group">
                                                  <input type = "text" name = "uname" placeholder = "Enter a Username" class = "form-control" style = "font-family: serif;"/>
                                              </div>
                                              <div class = "form-group">
                                                  <input type = "password" name = "pwd" placeholder = "Enter a Password" class = "form-control" style = "font-family: serif;"/>
                                              </div>
                                              <div class = "form-group">
                                                  <input type = "text" name = "email" placeholder = "Enter your Email" class = "form-control" style = "font-family: serif;"/>
                                              </div>
                                              <div class = "form-group">
                                                  <input type = "text" name = "tele" placeholder = "Enter your telephone" class = "form-control" style = "font-family: serif;"/>
                                              </div>
                                              <div class = "form-group">
                                                  <select name = "tele-network" class = "form-control" style = "font-family: serif;">
                                                          <option name = "default"> Please select the network of telephone </option>
                                                          <option name = "att"> AT&T </option>
                                                          <option name = "sprint"> Sprint </option>
                                                          <option name = "tmobile"> T-Mobile </option>
                                                          <option name = "verizon"> Verizon </option>
                                                          <option name = "virginmobile"> Virgin Mobile </option>
                                                  </select>
                                              </div>
                                              <div class = "d-flex justify-content-center">
                                                  <input type = "submit" class = "btn btn-success" name = "submitInfo" value = "Register new account!"/>
                                              </div>
                                        </form>
                                        <?php
                                           if(isset($_POST['submitInfo']))
                                           {
                                              $firstname = $_POST['fname'];
                                              $lastname = $_POST['lname'];
                                              $username = $_POST['uname'];
                                              $password = $_POST['pwd'];
                                              $email = $_POST['email'];
                                              $telephone = $_POST['tele'];
                                              $telenetwork = $_POST['tele-network'];

                                              $signup = new Signup();
                                              $signup -> signup($firstname, $lastname, $username, $password, $email, $telephone, $telenetwork);
                                           }
                                        ?>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>
          </div>
     </body>
</html>
