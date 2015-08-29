<?php

if(isset($_COOKIE['user'])){


$title = 'Profile';
$on = 'Profile';
include('Includes/Header.php');


require_once("Includes/connection.php");


?>

<div id="Content">


<div id="Profile">

<h3>Other Profiles</h3>
<br />

<?php


if(isset($_GET['start'])){
$start = $_GET['start'];
} else {
$start = 0;
}



?>


<script type="text/javascript" src="prototype.js"></script>
<script type="text/javascript">


Event.observe(window, 'load', init, false);


function init(){

var url = 'users_update_profile.php?start=<?php echo $start.'&name='.$_GET['name']; ?>';
var pars = '';
var target = 'update';
var myAjax = new Ajax.PeriodicalUpdater(target, url, {method: 'get', parameters: pars});

}

  
</script>

<div id="update"></div>




</div>

<h1>Profile
<?php



if(isset($_GET['name'])){




$get = mysql_query("SELECT * FROM users WHERE name = '$_GET[name]' LIMIT 1");
while($row = mysql_fetch_assoc($get)){

$name = $row['name'];

echo ' Of '.$name;

}



} else {

$get = mysql_query("SELECT * FROM users WHERE name = '$_COOKIE[user]' LIMIT 1");
while($row = mysql_fetch_assoc($get)){

$name = $row['name'];

echo ' Of '.$name;


}

}

?>
</h1>
<a href="index.php?start=0"><-Back</a> 
<b>-</b>
<a href="profile.php?start=<?php if($start){ echo $start; } else { echo 0; } ?>&name=<?php echo $_COOKIE['user']; ?>">My Profile</a> 
<br />

<?php


if(isset($_GET['pic'])){
if($_GET['pic'] == 'true'){

if(isset($_POST['delete_pic'])){


$get = mysql_query("SELECT * FROM users WHERE name = '$_COOKIE[user]' LIMIT 1");
while($row = mysql_fetch_assoc($get)){

$picture = $row['picture_url'];
$to_delete = 'Upload/'.$picture;
unlink($to_delete);

}


$sql = "UPDATE users SET picture_url = '' WHERE name = '$_COOKIE[user]'";
mysql_query($sql);

header("Location: profile.php?deleted_pic=true&name=$_COOKIE[user]");




} else {


$temp = $_FILES['pic']['tmp_name'];
$name = $_FILES['pic']['name'];
$type = $_FILES['pic']['type'];


if($type == 'image/jpeg' || $type == 'image/bmp' || $type == 'image/png' || $type == 'image/gif'){



$name = $_COOKIE['user'].'_'.$name;



move_uploaded_file($temp,"Upload/".$name);

$sql = "UPDATE users SET picture_url = '$name' WHERE name = '$_COOKIE[user]'";
$result = mysql_query($sql);
echo $result ? 'yes' : 'no';


if($result == 'yes'){
header("Location: profile.php?insert=successful&name=$_COOKIE[user]");
} else {
header("Location: profile.php?insert=unsuccessful&name=$_COOKIE[user]");
}

} else {
header("Location: profile.php?insert=unsuccessful-notv&name=$_COOKIE[user]");
}



} // delete pic

}
}



if(isset($_GET['about'])){
if($_GET['about'] == 'true'){
if(isset($_POST['about'])){


if(strlen($_POST['about']) >= 1000) {
header("Location: profile.php?insert=unsuccessful-long&name=$_COOKIE[user]");
} elseif(strlen($_POST['about']) == 0){
header("Location: profile.php?insert=unsuccessful-emtpy&name=$_COOKIE[user]");
} else {

$sql = "UPDATE users SET about = '$_POST[about]' WHERE name = '$_COOKIE[user]'";
$result = mysql_query($sql);
echo $result ? 'yes' : 'no';



if($result == 'yes'){
header("Location: profile.php?insert=successful&name=$_COOKIE[user]");
} else {
header("Location: profile.php?insert=unsuccessful&name=$_COOKIE[user]");
}

}



}
}
}







if(isset($_GET['deleted_pic'])){
if($_GET['deleted_pic'] == 'true'){
echo '<font color="red">- Picture successfully deleted<br /></font>';
}
}


if(isset($_GET['insert'])){
if($_GET['insert'] == 'unsuccessful-notv'){
echo '<font color="red">- That file is not valid - Unsuccessfully changed<br /></font>';
}
}


if(isset($_GET['insert'])){
if($_GET['insert'] == 'unsuccessful-long'){
echo '<font color="red">- To long (500 max) - Unsuccessfully changed<br /></font>';
}
}


if(isset($_GET['insert'])){
if($_GET['insert'] == 'unsuccessful-emtpy'){
echo '<font color="red">- Empty, Unsuccessfully changed<br /></font>';
}
}


if(isset($_GET['insert'])){
if($_GET['insert'] == 'successful'){
echo '<font color="red">- Changed successfully<br /></font>';
}
}


if(isset($_GET['insert'])){
if($_GET['insert'] == 'unsuccessful'){
echo '<font color="red">- Unsuccessfully changed<br /></font>';
}
}


echo '<br />';



if(isset($_GET['name'])){


$get = mysql_query("SELECT * FROM users WHERE name = '$_GET[name]' LIMIT 1");
while($row = mysql_fetch_assoc($get)){

$name = $row['name'];
$picture = $row['picture_url'];
$about = $row['about'];

if($picture){
echo '<br /><image src="Upload/'.$picture.'" width="230" height="200" />';
} else {
echo '<br /><image src="Upload/no_picture.png" width="230" height="200" />';
}

if(!($_COOKIE['user'] == $name)){
if(!(empty($about))){
echo '<br /><h3>About:</h3><p id="pro-about">'.wordwrap($about, 60, '<br />', true).'</p>';
} else {
echo '<br /><br />This hasn\'t said anything about them self yet.';
}
}



echo '<br /><br />';


if($_COOKIE['user'] == $name){

?>

<form action="profile.php?pic=true" method="post" enctype="multipart/form-data">

<input type="file" name="pic" />
<br />
<input type="submit" value="change" /> 
<input type="submit" value="Delete" name="delete_pic" />


</form>

<?php



if(!(empty($about))){
echo '<br /><h3>About Me:</h3><p id="pro-about">'.wordwrap($about, 60, '<br />', true).'</p>';
}


?>

<br />
<form action="profile.php?about=true" method="post">

About:
<br />
<textarea cols="30" rows="7" name="about">
<?php

if(isset($_POST['message'])){
echo $_POST['message'];
} else {

$get = mysql_query("SELECT * FROM users WHERE name = '$_COOKIE[user]' LIMIT 1");
while($row = mysql_fetch_assoc($get)){

echo $row['about'];

}

}

?>
</textarea>

<br />
<input type="submit" value="change" />

<?php

}

}


} else {



$get = mysql_query("SELECT * FROM users WHERE name = '$_COOKIE[user]' LIMIT 1");
while($row = mysql_fetch_assoc($get)){

$name = $row['name'];
$picture = $row['picture_url'];
$about = $row['about'];


if($picture){
echo '<br /><image src="Upload/'.$picture.'" width="230" height="200" />';
} else {
echo '<br /><image src="Upload/no_picture.png" width="230" height="200" />';
}

echo '<br /><br />';


if($_COOKIE['user'] == $name){

?>

<form action="profile.php?pic=true" method="post" enctype="multipart/form-data">

<input type="file" name="pic" />
<br />
<input type="submit" value="change" />


</form>
<?php

}

if(!(empty($about))){
echo '<br /><h3>About Me:</h3><p id="pro-about">'.wordwrap($about, 60, '<br />', true).'</p>';
}



if($_COOKIE['user'] == $name){

?>

<form action="profile.php?pic=true" method="post" enctype="multipart/form-data">

<input type="file" name="pic" />
<br />
<input type="submit" value="change" />


</form>
<?php


if(!(empty($about))){
echo '<br /><h3>About Me:</h3><p id="pro-about">'.wordwrap($about, 60, '<br />', true).'</p>';
}

?>

<br />
<form action="profile.php?about=true" method="post">

About:
<br />
<textarea cols="30" rows="7" name="about">
<?php

if(isset($_POST['message'])){
echo $_POST['message'];
} else {

$get = mysql_query("SELECT * FROM users WHERE name = '$_COOKIE[user]' LIMIT 1");
while($row = mysql_fetch_assoc($get)){

$about = $row['about'];


if(!(empty($about))){
echo '<br /><h3>About Me:</h3><p id="pro-about">'.wordwrap($about, 60, '<br />', true).'</p>';
}




}

}

?>
</textarea>

<br />
<input type="submit" value="change" />

<?php


}


?>

<br />
<br />

<?php


}

}




?>
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