<?php
if (!isset($_SESSION)) {
  session_start();
}
$MM_authorizedUsers = "";
$MM_donotCheckaccess = "true";

// *** Restrict Access To Page: Grant or deny access to this page
function isAuthorized($strUsers, $strGroups, $UserName, $UserGroup) { 
  // For security, start by assuming the visitor is NOT authorized. 
  $isValid = False; 

  // When a visitor has logged into this site, the Session variable MM_Username set equal to their username. 
  // Therefore, we know that a user is NOT logged in if that Session variable is blank. 
  if (!empty($UserName)) { 
    // Besides being logged in, you may restrict access to only certain users based on an ID established when they login. 
    // Parse the strings into arrays. 
    $arrUsers = Explode(",", $strUsers); 
    $arrGroups = Explode(",", $strGroups); 
    if (in_array($UserName, $arrUsers)) { 
      $isValid = true; 
    } 
    // Or, you may restrict access to only certain users based on their username. 
    if (in_array($UserGroup, $arrGroups)) { 
      $isValid = true; 
    } 
    if (($strUsers == "") && true) { 
      $isValid = true; 
    } 
  } 
  return $isValid; 
}

$MM_restrictGoTo = "login_captcha.php";
if (!((isset($_SESSION['MM_Username'])) && (isAuthorized("",$MM_authorizedUsers, $_SESSION['MM_Username'], $_SESSION['MM_UserGroup'])))) {   
  $MM_qsChar = "?";
  $MM_referrer = $_SERVER['PHP_SELF'];
  if (strpos($MM_restrictGoTo, "?")) $MM_qsChar = "&";
  if (isset($_SERVER['QUERY_STRING']) && strlen($_SERVER['QUERY_STRING']) > 0) 
  $MM_referrer .= "?" . $_SERVER['QUERY_STRING'];
  $MM_restrictGoTo = $MM_restrictGoTo. $MM_qsChar . "accesscheck=" . urlencode($MM_referrer);
  header("Location: ". $MM_restrictGoTo); 
  exit;
}
?>
<!doctype html>
<html><!-- InstanceBegin template="/Templates/style.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=yes">
<!-- InstanceBeginEditable name="doctitle" -->
<title>樣式</title>
<!-- InstanceEndEditable -->
<!-- InstanceBeginEditable name="head" -->
<!-- InstanceEndEditable -->
<body>
<div id="container">
  <div id="banner"> </div>
  <div id="navbar"> <a href="#">關於本站</a>| <a href="contact.php">連絡我們</a>| <a href="googlemap.html">網站地圖</a>| <a href="#">友站連結</a> </div>
  <!-- InstanceBeginEditable name="sidebar" -->
  <div id="sidebar">
    <ul>
      <li><a href="#">友站連結</a></li>
      <li><a href="#">Android 手機程式開發入門</a></li>
      <li><a href="#">手機程式開發</a></li>
      <li><a href="#">嵌入式 Android 系統班</a></li>
      <li><a href="#">雲端網路</a></li>
      <li><a href="#">Java 系統設計與手機應用</a></li>
      <li><a href="#">物聯網</a></li>
      <li><a href="#">ERP 系統設計與應用</a></li>
      <li><a href="#">工業電子技術</a></li>
    </ul>
    <div class="adblock"> <img src="images/sidebar.png" width="180" height="150" id="ad" name="ad" alt="" />
      <h3>2017 招生班級</h3>
    </div>
  </div>
  <!-- InstanceEndEditable --><!-- InstanceBeginEditable name="main" -->
  <div id="main">
    <div class="artmain">
      <h1> 畫下句點！ 辜仲諒與元配羅惠玲9月離婚</h1>
      <p  class="artcontent">中信金控大股東辜仲諒和妻子羅惠玲20多年婚姻，在今年9月正式畫下句點！兩個人當初不受家裡反對，毅然決然到夏威夷結婚，不過後來羅惠玲罹患憂鬱症，赴美療養，陸續傳出兩人談離婚消息，加上辜仲諒紅火案官司纏身，在國外避風頭都由秘書錢靖雯陪伴，兩人也陸續生下1子1女，與元配關係名存實亡。 </p>
    </div>
    <div class="artmain">
      <h1> 2北河岸音樂季．大稻埕情人日．煙火</h1>
      <img src="images/article.jpg" alt="" width="100" height="100" />
      <p class="artcontent">今年的大稻埕煙火換了名稱：台北河岸音樂季．大稻埕情人日晚上八點施放10分鐘的煙火看煙火模擬動畫可以發現到今年～"沒有忠孝橋煙火"、"沒有忠孝橋煙火"、"沒有忠孝橋火"以往都是20分鐘的大稻埕煙火+忠孝橋煙火去年壓縮成10分鐘的大稻埕煙火+忠孝橋煙火、一整個像是趕下班的節奏今年直接刪除忠孝橋煙火，大稻埕煙火只有一個炮陣地(去年有二個炮陣地)下午4-5點在頂樓準備進行拍攝，高處看可以發現到三重河濱沒多少人...跟以往比起來人真的少很多...說真的少了忠孝橋煙火，可惜這個拍攝點.... </p>
    </div>
    <div class="artmain">
      <h1> 步步驚心：麗</h1>
      <img src="images/article.jpg" alt="" width="100" height="100" />
      <p class="artcontent"> 帥皇子雲集的《步步驚心：麗》，每周播放兩集對於粉絲來說真的不夠啊！皇子們，剩下的五天你們說粉絲們該怎麼辦？今天妞編輯要來為大家整理《步步驚心：麗》的超美Fan Art，來自各國粉絲的作品各有不同畫風，讓我們除了回顧花絮、劇情片段之外，還能靠著這些美好的Fan Art一解五天無法相見的相思之苦！快跟著妞編輯一起看下去吧 </p>
    </div>
    <div class="artmain">
      <h1> 韓國「國民妹妹團」</h1>
      <img src="images/article.jpg" alt="" width="100" height="100" />
      <p class="artcontent">（中央社記者汪淑芬台北19日電）華信航空11月1日將首航高雄-馬公，提供4天0元機票，讓民眾免費搭乘，今天上午開放訂位，結果網路塞爆，華信中午宣布搶票活動暫停，明天上午10時重新開放，新增電話搶訂。        華信航空慶祝11月1日首航高雄-馬公，並舉辦「0元搭乘」體驗活動，從11月1日至4日免費搭乘，今天上午10時起，在華信官網開放搶訂。 華信表示，上午開放訂位後，網站流量瞬間爆量，造成網路壅塞。        為不佔用旅客時間，華信中午宣布，暫停搶訂「高雄-馬公開航 0元免費體驗搭乘」，明天上午10時重新開放。        為感謝旅客的支持，華信明天上午同時新增「電話搶訂」通路，除了上華信官網外，旅客也可撥打電話412-8008。        華信以104人座的Embraer E190噴射客機，執行高雄-馬公飛航任務，初期每天一班往返，飛行時間40分鐘。1051019 </p>
    </div>
  </div>
  <!-- InstanceEndEditable --><!-- InstanceBeginEditable name="footer" -->

  <div id="footer"> <!-- #BeginLibraryItem "/Library/footer_log.lbi" -->雲端網站設計&copy;2017<!-- #EndLibraryItem --></div>

  <!-- InstanceEndEditable --></div>
</body>
<!-- InstanceEnd --></html>
