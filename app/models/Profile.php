<?php
namespace Blog\Models;
use Blog\Models\Author;
use PDO;

class Profile extends \Blog\Models\Model
{

        if (isset($_SESSION['id'])){
        $requser =
            protected PDO $pdo_connection->prepare("SELECT * FROM authors WHERE id = ?");
            $requser->execute(array($_SESSION['id']));
            $user = $requser->fetch();

            if (isset($_POST['newmail']) and !empty($_POST['newmail']) and $_POST['newmail'] != $authors['mail']) {
                    $newmail = htmlspecialchars($_POST['newmail']);
                    $insertmail = $pdo_connection->prepare("UPDATE authors SET email = ? WHERE id = ?");
                    $insertmail->execute(array($newmail, $_SESSION['id']));
                    header('Location: profile.php?id=' . $_SESSION['id']);
                }

        if (isset($_POST['newmdp1']) and !empty($_POST['newmdp1']) and isset($_POST['newmdp2']) and !empty($_POST['newmdp2'])) {
            $mdp1 = sha1($_POST['newmdp1']);
            $mdp2 = sha1($_POST['newmdp2']);
            if ($mdp1 == $mdp2) {
                $insertmdp =$requser->prepare("UPDATE authors SET password = ? WHERE id = ?");
                $insertmdp->execute(array($mdp1, $_SESSION['id']));
                header('Location: profile.php?id=' . $_SESSION['id']);
            } else {
                $msg = "Vos deux mdp ne correspondent pas !";
            }
        }
if(isset($_FILES['avatar']) AND !empty($_FILES['avatar']['name'])) {
    $tailleMax = 2097152;
    $extensionsValides = array('jpeg', 'png');
    if($_FILES['avatar']['size'] <= $tailleMax) {
        $extensionUpload = strtolower(substr(strrchr($_FILES['avatar']['name'], '.'), 1));
        if(in_array($extensionUpload, $extensionsValides)) {
            $chemin = "membres/avatars/".$_SESSION['id'].".".$extensionUpload;
            $resultat = move_uploaded_file($_FILES['avatar']['tmp_name'], $chemin);
            if($resultat) {
                $updateavatar = $PDO->prepare('UPDATE authors SET avatar = :avatar WHERE id = :id');
                $updateavatar->execute(array(
                    'avatar' => $_SESSION['id'].".".$extensionUpload,
                    'id' => $_SESSION['id']
                ));
                header('Location: profile.php?id='.$_SESSION['id']);
            } else {
                $msg = "Erreur durant l'importation de votre photo de profil";
            }
        } else {
            $msg = "Votre photo de profil doit être au format jpeg ou png";
        }
    } else {
        $msg = "Votre photo de profil ne doit pas dépasser 2Mo";
    }
}

}