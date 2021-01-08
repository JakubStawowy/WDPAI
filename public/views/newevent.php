<!DOCTYPE html>
<head>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;400&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="public/stylecss/style.min.css" type="text/css"/>
    <link rel="stylesheet" href="public/stylecss/newevent.min.css" type="text/css"/>
    <script src="https://kit.fontawesome.com/607b75d37b.js" crossorigin="anonymous"></script>
    <script type="text/javascript" src="public/js/homeScript.js" defer></script>
    <script type="text/javascript" src="public/js/mobileScript.js" defer></script>
    <title>Dodaj wydarzenie</title>
</head>
<body onload="onLoad()">
    <div class="menu-bar">
        <a class="image" href="home">
            <img src="public/img/Graylogo.png">
        </a>
        <ul>
            <li>
                <a href="home">
                    Home
                </a>
            </li>
            <li>
                <a href="eSports">
                    E-sports
                </a>
            </li>
            <li>
                <a href="normalSports">
                    Team-sports
                </a>
            </li>
            <li>
                <a href="newEvent">
                    New event
                </a>
            </li>

        </ul>
    </div>
    <div id="right-side-bar-hidden" class="right-side-bar-hidden">
        <i class="fas fa-angle-up nav-icon"></i>
        <i id="nav-icon-hidden" class="fas fa-angle-left nav-icon"></i>
    </div>
    <div id="right-side-bar" class="right-side-bar">
        <a>
            <i class="fas fa-angle-up nav-icon"></i>
        </a>

            <?
                if(isset($user)){
            ?>
            <img src="public/uploads/<?=$user->getUserDetails()->getImage()?>">
            <?}?>
        <a>
            <?
            if(isset($user)){
                echo $user->getUserDetails()->getName().' '.$user->getUserDetails()->getSurname();
            }
            ?>
        </a>
        <a href="personalProfile">My profile</a>
        <a href="personalProfile">Sports</a>
        <a href="userSignedEvents">Events</a>
        <a href="userEvents">My events</a>
        <a>
            <i class="fas fa-cog"></i>
            Account settings
        </a>
        <a href="logout">
            <i class="fas fa-sign-out-alt"></i>
            Logout
        </a>
        <a>
            <i id="nav-icon" class="fas fa-angle-right nav-icon"></i>
        </a>
    </div>
    <div class="container">
        <div class="bottom-bar">
            <i class="fas fa-bars"></i>
            <a href="home">
                <i class="fas fa-home"></i>
            </a>
            <a href="profile">
                <i class="fas fa-user"></i>
            </a>
            <ul class="bottom-menu">
                <li>
                    <a href="home">
                        Home
                    </a>
                </li>
                <li>
                    <a href="normalSports">
                        Team sports
                    </a>
                </li>
                <li>
                    <a href="eSports">
                        E-sports
                    </a>
                </li>
                <li>
                    <a href="addEvent">
                        New event
                    </a>
                </li>
            </ul>
        </div>
        <form action="addEvent" method="POST" class="new-event-section" ENCTYPE="multipart/form-data">
            <h2>
                New event
            </h2>
            <button type="submit" class="publish-button">
                Publish event
            </button>
            <input name="title" class="event-title" type="text" placeholder="Title">
            <input name="sport" class="sport" type="text" placeholder="Sport">
            <input name="numberOfPlayers" class="players" type="text" placeholder="Number of players">
            <input type="file" name="file" class="image-button">
                <!-- <i class="fas fa-image"></i>
                <a>
                    Picture (optional)
                </a> -->
            </input>
            <textarea name="description" class="description" placeholder="Description, requirements"></textarea>
            <div class="date-location">
                <div class="date">
                    <i class="fas fa-calendar-alt"></i>
                    <a>
                        Date
                    </a>
                </div>
                <div class="location">
                    <i class="fas fa-map-marker-alt"></i>
                    <a>
                        Location (optional)
                    </a>
                </div>
            </div>
            
            <?php
                if(isset($messages)){
                    foreach ($messages as $message){
                        echo $message;
                    }
                }
            ?>
        </form>
    </div>
</body>