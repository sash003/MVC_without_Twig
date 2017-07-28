<?php

namespace controllers;

class MainPageController extends ACore
{
  
    public function actionIndex($way)
    {   
        $way = substr($way, 0, strrpos($way, '.'));
        $arrData = $this->m->query("select `title`, `description`, `text` from `mainPages` where `href`=?", array($way));
        $title = $arrData[0]['title'];
        $description = $arrData[0]['description'];
        $text = $arrData[0]['text'];
        
        // header
        require "/template/views/header.php";
        
        // Подключаем вид
        require "/template/views/main.php";
        
        // footer
        require "/template/views/footer.php";
        return true;
    }
        
}
