<?php

 class NewsController
 {

   public function actionIndex ()

   {
      echo '<br><br> Список новостей';
      return true;
   }

   public function actionView ($category, $id)
   {
      echo '<br>'.$category;
      echo '<br>'.$id;




      return true;
   }

}
