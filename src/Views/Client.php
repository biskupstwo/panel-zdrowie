<?php get_header('Tworzenie Klienta', ['register.css']); ?>
    <div class="container">
        <h1>Dodaj klienta</h1>
        <form class="formu" method="post" action="/createClient">
            <label for="name">Imię:</label>
            <input class="input" type="text" placeholder="wprowadź imię" name="name">
            <span class="invalidFeedback">
                <?php echo $data['nameError']; ?>
            </span>
            <label for="surname">Nazwisko:</label>
            <input class="input" type="text" placeholder="wprowadź nazwisko" name="surname">
            <span class="invalidFeedback">
                <?php echo $data['surnameError']; ?>
            </span>
            <label for="email">E-mail:</label>
            <input class="input" type="text" placeholder="wprowadź swojego maila" name="email"/>
            <span class="invalidFeedback">
                <?php echo $data['emailError']; ?>
            </span>
            <label for="phoneNumber">Numer Telefonu:</label>
            <input class="input" type="text" name="phoneNumber" placeholder="wprowadź numer telefonu"/>
            <span class="invalidFeedback">
                <?php echo $data['phoneNumberError']; ?>
            </span>
            <label for="companyName">Nawa Firmy:</label>
            <input class="input" type="text" name="companyName" placeholder="podaj nazwe firmy"/>
            <span class="invalidFeedback">
                <?php echo $data['companyNameError']; ?>
            </span>
            <label for="city">Adres:</label>
            <input class="input" type="text" name="city" placeholder="podaj miasto"/>
            <span class="invalidFeedback">
                <?php echo $data['cityNameError']; ?>
            </span>
            <input class="input" type="text" name="postalCode" placeholder="podaj kod pocztowy"/>
            <span class="invalidFeedback">
                <?php echo $data['postalCodeNameError']; ?>
            </span>
            <input class="input" type="text" name="street" placeholder="podaj ulicę"/>
            <span class="invalidFeedback">
                <?php echo $data['streetNameError']; ?>
            </span>
            <button class="submit-button" type="submit">Wyslij</button>
        </form>
    </div>
<?php get_footer(); ?>