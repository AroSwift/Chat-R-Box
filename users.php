<?php


$title = 'Users';
$on = 'Users';
include('Includes/Header.php');

require_once("Includes/connection.php");


?>


<div id="Content">
<h1>Users</h1>
<a href="index.php?start=0"><-Back</a> 
<b>-</b>
<a href="profile.php?name=<?php echo $_COOKIE['user']; ?>">My Profile</a> 
<br />
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

var url = 'users_update.php?start=<?php echo $start; ?>';
var pars = '';
var target = 'update';
var myAjax = new Ajax.PeriodicalUpdater(target, url, {method: 'get', parameters: pars});

}

  
</script>

<div id="update"></div>




</div>


<?php

include('Includes/Footer.php');

?>



</body>
</html>