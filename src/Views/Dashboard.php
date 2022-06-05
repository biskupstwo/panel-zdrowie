<?php get_header('Dashboard', ['dashboard.css']); ?>
<?php guard_route('/'); ?>
<div class="container">
<div id="miniwindow" style="visibility:hidden">
        <div id="bard">
            <ul class="buttons">
                <li  id="closemini" class="close"></li>
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
    <div class="window">
        <div class="bar">
            <ul class="buttons">
                <li class="close"></li>
                <li class="minimize"></li>
                <li class="maximize"></li>
            </ul>
            <p class="title">Panel</p>
        </div>
        <div class="dash">
            <div>

                    <a class="shortcut" id="non" href="javascript:window.alert('do zrobienia');">
                        <div class="healthcard"></div>
                        <p>karta zdrowia</p>
                    </a>
                    <a class="shortcut" id="non" href="javascript:window.alert('do zrobienia');">
                        <div class="l4"></div>
                        <p>zaświadczenia</p>
                    </a>
                    <a class="shortcut" id="non" href="javascript:window.alert('do zrobienia');">
                        <div class="reservation"></div>
                        <p>rezerwacje</p>
                    </a>
                    <a class="shortcut" id="non" href="javascript:window.alert('do zrobienia');">
                        <div class="department"></div>
                        <p>oddział</p>
                    </a>
                    <a id="profile" class="shortcut">
                        <div class="profile"></div>
                        <p>profil</p>
                    </a>
                    <a class="shortcut" id="non" href="javascript:window.alert('do zrobienia');">
                        <div class="protest"></div>
                        <p>protest</p>
                    </a>
                    <a class="shortcut" id="non" href="javascript:window.alert('do zrobienia');">
                        <div class="chadsans"></div>
                        <p>chadsans</p>
                    </a>
            </div>
        </div>


    </div>
</div>

</div>
</div>

<?php get_footer() ?>