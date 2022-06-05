<?php 

class UserController extends Controller {
    public function show($id) {
        $user = $this->model('User');
        $data = $user->getUserById($id);
        $this->view("User", $data);
    }
}