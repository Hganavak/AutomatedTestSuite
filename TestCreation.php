<!DOCTYPE HTML>
<html>
<head>
	<link rel="stylesheet" type="text/css" href="css/style.css">
	<title>Test Creation</title><F5>
</head>

<body>
<div id="content">
<h1>Test Creation</h1>

<p>

Use the following form to generate a new test activity.

</p>

<form>
	<fieldset>
		<legend><h4>Create Test Activity</h4></legend>
		<table style="width:100%; color: #000; text-align: left">
			<colgroup>
				<col span="1" style="width: 25%;">
				<col span="1" style="width: 65%">
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
				<td><label for="testMethod">Test Method Code:</label></td>
				<td>
					<textarea name="testMethod" cols="40" rows="10" style="width: 100%">
private void testMethod(Object a, Object b) {

	numTestCases(#); //Enter total number of test cases

	if(Object a.equals("Example") || Object b != 0) {
		tested(#); //Test case achieved
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
