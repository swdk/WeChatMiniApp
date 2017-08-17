//index.js
//获取应用实例
const app = getApp()

Page({
  data: {
    userInfo: {},
    hasUserInfo: false, 
    array: ['Accounting', 'Information Technology', 'Business Developement'],
    objectArray: [
      {
        id: 0,
        name: 'Accounting'
      },
      {
        id: 1,
        name: 'Information Technology'
      },
      {
        id: 2,
        name: 'Business Developement'
      },
      {
        id: 3,
        name: ''
      }
    ],
    index :0
  },
    bindPickerChange: function (e) {
      console.log('picker发送选择改变，携带值为', e.detail.value)
      this.setData({
        index: e.detail.value
      })
  }, formSubmit: function (e) {
    console.log('form发生了submit事件，携带数据为：', e.detail.value)
    wx.request({
      url: 'http://localhost/zoom/request.php', //仅为示例，并非真实的接口地址
      data: {
        userInfo: app.globalData.userInfo,
        formdata: e.detail.value
      },
      header: {
        "Content-Type": "application/json"
      },
      success: function (res) {
        console.log(res.data)
        wx.navigateTo({
          url: '../table/table'
        })

      }
    })
  },
  formReset: function () {
    console.log('form发生了reset事件')
    this.setData({
      index: 0
    })
  },

  onLoad: function () {
    if (app.globalData.userInfo) {
      this.setData({
        userInfo: app.globalData.userInfo,
        hasUserInfo: true
      })
    } else {
      // 由于 getUserInfo 是网络请求，可能会在 Page.onLoad 之后才返回
      // 所以此处加入 callback 以防止这种情况
      app.userInfoReadyCallback = res => {
        this.setData({
          userInfo: res.userInfo,
          hasUserInfo: true
        })
      }
    }
  },
  getUserInfo: function (e) {
    this.setData({
      userInfo: e.detail.userInfo,
      hasUserInfo: true
    })
  },
  viewrequest: function (e) {
    wx.navigateTo({
      url: '../table/table'
    })
  }
})