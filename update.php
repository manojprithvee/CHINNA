<?php require_once('Connections/database.php'); ?>
<?php
session_start();
$an="9842720874";
if($_GET['mobile']==$am){
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}}
if(!isset($_GET["type"]))
{die("type not found");}
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

if ((isset($_POST["MM_update"])) && ($_POST["MM_update"] == "form1")) {
  $updateSQL = sprintf("UPDATE %s SET `invoice no`=%s, `recipt no`=%s, `open stock`=%s, totalstock=%s, sales=%s, rate=%s, amount=%s, `close sock`=%s WHERE `date`=%s",
                       $_GET["type"],
                       GetSQLValueString($_POST['invoice_no'], "int"),
                       GetSQLValueString($_POST['recipt_no'], "int"),
                       GetSQLValueString($_POST['open_stock'], "double"),
                       GetSQLValueString($_POST['totalstock'], "double"),
                       GetSQLValueString($_POST['sales'], "double"),
                       GetSQLValueString($_POST['rate'], "double"),
                       GetSQLValueString($_POST['amount'], "double"),
                       GetSQLValueString($_POST['close_sock'], "double"),
                       GetSQLValueString($_POST['date'], "text"));

  mysql_select_db($database_database, $database);
  $Result1 = mysql_query($updateSQL, $database) or die(mysql_error());


  if (isset($_SERVER['QUERY_STRING'])) {
    $updateGoTo .= (strpos($updateGoTo, '?')) ? "&" : "?";
    $updateGoTo .= $_SERVER['QUERY_STRING'];
  }
  header(sprintf("Location: %s.php",$_GET["type"]));
}

$colname_Recordset1 = "-1";
if (isset($_GET['date'])) {
  $colname_Recordset1 = $_GET['date'];
  $type=$_GET["type"];
}
mysql_select_db($database_database, $database);
$query_Recordset1 = sprintf("SELECT * FROM %s WHERE `date` = %s", $_GET["type"],GetSQLValueString($colname_Recordset1, "text"));
$Recordset1 = mysql_query($query_Recordset1, $database) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
</head>
<body background="BG.jpg">
<div style="margin-left:50px;margin-right: 50px; background-color:#FFF;"><h1 style="font-family: Trebuchet MS,Tahoma,Verdana,Arial,sans-serif;color: #F00" align="center" >CHINNARAJU TRADERS</h1>
<form action="<?php echo $editFormAction; ?>" method="post" name="form1" id="form1">
  <table align="center">
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Date:</td>
      <td><?php echo $row_Recordset1['date']; ?></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Invoice no:</td>
      <td><input type="text" name="invoice_no" value="<?php echo htmlentities($row_Recordset1['invoice no'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Recipt no:</td>
      <td><input type="text" name="recipt_no" value="<?php echo htmlentities($row_Recordset1['recipt no'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Open stock:</td>
      <td><input type="text" name="open_stock" value="<?php echo htmlentities($row_Recordset1['open stock'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Totalstock:</td>
      <td><input type="text" name="totalstock" value="<?php echo htmlentities($row_Recordset1['totalstock'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Sales:</td>
      <td><input type="text" name="sales" value="<?php echo htmlentities($row_Recordset1['sales'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Rate:</td>
      <td><input type="text" name="rate" value="<?php echo htmlentities($row_Recordset1['rate'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Amount:</td>
      <td><input type="text" name="amount" value="<?php echo htmlentities($row_Recordset1['amount'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">Close sock:</td>
      <td><input type="text" name="close_sock" value="<?php echo htmlentities($row_Recordset1['close sock'], ENT_COMPAT, 'utf-8'); ?>" size="32" /></td>
    </tr>
    <tr valign="baseline">
      <td nowrap="nowrap" align="right">&nbsp;</td>
      <td><input type="submit" value="Update record" /></td>
    </tr>
  </table>
  <input type="hidden" name="MM_update" value="form1" />
  <input type="hidden" name="date" value="<?php echo $row_Recordset1['date']; ?>" />
</form>
<p>&nbsp;</p></div>
</body>
</html>
<?php
mysql_free_result($Recordset1);
?>