By: Hanifa Hotelwala


<!--COMMENT!-->

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
   "DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
<meta charset="utf-8">
<title> ToDo </title>
    
<link href="https://fonts.googleapis.com/css?family=Nanum+Myeongjo" rel="stylesheet">
    
    <link rel="stylesheet" href="css/main.css">
    
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
     
</head>
    
 <body>
     
    <div class="list">
         <h1 class="header"><center>My To-Do List </center> </h1>
     
    </div>  

        <!--The form that the user uses to add a task to the To Do List -->
     
<style>
form.a {
outline-style: dotted;
outline-offset: 10px;
width: 400px;
resize: both;
overflow: auto;
text-align: center;
}


</style> 
   <center>  <form class="a" action="todo.php" method="post"> 

         Task:  <input type="text" name="task" > <p>

            
         Date (mm/dd/yyyy): 
            <input type="text" name="mm" size="2" />
            <input type="text" name="dd" size="2" />
            <input type="text" name="yy" size="4" /> <p>
          
         Priority: 
            <select name="priority" id="priority">
            <option name="np">None 
            <option name="hp">High
            <option name="lp">Low 
            </select>
            <p>
  
            <input type="submit" value="Add Task" name="submit">
            <input type="submit" value="Display List" name="display">


        </form> </center>  <p>
 
     
     
 <?php 

     //Once submit is pressed, inserts data into the table. 
    if(isset($_POST['submit'])) 
    {   
  
    //connecting to database
    $mysqli = new mysqli("localhost", "root", "", "todo"); 
   
          
    if($mysqli == false)
       die("Error: could not connect. " .mysqli_connect_error());

    //creating variables  
        
    $code = rand(1, 999999); //ID that each task is randomly "assigned to" 
   
    $task = !empty($_POST['task']) ? $mysqli->escape_string($_POST['task']) : die('<center>ERROR: Task is required!</center> ');  
        
    $mm = !empty($_POST['mm']) ? $mysqli->escape_string($_POST['mm']) : die('<center>ERROR, Due date is required!</center>'); 
    $dd = !empty($_POST['dd']) ? $mysqli->escape_string($_POST['dd']) : die('<center>ERROR, Due date is required!</center>'); 
    $yy = !empty($_POST['yy']) ? $mysqli->escape_string($_POST['yy']) : die('<center>ERROR, Due date required!</center>'); 
        
    $date = checkdate($mm, $dd, $yy) ? $yy.'-'.$mm.'-'.$dd : die('ERROR: Due date is invalid');  
        
    $priority = $_POST['priority']; 
        
    //inserts the values from variables that the user inputs into the todoList table    
    $sql_insert = "INSERT INTO todoList(id, task, deadline, priority) VALUES ('$code', '$task', '$date', '$priority')"; 
    
    //If insertion is successful... 
    if ($mysqli->query($sql_insert) === true) {
        echo "<center> Task has been added! </center>";
        
      } else {
        echo "ERROR: Could not execute $sql_insert. " . $mysqli->error;
      } 
    $mysqli->close();
    } 
     
//Once display is pressed, displays the list. 
if(isset($_POST['display']))
   {
      $mysqli = new mysqli("localhost", "root", "", "todo"); 
    
     ?>
  
  
<!--     Table styling/format begins here with few integrated PHP lines of code-->
    <center>
         <?php  echo " <strong>  <p>  ----- Current TO DO List ----- </strong> "; ?> 
    </center> <p> <p>
<?php
 
    $sql_sel = "SELECT id, task, deadline, priority FROM todoList ORDER BY deadline"; 
    
    //storing data from selected into  $sql_sel 
    if ($result = $mysqli->query($sql_sel)) {
         if ($result->num_rows > 0) {
?>
     
    <style>
       table { border-collapse: collapse;
         }

       table, td, th { border: 1px solid black; }
        
    </style>
    
    <center>
        <table> 
         <thead>
             <tr>
                <th>code</th>
                <th> Task  </th>
                <th> Deadline </th> 
                <th> Priority </th>
                <th> Edit </th>
                <th> Delete </th> 
             </tr>
         </thead>
        <tbody>
             <?php while($row = $result->fetch_object()) { ?>  
            <tr>
                <td><?php echo $row->id ?> </td>
                <td> <?php echo $row->task ?></td>   
                <td> <?php echo $row->deadline ?></td>
                <td> <?php echo $row->priority ?> </td>
                <?php echo" <td> <a href=\"updateToDo.php?id=" . $row->id . "\">EDIT</a> </td>\n";      
                echo"<td><a href=\"deleteToDo.php?id=" . $row->id ."\"><center>X </center></a></td>\n "; ?>
            </tr>       
            <?php    } ?> 
             
        </tbody>
     </table> 
    </center> 
     
<?php }
        else {
            echo '<center> <div id="message">Empty List!</div> </center>'; 
        }  
    } 
      
    else 
      echo "Error retrieving information from table.."; 
   
   $mysqli->close(); 
    //moved this to top of end of submit
   }
?>
     
     
</body>
</html>
