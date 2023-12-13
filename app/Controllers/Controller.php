<?php

namespace App\Controllers;

use Pecee\SimpleRouter\SimpleRouter as Router;

class Controller
{

    public function input(string $key, $default = null)
    {
        return Router::request()->getInputHandler()->value($key, $default);
    }

    public function view(string $name, array $vars, int $statusCode = 200)
    {
        http_response_code($statusCode);

        foreach ($vars as $key => $value) {
            $$key = $value;
        }

        require(__DIR__ . "/../../views/$name.view.php");
    }

    public function json(array $data, int $statusCode = 200)
    {

        http_response_code($statusCode);
        header("Content-Type: application/json");

        echo json_encode($data);
    }
}
