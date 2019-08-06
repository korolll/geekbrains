<?php
class UserController extends Controller
{
    public $view = 'user';
    public $title = 'user';
    
    public function register()
    {
        if (!empty($_POST['userName']) && !empty($_POST['password']) && !empty($_POST['repeatPassword'])) {
            if ($_POST['password'] !== $_POST['repeatPassword']) {
                    return [];
            }
            $user = new User([
                'name' => $_POST['userName'],
                'password' => md5($_POST['password']),
            ]);

            if ($user->create()) {
                $this->goToMain();
            }
        }
        return [];
    }

    public function login()
    {
        if (!empty($_POST['userName']) && !empty($_POST['password'])) {
            $user = new User([
                'name' => $_POST['userName'],
                'password' => md5($_POST['password']),
            ]);

            if ($user->login()) {
                $_SESSION['userName'] = $user->name;
                $this->goToMain();
            }
        }
        return [];
    }

    public function logout()
    {
        unset($_SESSION['userName']);
        unset($_SESSION['data']);
        $this->goToMain();
    }

    public function profile()
    {
        return [];
    }


}