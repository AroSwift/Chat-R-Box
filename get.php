
<?php 

require_once("Includes/connection.php");



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


echo '<ul><li>';

$get2 = mysql_query("SELECT * FROM users WHERE name='$by'");
while($row = mysql_fetch_assoc($get2)){

$picture = $row['picture_url'];


if($picture){
echo '<image src="Upload/'.$picture.'" width="70" height="60" /><br />';
} else {
echo '<image src="Upload/no_picture.png" width="70" height="60" /><br />';
}




}

echo $by.'Wrote On '.$date.' At '.$time.'<br />';
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