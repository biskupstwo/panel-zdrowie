<?php get_header('Profil', ['profile.css']); ?>
<?php guard_route('/'); ?>

    <div hidden id="miniwindow">
        <div id="bard">
            <ul class="buttons">
                <li class="close"></li>
                <li class="minimize"></li>
                <li class="maximize"></li>
            </ul>
            <p class="title">Profil</p>
        </div>

        <div id="pole">
            <?php echo $_SESSION['login']; ?>
            <span class="dot"></span>
            <?php echo get_role($_SESSION['user_role']); ?>
            <br />
        </div>
    </div>




    <br>
    <?php get_footer(); ?>