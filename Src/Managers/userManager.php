<?php

/**
 * @author     Jean-Marie HOLLAND <illaweb35@gmail.com>
 * @copyright  (c) 2018, Jean-Marie HOLLAND. All Rights Reserved.
 * @license    Lesser General Public Licence <http://www.gnu.org/copyleft/lesser.html>
 * @link       https://illaweb.fr
 */

namespace Src\Managers;

use App\Dbd;
use App\Alert;
use App\Check;
use App\Verif;


class userManager
{
    private $_pdo;
    public function __construct()
    {
        $this->_pdo = new Dbd;
    }

    public function Connexion()
    {
        $request = $this->_pdo->prepare('SELECT * FROM T_users WHERE username=:username');
        $request->execute([':username' => Verif::filterName($_POST['username'])]);
        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Src\Entity\User');
        if ($request->rowCount() == 1) {
            $user = $request->fetch();
            if (\password_verify(Verif::filterString($_POST['password']), $user->getPassword())) {
                if (\session_status() == PHP_SESSION_NONE) {
                    \session_start();
                    session_name('Alaska_MonBlog');
                }
                $_SESSION = $user;
                $_SESSION['authenticated'] = true;
                $_SESSION['token_encrypted'] = \uniqid();
                $_SESSION['token'] = Check::mixMdp($_SESSION['token_encrypted']);
                $_SESSION['name'] = $user->getUsername();
                //redirection vers le tableau de board
                header('Location:' . \BASEPATH . 'Back/Dashboard');
                exit();
            }
        } else {
            Alert::getError($errorMsg = " Erreur, Mauvais couple d'identifiant!");
        }
    }

    public function Read($id)
    {
        $request = $this->_pdo->prepare("SELECT * FROM T_users WHERE id_user = :id LIMIT 1");
        $request->bindValue(':id', (int) $id, \PDO::PARAM_INT);
        $request->execute();
        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Src\Entity\User');
        return $users = $request->fetch();
        $request->closeCursor();
    }

    public function UserAll()
    {
        $request = $this->_pdo->query('SELECT * FROM T_users ORDER BY create_at DESC');
        $request->execute();
        $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Src\Entity\User');
        $users = $request->fetchAll();
        $request->closeCursor();
        return $users;
    }

    public function Create()
    {
        $username = $email = $password = $create_at = $modif_at = "";
        if (empty($_POST['username'])) {
            Alert::getError('Merci d\'entrer un nom ou pseudo');
        } else {
            $username = Verif::filterName($_POST['username']);
            if ($username == false) {
                Alert::getError('Votre non ou pseudo n\'est pas valide');
            }
        }
        if (empty($_POST['email'])) {
            alert::getError('Merci de renseigner une adresse email');
        } else {
            $email = Verif::filterEmail($_POST['email']);
            if ($email == false) {
                Alert::getError('Adresse email non valide , merci de vérifier le format!');
            }
        }
        $password = Check::mixMdp(\htmlspecialchars($_POST['password']));
        $create_at = date(DATE_W3C);
        $modif_at = date(DATE_W3C);
        $request = $this->_pdo->query("SELECT* FROM T_users WHERE username = '$username' OR email='$email'");
        $userExist = $request->rowCount();
        if ($userExist == 1) {
            Alert::getError("Nom d'utilisateur ou email deja utilisé");
        } else {
            try {
                $request = $this->_pdo->prepare('INSERT INTO T_users (username, email, password, create_at, modif_at) VALUES (:username, :email, :password,  NOW(),NOW())');
                $request->bindValue(':username', $username, \PDO::PARAM_STR);
                $request->bindValue(':email', $email, \PDO::PARAM_STR);
                $request->bindValue(':password', $password, \PDO::PARAM_STR);
                $users = $request->execute();
                $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Src\Entity\User');
                $verifIsOk = $users;
                if (!$verifIsOk) {
                    return false;
                } else {
                    $request->closeCursor();
                    return $users;
                }
            } catch (\PDOException $e) {
                throw new \Exception($e->getMessage());
            }
        }
    }

    public function Update($id)
    {
        $username = $email = $password = $modif_at = "";
        if (empty($_POST['username'])) {
            Alert::getError($errorMsg = 'Merci d\'entrer un nom ou pseudo');
        } else {
            $username = Verif::filterName($_POST['username']);
            if ($username == false) {
                Alert::getError($errorMsg = 'Votre non ou pseudo n\'est pas valide');
            }
        }
        if (empty($_POST['email'])) {
            alert::getError($errorMsg = 'Merci de renseigner une adresse email');
        } else {
            $email = Verif::filterEmail($_POST['email']);
            if ($email == false) {
                Alert::getError($errorMsg = 'Adresse email non valide , merci de vérifier le format!');
            }
        }

        $modif_at = date(DATE_W3C);
        try {
            $request = $this->_pdo->prepare('UPDATE T_users SET username=:username,email=:email, modif_at=NOW() WHERE id_user=:id');
            $request->bindValue(':id', (int)$id, \PDO::PARAM_INT);
            $request->bindValue(':username', $username, \PDO::PARAM_STR);
            $request->bindValue(':email', $email, \PDO::PARAM_STR);
            $request->execute();
            $request->setFetchMode(\PDO::FETCH_CLASS | \PDO::FETCH_PROPS_LATE, 'Src\Entity\User');
        } catch (\PDOException $e) {
            throw new \Exception($e->getMessage());
        }
    }

    public function Delete($id)
    {
        $request = $this->_pdo->prepare('DELETE FROM T_users WHERE id_user = :id');
        $request->bindParam(':id', $id, \PDO::PARAM_INT);
        $request->execute();
        return true;
    }
}
