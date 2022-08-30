<?php
namespace Blog\Controllers;


use Blog\Models\Author;
use JetBrains\PhpStorm\NoReturn;
use Blog\ViewComposers\AsideData;
use Intervention\Image\ImageManagerStatic;
use Blog\Request\Validators\UpdateProfileRequest;

class ProfileController
{
    use AsideData;
    use UpdateProfileRequest;

    private Author $author;

    public function __construct()
    {
        if (!isset($_SESSION['connected_author'])) {
            header('Location: /?action=login&resource=auth');
            exit;
        }
      //  $this->author = unserialize($_SESSION['connected_author']);
    }

/*Fatal error: Uncaught TypeError: unserialize():
Argument #1 ($data) must be of type string, stdClass given in /var/www/html/controllers/ProfileController.php:24
# Stack trace: #0 /var/www/html/controllers/ProfileController.php(24): unserialize(Object(stdClass)) #1 /var/www/html/index.php(12):
# Blog\Controllers\ProfileController->__construct() #2 {main} thrown in /var/www/html/controllers/ProfileController.php on line 24*/
    //J'ai regardé le unserialize mais aucune conséquence, j'ai vérifié que les données reçues étaient bien des strings ->ok
    //J'ai réussi à avoir accès 1x en tapant en dur le chemin dans l'url mais à chaque données à récupérées (data) = message d'erreur
    //Je n'arrive plus à retrouver cette url et ai tjr se message qu'il veut une string en argument 1 et que c'est une stdClass qui est donné.
    //j'ai testé strval mais message indiquant qu'il n'a pas pu être convertit.
    //stackoverflow recommande d'utiliser Eloquent haha !


    public function edit(): array
    {
        $view_data = [];
        $view_data['view'] = 'profile/edit_form.php';
        //fusionne les deux tableaux
        $view_data['data'] = array_merge(['author' => $this->author], $this->fetch_aside_data());

        return $view_data;
    }

    #[NoReturn] public function update(): void
    {
        if (!$this->has_validation_errors()) {
            $author = unserialize($_SESSION['connected_author']);

            $email = empty($_POST['email']) ? $author->email : $_POST['email'];
            $password = empty($_POST['password']) ? $author->password : password_hash($_POST['password'],
                PASSWORD_DEFAULT);

            $avatar = $author->avatar;
            if ($_FILES['avatar']['tmp_name'] != '') {
                $image = ImageManagerStatic::make($_FILES['avatar']['tmp_name']);
                $image->resize(200, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
                $avatar = 'images/'.uniqid().'.jpg';
                $image->save($avatar, 80);
            }

            $author->update(compact('email', 'password', 'avatar'));
            $_SESSION['connected_author'] = serialize($author);
            header('Location: index.php?action=edit&resource=profile');
            exit;
        } else {
            $_SESSION['old'] = $_POST;
            header('Location: index.php?action=edit&resource=profile#general-error');
            exit;
        }
    }
}