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
?>
<?php
// *** Validate request to login to this site.
if (!isset($_SESSION)) {
  session_start();
}

$loginFormAction = $_SERVER['PHP_SELF'];
if (isset($_GET['accesscheck'])) {
  $_SESSION['PrevUrl'] = $_GET['accesscheck'];
}

if (isset($_POST['l_name'])  &&   $_POST['rnd'] == $_SESSION['rnd'] ) {
  $loginUsername=$_POST['l_name'];
  $password=$_POST['l_pwd'];
  $MM_fldUserAuthorization = "";
  $MM_redirectLoginSuccess = "index.php";
  $MM_redirectLoginFailed = "login_captcha.php";
  $MM_redirecttoReferrer = false;
  mysql_select_db($database_connclouddb, $connclouddb);
  
  $LoginRS__query=sprintf("SELECT l_name, l_pwd FROM tbadmin WHERE l_name=%s AND l_pwd=%s",
    GetSQLValueString($loginUsername, "text"), GetSQLValueString($password, "text")); 
   
  $LoginRS = mysql_query($LoginRS__query, $connclouddb) or die(mysql_error());
  $loginFoundUser = mysql_num_rows($LoginRS);
  if ($loginFoundUser) {
     $loginStrGroup = "";
    
	if (PHP_VERSION >= 5.1) {session_regenerate_id(true);} else {session_regenerate_id();}
    //declare two session variables and assign them
    $_SESSION['MM_Username'] = $loginUsername;
    $_SESSION['MM_UserGroup'] = $loginStrGroup;	      

    if (isset($_SESSION['PrevUrl']) && false) {
      $MM_redirectLoginSuccess = $_SESSION['PrevUrl'];	
    }
    header("Location: " . $MM_redirectLoginSuccess );
  }
  else {
    header("Location: ". $MM_redirectLoginFailed );
  }
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>2登入</title>
<style type="text/css">
.login {
	height: 300px;
	width: 300px;
	margin-right: auto;
	margin-left: auto;
}
</style>
</head>

<body>
<div class="login">
  <form action="<?php echo $loginFormAction; ?>" method="POST" name="form1">
    <div align="center">
      <table border="1">
        <tr>
            <td colspan="2">
             <div align="center">登入</div>
            </td>      
        </tr>
        <tr>
          <td>帳號:</td>
          <td><label for="l_name"></label>
            <input name="l_name" type="text" /></td>
        </tr>
        <tr>
          <td>密碼:</td>
          <td><label for="l_pwd"></label>
            <input name="l_pwd" type="text" /></td>
        </tr>
        <tr>
           <td>驗證碼</td>
           <td>
              <label for="rnd"></label>
              <input type="text" name="rnd" />
              <br />
              <input type="image" src="pic.php"  />
              <input type="submit" name="button3" value="更換驗證碼"  />           
           </td>        
        </tr>       
        <tr>
          <td colspan="2">
             <input name="button" type="submit" value="送出" />
             <input name="button2" type="reset" value="重置" />          
          </td>
        </tr>
      </table>
    </div>
  </form>
</div>
</body>
</html>
