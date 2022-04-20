<?php

/**
 * @author     Jean-Marie HOLLAND <illaweb35@gmail.com>
 * @copyright  (c) 2018, Jean-Marie HOLLAND. All Rights Reserved.
 * @license    Lesser General Public Licence <http://www.gnu.org/copyleft/lesser.html>
 * @link       https://illaweb.fr
 */

namespace Src\Controllers;

use App\Viewer;

class Back extends Main
{
    public function Index()
    {
        if (!isset($_SESSION['authenticated'])) {
            header('Location:' . \BASEPATH . 'Front/Index');
        }
    }

    public function Dashboard()
    {
        if (!isset($_SESSION['authenticated'])) {
            header('Location:' . \BASEPATH . 'Front/Index');
        }
        $billets = $this->billetManager->ReadFront(0, 100);
        $all_billets = $this->billetManager->readAll();
        $comments = $this->commentManager->ReadAll();
        $commentModerate = $this->commentManager->ReadModerate();
        $users = $this->userManager->UserAll();
        $view = new Viewer('Back/Dashboard', "Mon Blog _ Tableau de bord");
        $view->createFile(['billets' => $billets, 'all_billets' => $all_billets, 'comments' => $comments, 'users' => $users, 'commentModerate' => $commentModerate]);
    }

    public function ListPost()
    {
        $billets = $this->billetManager->ReadAll(0, 100);
        $view = new Viewer('Back/List', 'Liste des billets');
        $view->createFile(['billets' => $billets]);
    }

    public function ListUsers()
    {
        if (!isset($_SESSION['authenticated'])) {
            header('Location:' . \BASEPATH . 'Front/Index');
        }
        $users = $this->userManager->UserAll();
        $view = new Viewer('Back/ListUsers', 'Alaska _ Paramètres');
        $view->createFile(['users' => $users]);
    }

    public function Check($id)
    {
        $comment = $this->commentManager->Moderate($id);
        if ($comment !== false) {
            header('Location:' . \BASEPATH . 'Back/Dashboard/' . $comment);
            exit();
        }
    }
}
