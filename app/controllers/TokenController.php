<?php

namespace Blog\Controllers;

use Blog\Models\Post;
use JetBrains\PhpStorm\NoReturn;

class TokenController extends \Blog\Models\Model
{

    public function index(): bool|string
    {
        if(isset($_SESSION['connected_author'])){

        }
        header('Location: index.php?action=edit&resource=profile#general-error');
       exit;
    }

    public function store(){
        function str_rand(int $length= 32){
            $length= ($length < 4) ? 4 : $length;
            return bin2hex(($length - ($length % 2)) /2);
        }
        $api_token = str_rand().uniqid();
        $api_token->//faire en sorte que ça s'enregistre
    }




}