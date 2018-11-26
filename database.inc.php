<?php
// db_lib.php

class db
{
  public $dbh;

  // Create a database connection for use by all functions in this class
  function __construct() {

    require_once('config.inc.php');

     //require_once('html_dom_parser.php');
      //require_once('class.phpmailer.php');
   
    if($this->dbh = mysqli_connect($db_host,$db_user, $db_password, $db_name)) { 
	} else {
	  exit('Unable to connect to DB');
    }
	// Set every possible option to utf-8
    mysqli_query($this->dbh, 'SET NAMES "utf8"');
    mysqli_query($this->dbh, 'SET CHARACTER SET "utf8"');
    mysqli_query($this->dbh, 'SET character_set_results = "utf8",' .
        'character_set_client = "utf8", character_set_connection = "utf8",' .
        'character_set_database = "utf8", character_set_server = "utf8"');
  }
  function insert_id(){
   return mysqli_insert_id($this->dbh);
  }
  // Create a standard data format for insertion of PHP dates into MySQL
  public function date($php_date) {
    return date('Y-m-d H:i:s', strtotime($php_date));	
  }
  
  // All text added to the DB should be cleaned with mysqli_real_escape_string
  // to block attempted SQL insertion exploits
  public function escape($str) {
    return mysqli_real_escape_string($this->dbh,$str);
  }
  
  public function close()
  {
    #$this->dbh->close();
  }  
  // Test to see if a specific field value is already in the DB
  // Return false if no, true if yes
  public function in_table($table,$where) {
    $query = 'SELECT * FROM ' . $table . 
      ' WHERE ' . $where;
    $result = mysqli_query($this->dbh,$query);
    return mysqli_num_rows($result) > 0;
  }

  
  // Perform a generic select and return a pointer to the result
  public function select($query) {
    $result = mysqli_query( $this->dbh, $query );   
    return $result;
  }

  public function delete($query) {
    $result = mysqli_query( $this->dbh, $query );
    return $result;
  }

  public function fatch_all_assec($query){
   
     $result =  mysqli_fetch_all($query,MYSQLI_ASSOC);
    return $result;
  }
    
  // Add a row to any table
  public function insert($table,$field_values) {
   
      $k =1;
      foreach ($field_values as $key => $n) {
          if ( $k++ != 1)
            $value .=", $key = '$n'" ;
          else
            $value .=" $key = '$n'" ;
      }
      $query = 'INSERT INTO ' . $table . ' SET '.$value;
  
    mysqli_query($this->dbh,$query);
  }
  
  // Update any row that matches a WHERE clause
  public function update($table,$field_values,$where) {
    $query = 'UPDATE ' . $table . ' SET ';
       $k =1;
      foreach ($field_values as $key => $n) {
          if ( $k++ != 1)
            $query .=", $key = '$n'" ;
          else
            $query .=" $key = '$n'" ;
      }
        $query .=" WHERE " . $where;
     //exit;
    mysqli_query($this->dbh,$query);
  } 
    public function sortTime($time)
    {
        $intervel=explode(',',$time);
         $strtotime=array();
        foreach ($intervel as $i => $val) {
          $strtotime[$i]=strtotime($val);
        }
        $res=sort($strtotime);
        if($res)
          {
                foreach ($strtotime as $i => $val) {

                    $intervel[$i]=date('h:i A',$val);
                    
                }            
          }
          $uniqueArray=array_unique($intervel);
          $time1=implode(', ', $uniqueArray);
          return $time1;
     }
 
} 
?>
