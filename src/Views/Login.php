<?php
get_header('Logowanie', ['login.css']);
?>
<div class="container">
    <form class="formu" action="/login" method="post">
    <div class="bar">
            <ul class="buttons">
                <li class="close"></li>
                <li class="minimize"></li>
                <li class="maximize"></li>
            </ul>
            <p class="title">Zaloguj się</p>
        </div>
        <label for="login">Login</label>
        <input type="text" placeholder="Wprowadź login" name="login" required>
        <label for="password">Hasło</label>
        <input type="password" placeholder="Wprowadź hasło" name="password" required>
        <button type="submit">Zaloguj się</button>
        <?php if (isset($_SESSION['error'])) {
            echo $_SESSION['error'];
        } ?>
    </form>
</div>
<?php get_footer(); ?>