<?php if (!defined('THINK_PATH')) exit();?><!doctype html>
<html>
<head>
    <meta charset="UTF-8">
    <title>目录浏览</title>
    <script src="/Public/js/jquery-1.4.min.js"></script>
    <link type="text/css" href="/Public/css/jquery-ui.css" rel="stylesheet">
    <link type="text/css" href="/Public/css/jquery-contextMenu.css" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="/Public/css/jquery.jcarousel.css">
    <link rel="stylesheet" type="text/css" href="/Public/css/skin.css">
    <link type="text/css" href="/Public/css/CommonHeader.css" rel="stylesheet">
    <link type="text/css" href="/Public/css/list.css" rel="stylesheet">
    <link type="text/css" href="/Public/css/WebClientIcons.css" rel="stylesheet">
    <link type="text/css" href="/Public/css/CommonUI.css" rel="stylesheet">
    <style>
        table{
            text-align: left;
        }
        #ListFilesContainer  a{
            font-size: 9pt;
            color:black;
        }
    </style>
</head>
<body>
    <div id="container" style="overflow: hidden;">
        <div style="height:1px; background-color: #561D58" ></div>
        <div class="SUWCHeader" id="SUWCHeader" style="background-color: #7B7A7B;">
            <div class="SUWCsulogo">
                <a href="/Web Client/ListDir.htm">
                    <img class="SUWCHeadLogo" src="/Public/img/Gymbaby-Logo-Text-small.png?Width=160&amp;Height=40&amp;Thumbnail=1&amp;Sync=1516775639412" alt="Web 客户端" id="SULOGO" style="margin-right: 10px;" width="160" height="40" border="0"></a>
            </div>
            <div class="SUWCheadbar"></div>
            <div class="SUWCheadtext">Web 客户端</div>
            <div class="SUWCheadlinks">&nbsp;
                <span class="SUWCHeadUserField">
                  <span class="SUWCHeadLinkHand" id="SUWCHeadUsernameMenuOwner">
                    <span id="SUWCHeadUsername">
                      <span id="UserLogInFullName">测试中心</span>
                    </span>
                    <img src="/Public/img/icon_user_name_dropdown.png" alt="" style="margin-left: 4px;" border="0">
                  </span>
                </span>
            </div>
        </div>
        <div class="SUWCNavigationBar">
            <div class="SUWCNavBttns">&nbsp;
                <div class="SUWCNavico WC-Icon-18 WC-Icon-BackArrow-disabled" id="History-Back" title="后退" onclick="javascript:history.go(-1);"></div>
                <div class="SUWCNavico WC-Icon-18 WC-Icon-ForwardArrow-disabled" id="History-Forward" title="前进" onclick="javascript:history.go(1);"></div>
                <a href="#" id="History-List" class="SUWCNavico WC-Icon-18 WC-Icon-History" title="历史记录列表"></a>
                <a href="javascript:GoToDialog();" class="SUWCNavico WC-Icon-18 WC-Icon-GoTo" title="转到目录"></a>&nbsp;
            </div>
            <div style="float:left;" class="ie6CrumbFix">
                <span id="CrumbBar">
                  <div style="width:100%;">
                      <table style="white-space:nowrap;" cellspacing="0" cellpadding="0" border="0" id="pathtable">
                          <tbody>
                          <tr >
                              <td style="white-space:nowrap;" >
                                  <a href="<?php echo U('index');?>">主页</a>
                                  <span id="crumb2" class=""><span class="crumbarrowico"></span></span>
                              </td>
                          </tr>
                          </tbody>
                      </table>
                  </div>
                </span>
            </div>
        </div>
        <div class="SUWCDirhead">
            <img src="/Public/img/folder_icon_24x24.png" class="SUWCNavico" border="0">
            <span id="SUWCCurrDir"><?php echo ($nowpath); ?></span>
            <div class="SUWCSearch" style="float:right;width:auto;">
                <div style="float:left;">
                    <input class="SUWCSearchInput" id="searchinput" placeholder="搜索"  type="text">
                </div>
                <div id="searchOptionButton" class="SUWCSearchGo">
                    <div id="Search-Action-Ico" class="SUWCSearchico  WC-Icon-18 WC-Icon-MagGlass" title="搜索"></div>
                </div>
            </div>
        </div>
        <div class="SUWCActionBar">
            <div class="SUWCActionBttns">
                <?php if($prevpath != 1): ?><a href="<?php echo U('index?n='.$prevpath);?>"  style="color: rgb(0,0,0);">
                        <div  class="SUWCActionico  WC-Icon-18 WC-Icon-ParentDir" title="回到父目录"></div>父目录
                        <span class="pipedivide"></span>
                    </a>
                    <?php else: ?>
                    <a href="#"  style="color: rgb(144, 144, 144); cursor: default;">
                        <div  class="SUWCActionico  WC-Icon-18 WC-Icon-ParentDir WC-Icon-Disabled" title="回到父目录"></div>父目录
                        <span class="pipedivide"></span>
                    </a><?php endif; ?>
                <a href="#" id="OpenDir-Action" style="color: rgb(144, 144, 144); cursor: default;">
                    <div id="OpenDir-Action-Ico" class="SUWCActionico  WC-Icon-18 WC-Icon-OpenDir WC-Icon-Disabled" title="打开"></div>打开
                    <span class="pipedivide"></span>
                </a>
                <a href="#" id="Download-Action" style="color: rgb(144, 144, 144); cursor: default;">
                    <div id="Download-Action-Ico" class="SUWCActionico  WC-Icon-18 WC-Icon-Download WC-Icon-Disabled" title="下载"></div>下载
                    <span class="pipedivide"></span>
                </a>
                <a href="#" id="More-Action">More Actions
                    <div class="SUWCActionico  WC-Icon-12 WC-Icon-DownArrow" title="More Actions"></div>
                </a>
            </div>
            <div style="float:right;width:auto;">
                <a href="javascript:RefreshList(true);">
                    <div class="SUWCActionico  WC-Icon-18 WC-Icon-Refresh" title="刷新">
                    </div>
                </a>
                <a href="#" id="View-Action" title="缩略图">
                    <div id="Thumb-Size-Img" class="SUWCActionico  WC-Icon-18 WC-Icon-Thumb">
                    </div>
                </a>
                <a href="#" id="Thumb-Size-Action" style="visibility:hidden;" class="disabled">
                    <div class="crumbico WC-Icon-10 WC-Icon-DownArrow" style="position:relative;top:3px;padding: 0 3px;">
                    </div>
                </a>
            </div>
        </div>

        <div id="ListFilesContainer" data-load="true" style="overflow: hidden; margin: 0px 60px; border-left: 1px solid rgb(227, 227, 227); border-right: 1px solid rgb(227, 227, 227); display: block;">
            <table width="60%">
                <tr>
                    <th width="19px;">&nbsp;</th>
                    <th width="40%"><a href='#'>名称</a></th>
                    <th width="8%"><a href='#'>大小</a></th>
                    <th><a href='#'>时间</a></th>
                </tr>
                <?php if(is_array($infos)): foreach($infos as $key=>$v): ?><tr onclick="changebg(this)">
                        <td><div style="height:18px;width:18px" id="ListFiles-cell-0-3-box-image" class="aw-item-image <?php echo ($v['icon']); ?> "></div></td>
                        <td>
                            <input type="hidden" class="lianjie" value="/Vi/index/n/www.b.com__Public__img.html">
                            <input type="hidden" class="linkpath" value="<?php echo ($v['linkpath']); ?>" >
                            <a href="../../../data/www.b.com.zip" download="" ondblclick="dbhref(this)" class="filename"><?php echo ($v['filename']); ?></a>
                            <input type="hidden" class="type" value="<?php echo ($v['type']); ?>">  <!--存储文件类型 如果是文件的话选中时下载可选-->
                        </td>
                        <td><?php echo ($v['size']); ?></td>
                        <td><?php echo ($v['mtime']); ?></td>
                    </tr><?php endforeach; endif; ?>
            </table>
        </div>
    </div>
