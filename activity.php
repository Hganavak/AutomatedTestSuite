<?php

    //Pretend student is logged in
    $studentID = 1;

    require('ActivityDetails.php');

    $con = mysqli_connect("localhost", "root"); //Create DB connection
    mysqli_select_db($con, "automatedtestsuite");

    //Create this activity object
    $activity = new ActivityDetails($_GET['activityID']);

    //Simple function that checks if a test case has already been achieved by a student
    function achieved($aID, $sID, $testCase) {
         //Establish DB connection
        $con = mysql_connect("localhost", "root"); //Create DB connection
        mysql_select_db("automatedtestsuite", $con);
        
        $query = mysql_query("SELECT TestCase FROM activityanswers WHERE StudentID='$sID' AND ActivityID='$aID' AND TestCase='$testCase'", $con);
//        $result = mysqli_fetch_array($query);
        
        if(mysql_num_rows($query) > 0) {
            return true;
        }
        
        return false;
    }

    //Simple function that logs a new ActivityAnswer for a student
    function achieve($aID, $sID, $testCase, $justification) {
          //Establish DB connection
        $con = mysqli_connect("localhost", "root"); //Create DB connection
        mysqli_select_db($con, "automatedtestsuite");
        
        if(!mysqli_query($con, "INSERT INTO activityanswers VALUES ('$aID', '$sID', '$testCase', '$justification')")) {
         echo "Error occured creating test case: " . mysqli_error($con);   
        }
     }

?>
<!DOCTYPE HTML>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title>Activity <?php echo $_GET['activityID']; ?></title>
</head>

<body>
<div id="content">
<h1>Activity ID: <?php echo $_GET['activityID']; ?></h1>
<h2>Activity Name: <?php echo $activity->activityName; ?></h2>

<fieldset style="text-align: left"> 
    <legend><h4>Details</h4></legend>
<table style="width:100%; color: #000; text-align: left">
<colgroup>
    <col span="1" style="width: 15%;">
	<col span="1" style="width: 75%">
</colgroup>
<tr>
<td>Description: </td><td><textarea readonly cols="40" rows="3" style="width: 100%"><?php echo $activity->description; ?>" style="width: 100%"></textarea></td>
</tr>
<tr>
<td>Code:</td><td><textarea readonly cols="40" rows="8" style="width: 100%"><?php echo $activity->studentCode; ?></textarea></td>
</tr>
<tr>
    <td>Example Input:</td>
    <td><input readonly type="text" value="<?php echo $activity->exampleInput; ?>"></td>
</tr>
<tr>
    <td>Example Output: </td>
    <td><input readonly type="text" value="<?php echo $activity->exampleOutput; ?>"></td>
</tr>
</table>
</fieldset>

<br />

<fieldset style="text-align: left">
    <legend><h4>Test Case</h4></legend>
<form method="POST">
    
<table style="width:100%; color: #000; text-align: left">
<colgroup>
    <col span="1" style="width: 15%;">
	<col span="1" style="width: 75%">
</colgroup>
<tr>
    <td><label for="inputCase">Input Case:</label></td>
    <td><input type="text" name="inputCase"></td>
</tr>
<tr>
    <td><label for="justification">Test Case Justification</label></td>
    <td><textarea name="justification" cols="40" rows="5" style="width: 100%"></textarea></td>
</tr>
<tr style="text-align: right">
    <td colspan="2"><input type="submit" name="submit" value="Submit Test Case"></td>    
</tr>    
</table>
</form> 
</fieldset>      
    
<?php
    
    //Run the test case
    if(isset($_POST['submit'])) {
        chdir('activities');
        exec("java $activity->activityName " . "$_POST[inputCase]", $output, $code);
      
        //Should be built upon to provide yellow feedback when test case has already been achieved
        echo "<fieldset style='text-align: left;'>";
        echo "<legend><h4>Results</h4></legend>";
        
        echo "<div style='text-align: center; width: 100%; background-color: ";
        if(count($output) == 1) { echo "lime"; }
        else {
            echo "red";
        }
        echo "'>";
       
        if($code == 0) {
            //Check if student has already achieved this test case
            if(achieved($_GET['activityID'], $studentID, $output[0])) {
                echo "You have already done this test case";   
            } else {
                achieve($_GET['activityID'], $studentID, $output[0], $_POST['justification']);
                echo "Congratulations! You achieved test case #$output[0]";  
            }         
        } else {
         echo "You did not achieve any test cases";   
        }
        
        echo "</div>";
        echo "</fieldset>";
        
        
    }

?>    

  

</div>
</body>
</html>