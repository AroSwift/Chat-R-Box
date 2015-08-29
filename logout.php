<?php


setcookie("user","$_POST[name]",time()-3600);
header('Location: login.php');







?>