
<?php 

require_once("Includes/connection.php");



if(isset($_GET['delete']) && $_GET['id']){
if($_GET['delete'] == 'true'){

mysql_query("DELETE FROM mail WHERE id='$_GET[id]' LIMIT 1");

}
}


$get = mysql_query("SELECT * FROM mail WHERE m_to = '$_COOKIE[user]' OR m_to = '$_COOKIE[user] (You)'");
echo 'You have '.mysql_num_rows ($get).' Mail<br /><br />';




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




$get = mysql_query("SELECT * FROM mail ORDER BY id DESC LIMIT $start, $per_page");
while($row = mysql_fetch_assoc($get)){

$to = $row['m_to'];
$from = $row['m_from'];
$message = $row['message'];
$date = $row['date'];
$time = $row['time'];
$id = $row['id'];


if($to === $_COOKIE['user'].' (You)' || $to === $_COOKIE['user']){

echo '<ul><li>From '.$from.' Sent '.$date.' at '.$time.' ';
?>
<a href="check_mail.php?start=<?php echo $start; ?>&message=<?php echo $message; ?>">Open</a>
&ensp;
<a href="check_mail.php?delete=true&id=<?php echo $id.'&start'.$start; ?>">Delete</a>
</li></ul>

<?php


}
}


echo '<br /><hr style="width: 300px; float: left;" /> <br />';

$prev = $start - $per_page;
$next = $start + $per_page;



if(!($start<=0)){
echo '<a href="check_mail.php?start='.$prev.'">Prev</a>&ensp;';
}



$i = 1;

for($x=0; $x<$record_count; $x = $x + $per_page){

if($start != $x){

echo' <a href="check_mail.php?start='.$x.'">'.$i.'</a> ';

} else {
echo' <a href="check_mail.php?start='.$x.'" style="font-size: 20px;"><b>'.$i.'</b></a> ';
}

$i++;


}


if(!($start>=$record_count-$per_page)){
echo '&ensp;<a href="check_mail.php?start='.$next.'">Next</a>';
}



?>