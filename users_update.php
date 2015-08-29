<?php 

require_once("Includes/connection.php");



$per_page = 20;


if(isset($_GET['start'])){
$start = $_GET['start'];
} else {
$start = 0;
}



$record_count = mysql_num_rows(mysql_query("SELECT * FROM users"));

$max_pages = $record_count / $per_page;

if(!$start){

$start = 0;

}



$get = mysql_query("SELECT * FROM users ORDER BY id DESC LIMIT $start, $per_page");
while($row = mysql_fetch_assoc($get)){

$name = $row['name'];
$picture = $row['picture_url'];

echo '
 <a href="profile.php?name='.$name.'">See Profile</a> Of 
';

if($picture){
echo $name.'<br /><image src="Upload/'.$picture.'" width="100" height="80" />';
} else {
echo $name.'<br /><image src="Upload/no_picture.png" width="100" height="80" />';
}

echo '<br /><br />';

}

echo '<br /><hr style="width: 300px; float: left;" /> <br />';

$prev = $start - $per_page;
$next = $start + $per_page;



if(!($start<=0)){
echo '<a href="users.php?start='.$prev.'">Prev</a>&ensp;';
}



$i = 1;

for($x=0; $x<$record_count; $x = $x + $per_page){

if($start != $x){

echo' <a href="users.php?start='.$x.'">'.$i.'</a> ';

} else {
echo' <a href="users.php?start='.$x.'" style="font-size: 20px;"><b>'.$i.'</b></a> ';
}

$i++;


}


if(!($start>=$record_count-$per_page)){
echo '&ensp;<a href="users.php?start='.$next.'">Next</a>';
}



?>