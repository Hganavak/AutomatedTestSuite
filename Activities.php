<!DOCTYPE HTML>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title>Activities</title>
</head>

<body>
<div id="content">
<h1>Activities</h1>

<?php

    //Lists all of the activities
    
    //Establish DB connection
    $con = mysqli_connect("localhost", "root"); //Create DB connection
    mysqli_select_db($con, "automatedtestsuite");
    
    $result = mysqli_query($con, "SELECT ActivityID, ActivityName, Description FROM activities");
    
    echo "<table style=\"width:100%; color: #000; text-align: center; margin-left: auto; margin-right: auto\"><tr><th>Activity ID</th><th>Activity Name</th><th>Description</th><tr>";
    
    while($row = mysqli_fetch_array($result))
    {
        echo "<tr>";
        echo "<td><a href=\"activity.php?activityID=" . $row['ActivityID'] . "\">" . $row['ActivityID']. "</a></td>";
        echo "<td>" . $row['ActivityName'] . "</td>";
        echo "<td>" . $row['Description'] . "</td>";
        echo "</tr>";
    }

    echo "</table>";

?>
    
</div>
</body>
</html>