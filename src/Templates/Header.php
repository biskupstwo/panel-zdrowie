<!DOCTYPE html>
<html lang="pl">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>PanelZdrowie - <?php echo $title ?></title>
    <link rel="stylesheet" href="src/Styles/style.css">
    <?php
    if (isset($styles) && is_array($styles)) {
        load_css($styles);
    }
    ?>
</head>

<body>
    <style>
        
    </style>
    <div class="wrapper">
        <div class="nav_wrapper">
            <nav>
            <?php
                if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) :
            ?>
                <a href="/dashboard" class="logo">PanelZdrowie</a>
            <?php else : ?>
                    <a href="/" class="logo">PanelZdrowie</a>
            <?php endif; ?>
                <ul>
                    <?php
                    if (isset($_SESSION['logged_in']) && $_SESSION['logged_in']) :
                    ?>
                        <div class="dropdown">
                            <li style="float:right;"><a onclick="myFunction()" class="dropbtn"><?php echo $_SESSION['login']; ?></a></li>
                            <div id="myDropdown" class="dropdown-content">
                                <a href="/dashboard">ustawienia</a>
                                <a href="/logout">wyloguj</a>
                            </div>
                        </div>
                    <?php else : ?>
                        <li style="float:right"><a href="/login">Zaloguj się</a></li>
                    <?php endif; ?>
                </ul>
            </nav>
        </div>
        <script>
            function myFunction() {
                document.getElementById("myDropdown").classList.toggle("show");
            }

            window.onclick = function(event) {
                if (!event.target.matches('.dropbtn')) {
                    var dropdowns = document.getElementsByClassName("dropdown-content");
                    var i;
                    for (i = 0; i < dropdowns.length; i++) {
                        var openDropdown = dropdowns[i];
                        if (openDropdown.classList.contains('show')) {
                            openDropdown.classList.remove('show');
                        }
                    }
                }
            }
        </script>