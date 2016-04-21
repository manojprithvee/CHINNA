<?php
require_once('Connections/database.php');
?>
<?php
session_start();
session_start();
$an="9842720874";
if($_GET['mobile']==$am){
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}}
mysql_select_db($database_database, $database);
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

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form1")) {
    $insertSQL = sprintf("INSERT INTO hsdold (`date`, `invoice no`, `recipt no`, `open stock`, totalstock, sales, rate, amount, `close sock`) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)", GetSQLValueString($_POST['date'], "date"), GetSQLValueString($_POST['invoice_no'], "int"), GetSQLValueString($_POST['recipt_no'], "int"), GetSQLValueString($_POST['open_stock'], "double"), $_POST['recipt_no'] + $_POST['open_stock'], GetSQLValueString($_POST['sales'], "double"), GetSQLValueString($_POST['rate'], "double"), $_POST['sales'] * $_POST['rate'], ($_POST['recipt_no'] + $_POST['open_stock']) - $_POST['sales']);
    
    mysql_select_db($database_database, $database);
    $Result1 = mysql_query($insertSQL, $database) or die(mysql_error());
    
    $insertGoTo = "hsdold.php";
    if (isset($_SERVER['QUERY_STRING'])) {
        $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
        $insertGoTo .= $_SERVER['QUERY_STRING'];
    }
    header(sprintf("Location: %s", $insertGoTo));
}

$query_Recordset1 = "SELECT * FROM hsdold group by date ORDER BY `date` DESC";
$Recordset1 = mysql_query($query_Recordset1, $database) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$query_Recordset3 = "SELECT * FROM hsdold ORDER BY `date` DESC LIMIT 1;";
$Recordset3 = mysql_query($query_Recordset3, $database) or die(mysql_error());
$row_Recordset3       = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);

$query_Recordset7 = "SELECT ADDDATE(date, 1) as date FROM hsdold ORDER BY `date` DESC LIMIT 1;";
$Recordset7 = mysql_query($query_Recordset7, $database) or die(mysql_error());
$row_Recordset7       = mysql_fetch_assoc($Recordset7);
$totalRows_Recordset7 = mysql_num_rows($Recordset7);



$query_Recordset5 = "SELECT monthname(date) AS month,year(date) AS year,sum(amount) AS amount,sum(sales) AS sales,sum(`recipt no`) AS recpitno FROM hsdold GROUP BY month(date),year(date);";
$Recordset5 = mysql_query($query_Recordset5, $database) or die(mysql_error());
$row_Recordset5       = mysql_fetch_assoc($Recordset5);
$totalRows_Recordset5 = mysql_num_rows($Recordset5);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>HSDOLD</title>
<link  href="jquery/jquery-ui-1.10.4.custom/css/ui-lightness/jquery-ui.css" rel="stylesheet" type="text/css"/>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<script src="javamobile.js"></script>

<script src="jquery/jquery-ui-1.10.4.custom/js/jquery-1.10.2.js"></script>
<script src="jquery/jquery-ui-1.10.4.custom/js/jquery-ui.js"></script>
<script src="java.js">
</script>
</head>
<body background="BG.jpg">
<div style="margin-left:50px;margin-right: 50px; background-color:#FFF;"><h1 style="font-family: Trebuchet MS,Tahoma,Verdana,Arial,sans-serif;color: #F00" align="center" >CHINNARAJU TRADERS</h1>
<p align="right"><a href="logout.php" style="margin-right:10px">logout</a></p>
<br />
<div id="tabs" style="overflow: hidden;">
<ul>
<li><a href="#tabs-1">hsdold</a></li>
<li><a href="#tabs-2">hsdold total</a></li>
<li><a href="#tabs-3">hsdold month</a></li>
</ul>
<div id="tabs-1" style="overflow: scroll;">
<form action="<?php
echo $editFormAction;
?>" method="post" name="form1" id="form1">
      <table align="center">
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Date(yyyy-mm-dd):</td>
          <td>        
          <input type="text" name="date" id="date" value="<?php echo $row_Recordset7['date'] ?>"/>
 </td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Invoice no:</td>
          <td><input type="text" name="invoice_no" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Recipt no:</td>
          <td><input type="text" name="recipt_no" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Open stock:</td>
          <td><input type="text" name="open_stock" value="<?php echo $row_Recordset3['close sock'] ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Sales:</td>
          <td><input type="text" name="sales" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Rate:</td>
          <td><input type="text" name="rate" value="<?php echo $row_Recordset3['rate'] ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">&nbsp;</td>
          <td><input type="submit" value="Insert record" /></td>
        </tr>
      </table>
      <input type="hidden" name="MM_insert" value="form1" />
    </form>
    <p>&nbsp;</p>
</div>
<div id="tabs-2" style="overflow: scroll;">
  <table border="1">
    <tr>
      <td>date</td>
      <td>invoice no</td>
      <td>recipt no</td>
      <td>open stock</td>
      <td>totalstock</td>
      <td>sales</td>
      <td>rate</td>
      <td>amount</td>
      <td>close sock</td>
      <td>&nbsp;</td>
      <td>&nbsp;</td>
    </tr>
    <?php
do {
?>
     <tr>
        <td><?php
    echo $row_Recordset1['date'];
?></td>
        <td><?php
    echo $row_Recordset1['invoice no'];
?></td>
        <td><?php
    echo $row_Recordset1['recipt no'];
?></td>
        <td><?php
    echo $row_Recordset1['open stock'];
?></td>
        <td><?php
    echo $row_Recordset1['totalstock'];
?></td>
        <td><?php
    echo $row_Recordset1['sales'];
?></td>
        <td><?php
    echo $row_Recordset1['rate'];
?></td>
        <td><?php
    echo $row_Recordset1['amount'];
?></td>
        <td><?php
    echo $row_Recordset1['close sock'];
?></td>
        <td><a href="update.php?date=<?php
    echo $row_Recordset1['date'];
?>&amp;type=hsdold">update</a></td>
        <td><a href="delete.php?date=<?php
    echo $row_Recordset1['date'];
?>&amp;type=hsdold">delete</a></td>
      </tr>
      <?php
} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));
?>
 </table>
 
 <a href="word/hsdoldtotal.php">genarate word</a>
</div>
<div id="tabs-3" style="overflow: scroll;">
   <table border="1">
    <tr>
      <td>month</td>
      <td>year</td>
      <td>recipt no</td>
      <td>sales</td>
      <td>amount</td>
    </tr>
    <?php
do {
?>
     <tr>
        <td><?php
    echo $row_Recordset5['month'];
?></td>
        <td><?php
    echo $row_Recordset5['year'];
?></td>
        <td><?php
    echo $row_Recordset5['recpitno'];
?></td>
        <td><?php
    echo $row_Recordset5['sales'];
?></td>
        <td><?php
    echo round($row_Recordset5['amount'], 2);
?></td>        
      </tr>
      <?php
} while ($row_Recordset5 = mysql_fetch_assoc($Recordset5));
?>
 </table>
   <a href="word/hsdoldmonth.php">genarate report</a> </div>
</div></div>

</body>
</html>
<?php
mysql_free_result($Recordset1);
mysql_free_result($Recordset5);
mysql_free_result($Recordset3);
?>