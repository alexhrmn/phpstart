<?php
class Router
{
    private $routes;

    public function __construct()
   {
     $routesPath= ROOT.'/config/routes.php';
     $this->routes = include($routesPath);
   }
   /**
   * Returns request string
   **/
    private function getURI()
   {
     if (!empty($_SERVER['REQUEST_URI'])) {
       return trim($_SERVER['REQUEST_URI'], '/');
     }

   }
    public function run()
   {
//String of request
     $uri = $this->getURI();
//Check routes.php
     foreach ($this ->routes as $uriPattern => $path) {
// comprassion $uriPattern and $uri
    if (preg_match("~$uriPattern~", $uri)) {

        echo '<br>Где ищем (запрос, который набрал пользователь):'.$uri;
        echo '<br>Что ищем (Совпадение из правил):'.$uriPattern;
        echo '<br>Кто обрабатывает: '.$path;

        // получаем внутренний путь из внешнего согласно правилу
        $internalRoute = preg_replace("~$uriPattern~", $path, $uri);

        echo '<br><br> Нужно сформировать: '.$internalRoute;
           //what controller action chose request
        $segments = explode('/', $internalRoute);

        $controllerName = array_shift($segments).'Controller';
        $controllerName = ucfirst($controllerName);

        $actionName = 'action'.ucfirst(array_shift($segments));

        $parameters = $segments;

        // turn on file class-controller
        $controllerFile = ROOT . '/controllers/' .  $controllerName . '.php';

        if (file_exists($controllerFile)) {
          include_once($controllerFile);
           }
        // Create object, run method or action
        $controllerObject = new $controllerName;

        $result = call_user_func_array ($controllerObject, $actionName, $parameters);

        if ($result != null) {
          break;
           }
        }
     }
  }
}
