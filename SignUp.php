<?php



$title = 'SignUp';
$on = 'SignUp';
include('Includes/Header.php');


require_once("Includes/connection.php");


?>


<div id="Content">

<h1>Sign Up!</h1>

<?php

$errors = '';

if(isset($_POST['submit'])){


if(empty($_POST['s_name'])){
$errors = '- Name is empty!';
}

if(empty($_POST['s_password'])){
$errors = '- Password is empty!';
}

if(30 <= strlen($_POST['s_name'])){
$errors = '- Name is more than 30 charecters';
}

if(3 >= strlen($_POST['s_name'])){
$errors = '- Name is less then 3 charecters';
}

if(30 <= strlen($_POST['s_password'])){
$errors = '- Password is more than 30 charecters';
}

if(3 >= strlen($_POST['s_password'])){
$errors = '- Password is less then 3 charecters';
}


$query = "SELECT * FROM users WHERE name = '$_POST[s_name]'";
$result = mysql_query($query);

while($row = mysql_fetch_array($result)){
$name = $row['name'];

if($name === $_POST['s_name']){

$errors .= '- That user name already is taken<br />';


}
}



echo '<font color="red">'.$errors.'<br /></font>';



if(strlen($errors) === 0){

require_once("Includes/connection.php");

$name = trim(strip_tags($_POST['s_name']));
$password = trim(strip_tags($_POST['s_password']));


$sql = "INSERT INTO users (name, password) VALUES ('$name', '$password')";
$result = mysql_query($sql);
echo $result ? '  ' : '';


if(isset($_POST['s_name']) && $result == '  '){

setcookie("user","$_POST[s_name]",time()+3600);

unset($_POST['name']);
unset($_POST['password']);
echo 'Account created!<br/>You are now logged in<br />';

} elseif(isset($_POST['s_name']) && $result == '  '){

echo 'Account created! <br /> <a href="login.php">Login</a> <br /> <br />';


} else {

echo '<font color="red">- Account NOT created </font> <br /> <br />';

}



}








}



?>


<br />


<form action="signup.php" method="post">
Name:
<br /> 
<input type="text" name="s_name" maxlength="30" value="
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
<input type="text" name="s_password" maxlength="30" value="
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


<?php

include('Includes/Footer.php');

?>



</body>
</html>