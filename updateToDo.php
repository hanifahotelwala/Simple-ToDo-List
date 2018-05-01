<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" 
   "DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
  <head>
      <meta charset="utf-8">
    <title>Update To Do List </title>
      
<link href="https://fonts.googleapis.com/css?family=Nanum+Myeongjo" rel="stylesheet">
      
      <link rel="stylesheet" href="css/main.css">
         
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
  </head>
  <body>
  
      <div class="list">
      <h1 class="header"><center>Update List </center> </h1>
     
    </div>  

    
    <?php
	// if form not submitted
    // generate new form
      
      
	if (!isset($_POST['update'])) {
        
	if (isset($_GET['id'])) {      
      // attempt database connection
    $mysqli = new mysqli ("localhost", "root", "", "todo");
      // check and sanitize input

    $code = $_GET['id'];// !empty($_GET['id']) ? $mysqli->escape_string($_GET['id']) : die('ERROR: Code is required');
        
    $sql_sel = "SELECT id, task, deadline, priority from todoList WHERE id = '$code'";
      if ($result = $mysqli->query($sql_sel)) {
		if ($result->num_rows == 1) {
			$row = $result->fetch_object();
			$dd = substr($row->deadline, 8, 2);
			$mm = substr($row->deadline, 5, 2);
			$yy = substr($row->deadline, 0, 4);
    ?>
<style>
form.b {
outline-style: dotted;
outline-offset: 10px;
width: 400px;
resize: both;
overflow: auto;
text-align: center;
}

</style> 
      
   <center> <form class="b" method="post" action="updateToDo.php">
     <br>
 [code] : <input type="text" name="code" disabled value="<?php echo $row->id; ?>" />  <br> 
[current prior] : <?php echo $row->priority ?> <p>
       
       -------------- <br> 
        

    <input type="hidden" name="hidcode" value="<?php  echo $row->id; ?>" />
      
      <p>
      Task: 
      <input type="text" name="task" disabled value="<?php echo $row->task; ?>" />
      <p>
				
      Deadline: (dd/mm/yyyy): 
      <input type="text" name="dd" size="2" disabled value="<?php echo $dd; ?>" />
      <input type="text" name="mm" size="2" disabled value="<?php echo $mm; ?>" />
      <input type="text" name="yy" size="4" disabled value="<?php echo $yy; ?>" />
      <p>
          
    
				
      Priority: 
      <select name="u_priority">
        <option name="np" <?php if ($row->priority == "np") {echo "selected";} ?>>None </option>
        <option name="hp" <?php if ($row->priority == "hp") {echo "selected";} ?> >High </option>
        <option name="lp" <?php if ($row->priority == "lp") {echo "selected";} ?> >Low </option>
      </select>
      <p>

     
			
      <input type="submit" name="update" value="Update" />      
    </form>   </center> 
    
    <?php
	  } else {
		  echo '<div id="message">No record matches task code</div>';
             
	  }
	  }
        else {
		  echo "ERROR: Could not execute $sql_sel. " . $mysqli->error;


        }
    
   }  
      
        		$mysqli->close();

    }

      
      else {
         
         // updating the form
		$mysqli = new mysqli("localhost", "root", "", "todo");
		
        $code = $_POST['hidcode'];
        $priority = $_POST['u_priority'];

		//$sql_upd = "UPDATE todoList SET priority ='".$priority."' WHERE id = '".$code."'";
          //echo $code; 
          
       $sql_upd =  "UPDATE todoList SET priority = '$priority' WHERE id = '$code'"; 
         
		
		if ($mysqli->query($sql_upd) === true) {
            
            
    
            header("location: todo.php");
            
		} else {
			echo "ERROR: Could not execute query: $sql_upd. " . $mysqli->error;
		}
		
      $mysqli->close();
	} 
      
    ?>    
 
  </body>
</html>