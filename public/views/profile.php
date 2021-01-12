<?php include('header.php') ?>
    <div class="container">
        <? if(isset($userProfile)){?>
        <section class="profile">
            <div class="profile-data">

                <img src="public/uploads/<?=$userProfile->getUserDetails()->getImage()?>">
                <div class="data">
                    <h2>
                        <?
                            echo $userProfile->getUserDetails()->getName().' '.$userProfile->getUserDetails()->getSurname();
                        ?>
                    </h2>
                    <a>
                        <?
                            echo $userProfile->getUserDetails()->getCountry();
                        ?>
                    </a>
                    <a>
                        <?
                            echo $userProfile->getUserDetails()->getAge();

                        ?>
                    </a>
                    <div class="stars">
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="fas fa-star"></i>
                        <i class="far fa-star"></i>
                    </div>
                </div>
                <div class="profile-settings">
                    <?
                        if($userProfile->getId() == $_COOKIE['id']){
                    ?>
                    <a href="userSettings">
                        <i class="fas fa-cog"></i>
                        profile settings
                    </a>
                    <?
                        }
                        else if($user->getRole() == 'admin' && $userProfile->getRole() == 'normal'){
                    ?>
                        <form action="makeAdmin" method="post">
                            <input type="hidden" name="userId" value="<?= $userProfile->getId() ?>">
                            <button type="submit">
                                <i class="fas fa-toolbox"></i>
                                make admin
                            </button>
                        </form>
                    <?
                        }
                    ?>
                </div>
            </div>
            <section class="event-section">
            <a href="userSignedEvents">Events</a>
            <a href="userEvents">My events</a>
            <?
            if(isset($events)){
                foreach ($events as $event):
                    include('event.php');
                endforeach;
            }
            ?>
            </section>
            <div class="profile-description">

                <h2>
                    About me
                </h2>
                <a>
                    <?
                        echo $userProfile->getUserDetails()->getDescription();
                    ?>
                </a>
            </div>
            <h2>
                Sports
            </h2>
            <div class="profile-sports">
                <div class="sport">
                    <i class="fas fa-volleyball-ball"></i>
                    Volleyball
                </div>
                <div class="sport">
                    <i class="fas fa-laptop"></i>
                    Leauge of legends
                </div>
            </div>
            <section class="profile-feedback">

                <h2>
                    User feedback
                </h2>
                <?
                    if(isset($feedback)){
                        foreach ($feedback as $item):
                ?>
                    <div class="feedback">

                        <div class="image">
                            <img src="public/uploads/<?=$item->getUserImage()?>">
                        </div>
                        <div class="feedback-body">

                            <a class="user date">
                                <?= $item->getAddedByNameSurname()?>
                                <?= $item->getCreatedAt()?>
                            </a>
                            <a>
                                <?= $item->getComment() ?>
                            </a>
                        </div>
                        <div class="stars">
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                            <i class="fas fa-star"></i>
                        </div>
                    </div>

                <?
                    endforeach;
                    }
                    if($userProfile->getId() != $_COOKIE['id']){

                ?>
                        <form action="leaveComment" method="post">
                            <input type="hidden" name="userId" value="<?= $userProfile->getId() ?>">
                            <input class="comment-text" type="text" name="feedback">
                            <input class="comment-submit button-disabled" type="submit" value="leave comment">
                        </form>
                <?
                    }
                ?>
            </section>
        </section>
            <?
        }
        ?>
    </div>
</body>