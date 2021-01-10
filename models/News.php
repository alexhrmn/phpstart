<?php

class News
{

    /**
    * Returns single news item with specified id
    * @ param integer $id
    */
    public static function getNewsItemById($id)
        {
         //Запроск БД

         $id = intval ($id);

         if ($id) {
           $host = 'localhost';
           $dbname = 'mvc_site';
           $user = 'root';
           $password = 'password';
           $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password,);

           $result = $db->query('SELECT * from news WHERE id=' . $id);




           $newsItem = $result->fetch();

           return $newsItem;


         }
//
    }


    /**
    * Return an array of news item
    */
    public static function getNewsList()

    {

         // Запрос к БД


      $host = 'localhost';
      $dbname = 'mvc_site';
      $user = 'root';
      $password = 'password';
      $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);

      $newsList = array();

      $result = $db->query('SELECT id, title, date, short_content, type '
              . 'FROM news '
              . 'ORDER BY date DESC '
              . 'LIMIT 10 ');

      $i = 0;

        while($row = $result->fetch())

      {
        $newsList[$i]['id'] = $row['id'];
        $newsList[$i]['title'] = $row['title'];
        $newsList[$i]['date'] = $row['date'];
        $newsList[$i]['short_content'] = $row['short_content'];
        $newsList[$i]['type'] = $row['type'];

        $i++;
      }
      return $newsList;
    }

}
