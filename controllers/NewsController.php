<?php

 class NewsController
 {

   public function actionIndex ()

   {
      echo '<br><br> Список новостей';
      return true;
   }

   public function actionView($params)
   {
      echo '<br>'.$params[0];
      echo '<br>'.$params[1];

      return true;
   }

}
