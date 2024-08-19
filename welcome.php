<!DOCTYPE html>
<html>
<head>
<style>
table, th, td {
  border: 1px solid black;
}
</style>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>

<!-- <form action="welcome.php" method="post">
Name: <br>
  <input type="text" list="names" name="nameDatalist" id="nameDatalist">
  <datalist id="names">
    <option value="Dennis">
    <option value="Eunsil">
    <option value="Pastor Kim">
    <option value="Teacher">
    <option value="Student">
  </datalist>
  <br>
Prayer Request: <br>
<textarea name="prayer" rows="4" cols="50"></textarea><br>
<input type="submit">
</form> -->

<?php
$servername = "localhost";
$username = "rwhlopte_admin";
$password = "!Ssmilez84";
$dbname = "rwhlopte_dennis";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);
// Check connection
if ($conn->connect_error) {
    echo "failed";
    die("Connection failed: " . $conn->connect_error);
}

// $nameVar =  $_POST["name"];
$prayerVar =  $_POST["prayer"];
echo $prayerVar;

$nameDatalistVar =  $_POST["nameDatalist"];

$timestamp = date('Y-m-d H:i:s');

/*echo '<script>
function myFunction() {
    var val = $("#nameDatalist").val();

    var obj = $("#names").find("option[value=\'" + val + "\']");

    if(obj != null && obj.length > 0)
        alert("validPHP");  // allow form submission
    else
        alert("invalidPHP");
}
</script>';
*/

$nameDataListValues = array("Dennis", "Eunsil", "Pastor Kim", "Teacher", "Student");

//alert($nameDatalistVar);

// if (!empty($nameDatalistVar)) {
//     $found = false;
//     foreach ($nameDataListValues as $x) 
//     {
//         if ($x == $nameDatalistVar) {
//             found = true;
//         }
//     }
// }

if ($nameDatalistVar != "" && $prayerVar != "") {
    $sql = "INSERT INTO test (namePerson, prayer, Time) VALUES ('$nameDatalistVar', '$prayerVar', '$timestamp')";

    if ($conn->query($sql) === TRUE) {
        echo "New record created successfully";
      } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
      }
}

$sql = "SELECT namePerson, prayer, Time FROM test";
$result = $conn->query($sql);

$nameArray = array();
$prayerArray = array();
$timeArray = array();

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        $nameArray[] = $row["namePerson"];
        $prayerArray[] = $row["prayer"];
        $timeArray[] = $row["Time"];
    }
    echo "</table>";
} else {
    echo "0 results";
}

echo "<table>";
echo "<tr><th>Name</th><th>Prayer Request</th></tr>";
for ($x = sizeof($nameArray) - 1; $x >0; $x--) {
    echo "<tr><td>". $nameArray[$x]. "</td>". "<td>". $prayerArray[$x]. "</td>.". "<td>". $timeArray[$x]. "</td> </tr>";
//     }
  }
echo "</table>";

// if ($result->num_rows > 0) {
//     // output data of each row
//     echo "<table>";
//     echo "<tr><th>Name</th><th>Prayer Request</th></tr>";
//     while($row = $result->fetch_assoc()) {
//         echo "<tr><td>". $row["namePerson"]. "</td>". "<td>". $row["prayer"]. "</td></tr>";
//     }
//     echo "</table>";
// } else {
//     echo "0 results";
// }

$conn->close();
?>

</body>
</html>