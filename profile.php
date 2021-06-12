<?php
  session_start();

  include "includes/ProfileUpdater.php";
  $infoupdate = new ProfileUpdater();

  $UserId = $_SESSION['userid'];
?>
<html lang = "en">
     <head>
          <title> Welcome to your profile </title>

          <meta charset = "utf-8"/>
          <meta name = "viewport" content = "width=device-width, initial-scale=1"/>

          <!-- Link the Bootstrap 4 CDN CSS files -->
          <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
          <!-- Link the Bootstrap 4 CDN JS and jQuery files (must be in this order: jQuery, Popper, Bootstrap.js) -->
          <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
          <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

          <!-- The jQuery code is for making the name of the file appear when you select a specific file to change the profile picture -->
          <script>
                $(document).ready(function(){
                  $(".custom-file-input").on("change", function(){
                    var fileName = $(this).val().split("\\").pop();

                    $(this).siblings(".custom-file-label").addClass("selected").html(fileName);
                  });
                });
          </script>
     </head>

     <body>
          <!-- Navbar -->
          <nav class = "navbar bg-light navbar-expand-md fixed-top" style = "font-family: serif;">
               <ul class = "navbar-nav mr-auto">
                   <li class = "nav-item"> <a href = "#" class = "nav-link" style = "font-family: serif; text-decoration: none;"> Hello: <?php echo $_SESSION['username']; ?> </a> </li>
                   <li class = "nav-item"> <a href = "home.php" class = "nav-link" style = "font-family: serif; text-decoration: none;"> Go back to task manager page </a> </li>
               </ul>

               <ul class = "navbar-nav mx-auto">
                   <li class = "nav-item"> <a href = "#" class = "nav-link" style = "font-family: serif; text-decoration: none;"> Status: <?php echo $_SESSION['status']; ?> </a> </li>
               </ul>

               <ul class = "navbar-nav ml-auto">
                   <li class = "nav-item"> <a href = "#" class = "nav-link text-dark"> <?php echo "<img src = '".$_SESSION['profilepic']."' width = '30px' height = '30px'/>"; ?> </a> </li>
                   <li class = "nav-item"> <a class = "nav-link text-dark" href = "includes/logout.php"> Logout </a> </li>
               </ul>
          </nav>

          <!-- Welcome text -->
          <div class = "container" style = "margin-top: 7%;">
               <h3 style = "text-align: center; font-family: serif;"> Welcome to your profile page </h3>
          </div>

          <!-- Profile card -->
          <div class = "container d-flex justify-content-center">
               <div class = "card" style = "font-family: serif; width: 350px;">
                    <?php echo "<img class = 'card-img-top' src = '".$_SESSION['profilepic']."'/>"; ?>
                    <div class = "card-body">
                         <p> Full name: <span class = "text-primary"> <?php echo $_SESSION['firstname'] . " " . $_SESSION['lastname']; ?> </span> </p>
                         <p> Username: <span class = "text-primary"> <?php echo $_SESSION['username']; ?> </span> </p>
                         <p> Email Address: <span class = "text-primary"> <?php echo $_SESSION['email']; ?> </span> </p>
                         <p> Telephone number: <span class = "text-primary"> <?php echo $_SESSION['telephone']; ?> </span> </p>
                    </div>
                    <div class = "card-footer">
                         <p> Status: <span class = "text-primary"> <?php echo $_SESSION['status']; ?> </span> </p>
                    </div>
               </div>
          </div>

          <!-- Options to fix profile information -->
          <div class = "container" style = "margin-top: 5%; font-family: serif;">
               <h3 style = "text-align: center;"> Edit profile information </h3>

               <!-- Change first name -->
               <form method = "POST" action = "profile.php" class = "d-flex justify-content-center">
                     <div class = "input-group mb-3">
                          <input type = "text" name = "newfname" class = "form-control" placeholder = "Change first name"/>
                          <div class = "input-group-append"><input type = "submit" name = "change-fname" class = "btn btn-primary" value = "Change first name"/></div>
                     </div>
               </form>
               <?php
                  if(isset($_POST['change-fname']))
                  {
                     $newfname = $_POST['newfname'];

                     $infoupdate -> updateFirstname($UserId, $newfname);
                  }
               ?>
               <!-- Change last name -->
               <form method = "POST" action = "profile.php" class = "d-flex justify-content-center">
                     <div class = "input-group mb-3">
                          <input type = "text" name = "newlname" class = "form-control" placeholder = "Change last name"/>
                          <div class = "input-group-append"><input type = "submit" name = "change-lname" class = "btn btn-primary" value = "Change last name"/></div>
                     </div>
               </form>
               <?php
                  if(isset($_POST['change-lname']))
                  {
                     $newlname = $_POST['newlname'];

                     $infoupdate -> updateLastname($UserId, $newlname);
                  }
               ?>
               <!-- Change username -->
               <form method = "POST" action = "profile.php" class = "d-flex justify-content-center">
                     <div class = "input-group mb-3">
                          <input type = "text" name = "newuname" class = "form-control" placeholder = "Change username"/>
                          <div class = "input-group-append"><input type = "submit" name = "change-uname" class = "btn btn-primary" value = "Change username"/></div>
                     </div>
               </form>
               <?php
                  if(isset($_POST['change-uname']))
                  {
                     $newuname = $_POST['newuname'];

                     $infoupdate -> updateUsername($UserId, $newuname);
                  }
               ?>
               <!-- Change password -->
               <form method = "POST" action = "profile.php" class = "d-flex justify-content-center">
                     <div class = "input-group mb-3">
                          <input type = "password" name = "newpwd" class = "form-control" placeholder = "Change password"/>
                          <div class = "input-group-append"><input type = "submit" name = "change-pwd" class = "btn btn-primary" value = "Change password"/></div>
                     </div>
               </form>
               <?php
                  if(isset($_POST['change-pwd']))
                  {
                     $newpwd = $_POST['newpwd'];

                     $infoupdate -> updatePassword($UserId, $newpwd);
                  }
               ?>
               <!-- Change email address -->
               <form method = "POST" action = "profile.php" class = "d-flex justify-content-center">
                     <div class = "input-group mb-3">
                          <input type = "email" name = "newemail" class = "form-control" placeholder = "Change email"/>
                          <div class = "input-group-append"><input type = "submit" name = "change-email" class = "btn btn-primary" value = "Change email"/></div>
                     </div>
               </form>
               <?php
                  if(isset($_POST['change-email']))
                  {
                     $newemail = $_POST['newemail'];

                     $infoupdate -> updateEmail($UserId, $newemail);
                  }
               ?>
               <!-- Change your status -->
               <form method = "POST" action = "profile.php" class = "d-flex justify-content-center">
                     <div class = "input-group mb-3">
                          <input type = "text" name = "newstatus" class = "form-control" placeholder = "Change your status"/>
                          <div class = "input-group-append"><input type = "submit" name = "change-status" class = "btn btn-primary" value = "Change your status"/></div>
                     </div>
               </form>
               <?php
                  if(isset($_POST['change-status']))
                  {
                     $newstatus = $_POST['newstatus'];

                     $infoupdate -> updateStatus($UserId, $newstatus);
                  }
               ?>
               <!-- Change telephone number and network domain -->
               <form method = "POST" action = "profile.php" class = "d-flex justify-content-center">
                     <div class = "input-group mb-3">
                          <input type = "text" name = "newtelenum" class = "form-control" placeholder = "Change telephone number"/>
                          <select name = "tele-network" class = "form-control" style = "font-family: serif;">
                                  <option name = "default"> Please select the network of telephone </option>
                                  <option name = "att"> AT&T </option>
                                  <option name = "sprint"> Sprint </option>
                                  <option name = "tmobile"> T-Mobile </option>
                                  <option name = "verizon"> Verizon </option>
                                  <option name = "virginmobile"> Virgin Mobile </option>
                          </select>
                          <div class = "input-group-append"><input type = "submit" name = "change-telenum" class = "btn btn-primary" value = "Change telephone number"/></div>
                     </div>
               </form>
               <?php
                  if(isset($_POST['change-telenum']))
                  {
                     $newtele = $_POST['newtelenum'];
                     $newnetwork = $_POST['tele-network'];

                     $infoupdate -> updateTeleNum($UserId, $newtele, $newnetwork);
                  }
               ?>
          </div>

          <!-- Change profile picture -->
          <div class = "container" style = "margin-top: 5%; font-family: serif;">
               <h4 style = "text-align: center;"> Change profile image here </h4>

               <form method = "POST" action = "profile.php" enctype = 'multipart/form-data' class = "d-flex justify-content-center">
                     <div class = "input-group">
                          <div class = "custom-file">
                               <input type = "file" name = "newprofilepic" class = "custom-file-input" id = "profilePic"/>
                               <label class = "custom-file-label" for = "profilePic"> Choose file </label>
                          </div>
                          <div class = "input-group-append"><input type = "submit" class = "btn btn-primary" name = "change-profilepic" value = "Change picture"/></div>
                     </div>
               </form>
               <?php
                 if(isset($_POST['change-profilepic']))
                 {
                    $infoupdate -> updatePicture($UserId);
                 }
               ?>
          </div>
     </body>
</html>
