var g_UserName="";var bRightClickDisable=true;if(bRightClickDisable){if(document.attachEvent)this.attachEvent('onmousedown',OnRightClickIE4);else this.addEventListener('mousedown',OnRightClickNS4,false);document.oncontextmenu=function(){return(false);};}function OnRightClickIE4(){if(event.button==2)return(false);}function OnRightClickNS4(e){if(e.which==2||e.which==3)return(false);}function LoadErrorMessage(sObjId,sSearch,sMsg){if(GetURLParameter("Command").toLowerCase()==sSearch.toLowerCase()){document.getElementById(sObjId+"-text").innerHTML=sMsg;document.getElementById(sObjId).style.display="block";}}function OnLoadSetFocus(FocusObj){LoadingDialog(false);if(FocusObj!=undefined)FocusObj.focus();}nBrowserVersion=parseInt(navigator.appVersion);sBrowserType=navigator.appName;document.cookie='killme'+escape('nothing');