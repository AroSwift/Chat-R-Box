
<?php


if(isset($_COOKIE['user'])){



$title = 'Report Error';
$on = 'Report Error';
include('Includes/Header.php');


require_once("Includes/connection.php");


?>


<div id="Content">

<h1>Report Error</h1>

<a href="index.php?start=0"><-Back</a>

<?php


if(isset($_GET['send'])){
if($_GET['send'] == 'true'){
if($_POST['error']){




$to  = 'aaron-inc@charter.net';
$subject = 'Error Report';




$message = $_POST['error'];


$result = mail($to, $subject, $message, $headers);
echo $result ? 'yes' : 'no';


if($result == 'yes'){
header("Location: report_error.php?successful=true");
} else {
header("Location: report_error.php?unsuccessful=true");
}







} else {
header("Location: report_error.php?unsuccessful=true");
}
}
}





if(isset($_GET['unsuccessful'])){
if($_GET['unsuccessful'] == 'true'){
echo '<font color="red"><br />- Unsuccessfully sent<br /></font>';
}
}


if(isset($_GET['successful'])){
if($_GET['successful'] == 'true'){
echo '<font color="red"><br />- successfully sent and will be fixed shortly<br /></font>';
}
}




?>
<br />
<br />

<form action="report_error.php?send=true" method="post">
<input type="hidden" name="by" value="<?php echo $_COOKIE['user']; ?>" />

Message:
<br />
<textarea rows="5" cols="30" name="error">
<?php

if(isset($_POST['error'])){
echo $_POST['error'];
}

?>
</textarea>

<br />

<input type="submit" name="submit" value="submit" />

</form>



</div>


<?php

include('Includes/Footer.php');

?>



</body>
</html>

<?php

} else {

header("Location: login.php");

}


?>