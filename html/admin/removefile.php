<!DOCTYPE html>
<html>
<head>
<title>Site 58</title>
<link rel="icon" type="image/png" href="favicon.png">
</head>
<body style="background-image: url('lightbg.png')">
	<?php
require '../mysql.php';
if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $getnum = $_GET["num"];
    $query = "SELECT filename FROM Files WHERE num=\"$getnum\"";
    $result = $conn->query($query);
    if ($result->num_rows == 1) {
        echo "<script>location.href='filelog'</script>";
        $row = $result->fetch_assoc();
        $filetodel = "n184148124";
        $filetodel = $row["filename"];
        rename('/var/www/files/'.$filetodel, '/var/www/trash/'.$filetodel);
        #unlink("/var/www/files/".$filetodel);
        $query = 'INSERT INTO Trash SELECT * FROM Files WHERE num="'.$getnum.'"';
        $conn->query($query);
        $query = 'DELETE FROM Files WHERE num="'.$getnum.'"'; 
        $conn->query($query);
        #echo $conn->errno . ": " . $conn->error . "<br>";
        #echo $query;
    } else {
        echo '<h1 style="margin-top:100px;text-align:center;color:red">Invalid file number</h1>';
        ob_flush();
        flush();
        sleep(2);
        echo "<script>location.href='../home'</script>";
    }
}
?>
</body>
</html>
