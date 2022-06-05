<?php get_header('Rejestracja', ['register.css']); ?>
<div class="container">
    <h1>Zarejestruj się</h1>

    <form class="formu" method="post" action="/register">
        <label for="username">Imię:</label>
        <input class="input" type="text" placeholder="wprowadź imię" name="username">
        <span class="invalidFeedback">
            <?php echo $data['usernameError']; ?>
        </span>
        <label for="surname">Nazwisko:</label>
        <input class="input" type="text" placeholder="wprowadź nazwisko" name="surname">
        <span class="invalidFeedback">
            <?php echo $data['surnameError']; ?>
        </span>
        <label for="login">Login:</label>
        <input class="input" type="text" placeholder="wprowadź login" name="login">
        <span class="invalidFeedback">
            <?php echo $data['loginError']; ?>
        </span>
        <label for="email">E-mail:</label>
        <input class="input" type="text"  placeholder="wprowadź swojego maila"  name="email"/>
        <span class="invalidFeedback">
            <?php echo $data['emailError']; ?>
        </span>
        <label for="password">Hasło:</label>
        <input class="input" type="password" name="password" placeholder="wprowadź hasło"/>
        <span class="invalidFeedback">
            <?php echo $data['passwordError']; ?>
        </span>
        <label for="password">Powtórz hasło:</label>
        <input class="input" type="password" name="confirmPassword" placeholder="wprowadź ponownie hasło"/>
        <span class="invalidFeedback">
            <?php echo $data['confirmPasswordError']; ?>
        </span>
        <button class="submit-button" type="submit">Wyslij</button>
    </form>
    </div>
<?php get_footer(); ?>