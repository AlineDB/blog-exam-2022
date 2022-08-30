<?php

namespace Blog\Controllers;

use Blog\Models\Post;
use JetBrains\PhpStorm\NoReturn;
use PDOException;

class TokenController extends \Blog\Models\Model
{

    public function index(): array
    {
        //vérifier si token et author correspondent




        //rendering
        $posts = //faire le fichier json dans requête post
        $view_data = [];
        $view_data['view'] = 'token/index.php';
        $view_data['data'] = json_decode('posts'); //reprendre se fichier
        return $view_data;
    }

    public function store(){
        function str_rand(int $length= 32){
            $length= ($length < 4) ? 4 : $length;
            return bin2hex(($length - ($length % 2)) /2);
        }
        $api_token = str_rand().uniqid();
       // $api_token->//faire en sorte que ça s'enregistre dans la BDD
        try {
            $st_token = $this->pdo_connection->prepare(
                <<<SQL
                    INSERT INTO authors(api_token) 
                    VALUES(:api_token);
                SQL
            );
            $st_token->execute([
                ':api_token' => $api_token,

            ]);

            return true;
        } catch (PDOException $exception) {
            return $exception->getMessage();
        }
    }

//requête récupération des posts sont dans models/Post
//add_categories
//add_categories_to_many
//get
//get_unfiltered

}