<?php
//db connection
$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("zoom", $con);

$result = mysql_query("SELECT * FROM requests");

 $pois = array();

//putting data into arrays of arrays to return, Mini App will then put them back to the request table
while($row = mysql_fetch_array($result))
  {
  $pois[] = array($row['user_name'],$row['business'],$row['details']);
}
echo json_encode($pois);


/*
array of objects

0 - [user_name,business,detials]
1 -	[user_name,business,detials]
2 - [user_name,business,detials]
...

*/



mysql_close($con);

?>