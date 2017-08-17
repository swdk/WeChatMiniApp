

<?php




/*
READ ME
This is a sample request sent from the mini app

http://localhost/zoom/request.php?userInfo=%7B%22nickName%22%3A%22Samuel%20Kong%22%2C%22gender%22%3A1%2C%22language%22%3A%22zh_HK%22%2C%22city%22%3A%22%22%2C%22province%22%3A%22%22%2C%22country%22%3A%22%22%2C%22avatarUrl%22%3A%22https%3A%2F%2Fwx.qlogo.cn%2Fmmopen%2Fvi_32%2FUF4tyJKXiclL0gECIbcJB307OXFf9cVeavTerTEGOCArznje9dJOhiaZvJ8tbxbiajoBO5G6qxTyiaFFcWNMX1AK7w%2F0%22%7D&formdata=%7B%22picker%22%3A0%2C%22textarea%22%3A%22%22%7D



if you paste the above code into URL_DECODE
http://www.convertstring.com/zh_CN/EncodeDecode/UrlDecode
you can get the following messages, but this will be handled by php automatically

http://localhost/zoom/request.php?userInfo={"nickName":"Samuel Kong","gender":1,"language":"zh_HK","city":"","province":"","country":"","avatarUrl":"https://wx.qlogo.cn/mmopen/vi_32/UF4tyJKXiclL0gECIbcJB307OXFf9cVeavTerTEGOCArznje9dJOhiaZvJ8tbxbiajoBO5G6qxTyiaFFcWNMX1AK7w/0"}&formdata={"picker":0,"textarea":""}


So this php handles the above requet by first extracting the useful data and then inserting thme into db

you can paste the url into the browser, I displayed all info extracted from the request using echo
*/

$query = $_GET["userInfo"];

//getting data seperated by ,
//the getting the value (the things after the :)
$pieces = explode(",", $query);
$nickname = getvalue($pieces[0]); 
echo ($nickname);
echo "<br>";
$gender = getvalue($pieces[1]);  
echo($gender);
echo "<br>";
$language =  getvalue($pieces[2]); 
echo($language);
echo "<br>";
$city =  getvalue($pieces[3]); 
echo($city);
echo "<br>";
$province =  getvalue($pieces[4]);
echo ($province);
echo "<br>";
$country =  getvalue($pieces[5]); 
echo ($country);
echo "<br>";
$avatarurl =  getvalue($pieces[6]); 
echo ($avatarurl);
echo "<br>";

//form data sent from micro app
//picker is the business type request
$formdata = $_GET["formdata"];
$pieces = explode(",", $formdata);
$picker =  getvalue($pieces[0]); 

if($picker=="0"){
	$picker = "Accounting";
}else if ($picker=="1"){
	$picker = "Information Technology";
}
else if ($picker=="2"){
	$picker = "Business Developement";
}
echo ($picker);
echo "<br>";
//text area is the details of the reqeust sent by user
$textarea =  getvalue($pieces[1]); 
echo ($textarea);


//helper function to get the value part from the key:value format sent from request
Function getvalue($string){ 
	$pos = strpos($string, "https");
		if ($pos !== false) {
			//handle url
		         $pieces = explode("https", $string);
		         $value = ("https".$pieces[1]);
		         $value = preg_replace('/[}"]/s','',$value);
		         //replacing } and "
		         $value = str_replace( '/', '\\', $value);
		         //replace / with \ so so it will not get messed up in mysql
		         Return $value;
		} else {
			//handle other data, get only the value needed
			$pieces = explode(":", $string);
			$value = str_replace( array( '{','}',"\"" ), '', $pieces[1]);
			Return $value;   
		}
} 


//db connections

$con = mysql_connect("localhost","root","");
if (!$con)
  {
  die('Could not connect: ' . mysql_error());
  }

mysql_select_db("zoom", $con);

mysql_query("INSERT INTO requests (user_name, business, details) 
VALUES ('$nickname','$picker','$textarea')");


mysql_close($con);




?>
