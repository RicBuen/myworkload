<?php
   session_start();

   include 'includes/taskmanager.php';
?>
<html lang = "en">
     <head>
          <title> Personal Task Manager </title>

          <meta charset = "utf-8"/>
          <meta name = "viewport" content = "width=device-width, initial-scale=1"/>

          <!-- Link the Bootstrap 4 CDN CSS files -->
          <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
          <!-- Link the Bootstrap 4 CDN JS and jQuery files (must be in this order: jQuery, Popper, Bootstrap.js) -->
          <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
          <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>

          <!-- AJAX files (for displaying data from the database using AJAX) -->
          <!-- For the Task Page -->
          <script src = "js/addTasks.js"></script>  <!-- For displaying the table responsible for adding new user tasks -->
          <script src = "js/displayTasks.js"></script> <!-- For displaying list of user tasks in the 'displayTasks' form -->
          <!-- For the Daily Schedule page -->
          <script src = "js/displaySchedule.js"></script>
          <!-- For the Future Task page -->
          <script src = "js/displayFutureList.js"></script>

          <!-- For displaying the date -->
          <script src = 'js/date.js'></script>

          <!-- For changing the input time fields from 24 hour clock to 12 hour clock -->
          <script src = 'js/time.js'></script>

          <style>
               /* This just hides the background of the input type=text for the task page to make it look like plain text is being displayed */
               .taskValues
               {
                  background: transparent;
                  border: none;

                  color: white;

                  font-family: serif;
                  text-align: center;
               }
          </style>
     </head>

     <body onload = "setDate()">
           <!-- Navbar -->
           <nav class = "navbar bg-light navbar-expand-md">
                <!-- Greeting -->
                <ul class = "navbar-nav mr-auto">
                    <li class = "nav-item"> <a href = "#" class = "nav-link" style = "font-family: serif; text-decoration: none;"> Hello: <?php echo $_SESSION['username']; ?> </a> </li>
                </ul>
                <!-- Display user status -->
                <ul class = "navbar-nav mx-auto">
                    <li class = "nav-item"> <a href = "#" class = "nav-link" style = "font-family: serif; text-decoration: none;"> Status: <?php echo $_SESSION['status']; ?> </a> </li>
                </ul>
                <!-- Logout and profile page links -->
                <ul class = "navbar-nav ml-auto">
                    <li class = "nav-item"> <a class = "nav-link" href = "profile.php"> <?php echo "<img src = '".$_SESSION['profilepic']."' width = '30px' height = '30px'/>"; ?> </a> </li>
                    <li class = "nav-item"> <a class = "nav-link text-dark" href = "includes/logout.php"> Logout </a> </li>
                </ul>
           </nav>

           <div class = "d-flex bg-primary">
                <!-- Tabs that will open the task page, daily schedule page and future task page -->
                <div class = "bg-success">
                     <ul class = "nav nav-tabs flex-column">
                         <li class = "nav-item"> <a data-toggle = "tab" class = "nav-link text-white" href = "#task-page"> Go to Tasks Page </a> </li>
                         <li class = "nav-item"> <a data-toggle = "tab" class = "nav-link text-white" href = "#schedule-page"> Go to Daily Schedule Page </a> </li>
                         <li class = "nav-item"> <a data-toggle = "tab" class = "nav-link text-white" href = "#futuretask-page"> Go to Future Tasks Page </a> </li>
                     </ul>
                </div>

                <!-- Contains the Task page, the Daily Schedule page and Future Task page -->
                <div class = "flex-grow-1 tab-content bg-info table-responsive">
                     <!-- This is just to greet the user when they log in (will be hidden once user clicks one of the buttons) -->
                     <div id = "greetings-page" class = "flex-grow-1 container-fluid tab-pane active">
                          <h2 style = "font-family: serif; text-align: center; color: #F0FFF0;"> Welcome to your task manager </h2>
                          <h4 style = "font-family: serif; text-align: center; margin-top: 50px; color: #F0FFF0;"> Manage all your daily tasks and manage your schedule here </h4>
                          <p style = "font-family: serif; text-align: center; color: #F0FFF0;"> <em> Click on one of the tabs on the left to manage your schedule or task list </em> </p>
                     </div>

          <!--*******************************************************************************************************************************-->

                     <!-- Task Page -->
                     <div id = "task-page" class = "flex-grow-1 container-fluid tab-pane fade">
                          <!-- For adding new tasks -->
                          <form id = "addTasks" action = "home.php" method = "POST" style = "margin-top: 3%;"></form>
                          <?php
                              if(isset($_POST['submitInfo']))
                              {
                                 $userid = $_SESSION['userid'];
                                 $usertask = $_POST['addTask'];
                                 $usernotes = $_POST['addNotes'];
                                 $taskType = "";

                                 if(isset($_POST['taskType']))
                                 {
                                    $type = $_POST['taskType'];

                                    switch($type)
                                    {
                                       case 'Personal Task':
                                          $taskType = "Personal Task";
                                          break;
                                       case 'Work Task':
                                          $taskType = "Work Task";
                                          break;
                                       case 'School Task':
                                          $taskType = "School Task";
                                          break;
                                       default:
                                          echo "<p id = 'warningMessage'> You must choose the type of task! </p>";
                                          break;
                                    }
                                 }

                                 $addTask = new UserTasks();
                                 $addTask -> addTask($userid, $usertask, $usernotes, $taskType);
                              }
                          ?>

                          <!-- For displaying list of user tasks -->
                          <form id = "displayTasks" action = "home.php" method = "POST" style = "margin-top: 15%;"></form>
                          <?php
                             //For the 'Add to daily schedule' button
                             for($x = 1; $x <= 100; $x++) //for getting the task_id
                             {
                               if(isset($_POST['addtoschedule|'.$x.'|']))
                               {
                                  $userid = $_SESSION['userid'];
                                  $taskid = $_POST['usertaskid|'.$x.'|'];
                                  $taskdesc = $_POST['usertask|'.$x.'|'];
                                  $addnotes = $_POST['usernotes|'.$x.'|'];
                                  $tasktype = $_POST['usertasktype|'.$x.'|'];
                                  $taskpriority = "";
                                  $starttime = $_POST['start-time|'.$x.'|'];
                                  $endtime = $_POST['end-time|'.$x.'|'];

                                  if(isset($_POST['priority|'.$x.'|']))
                                  {
                                     $prioritytype = $_POST['priority|'.$x.'|'];

                                     switch($prioritytype)
                                     {
                                        case 'Low':
                                           $taskpriority = "Low";
                                           break;
                                        case 'Medium':
                                           $taskpriority = "Medium";
                                           break;
                                        case 'High':
                                           $taskpriority = "High";
                                           break;
                                        default:
                                           echo "<p id = 'warningMessage'> You must select a priority of the task! </p>";
                                           break;
                                     }
                                  }

                                  $addusertask = new UserSchedule();
                                  $addusertask -> addusertask($userid, $taskid, $taskdesc, $addnotes, $tasktype, $taskpriority, $starttime, $endtime);
                               }
                             }
                          ?>
                          <?php
                          //For the 'Add to Future Tasks list' button
                          for($x = 1; $x < 100; $x++)
                          {
                             if(isset($_POST['addtofuturelist|'.$x.'|']))
                             {
                               $userid = $_SESSION['userid'];
                               $taskid = $_POST['usertaskid|'.$x.'|'];
                               $taskdesc = $_POST['usertask|'.$x.'|'];
                               $addnotes = $_POST['usernotes|'.$x.'|'];
                               $tasktype = $_POST['usertasktype|'.$x.'|'];
                               $taskpriority = "";
                               $starttime = $_POST['start-time|'.$x.'|'];
                               $endtime = $_POST['end-time|'.$x.'|'];

                               if(isset($_POST['priority|'.$x.'|']))
                               {
                                  $prioritytype = $_POST['priority|'.$x.'|'];

                                  switch($prioritytype)
                                  {
                                     case 'Low':
                                        $taskpriority = "Low";
                                        break;
                                     case 'Medium':
                                        $taskpriority = "Medium";
                                        break;
                                     case 'High':
                                        $taskpriority = "High";
                                        break;
                                     default:
                                        echo "<p id = 'warningMessage'> You must select a priority of the task! </p>";
                                        break;
                                  }
                               }

                               $storeusertask = new UserFuturelist();
                               $storeusertask -> addusertask($userid, $taskid, $taskdesc, $addnotes, $tasktype, $taskpriority, $starttime, $endtime);
                             }
                          }
                          ?>
                          <?php
                             //For the 'Delete Task' button
                             for($x = 1; $x < 100; $x++)
                             {
                                if(isset($_POST['deletetask|'.$x.'|']))
                                {
                                   $deleteTask = new UserTasks();
                                   $deleteTask -> deletetask($_SESSION['userid'], $x);
                                }
                             }
                          ?>
                     </div>

         <!--*******************************************************************************************************************************-->

                     <!-- Daily Schedule page -->
                     <div id = "schedule-page" class = "flex-grow-1 container-fluid tab-pane fade">
                          <h1 style = "text-align: center; font-family: serif; color: #F0FFF0;"> Welcome to your daily schedule </h1>
                          <form id = "scheduleList" method = "POST" action = "home.php" style = "margin-top: 5%;"></form>
                          <?php
                             //For the 'Remove from schedule' button
                             for($x = 1; $x <= 100; $x++)
                             {
                               if(isset($_POST['deleteTask|'.$x.'|']))
                               {
                                  $deleteScheduletask = new UserSchedule();
                                  $deleteScheduletask -> deleteusertask($_SESSION['userid'], $x);
                               }
                             }
                          ?>
                          <?php
                             //For the 'Add email alert' button
                             for($x = 1; $x <= 100; $x++)
                             {
                                if(isset($_POST['addemailalert|'.$x.'|']))
                                {
                                   $addEmailAlert = new UserSchedule();
                                   $addEmailAlert -> addemailalert($_SESSION['userid'], $x, $_SESSION['email']);
                                }
                             }
                          ?>
                          <?php
                             $textaddress = $_SESSION['telephone'];

                             //For the 'Add text alert' button
                             for($x = 1; $x <= 100; $x++)
                             {
                                if(isset($_POST['addtextalert|'.$x.'|']))
                                {
                                   $addTextAlert = new UserSchedule();
                                   $addTextAlert -> addtextalert($_SESSION['userid'], $x, $textaddress);
                                }
                             }
                          ?>
                     </div>

        <!--*******************************************************************************************************************************-->

                     <!-- Future Task page -->
                     <div id = "futuretask-page" class = "flex-grow-1 container-fluid tab-pane fade">
                          <h1 style = "text-align: center; font-family: serif; color: #F0FFF0;"> Welcome to your list of future tasks </h1>
                          <form id = "futuretask-list" method = "POST" action = "home.php" style = "margin-top: 5%;"></form>
                          <?php
                             //For the 'Delete task from your future task list' button
                             for($x = 1; $x <= 100; $x++)
                             {
                               if(isset($_POST['deleteFutureTask|'.$x.'|']))
                               {
                                  $deleteFuturetask = new UserFuturelist();
                                  $deleteFuturetask -> deleteusertask($_SESSION['userid'], $x);
                               }
                             }
                          ?>
                          <?php
                             //For the 'Add task to daily schedule' button
                             for($x = 1; $x <= 100; $x++)
                             {
                               if(isset($_POST['addTaskSchedule|'.$x.'|']))
                               {
                                  $addtoSchedule = new UserFuturelist();
                                  $addtoSchedule -> addtoDailySchedule($_SESSION['userid'], $x);
                               }
                             }
                          ?>
                     </div>
                </div>
           </div>
     </body>
</html>
