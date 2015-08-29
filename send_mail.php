<?php

if(isset($_COOKIE['user'])){


$title = 'Send Mail';
$on = 'Send Mail';
include('Includes/Header.php');



?>

<div id="Content">

<h1>Send Mail</h1>

<a href="index.php?start=0"><-Back</a> 
<b>-</b> 
<a href="check_mail.php?start=0">Check Mail</a>
<br />

<?php

$errors = '';

if(isset($_GET['send'])){
if($_GET['send'] == 'true'){

if(isset($_POST['message']) && isset($_POST['to'])){
if(!(empty($_POST['message']))){


require_once("Includes/connection.php");

$date = date('m-d-Y');
$time = date('g:i A');


$sql = "INSERT INTO mail (m_to, m_from, message, date, time) VALUES ('$_POST[to]', '$_POST[from]', '$_POST[message]', '$date', '$time')";
$result = mysql_query($sql);
echo $result ? 'yes' : 'no';


if($result == 'yes'){
header("Location: send_mail.php?insert=successful");
} else {
header("Location: send_mail.php?insert=unsuccessful");
}


} else {
$errors .= '<font color="red">- Message is empty<br /></font>';
}


} else {
$errors .= '<font color="red">- Message is empty<br /></font>';
}

} else {
$errors .= '<font color="red">- Message is empty<br /></font>';
}

}



if(isset($_GET['insert'])){
if($_GET['insert'] == 'successful'){
echo '<font color="red">- Your message was sent successfully<br /></font>';
}
}


if(isset($_GET['insert'])){
if($_GET['insert'] == 'unsuccessful'){
echo '<font color="red"><br /><br />- Your message was NOT successfully sent<br /></font>';
}
}



if(isset($errors)){
echo $errors;
}


echo '<br />';




?>

<form action="send_mail.php?send=true" method="post">
<input type="hidden" name="from" value="<?php echo $_COOKIE['user']; ?>" />
To: <br /><select name="to">


<?php

require_once("Includes/connection.php");

$sql = "SELECT * FROM users ORDER BY id DESC";
$result = mysql_query($sql);
while($row = mysql_fetch_assoc($result)){

$name = $row['name'];


if($_COOKIE['user'] === $name){

$name = $name.' (You)';


}


echo '<option value="'.$name.'">'.$name.'</option>';




}

?>

</select>
<br />
<br />
Message:
<br />
<textarea rows="7" cols="30" name="message">
<?php

if(isset($_POST['message'])){
echo $_POST['message'];
}

?>
</textarea>
<br />
<input type="submit" name="submit" value="send" />


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