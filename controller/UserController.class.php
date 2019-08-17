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

            if ($userDb = $user->login()) {
                $_SESSION['user'] = $userDb;
                $this->goToMain();
            }
        }

        return [];
    }

    public function logout()
    {
        unset($_SESSION['user']);
        unset($_SESSION['data']);
        unset($_SESSION['basket']);
        $this->goToMain();
    }

    public function profile()
    {
        return [];
    }

    public function basket()
    {
        return [];
    }

    public function addToBasket()
    {
        $goodId = $_GET['id'];
        $issetGood = false;
        if (!isset($_SESSION['basket'])) {
            $_SESSION['basket'] = [];
        }
        foreach ($_SESSION['basket'] as $key=>$item) {
            if ($item['id'] == $goodId) {
                $issetGood = true;
                $_SESSION['basket'][$key]['count'] += 1;
            }
        }
        $good = Good::getGood($goodId);

        if (!$issetGood) {
            $_SESSION['basket'][] = [
                'id' => $goodId,
                'name' => $good['name'],
                'price' => $good['price'],
                'count' => 1
            ];
        }

        return [];
    }


}