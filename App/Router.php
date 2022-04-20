<?php

/**
 * @author     Jean-Marie HOLLAND <illaweb35@gmail.com>
 * @copyright  (c) 2018, Jean-Marie HOLLAND. All Rights Reserved.
 * @license    Lesser General Public Licence <http://www.gnu.org/copyleft/lesser.html>
 * @link       https://illaweb.fr
 */

namespace App;

use Src\Controllers\Back;
use Src\Controllers\Backedit;
use Src\Controllers\Front;
use Src\Controllers\Main;

class Router
{
    private $_route;

    public function __construct()
    {
        $this->_route = new Main();
        $this->_route = new Back();
        $this->_route = new Backedit();
        $this->_route = new Front();
    }

    public function initRoute()
    {
        try {
            $url = substr($_SERVER['REQUEST_URI'], strlen(BASEPATH));
            $url = explode('/', filter_var($url, FILTER_SANITIZE_URL));

            if (strlen($url[0]) > 0) {
                $controllerName = 'Src\\Controllers\\' . ucfirst(strtolower($url[0]));
                if (in_array($controllerName, get_declared_classes())) {
                    $this->_route = new $controllerName();

                    if (sizeof($url) > 1) {
                        $method = strtolower($url[1]);
                        if (is_callable([$this->_route, $method])) {
                            $params = isset($url[2]) ? $url[2] : null;
                            $this->_route->$method($params);
                        }
                        if (method_exists($this->_route, $method)) {
                            call_user_func_array([$this->_route, $method], [$params]);
                        }
                    }
                } else {
                    Alert::getError($errorMsg = "La route suivant l'url demandée n'a pas été trouvé ou n'existe pas", 1);
                }
            } else {
                // Route par defaut
                $this->_route->index();
            }
        } catch (\Exception $e) {
            throw new \Exception($e);
            Alert::getError($e->getMessage());
        }
    }
}
