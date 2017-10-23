<?php require_once('Connections/connclouddb.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  if (PHP_VERSION < 6) {
    $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;
  }

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? doubleval($theValue) : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$currentPage = $_SERVER["PHP_SELF"];

$maxRows_rsMessage = 5;
$pageNum_rsMessage = 0;
if (isset($_GET['pageNum_rsMessage'])) {
  $pageNum_rsMessage = $_GET['pageNum_rsMessage'];
}
$startRow_rsMessage = $pageNum_rsMessage * $maxRows_rsMessage;

mysql_select_db($database_connclouddb, $connclouddb);
$query_rsMessage = "SELECT * FROM tbmessage ORDER BY m_id DESC";
$query_limit_rsMessage = sprintf("%s LIMIT %d, %d", $query_rsMessage, $startRow_rsMessage, $maxRows_rsMessage);
$rsMessage = mysql_query($query_limit_rsMessage, $connclouddb) or die(mysql_error());
$row_rsMessage = mysql_fetch_assoc($rsMessage);

if (isset($_GET['totalRows_rsMessage'])) {
  $totalRows_rsMessage = $_GET['totalRows_rsMessage'];
} else {
  $all_rsMessage = mysql_query($query_rsMessage);
  $totalRows_rsMessage = mysql_num_rows($all_rsMessage);
}
$totalPages_rsMessage = ceil($totalRows_rsMessage/$maxRows_rsMessage)-1;

$queryString_rsMessage = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsMessage") == false && 
        stristr($param, "totalRows_rsMessage") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsMessage = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsMessage = sprintf("&totalRows_rsMessage=%d%s", $totalRows_rsMessage, $queryString_rsMessage);

$MM_paramName = ""; 

// *** Go To Record and Move To Record: create strings for maintaining URL and Form parameters
// create the list of parameters which should not be maintained
$MM_removeList = "&index=";
if ($MM_paramName != "") $MM_removeList .= "&".strtolower($MM_paramName)."=";
$MM_keepURL="";
$MM_keepForm="";
$MM_keepBoth="";
$MM_keepNone="";
// add the URL parameters to the MM_keepURL string
reset ($HTTP_GET_VARS);
while (list ($key, $val) = each ($HTTP_GET_VARS)) {
	$nextItem = "&".strtolower($key)."=";
	if (!stristr($MM_removeList, $nextItem)) {
		$MM_keepURL .= "&".$key."=".urlencode($val);
	}
}
// add the Form parameters to the MM_keepURL string
if(isset($HTTP_POST_VARS)){
	reset ($HTTP_POST_VARS);
	while (list ($key, $val) = each ($HTTP_POST_VARS)) {
		$nextItem = "&".strtolower($key)."=";
		if (!stristr($MM_removeList, $nextItem)) {
			$MM_keepForm .= "&".$key."=".urlencode($val);
		}
	}
}
// create the Form + URL string and remove the intial '&' from each of the strings
$MM_keepBoth = $MM_keepURL."&".$MM_keepForm;
if (strlen($MM_keepBoth) > 0) $MM_keepBoth = substr($MM_keepBoth, 1);
if (strlen($MM_keepURL) > 0)  $MM_keepURL = substr($MM_keepURL, 1);
if (strlen($MM_keepForm) > 0) $MM_keepForm = substr($MM_keepForm, 1);
?>
<!doctype html>
<html><!-- InstanceBegin template="/Templates/style.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=yes">
<!-- InstanceBeginEditable name="doctitle" -->
<title>留言版</title>
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
    <br />
    <?php do { ?>
      <table align="center" width="600" border="0">
        <tr>
          <td width="40%">標題: <a href="detail.php?<?php echo $MM_keepNone.(($MM_keepNone!="")?"&":"")."m_id=".urlencode($row_rsMessage['m_id']) ?>"><?php echo $row_rsMessage['m_subject']; ?></a></td>
          <td width="40%" colspan="2">姓名: <?php echo $row_rsMessage['m_name']; ?></td>
        </tr>
        <tr>
          <td>電子郵件: <?php echo $row_rsMessage['m_email']; ?></td>
          <td>日期: <?php echo $row_rsMessage['m_date']; ?></td>
          <td><a href="modify.php?<?php echo $MM_keepNone.(($MM_keepNone!="")?"&":"")."m_id=".urlencode($row_rsMessage['m_id']) ?>">修改</a> <a href="delete.php?<?php echo $MM_keepNone.(($MM_keepNone!="")?"&":"")."m_id=".urlencode($row_rsMessage['m_id']) ?>">刪除</a></td>
        </tr>
        <tr>
          <td colspan="3"><hr /></td>
        </tr>
      </table>
      <?php } while ($row_rsMessage = mysql_fetch_assoc($rsMessage)); ?>
       <span style="text-align: center; display:block; margin-top:20px">
       <?php if ($pageNum_rsMessage > 0) { // Show if not first page ?>
  <a href="<?php printf("%s?pageNum_rsMessage=%d%s", $currentPage, 0, $queryString_rsMessage); ?>">第一頁</a>
  <?php } // Show if not first page ?>
  <?php if ($pageNum_rsMessage > 0) { // Show if not first page ?>
    <a href="<?php printf("%s?pageNum_rsMessage=%d%s", $currentPage, max(0, $pageNum_rsMessage - 1), $queryString_rsMessage); ?>">上一頁 </a>
    <?php } // Show if not first page ?>
  <?php if ($pageNum_rsMessage < $totalPages_rsMessage) { // Show if not last page ?>
    <a href="<?php printf("%s?pageNum_rsMessage=%d%s", $currentPage, min($totalPages_rsMessage, $pageNum_rsMessage + 1), $queryString_rsMessage); ?>">下一頁</a>
    <?php } // Show if not last page ?>
  <?php if ($pageNum_rsMessage < $totalPages_rsMessage) { // Show if not last page ?>
  <a href="<?php printf("%s?pageNum_rsMessage=%d%s", $currentPage, $totalPages_rsMessage, $queryString_rsMessage); ?>">最後一頁</a>
  <?php } // Show if not last page ?>
頁顯示第 x 筆到第 x 筆留言,	共 x 筆留言       </span> </div>
  <!-- InstanceEndEditable --><!-- InstanceBeginEditable name="footer" -->
  <div id="footer"> <!-- #BeginLibraryItem "/Library/footer_log.lbi" -->雲端網站設計&copy;2017<!-- #EndLibraryItem --></div>
  <!-- InstanceEndEditable --></div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsMessage);
?>
