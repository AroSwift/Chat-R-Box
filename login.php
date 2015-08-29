<?php


$title = 'Login';
$on = 'Login';
include('Includes/Header.php');



?>


<div id="Content">


<h1>Login</h1>

<?php

$errors = '';

if(isset($_POST['submit'])){
if(isset($_POST['name']) && isset($_POST['password'])){

require_once("Includes/connection.php");
$query = "SELECT * FROM users WHERE name = '$_POST[name]' AND password = '$_POST[password]'";



$result = mysql_query($query);

while($row = mysql_fetch_array($result)){
$name = $row['name'];
$password = $row['password'];

if($name === $_POST['name'] && $password === $_POST['password']){

setcookie("user","$_POST[name]",time()+3600);
header('Location: index.php?start=0');


}


}



if(mysql_num_fields($result) > 1){
echo '<font color="red">- That user does not exist <br /> <br /></font>';
}



}

}



if(!(isset($_COOKIE['user']))){


?>

<form action="login.php" method="post">
Name:
<br />
<input type="text" name="name" maxlength="30" value="
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
<input type="password" name="password" maxlength="30" value="
<?php

if(isset($_POST['password'])){
echo $_POST['password'];
}

?>
" />
<br />
<input type="submit" name="submit" value="submit" />

</form>

<?php

} else {
echo 'Your already logged in as '.$_COOKIE['user'].'! <br /><a href="logout.php">Logout</a>';
}

?>

</div>


<?php

include('Includes/Footer.php');

?>



</body>
</html>