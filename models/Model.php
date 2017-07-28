<?php

namespace models;


class Model
{
  protected $_db;
  
  public function __construct()
  {
    try{
      $this->_db = Connect::setConnect('/config/db_conf.xml');
    } catch (\Exception $e) {
      echo 'Ошибка конструктора ' . $err->getMessage(). '<br> в файле '.$err->getFile().", строка ".$err->getLine() . "<br><br>Стэк вызовов: " . preg_replace('/#\d+/', '<br>$0', $err->getTraceAsString());
      exit;  
    }
    
  }
  
  public function query($query, array $values = array(
), $param=false){
    try{
      $stmt = $this->_db->prepare($query);
      $values_len = count($values);
      
      for ($i = 0; $i < $values_len; $i++) {
        $value = trim($values[$i]);
        if (preg_match('/^\d+$/', $value)) {
          $stmt->bindValue($i + 1, $value, \PDO::PARAM_INT);
        }
        else {
          $stmt->bindValue($i + 1, $value, \PDO::PARAM_STR);
        }
      }
      $stmt->execute($values);
      if(!$param){
        return $stmt->fetchAll();
      }else{
        return $stmt->rowCount(); 
      }
      return $stat;
    } catch (\PDOException $err) {
      echo 'Ошибка при выборке из БД ' . $err->getMessage(). '<br> 
              в файле '.$err->getFile().", строка ".$err->getLine() . "<br><br>Стэк вызовов: " . preg_replace('/#\d+/', '<br>$0', $err->getTraceAsString()); 
        exit;  
    }
    
  }
  
  public function escapeStr($str, $size=0){
      $str = trim($str);
      $str = preg_replace('/`/', '', $str);
      $str = htmlentities($str, ENT_QUOTES, "UTF-8");
      if($size)$str = mb_substr($str, 0, $size, "UTF-8");
      return $str;
  }
 
  
  function __destruct()
  {
    $this->_db = null;
    unset($this);
  }
  
  
}
