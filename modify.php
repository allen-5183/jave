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

$editFormAction = $_SERVER['PHP_SELF'];
if (isset($_SERVER['QUERY_STRING'])) {
  $editFormAction .= "?" . htmlentities($_SERVER['QUERY_STRING']);
}

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "contactForm")) {
  $updateSQL = sprintf("UPDATE tbmessage SET m_name=%s, m_email=%s, m_subject=%s, m_content=%s, m_phone=%s, m_date=%s WHERE m_id=%s",
                       GetSQLValueString($_POST['m_name'], "text"),
                       GetSQLValueString($_POST['m_email'], "text"),
                       GetSQLValueString($_POST['m_subject'], "text"),
                       GetSQLValueString($_POST['m_content'], "text"),
                       GetSQLValueString($_POST['m_phone'], "text"),
                       GetSQLValueString($_POST['m_date'], "date"),
                       GetSQLValueString($_POST['m_id'], "int"));

  mysql_select_db($database_connclouddb, $connclouddb);
  $Result1 = mysql_query($updateSQL, $connclouddb) or die(mysql_error());

  $updateGoTo = "board.php";
  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s", $updateGoTo));
}

$colname_rsMessageModify = "-1";
if (isset($_GET['m_id'])) {
  $colname_rsMessageModify = $_GET['m_id'];
}
mysql_select_db($database_connclouddb, $connclouddb);
$query_rsMessageModify = sprintf("SELECT * FROM tbmessage WHERE m_id = %s", GetSQLValueString($colname_rsMessageModify, "int"));
$rsMessageModify = mysql_query($query_rsMessageModify, $connclouddb) or die(mysql_error());
$row_rsMessageModify = mysql_fetch_assoc($rsMessageModify);
$totalRows_rsMessageModify = mysql_num_rows($rsMessageModify);
?>
<!doctype html>
<html><!-- InstanceBegin template="/Templates/style.dwt" codeOutsideHTMLIsLocked="false" -->
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=yes">
<!-- InstanceBeginEditable name="doctitle" -->
<title>修改留言</title>
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
    <div class="contactblock">
      <form action="<?php echo $editFormAction; ?>" method="POST" name="contactForm" id="form1">
        <table width="600" border="1">
          <tr>
            <td colspan="2" align="center"> <h1>修改[<?php echo $row_rsMessageModify['m_name']; ?>]留言</h1>  </td>
          </tr>
          <tr>
            <td width="19%" align="right">姓名</td>
            <td width="81%">
                <label for="m_name"></label>
                <input name="m_name" type="text" required id="m_name" value="<?php echo $row_rsMessageModify['m_name']; ?>" />            
            </td>
          </tr>
          
          <tr>
            <td width="19%" align="right">電話</td>
            <td width="81%">
                <label for="m_phone"></label>
                <input name="m_phone" type="tel" required id="m_phone" value="<?php echo $row_rsMessageModify['m_phone']; ?>" />            
            </td>
          </tr>
          
          <tr>
            <td align="right"><p>電子郵件</p></td>
            <td>
                <label for="m_email"></label>
                <input name="m_email" type="email" required id="m_email" value="<?php echo $row_rsMessageModify['m_email']; ?>" />            
            </td>
          </tr>
          
          <tr>
            <td align="right">標題</td>
            <td>
                <label for="m_subject"></label>
                <input name="m_subject" type="text" required id="m_subject" value="<?php echo $row_rsMessageModify['m_subject']; ?>" />            </td>
          </tr>

          <tr>
            <td align="right">內容</td>
            <td>
                <label for="m_content"></label>
                <textarea name="m_content" id="m_content" cols="45" rows="5" required><?php echo $row_rsMessageModify['m_content']; ?></textarea>           
             </td>
          </tr>
          
          <tr>
            <td colspan="2" align="center">
              <input type="submit" name="button"  id="button"  value="更新留言" /><input name="m_id" type="hidden" value="<?php echo $row_rsMessageModify['m_id']; ?>">
              <input type="reset"  name="button2" id="button2" value="重設" />
              <input name="m_date" type="hidden"  id="m_date"  value="<?php echo date("Y-m-d H:i:s"); ?>" />          
            </td>
          </tr>
        </table>
        <input type="hidden" name="MM_update" value="contactForm">
      </form>
    </div>
  </div>
  <!-- InstanceEndEditable --><!-- InstanceBeginEditable name="footer" -->
  <div id="footer"> <!-- #BeginLibraryItem "/Library/footer_log.lbi" -->雲端網站設計&copy;2017<!-- #EndLibraryItem --></div>
  <!-- InstanceEndEditable --></div>
</body>
<!-- InstanceEnd --></html>
<?php
mysql_free_result($rsMessageModify);
?>
