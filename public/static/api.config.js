// 长连接地址
var socketUri = 'ws://wechat.ppe.app:7272';

var webHost = 'http://wechat.ppe.app/';

// 后台地址
var webRoute = {
    bind:webHost+"bind",
    // 主面板
    panel: {
        init: webHost + 'UserInfo/init',
        //获取群员接口
        getMembers: webHost + 'UserInfo/getMembers',
        findGroup: webHost + '',
    },
    chat: {
        uploadFile: webHost + 'upload/uploadFile',
        uploadimg: webHost + 'upload/uploadimg',
        log: webHost + 'Chatlog/index'
    },
    chat:{
        send:   webHost + 'Chat/send',
    }
};