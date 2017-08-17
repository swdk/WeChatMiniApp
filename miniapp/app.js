//app.js
App({
  onLaunch: function () {
    // 展示本地存储能力
    var logs = wx.getStorageSync('logs') || []
    logs.unshift(Date.now())
    wx.setStorageSync('logs', logs)

    // 登录
    wx.login({
      success: res => {
        if (res.code) {
          //发起网络请求
          wx.request({
            url: 'http://localhost/zoom/login.php',
            data: {
              code: res.code  
            },
            success: res =>{
              console.log('openid: ',res.data.openid);
              console.log('session_key: ',res.data.session_key);
              this.globalData.openid = res.data.openid;
              this.globalData.session_key = res.data.session_key;
              
              //getting UnionID
              //using iv,session_key,requestdata
              wx.request({
                url: 'http://localhost/zoom/PHP/demo.php',
                data: {
                  iv: this.globalData.iv,
                  session_key: this.globalData.session_key,
                  encryptedData: this.globalData.encryptedData
                },
                success: res => {
                  console.log('data: ', res.data);
                  this.globalData.UnionID = res.data.UnionID;
                  console.log('UnionID: ', this.globalData.UnionID);
                }
              })




            }
          })
        } else {
          console.log('获取用户登录态失败！' + res.errMsg)
        }
        // 发送 res.code 到后台换取 openId, sessionKey, unionId
      }
    })
    // 获取用户信息
    wx.getSetting({
      success: res => {
        if (res.authSetting['scope.userInfo']) {
          // 已经授权，可以直接调用 getUserInfo 获取头像昵称，不会弹框
          wx.getUserInfo({
            withCredentials: true,
            success: res => {
              // 可以将 res 发送给后台解码出 unionId
              this.globalData.userInfo = res.userInfo
              if (res.encryptedData){
                console.log("encryptedData: ",res.encryptedData)
                this.globalData.encryptedData = res.encryptedData;
              } 
              if(res.iv){
                console.log("iv: ",res.iv)
                this.globalData.iv = res.iv;
              }


              // 由于 getUserInfo 是网络请求，可能会在 Page.onLoad 之后才返回
              // 所以此处加入 callback 以防止这种情况
              if (this.userInfoReadyCallback) {
                this.userInfoReadyCallback(res)
              }
            }
          })
        }
      }
    })
    //getting unionID

  },
  globalData: {
    userInfo: null,
    requestdata: null,
    encryptedData: null,
    iv: null,
    openid :null,
    session_key: null,
    UnionID: null
  }
})