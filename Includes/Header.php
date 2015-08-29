<?php

header("Cache-Control: no-cache");
set_time_limit(5);

?>
<html>
<head>
<title>Chatr Box - <?php if(isset($title)){ echo $title; } ?></title>
<script type="text/javascript"src="http://ajax.googleapis.com/ajax/libs/jquery/1.4.2/jquery.min.js"></script>
<script>
$(document).ready(function(){

    $("#Content").hide();
    $("#Content").show(1500);


});
</script>
<style type="text/css">

body{
background-color: rgb(170,160,50);
padding: 0px;
margin: 0px;
overflow: none;
width: 100%;
}

#Header{
background-color: #8C2920;
padding: 40px;
background-image: url(Symbol.png);
background-repeat: no-repeat;
text-align: right;
}

#HeaderLinks{
background-color: #8C2920;
padding: 8px;
padding-left: 0px;
}


/* rgb(170,160,50) #191D1C*/



#HeaderLinks .on{
background-color: rgb(170,160,50);
-moz-border-radius: 10px 10px 0px 0px;
}

#HeaderLinks a{
color: #18334F;
font-weight: bold;
font-size: 21px;
text-decoration: none;
padding: 10px;
}

#HeaderLinks a:hover{
color: #1F4266;
}

#Content{
background-color: rgb(170,160,50);
padding-top: 20px;
padding-bottom: 350px;
padding-left: 15px;
padding-right: 15px;
font-family: Georgia;
color: #566629;
line-height: 23px;
color: black;
font-size: 18px;
font-weight: bold;
}

#content a{
color: #693D1F;
text-decoration: none;
display: inline;
}

#content a:hover{
color: #874F28;
}

#content li{
list-style-type: none;
margin-left: -30px;
padding: 5px;
display: block;
}

#content li:hover{
background-color: #3C7B91;
}

#Footer{
background-color: #BF8756;
padding-top: 15px;
padding-bottom: 7px;
padding-left: 10px;
padding-right: 3px;
margin-bottom: 0px;
clear: both;
font-size: 18px;
}

/* More */

#Login-index{
float: right;
padding: 0px 60px 60px 60px;
}

#Signup-index{
float: right;
padding: 0px 60px 60px 60px;
margin-top: -50;
clear: right;
}

#Profile{
float: right;
padding: 0px 60px 60px 60px;
clear: both;
}

#pro-about{
max-width: 50%;
padding: 5px 5px 5px 5px;
}

#pro-about:first-letter{
font-size: 40px;
text-transform:capitalize;
font-style: italic;
}

#Check_mail{
float: right;
padding: 0px 60px 60px 60px;
clear: both;
}

input:focus{
background-color: #BFB6AB;
color: #403D0A;
}

input:hover{
border: 2px solid red;
}

textarea:focus{
background-color: #BFB6AB;
color: #403D0A;
}

textarea:hover{
border: 2px solid red;
}

</style>
</head>
<body>


<div id="Header">
</div>


<div id="HeaderLinks">
<a href="index.php?start=0" <?php if($title == 'Home'){ echo 'class="on"'; } ?> >Home</a>
<a href="login.php" <?php if($title == 'Login'){ echo 'class="on"'; } ?> >Login</a>
<a href="signup.php" <?php if($title == 'SignUp'){ echo 'class="on"'; } ?> >SignUp</a>
</div>
