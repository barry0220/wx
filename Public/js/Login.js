AddOnloadEvent(EnableSelectionOnFormElements);function OnValidate(){var bLogInFlag=false;if(!g_bIsLocalAdmin){if(document.login.user.value==""){AlertDialog(g_sEnterUser,undefined,OnSetUserFocus);}else if(document.getElementById("CookieCheck").cookieexists.value=="false"){AlertDialog(g_sEnableCookies,true);}else{if(RememberMeCheckBox.getControlValue()){createCookie("SURememberMe","true",60);createCookie("SUUserId",encodeURI(document.login.user.value),60);}else{eraseCookie("SURememberMe");eraseCookie("SUUserId");}bLogInFlag=true;}}else if(document.getElementById("CookieCheck").cookieexists.value=="false"){AlertDialog(g_sEnableCookies,true);}else{bLogInFlag=true;}if(bLogInFlag){sLangValue=LanguageCombo.getControlValue();createCookie("SULang",sLangValue,60);if(!g_bLoggedIn)OnLogIn();}return false;}function OnSetUserFocus(){document.login.user.focus();}function getCookie(){var FocusObj;if(readCookie('SURememberMe')=="true"&&g_bAllowRemember){if(readCookie('SUUserId')!=""&&readCookie('SUUserId')!=null&&(!g_bIsLocalAdmin)){g_UserName=decodeURI(readCookie('SUUserId'));document.login.user.value=g_UserName;FocusObj=document.login.pword;}else{if(!g_bIsLocalAdmin)FocusObj=document.login.user;else FocusObj=document.login.pword;}}else{if(!g_bIsLocalAdmin)FocusObj=document.login.user;else FocusObj=document.login.pword;}OnLoadSetFocus(FocusObj);if(g_bRecommendIEUpgrade)RecommendIEUpgrade();}function LoginCookieCheck(){CookieCheck();getCookie();if(GetURLParameter("user")!=""&&g_bBrowserOk)setTimeout("OnLogIn(true)",1);}function GetBWCLoadParameters(){sURLParams="";if(GetURLParameter("dir")!="")sURLParams+="&dir="+GetURLParameter("dir");if(GetURLParameter("file")!="")sURLParams+="&file="+GetURLParameter("file");if(GetURLParameter("thumbnail")!="")sURLParams+="&thumbnail="+GetURLParameter("thumbnail");else if(GetURLParameter("thumbnails")!="")sURLParams+="&thumbnail="+GetURLParameter("thumbnails");if(GetURLParameter("slideshow")!="")sURLParams+="&slideshow="+GetURLParameter("slideshow");if(GetURLParameter("playmedia")!="")sURLParams+="&playmedia="+GetURLParameter("playmedia");if(GetURLParameter("playlist")!="")sURLParams+="&playlist="+GetURLParameter("playlist");if(GetURLParameter("sortcol")!="")sURLParams+="&sortcol="+GetURLParameter("sortcol");if(GetURLParameter("wcp")!="")sURLParams+="&wcp="+GetURLParameter("wcp");if(sURLParams.substr((sURLParams.length-1),sURLParams.length)=="&")sURLParams=sURLParams.substr(0,(sURLParams.length-1));return(sURLParams);}document.write("<style type='text/css'>");if(sBrowserType=="Microsoft Internet Explorer")document.write("#loginBtnCol{padding-right:24px;}");else document.write("#loginBtnCol{padding-right:44px;}");document.write(".RememberMeTable{padding:0;margin:5px auto 0 auto;width:400px;}");document.write(".RememberMeSpacer{padding-left:97px;}");document.write("</style>");