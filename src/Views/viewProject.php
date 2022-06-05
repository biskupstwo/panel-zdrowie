

<?php get_header('widok projektów', ['projects.css']); ?>
<h1>Widok projektów</h1>
<div class="projekty">
    <div class="naglowki">
                    <p class="entry">Nazwa</p>
                    <p class="entry">Opis</p>
                    <p class="entry">Data utworzenia</p>
                    <p class="entry">Menago projektu</p>

        </div>    
        <?php foreach ($data['projects'] as $project){?>
            <div class="projekt">
                <p class="entry"><?php echo $project['name']; ?></p>
                <p class="entry"><?php echo $project['description']; ?></p>
                <p class="entry"><?php echo $project['creation_date']; ?></p>
                <p class="entry"><?php echo $project['project_manager']; ?></p>

            </div>
        <?php
        }
        ?>
    </div>
<?php get_footer()?>