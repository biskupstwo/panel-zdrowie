<?php
require 'src/Framework/App.php';
require PROJECT_ROOT . '/Controller/UserController.php';
require PROJECT_ROOT . '/Controller/RegisterController.php';
require PROJECT_ROOT . '/Controller/LoginController.php';
require PROJECT_ROOT . '/Controller/TimerController.php';
require PROJECT_ROOT . '/Controller/ClientController.php';
require PROJECT_ROOT . '/Controller/ProjectController.php';
require PROJECT_ROOT . '/Controller/ViewProjectController.php';
require PROJECT_ROOT . '/Controller/EditController.php';
require PROJECT_ROOT . '/Controller/DeleteController.php';
use Framework\App\App;

session_start();
$app = new App();

$app->add_route('/', view('HomePage'));
$app->add_route('/register', [RegisterController::class, 'register']);
$app->add_route('/createClient', [ClientController::class, 'createClient']);
$app->add_route('/createProject', [ProjectController::class, 'createProject']);
$app->add_route('/viewProject', [ViewProjectController::class, 'viewProject']);

//$app->add_route('/timerEE', view('timerEE'));
$app->add_route('/edit',[EditController::class, 'edit']);
$app->add_route('/login', [LoginController::class, 'login']);
$app->add_route('/logout', [LoginController::class, 'logout']);
$app->add_route('/profile', view('Profile'));
$app->add_route('/timer', [TimerController::class, 'show']);
$app->add_route('/dashboard',view('Dashboard'));
$app->add_route('/user/{id}', [UserController::class, 'show']);
$app->add_route('/delete', [DeleteController::class,'delete']);


$app->run();
