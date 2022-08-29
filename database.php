<?php

class Database{

	private $db_host = "localhost";
	private $db_user = "root";
	private $db_pass = "";
	private $db_name = "my_data";
	private $mysqli  = "";
	private $result  = array();
	private $conn    = false;

	public function __construct(){
	if (!$this->conn) {
	$this->mysqli = new mysqli($this->db_host,$this->db_user,$this->db_pass,$this->db_name);
	if($this->mysqli == false){
	array_push($this->result, "Connection Error !");
	return true;
			} 
		}     else   {
		  return true;
		}
}

public function total_likes($post_id) {
$get_like ="SELECT `count` FROM `post_info` WHERE `post_id`='$post_id'";
$query_like = mysqli_query($get_like);
$res = mysqli_fetch_array($query_like);
$count = $res['count'];
array_push($this->result, $count);
}


public function insert_info($sql){
$query = $this->mysqli->query($sql);
if ($query) {
array_push($this->result, "1");
return true;
  }   else  {
array_push($this->result, "0");
 return false;
  }
}
public function like_count($slct){
$query = $this->mysqli->query($slct);
if ($query) {
$rows = $this->mysqli->num_rows($query);
array_push($this->result, $rows);
  }    else   {
array_push($this->result,'0');
  }
}
public function getResult(){
  	$val = $this->result;
  	$this->result = array();
  	return $val;
  }
}
/*
public function select($table, $column_1 , $value){
 $sql = "SELECT * FROM $table WHERE $column_1 = '$value'";
$query = $this->mysqli->query($sql);
if ($query) {
$data = mysqli_fetch_array($query);
$id = $data['user_id'];
array_push($this->result ,$id);
 }  else   {
array_push($this->result , "Error");
        }
    }
}
 $my = new Database ();
$table = "users";
$column_1 = "name";
$value = "Ghs Julian";
$my->select($table,$column_1,$value);
print_r($my->getResult());
*/


	// Function to insert into the database
 /* public function insert($table,$params=array()){
  	// Check to see if the table exists
  	if($this->tableExists($table)){
      // Seperate $params's Array KEYs and VALUEs and Convert them to String Value
  		$table_columns = implode(', ', array_keys($params));
  		$table_value = implode("', '", $params);

  		$sql = "INSERT INTO $table ($table_columns) VALUES ('$table_value')";
  		// Make the query to insert to the database
  		if($this->mysqli->query($sql)){
  			array_push($this->result, $this->mysqli->insert_id);
  			return true; // The data has been inserted
  		}else{
  			array_push($this->result, $this->mysqli->error);
  			return false; // The data has not been inserted
  		}

  	}else{
  		return false; // Table does not exist
  	}
  }

  // Function to update row in database
  public function update($table,$params=array(),$where = null){
    // Check to see if table exists
  	if($this->tableExists($table)){
      // Create Array to hold all the columns to update
      $args = array();
      foreach ($params as $key => $value) {
        $args[] = "$key = '$value'"; // Seperate each column out with it's corresponding value
      }

      $sql = "UPDATE $table SET " . implode(', ', $args);
      if($where != null){
        $sql .= " WHERE $where";
      }
      // Make query to database
      if($this->mysqli->query($sql)){
        array_push($this->result, $this->mysqli->affected_rows);
        return true; // Update has been successful
      }else{
        array_push($this->result, $this->mysqli->error);
        return false; // Update has not been successful
      }
    }else{
      return false; // The table does not exist
    }
  }

	//Function to delete table or row(s) from database
  public function delete($table,$where = null){
    // Check to see if table exists
  	if($this->tableExists($table)){
      $sql = "DELETE FROM $table";  // Create query to delete rows
      if($where != null){
        $sql .= " WHERE $where";
      }
      // Submit query to database
      if($this->mysqli->query($sql)){
        array_push($this->result, $this->mysqli->affected_rows);
        return true; // The query exectued correctly
      }else{
        array_push($this->result, $this->mysqli->error);
        return false; // The query did not execute correctly
      }
      
    }else{
      return false; // The table does not exist
    }
  }

  // Function to SELECT from the database
	public function select($table, $rows="*",$join = null,$where = null,$order=null,$limit=null){
     // Check to see if the table exists
	   if($this->tableExists($table)){
        // Create query from the variables passed to the function
        $sql = "SELECT $rows FROM $table";
        if($join != null){
          $sql .= " JOIN $join";
        }
        if($where != null){
          $sql .= " WHERE $where";
        }
        if($order != null){
          $sql .= " ORDER BY $order";
        }
        if($limit != null){
          if(isset($_GET['page'])){
            $page = $_GET['page'];
          }else{
            $page = 1;
          }
          $start = ($page - 1) * $limit;
          $sql .= " LIMIT $start,$limit";
        }

        $query = $this->mysqli->query($sql);

        if($query){
          $this->result = $query->fetch_all(MYSQLI_ASSOC);
          return true; // Query was successful
        }else{
          array_push($this->result, $this->mysqli->error);
          return false; // No rows were returned
        }
     }else{
       return false; // Table does not exist
     }
  }

  // FUNCTION to show Pagination
  public function pagination($table,$join = null,$where = null,$limit=null){
    // Check to see if table exists
    if($this->tableExists($table)){
      if($limit != null){
        // select count() query for pagination
        $sql = "SELECT COUNT(*) FROM $table";
        if($join != null){
          $sql .= " JOIN $join";  
        }
        if($where != null){
          $sql .= " WHERE $where"; 
        }

        $query = $this->mysqli->query($sql);

        $total_record = $query->fetch_array();
        $total_record = $total_record[0];

        $total_page = ceil($total_record / $limit);

        $url = basename($_SERVER['PHP_SELF']);
        // Get the Page Number which is set in URL
        if(isset($_GET['page'])){
          $page = $_GET['page'];
        }else{
          $page = 1;
        }
        // show pagination
        $output = "<ul class='pagination'>";

        if($page>1){
          $output .= "<li><a href='$url?page=".($page-1)."'>Prev</a></li>";
        }

        if($total_record > $limit){
          for($i = 1; $i <= $total_page; $i++){
            if($i == $page){
              $cls = "class='active'";
            }else{
              $cls = "";
            }
            $output .= "<li><a $cls href='$url?page=$i'>$i</a></li>";
          }
        }
        if($total_page>$page){
          $output .= "<li><a href='$url?page=".($page+1)."'>Next</a></li>";
        }
        $output .= "</ul>";

        echo $output;

      }else{
        return false; // If Limit is null
      }
    }else{
      return false; // Table does not exist
    }
  }

  public function sql($sql){
    $query = $this->mysqli->query($sql);

    if($query){
      $this->result = $query->fetch_all(MYSQLI_ASSOC);
      return true; // Query was successful
    }else{
      array_push($this->result, $this->mysqli->error);
      return false; // No rows were returned
    }
  }

  // Private function to check if table exists for use with queries
  private function tableExists($table){
  	$sql = "SHOW TABLES FROM $this->db_name LIKE '$table'";
  	$tableInDb = $this->mysqli->query($sql);
  	if($tableInDb){
  		if($tableInDb->num_rows == 1){
  			return true; // The table exists
  		}else{
  			array_push($this->result,$table." does not exist in this database.");
  			return false; // The table does not exist
  		}
  	}
  }

  // Public function to return the data to the user
  public function getResult(){
  	$val = $this->result;
  	$this->result = array();
  	return $val;
  }

  // close connection
	public function __destruct(){
		if($this->conn){
			if($this->mysqli->close()){
				$this->conn = false;
				return true;
			}
		}else{
			return false;
		}
	}

} //Class Close

*/
?>