</body>
<script>
    $(function(){
        if(history.length > 0){
            $('#History-Back').removeClass('WC-Icon-BackArrow-disabled');
            $('#History-Back').addClass('WC-Icon-BackArrow');
        }
        //获取路径参数
        getPath();

    })

    function getPath(){
        //判断当前路径用于导航地图显示
        var url = window.location.href;
        var arr = '';
        var allpath = '';
        if(url.indexOf("?")>=0){
            var search = window.location.search;    //获取 参数
            arr = search.split('=');    //用等号分割出路径参数
            allpath = arr.pop(); //获取所有路径
        }else{
            arr = url.split('/');
            var tmplen = arr.length;
            if(arr[tmplen-2] == "n"){
                allpath = arr.pop();
            }else{
                allpath = '';
            }
        }

        var paths = allpath.split('__');    //分割路径
        var len  = paths.length;
        var str = '';   //待拼接字符串
        var tagpath = '';   //记录当前的路径
        var tr = $('#pathtable tr:last');
        for (var i=0;i<len;i++){
            if(paths[i] == ''){
                return;
            }
            if(i==len-1){
                var tmp =  paths[i].split('.');
                paths[i] = tmp[0];
            }
            if(i>0){
                tagpath += '__'+paths[i];
            }else{
                tagpath = paths[i];
            }
            str += '<td style="white-space:nowrap;"> ' +
                '<div class="crumbico foldercrumb"></div> ' +
                '<a href="/vi/index?n='+tagpath+'">'+paths[i]+'</a> ' +
                '<span id="crumb2" class=""><span class="crumbarrowico"></span></span> ' +
                '</td>';
        }
        tr.append(str);
    }
    function dbhref(obj){
        var type = $(obj).next().val();
        var linkpath = $(obj).prev().val();
        var filename= $(obj).html();
        if(type == 'a'){
            location.href="/vi/index?n="+linkpath;
        }else{  //如果是文件类型  进行下载
//            console.log("/vi/downloadFile?linkpath="+linkpath+"&filename="+filename);
//            location.href = "/vi/downloadFile?linkpath="+linkpath+"&filename="+filename;
            window.open("/vi/downloadFile?linkpath="+linkpath+"&filename="+filename);
//            var host = window.location.host;
//            var protocol = window.location.protocol;
//            window.open(protocol+'//'+host+'/data/新建文本文档2.txt');
        }
    }

    function changebg(obj){
        var type = $(obj).find('.type').val();
        if(type == 'b'){  //如果是文件类型
            $('#Download-Action-Ico').removeClass('WC-Icon-Disabled');
            $('#Download-Action').css('color','rgb(0,0,0)');
            $('#Download-Action').css('cursor','');
            var linkpath = $(obj).find('.linkpath').val();
            var filename= $(obj).find('.filename').html();
            $('#Download-Action').click(function(){
                location.href = "/vi/downloadFile?linkpath="+linkpath+"&filename="+filename;
            });
        }else{  //文件夹
            $('#Download-Action-Ico').addClass('WC-Icon-Disabled');
            $('#Download-Action').css('color','rgb(144,144,144)');
            $('#Download-Action').css('cursor','default');
        }
        $(obj).siblings('tr').css('background','');
        $(obj).css('background','#3399FF');
    }
</script>
</html>