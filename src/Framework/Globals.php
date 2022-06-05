<?php

/**
 * Get header
 *
 * @return void
 */
function get_header($title = '', array $styles = [])
{
    require_once PROJECT_ROOT . '/Templates/Header.php';
}

/**
 * Get footer
 *
 * @return void
 */
function get_footer(array $js_files = [])
{
    if (count($js_files) > 0) {
        load_js($js_files);
    }
    require_once PROJECT_ROOT . '/Templates/Footer.php';
}

/**
 * Require view file
 *
 * @return void
 */
function view(string $view_name)
{
    return function () use ($view_name) {
        require_once PROJECT_ROOT . '/Views/' . $view_name . '.php';
    };
}

function load_css(array $css_files)
{
    if (empty($css_files)) {
        return;
    }
    foreach ($css_files as $file) {
        if (file_exists(PROJECT_ROOT . '/Styles/' . $file)) {
            echo '<link rel="stylesheet" href="src/Styles/' . $file . '">';
        } else {
            throw new Error('Linked css file does not exist');
        }
    }
}

function guard_route(string $redirect_route)
{
    if (!isset($_SESSION['logged_in'])) {
        header("Location: " . $redirect_route);
        exit();
    }
}

function load_js(array $js_files)
{
    if (empty($js_files)) {
        return;
    }
    foreach ($js_files as $file) {
        if (file_exists(PROJECT_ROOT . '/js/' . $file)) {
            echo '<script src="src/js/'.$file.'"></script>';
        } else {
            throw new Error('Linked js file does not exist');
        }
    }
}


function get_role(int $role_id)
{
    switch ($role_id) {
        case (0):
            return 'user';
        case (1):
            return 'moderator';
        case (2):
            return 'admin';
        default:
            break;
    }
}
