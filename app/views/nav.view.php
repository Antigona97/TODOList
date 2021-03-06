<!DOCTYPE html>
<html lang="en">
<head>
    <title>To Do List</title>
    <link rel="stylesheet" type="text/css" media="all" href="app/public/style.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css"/>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link rel="stylesheet" href="http://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
    <link href='../packages/core/main.css' rel='stylesheet' />
    <link href='../packages/daygrid/main.css' rel='stylesheet' />
    <link href='../packages/list/main.css' rel='stylesheet' />
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <script type="text/javascript" src="http://jqueryui.com/latest/ui/ui.datepicker.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.8.2/moment.min.js"></script>
    <script src='../packages/core/main.js'></script>
    <script src='../packages/interaction/main.js'></script>
    <script src='../packages/daygrid/main.js'></script>
    <script src='../packages/list/main.js'></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js" integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous"></script>
</head>
<body>
<div id="content" class="main_content" >
<div class="navbar navbar-light navbar-fixed-right">
    <?php if(isset($_SESSION['account'])){ ?>
    <form class="form-inline" method="get" action="/searchTasks">
        <input class="form-control mr-sm-2" name="searchTask" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-dark my-2 my-sm-0" type="submit">Search</button>
        <div class="nav-item dropdown">
            <button type="button" class="btn btn-outline-dark dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
            <div class="dropdown-menu">
                <a class="dropdown-item" href="/profile">Profile</a>
                <a class="dropdown-item" href="/logout">Logout</a>
            </div>
        </div>
    </form>
</div>
<!-- The sidebar -->
<div class="navbar align-items-baseline navbar-inverse navbar-fixed-left">
    <ul class="nav navbar-nav">
        <li><a class="navbar-brand active" href="/today">Today</a></li>
        <li><a class="navbar-brand" href="/allTasks">All Tasks</a></li>
        <li><a class="navbar-brand" href="/completedTasks?completed=1" tabindex="-1">Finished</a></li>
        <li><a class="navbar-brand" href="/calendar">Calendar</a></li>
    </ul>
</div>
<?php } else ?>