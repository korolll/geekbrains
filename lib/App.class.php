<?php

class App
{
    public static function Init()
    {
        date_default_timezone_set('Europe/Moscow');
        db::getInstance()->Connect(Config::get('db_user'), Config::get('db_password'), Config::get('db_base'));
        session_start();

        if (php_sapi_name() !== 'cli' && isset($_SERVER) && isset($_GET)) {
            self::web(isset($_GET['path']) ? $_GET['path'] : '');
        }
    }

    protected static function web($url)
    {
        if (!empty($url)) {
            $url = explode("/", $url);
            $_GET['page'] = $url[0];
            if (isset($url[1])) {
                if (is_numeric($url[1])) {
                    $_GET['id'] = $url[1];
                } else {
                    $_GET['action'] = $url[1];
                }
                if (isset($url[2])) {
                    $_GET['id'] = $url[2];
                }
            }
        } else {
            $_GET['page'] = 'Index';
        }

        if (isset($_GET['page'])) {
            $controllerName = ucfirst($_GET['page']) . 'Controller';
            $methodName = isset($_GET['action']) ? $_GET['action'] : 'index';
            $controller = new $controllerName();
            $session = [];
            if (isset($_SESSION['userName'])) {
                $currentUrl = (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? "https" : "http") . "://{$_SERVER['HTTP_HOST']}{$_SERVER['REQUEST_URI']}";
                static::setUrlToSession($currentUrl);
            }
            $data = [
                'content_data' => $controller->$methodName($_GET),
                'title' => $controller->title,
                'categories' => Category::getCategories(0),
                'session' => $_SESSION,
            ];

            $view = $controller->view . '/' . $methodName . '.html';
            if (!isset($_GET['asAjax'])) {
                $loader = new Twig_Loader_Filesystem(Config::get('path_templates'));
                $twig = new Twig_Environment($loader);
                $template = $twig->loadTemplate($view);

                echo $template->render($data);
            } else {
                echo json_encode($data);
                return true;
            }
        }
    }

    private static function setUrlToSession($url)
    {
        if (!isset($_SESSION['history'])) {
            $_SESSION['history'] = [];
        }
        if (count($_SESSION['history']) == 5) {
            array_shift($_SESSION['history']);
        }
        $_SESSION['history'][] = $url;
    }


}