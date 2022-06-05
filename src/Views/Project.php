<?php get_header('Tworzenie Projektu', ['register.css']); ?>
    <div class="container">
        <h1>Dodaj projekt</h1>
        <form class="formu" method="post" action="/createProject">
            <label for="name">Nazwa projektu:</label>
            <input class="input" type="text" placeholder="wprowadź nazwę projektu" name="name">
            <span class="invalidFeedback">
                <?php echo $data['nameError']; ?>
            </span>
            <label for="description">Opis projektu:</label>
            <input class="input" type="text" placeholder="Opis" name="description">
            <span class="invalidFeedback">
                <?php echo $data['descriptionError']; ?>
            </span>
            <label for="creationDate">Data rozpoczęcia projektu:</label>
            <input class="input" type="date" name="creationDate"/>
            <span class="invalidFeedback">
                <?php echo $data['creationDateError']; ?>
            </span>
            <label for="projectManager">Kierownik Projektu:</label>
            <input class="input" type="text" name="projectManager" placeholder="podaj kierownika projektu"/>
            <span class="invalidFeedback">
                <?php echo $data['projectManagerError']; ?>
            </span>
            <label for="clientId">Przypisz do klienta</label>
            <select name="clientId">
                <option selected value="">-----------------</option>
                <?php
                foreach ($data['clients'] as $key => $value):
                    echo '<option value="' . $key . '">' . $value . '</option>'; //close your tags!!
                endforeach;
                ?>
            </select>
            <span class="invalidFeedback">
                <?php echo $data['clientIdError']; ?>
            </span>
            <button class="submit-button" type="submit">Utwórz</button>
        </form>
    </div>
<?php get_footer(); ?>