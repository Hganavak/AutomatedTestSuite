<?php

    require('TestTemplate.php');

	if(isset($_POST['submit'])) {
	    createTestCase($_POST['activityName'], $_POST['testMethod']);
        compileActivity($_POST['activityName']);
	}

    /**
     * Creates a Java class
     */
    function createTestCase($activityName, $testMethod) {
        $handle = fopen('./activities/'.$activityName.'.java', 'w') or die('Could not create activity');
        $template = new TestCaseTemplate();
        $template->nameClass($activityName);
        $template->setTestMethod($testMethod);
        $template->createClass();
        fwrite($handle, $template->classString);
    }

	/**
	 * Compiles the full test class
	 */
	function compileActivity($activityName) {
	    $code = 0;
	    #exec('javac *.java 2>&1', $output, $code);
        chdir('activities');
        exec('javac *.java 2>&1', $output, $code);
        
	    if($code) {
		  echo "<p style='background-color: yellow; color: red; text-align: center'>An error occured: ";
          for($i = 0; $i < count($output); $i++) {
            echo "<br />$output[$i]";
            }
            echo "</pre>";
	    } else {
            echo "<pre style='background-color: lime; color: yellow; text-align: center'><b>Activity Compiled Successfully</b></pre>";
            //Create database entry
            createDBEntry();
	    }
	}

    /**
     * Enter database values if compile is successful
     */
    function createDbEntry() {
        $con = mysqli_connect("localhost", "root"); //Create DB connection
        mysqli_select_db($con, "automatedtestsuite");
        
        if(mysqli_connect_errno($con)) {
            echo "Failed to connect to database";   
        }
        
        //Perform the insert
        $sql = "INSERT INTO Activities (ActivityName, ExampleInput, ExampleOutput, Description, StudentCode) VALUES ('$_POST[activityName]', '$_POST[exampleInput]', '$_POST[exampleOutput]', '$_POST[description]', '$_POST[studentCode]')";
        
//        $sql="INSERT INTO Persons (FirstName, LastName, Age) VALUES ('$_POST[firstname]','$_POST[lastname]','$_POST[age]')";
        
        if (!mysqli_query($con, $sql)) {
            die('Error occured creating database entry: ' . mysqli_error($con));
        }
        
        echo "<pre style='background-color: lime; color: yellow; text-align: center'><b>Database Entry Created</b></pre>";
        
        mysqli_close($con); //Close the DB connection
    }

?>

<!DOCTYPE HTML>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title>Test Creation</title>
</head>

<body>
<div id="content">
<h1>Test Creation</h1>

<p>

Use the following form to generate a new test activity.

</p>

<form method="POST">
	<fieldset>
		<legend><h4>Create Test Activity</h4></legend>
		<table style="width:100%; color: #000; text-align: left">
			<colgroup>
				<col span="1" style="width: 15%;">
				<col span="1" style="width: 75%">
			</colgroup>
			<tr>
				<td><label for="activityName">Activity Name:</label></td>
				<td><input type="text" name="activityName"></td></tr>
			<tr>
			<tr>
				<td><label for="exampleInput">Example Input:</label></td>
				<td><input type="text" name="exampleInput"></td></tr>
			</tr>
			<tr>
				<td><label for="exampleOutput">Example Output:</label></td>
				<td><input type="text" name="exampleOutput"></td></tr>
			</tr>
				<td><label for="description">Description:</label></td>
				<td><textarea name="description" cols="40" rows="3" style="width: 100%"></textarea></td> 
			</tr>
            <tr>
            <td><label for="studentCode">Student Code:</label></td>
				<td><textarea name="studentCode" cols="40" rows="8" style="width: 100%">The method students will see (not actually executed)</textarea></td> 
            </tr>
			<tr>
				<td><label for="testMethod">Test Method Code:</label></td>
				<td>
					<textarea name="testMethod" cols="40" rows="12" style="width: 100%">
private static void testMethod(String[] args) {
                        
    numTestCases(2); //Enter total number of test cases
    int a = Integer.parseInt(args[0]); int b = Integer.parseInt(args[1]);

    if(a != 0 && b == 0) {
        tested(0); //Division by 0
    } else {
        tested(1); //'Normal' test case                  
    }
                        
}					</textarea>
				</td>
			</tr>
			<tr>
				<td> </td><td><input type="submit" value=" Create Activity " name="submit"></td>
			</tr>
		</table>


	</fieldset>
</form>
</div>
</body>

</html>
