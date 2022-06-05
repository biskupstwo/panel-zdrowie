<?php get_header('Edycja wpisu', ['register.css']); ?>
<?php
if (isset($_GET['id'])) : {
                $_SESSION['tid'] = $_GET['id'];
        }
endif;
?>
<div class="container">
        <h1>EDYCJA WPISU</h1>
        <form class="formu" method="post" action="/edit">
                <input class="input" type="text" placeholder="zmien nazwe" name="task_name">
                <button class="submit-button" type="submit">Zatwierdź zmiany</button>
        </form>
</div>
<?php get_footer(); ?>