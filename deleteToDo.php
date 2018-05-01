 <?php

// attempt database connection
    $mysqli = new mysqli ("localhost", "root", "", "todo");
        
// check and sanitize input

    $code = $_GET['id'];

    $sql_del = "DELETE FROM todoList WHERE id='$code'"; 
      
   if($mysqli->query($sql_del)=== true)
   {
       //echo "Task has been deleted!";
       header("location: todo.php");
   }
    else
        echo "Task could not be deleted."; 
       
 
 
  ?>