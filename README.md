ReadMe.txt

#WeChatMiniApp

This is a Simple Demonstration Using MiniApp and some basic APIs. <br>
We also build a simple php-mysql backend using xampp.<br>



##Demo
We will demonstrate connecting miniApp to backend using a simple Business requets platform

##Submitting the form
![Screenhot](1.png)
![Screenhot](2.png)
![Screenhot](8.png)

##Getting data from db and displaying it
![Screenhot](3.png)
![Screenhot](4.png)
![Screenhot](9.png)


##Part 2 Getting user detials and decrypting them

Getting userInfo with option withCredentials: true （See app.js) 
Documentation： https://mp.weixin.qq.com/debug/wxadoc/dev/api/network-request.html <br>

(We only displayed the encryptedData and iv part here)
![Screenhot](5.png)

After getting code from wx.login，we will then submit the code to our login.php and it will get session_key and 
![Screenhot](6.png)

Decrypting data by calling PHP/demo.php 
![Screenhot](7.png)



Setting Up the Backend
1.Installing xampp and starting the Apache and MySQL service
https://www.apachefriends.org/download.html

2. Copy the file zoom ito htdocs under the xampp root file

3. Import the mysql db


Setting up the MiniApp
1. Login https://mp.weixin.qq.com/ Wechat platform and and select the Add Mini App tab (you have to first passed the WeChat verification for company first http://kf.qq.com/faq/120911VrYVrA151214Fz26zm.html)



2. Create admin acount for MiniApp and fillin verification details

![Screenhot](10.png)

3. Login https://mp.weixin.qq.com/ again with the Mini App admin account, from there u should see the MiniApp tab

4. Add developers
![Screenhot](11.png)

5. Acquire the AppID and AppSecret fromt the option tab
![Screenhot](12.png)

6.Download the WeChat Developer Tool and login by scanning using the developers' wechat account

7.Filling the AppId and AppSecret and import the code




