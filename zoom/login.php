<?php
/*
After user login the wechat Mini App they will recieve a code and this php serves to get session_key and openid from wechat

According to Wechat, you will need to create your own login session using the session_key but for now this will just retrun all the data to the MiniApp

OpenID is a unique id for each user created when they first use our system. 
It is not WechatID.


*/


$appid = "wxdf874a02383b8f72"; //hardcoded 
$secret = '593ebd49e39aef00923e4820713758bc'; //hardcoded
$js_code = $_GET['code']; 
$grant_type = 'authorization_code';



$post_data = array(
    'appid' => $appid,
    'secret' => $secret,
    'js_code' => $js_code,
    'grant_type'=> $grant_type,

);

$url = 'https://api.weixin.qq.com/sns/jscode2session?appid='.$appid.'&secret='.$secret.'&js_code='.$js_code.'&grant_type=authorization_code';


$json = file_get_contents($url);
echo $json;


/*
See:
https://www.w3cschool.cn/weixinapp/weixinapp-api-login.html#wxloginobject

sample request
https://api.weixin.qq.com/sns/jscode2session?appid=wxdf874a02383b8f72&secret=593ebd49e39aef00923e4820713758bc&js_code=002bHC160BD0rH1JQM060TGF160bHC1G&grant_type=authorization_code


sample return
{"session_key":"OTcSH78loMXNa6gGt5Ivqg==","expires_in":7200,"openid":"ouKwA0Wloj5SkJjmT0tsOn515SOI"}
*/

?>	