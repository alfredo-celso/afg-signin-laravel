<?php
// Router.php
namespace App\Utilities;

class Router {
    public static function parseUrl($url) {
        $urlParts = explode('/', $url);

        $controllerName = ucfirst($urlParts[0] ?? 'Home') . 'Controller';
        $action = $urlParts[1] ?? 'index';

        return ['controller' => $controllerName, 'action' => $action];
    }

    public static function generateUrl($controller, $action, $query = '') {
        $queryString = $query ? '?' . $query : '';
        return "index.php?url={$controller}/{$action}{$queryString}";
    }
}
?>
