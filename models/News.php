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
           // Заменил на getConnection
           // $host = 'localhost';
           // $dbname = 'mvc_site';
           // $user = 'root';
           // $password = 'password';
           // $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);

           $db = Db::getConnection();

           $result = $db->query('SELECT * from news WHERE id=' . $id);

           $result->setFetchMode(PDO::FETCH_ASSOC);

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
         $db = Db::getConnection();

         $newsList = array();

         $result = $db->query('SELECT id, title, date, short_content, author_name, preview '
              . 'FROM news '
              . 'ORDER BY date DESC '
              . 'LIMIT 10 ');

      $i = 0;

        while($row = $result->fetch()){
          $newsList[$i]['id'] = $row['id'];
          $newsList[$i]['title'] = $row['title'];
          $newsList[$i]['date'] = $row['date'];
          $newsList[$i]['short_content'] = $row['short_content'];
          $newsList[$i]['author_name'] = $row['author_name'];
          $newsList[$i]['preview'] = $row['preview'];

        $i++;
      }
      return $newsList;
    }

}
