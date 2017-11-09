<?php

$serverName = "localhost";
$username = "root";
$password = "";
$dbName = "urbansurvay";

$dbCon = mysqli_connect($serverName,$username,$password,$dbName);

if(isset($_POST['submitted'])){
    //include ('connect-mysql.php');



    $sqlinsert = "INSERT INTO survay (firstname, lastname) VALUES ('$fname','$lname')";

    if(!mysqli_query($dbCon, $sqlinsert)){
        die('error inserted');
    }//end of my nested if statement

   $newrecord = "1 recordss";
}//end of the main if statement
?>

<html>
<head>
    <title>
        Insert
    </title>
</head>

<body>
<form method="post" action="insert.php">
<input type="hidden" name="submitted" value="true">
    <fieldset>
        <legend>New Survay</legend>
        <label>Firstname: <input type="text" name="fname"/></label>
        <label>LastName: <input type="text" name="lname"/></label>
    </fieldset><br />
    <input type="submit" value="add new survay">
</form>

<?php
echo $newrecord
?>



</body>
</html>
