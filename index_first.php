<?php


$title = 'Home';
$on = 'Home';
include('Includes/Header.php');

require_once("Includes/connection.php");

?>


<script type="text/javascript" src="prototype.js"></script>
<script type='text/javascript'>

Event.observe(window, 'load', init, false);

function init(){


var url = 'index2.php';
var pars = '';
var target = 'update';
var myAjax = new Ajax.PeriodicalUpdater(target, url, {method: 'get', parameters: pars});


}

  
</script>


<div id="Content">

<?php


if(isset($_COOKIE['user'])){

echo '<h1>Welcome '.$_COOKIE['user'].'!</h1>';


echo '<a href="send_mail.php?start=0">Send Mail</a> <b>-</b> ';
echo ' <a href="check_mail.php?start=0">Check Mail</a> <b>-</b> ';
echo '<a href="report_error.php">Reprot Error</a> <b>-</b> ';
echo '<a href="users.php?start=0">Users</a> <b>-</b> ';
echo '<a href="profile.php?start=0&name='.$_COOKIE['user'].'">My Profile</a> <b>-</b> ';
echo '<a href="logout.php">Logout</a> ';


if(isset($_POST['submit'])){
if(isset($_GET['mkm'])){
if($_GET['mkm'] = 'true'){
if(!(empty($_POST['message']))){
if(isset($_POST['by']) && isset($_POST['message'])){
if(!($_POST['message']) <= 50){

$date = date('Y-m-d');
$time = date('g:i A');

$sql = "INSERT INTO chat (created_by, content, date, time) VALUES ('$_POST[by]', '$_POST[message]', '$date', '$time')";
$result = mysql_query($sql);
echo $result ? 'yes' : 'no';


if($result == 'yes'){
header("Location: index.php?insert=successful");
} else {
header("Location: index.php?insert=unsuccessful");
}



} else {
echo '<font color="red"><br /><br />- Message to long</font>';
}

} else {
echo '<font color="red"><br /><br />- Error</font>';
}
} else {
echo '<font color="red"><br /><br />- Your message is empty</font>';
}
}
}
}


if(isset($_GET['insert'])){
if($_GET['insert'] == 'successful'){
echo '<font color="red"><br /><br />- Your message was created successfully</font>';
}
}


if(isset($_GET['insert'])){
if($_GET['insert'] == 'unsuccessful'){
echo '<font color="red"><br /><br />- Your message was NOT successfully created</font>';
}
}

echo '<br /><br /><br />';


$per_page = 5;


if(isset($_GET['start'])){
$start = $_GET['start'];
} else {
$start = 0;
}

$record_count = mysql_num_rows(mysql_query("SELECT * FROM chat"));

$max_pages = $record_count / $per_page;

if(!$start){

$start = 0;

}



$get = mysql_query("SELECT * FROM chat ORDER BY id DESC LIMIT $start, $per_page");
while($row = mysql_fetch_assoc($get)){

$by = $row['created_by'];
$message = $row['content'];
$date = $row['date'];
$time = $row['time'];

echo '<ul><li>Wrote By '.$by.' On '.$date.' At '.$time.'<br />';
echo $message.'<br /></li></ul>';

}

echo '<hr style="width: 300px; float: left;" /> <br />';

$prev = $start - $per_page;
$next = $start + $per_page;



if(!($start<=0)){
echo '<a href="index.php?start='.$prev.'">Prev</a>&ensp;';
}



$i = 1;

for($x=0; $x<$record_count; $x = $x + $per_page){

if($start != $x){

echo' <a href="index.php?start='.$x.'">'.$i.'</a> ';

} else {
echo' <a href="index.php?start='.$x.'" style="font-size: 20px;"><b>'.$i.'</b></a> ';
}

$i++;


}


if(!($start>=$record_count-$per_page)){
echo '&ensp;<a href="index.php?start='.$next.'">Next</a>';
}



?>


<br />
<br />
<br />

<form action="index.php?start=<?php echo $start; ?>&mkm=true" method="post">
<input type="hidden" name="by" value="<?php echo $_COOKIE['user']; ?>" />

Message:
<br />
<textarea rows="5" cols="30" name="message">
<?php

if(isset($_POST['message'])){
echo $_POST['message'];
}

?>
</textarea>

<br />

<input type="submit" name="submit" value="submit" />

</form>
<?php


} else {


?>




<div id="Login-index">
<h3>Login</h3>




<form action="login.php" method="post">
Name:
<br />
<input type="text" name="name" value="
<?php

if(isset($_POST['name'])){
echo $_POST['name'];
}

?>
" />
<br />
<br />
Password:
<br />
<input type="password" name="password" value="
<?php

if(isset($_POST['password'])){
echo $_POST['password'];
}

?>
" />
<br />
<input type="submit" name="submit" value="submit" />

</form>

</div>
<div id="Signup-index">

<h3>Sign Up</h3>

<form action="signup.php" method="post">
Name:
<br />
<input type="text" name="s_name" value="
<?php


if(isset($_POST['s_name'])){
echo $_POST['s_name'];
}


?>
" />
<br />
<br />
Password:
<br />
<input type="text" name="s_password" value="
<?php


if(isset($_POST['s_password'])){
echo $_POST['s_password'];
}


?>
" />
<br />
<input type="submit" name="submit" value="Submit" />


</form>






</div>






<h1>About Chatr Box</h1>
With the New Chatr box out 
<?php



require_once("Includes/connection.php");
$query = "SELECT * FROM admin";

$result = mysql_query($query);

while($row = mysql_fetch_array($result)){
echo '('.$row['version'].')';

}

?>

.  
I think it could amount to something.  
I decided to make some changes like messaging and some other things that you probally wont notice.  
But there is one problem I had with the last one.  I had Jquery in the wrong place and css too so it didn't make some of the colors show correctly!  
I was wanting to make it as automatice and self runing as possibe.  
So enough about that old one!  Let me tell you what I made the new one with.  
HTML, CSS, PHP, MYSQL (PHPmyadmin) and sql statements, with some javascript. 
This took me about 13 - 15 hours (Coding).  Testing took about 4 hours.
<br />
<br />

Programmer,
<br />
<i>Aaron</i>
<?php

}

?>
</div>


<?php

include('Includes/Footer.php');

?>



</body>
</html>