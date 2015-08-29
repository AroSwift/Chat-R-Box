<?php


$title = 'Admin area';
$on = 'Admin area';
include('Includes/Header.php');


require_once("Includes/connection.php");


if(isset($_COOKIE['user']) && isset($_COOKIE['admin'])){


?>


<div id="Content">
<h1>Admin Area</h1>
<a href="index.php?start=0"><-Back</a> 
<br />
<br />

<?php





?>

</div>

<?php

} else {

?>


<div id="Content">
<h1>Admin Area</h1>
<a href="index.php?start=0"><-Back</a> 
<br />
<br />

You are not atherized to view this.



</div>

<?php

}


include('Includes/Footer.php');

?>


</body>
</html>