<?php

/**
 * @author    Jean-Marie HOLLAND <illaweb35@gmail.com>
 * @copyright  (c) 2018, Jean-Marie HOLLAND. All Rights Reserved.
 * @license    Lesser General Public Licence <http://www.gnu.org/copyleft/lesser.html>
 * @link       https://illaweb.fr
 */
require_once('Pattern/Singleton.trait.php');

use App\Pattern\Singleton;


class Autoloader
{
    use Singleton;

    public static function autoload($class)
    {
        $class = str_replace(__NAMESPACE__, '', $class);
        $class = str_replace('\\', '/', $class);
        $file = (dirname(__DIR__) . '/' . $class . '.php');
        require_once $file;
    }

    public static function init()
    {
        spl_autoload_register([__CLASS__, 'autoload']);
    }
}
