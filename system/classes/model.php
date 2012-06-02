<?php

class Model
{
  function add_data($table, $data)
  {
    $query = "INSERT INTO `$table` values (";
    foreach ($data as $key => $value)
    {
      $query .= "'". mysql_real_escape_string($value) ."', ";
    }
    $query = trim($query, ", ") . ")";

    if (mysql_query($query))
      return true;
    else
      return false;
  }

  function get_data($table, $limit = 0, $offset = 30, $order=true, $where = array(), $first_only=false)
  {
    $query = "SELECT * FROM `$table` ";
    if (!empty($where))
    {
      $query .= "WHERE ";
      foreach ($where as $key => $value)
      {
        $query .= "`$key` = '". mysql_real_escape_string($value) ."' AND ";
      }
      $query = trim($query, "AND ");
    }
    if ($order)
      $query .= " ORDER BY `id` DESC ";
    else
      $query .= " ORDER BY `id` ASC ";
    $query .= " LIMIT $limit, $offset";
    $result = mysql_query($query);
    if (!$result)
      return false;
    else
    {
      if ($first_only)
      {
         return mysql_fetch_array($result, MYSQL_ASSOC);
      }
      else
      {
        while($row = mysql_fetch_array($result, MYSQL_ASSOC))
          $rows[] = $row;
        return $rows;
      }
    }
  }

  function update_data($table,$data)
  {
    $query = "UPDATE `$table` SET ";
    foreach ($data as $key => $value)
    {
      $query .= "`$key` = '$value', ";
    }
    $query = trim($query, ", ") . " WHERE `id` = ".$this->id;
    if (mysql_query($query))
      return true;
    else
      return false;
  }

  function destroy_data($table, $where=array())
  {
    $query = "DELETE FROM `$table` WHERE ";
    if (empty($where))
      $query .= "`id` = ".$this->id;
    else
    {
      foreach ($where as $key => $value)
      {
        $query .= "`$key` = '$value', ";
      }
      $query = trim($query, ", ");
    }

    if (mysql_query($query))
      return true;
    else false;
  }

  }
?>
