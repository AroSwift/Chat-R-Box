<?php

if(isset($_COOKIE['user'])){


$title = 'Check Mail';
$on = 'Check Mail';
include('Includes/Header.php');


require_once("Includes/connection.php");


?>

<div id="Content">



<div id="Check_mail">
<br />
<h3>Message:</h3>
<?php


if(isset($_GET['message'])){
echo wordwrap($_GET['message'], 30, '<br />', true);
} else {
echo $_GET['message'] = 'You Must select a message';
}


?>
</div>



<h1>Check Mail</h1>

<a href="index.php?start=0"><-Back</a> 
<b>-</b> 
<a href="send_mail.php">Send Mail</a>
<br />
<?php





$per_page = 10;


if(isset($_GET['start'])){
$start = $_GET['start'];
} else {
$start = 0;
}

if(isset($_GET['message'])){
$message = $_GET['message'];
} else {
$message = '';
}



$record_count = mysql_num_rows(mysql_query("SELECT * FROM mail"));

$max_pages = $record_count / $per_page;

if(!$start){

$start = 0;

}




?>

<script type="text/javascript" src="prototype.js"></script>
<script type="text/javascript">


Event.observe(window, 'load', init, false);


function init(){

var url = 'get_mail.php?start=<?php echo $start.'&message='.$message; ?>';
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

<?php

} else {

header("Location: login.php");

}


?>