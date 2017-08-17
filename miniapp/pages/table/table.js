// table.js
Page({

  data: {
    listData: [

    ]
  },
  requestData() {
    var that = this
    wx.request({
      url: 'http://localhost/zoom/getrequest.php', //仅为示例，并非真实的接口地址
      success: function (res) {//更新数据刷新UI

        var list = that.data.listData;
        for (var i = 0; i < res.data.length; i++) {
          list.push({"code": res.data[i][0], "text": res.data[i][1], "type": res.data[i][2]});
        }
        console.log(list);
        that.setData({
          listData: list,//更新数据
        })
      },
       
     
    })
  },
  onLoad: function (options) {
   
    this.requestData();
  },
  


})