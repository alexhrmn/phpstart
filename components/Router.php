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


        // получаем внутренний путь из внешнего согласно правилу
        $internalRoute = preg_replace("~$uriPattern~", $path, $uri);

        // Убрал phpstart с URI


        $uri = str_replace('phpstart/','',$uri);
        $internalRoute = str_replace('phpstart/','',$internalRoute);


        // Определить контроллер, action, параметры

        $segments = explode('/', $internalRoute);

        $controllerName = array_shift($segments) . 'Controller';
        $controllerName = ucfirst($controllerName);

        $actionName = 'action' . ucfirst(array_shift($segments));
         //echo '<br>controller name: '.$controllerName;
         //echo '<br>action name: '.$actionName;
        $parameters = $segments;
          // echo '<pre>';
           //print_r($parameters);
           //echo '<br>где.запрос пользователя $uri '.$uri;

           //echo '<br>что?совпадение из правил $uriPattern '.$uriPattern;
           //echo '<br>кто обрабатывает $path '.$path;
           //echo '<br> $actionName '.$actionName;
          // echo '<br>'.$segments;
          // echo '<br>'.$parameters;
          //echo '<br>нужно сформировать $internalRoute '.$internalRoute;
           //die;


        // Подключить файл класса-контроллера
        $controllerFile = ROOT . '/controllers/' .
                $controllerName . '.php';


        if (file_exists($controllerFile)) {
          include_once($controllerFile);
           }
      // Создать объект,вызвать метод (т.е. action)
        $controllerObject = new $controllerName;

        $result = call_user_func_array (array($controllerObject, $actionName), $parameters);

        if ($result != null) {
          break;
           }
        }
     }
  }
}
