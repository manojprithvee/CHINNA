<?php
require_once('Connections/database.php');
?>
<?php
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
    $insertSQL = sprintf("INSERT INTO hsd (`date`, `invoice no`, `recipt no`, `open stock`, totalstock, sales, rate, amount, `close sock`) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)", GetSQLValueString($_POST['date'], "date"), GetSQLValueString($_POST['invoice_no'], "int"), GetSQLValueString($_POST['recipt_no'], "int"), GetSQLValueString($_POST['open_stock'], "double"), $_POST['recipt_no'] + $_POST['open_stock'], GetSQLValueString($_POST['sales'], "double"), GetSQLValueString($_POST['rate'], "double"), $_POST['sales'] * $_POST['rate'], ($_POST['recipt_no'] + $_POST['open_stock']) - $_POST['sales']);
    
    mysql_select_db($database_database, $database);
    $Result1 = mysql_query($insertSQL, $database) or die(mysql_error());
    
    $insertGoTo = "hsd.php";
    if (isset($_SERVER['QUERY_STRING'])) {
        $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
        $insertGoTo .= $_SERVER['QUERY_STRING'];
    }
    header(sprintf("Location: %s", $insertGoTo));
}

$query_Recordset1 = "SELECT * FROM hsd group by date ORDER BY `date` DESC";
$Recordset1 = mysql_query($query_Recordset1, $database) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$query_Recordset7 = "SELECT ADDDATE(date, 1) as date FROM hsd ORDER BY `date` DESC LIMIT 1;";
$Recordset7 = mysql_query($query_Recordset7, $database) or die(mysql_error());
$row_Recordset7       = mysql_fetch_assoc($Recordset7);
$totalRows_Recordset7 = mysql_num_rows($Recordset7);

$query_Recordset3 = "SELECT * FROM hsd ORDER BY `date` DESC LIMIT 1;";
$Recordset3 = mysql_query($query_Recordset3, $database) or die(mysql_error());
$row_Recordset3       = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);



$query_Recordset5 = "SELECT monthname(date) AS month,year(date) AS year,sum(amount) AS amount,sum(sales) AS sales,sum(`recipt no`) AS recpitno FROM hsd GROUP BY month(date),year(date) order by year desc,month(date);";
$Recordset5 = mysql_query($query_Recordset5, $database) or die(mysql_error());
$row_Recordset5       = mysql_fetch_assoc($Recordset5);
$totalRows_Recordset5 = mysql_num_rows($Recordset5);

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>HSD</title>
<link  href="jquery/jquery-ui-1.10.4.custom/css/ui-lightness/jquery-ui.css" rel="stylesheet" type="text/css"/>

<link  href="bootstrap.css" rel="stylesheet" type="text/css"/>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<script src="jquery/jquery-ui-1.10.4.custom/js/jquery-1.10.2.js"></script>
<script src="jquery/jquery-ui-1.10.4.custom/js/jquery-ui.js"></script>
<script src="java.js">
</script>


</head>
<body>
<div class="container-fluid" style="background-color:white;"><h1 style="font-family: Trebuchet MS,Tahoma,Verdana,Arial,sans-serif;color: #F00" align="center" >CHINNARAJU TRADERS</h1>
<p align="right"><a href="logout.php" class="btn btn-danger" >logout</a></p>
<div class="btn-group btn-group-justified">
  <div class="btn-group">
    <a href="ms.php" class="btn btn-primary">MS</a>
  </div>
  <div class="btn-group">
    <a href="hsd.php" class="btn btn-primary">HSD</a>
  </div>
  <div class="btn-group">
    <a href="oil.php" class="btn btn-primary">OIL</a>
  </div>
</div>
<br />
<div id="tabs" class="nav nav-tabs" style="margin-bottom:1em">
<ul>
<li><a href="#tabs-1" role="tab" data-toggle="tab">hsd</a></li>
<li><a href="#tabs-3" role="tab" data-toggle="tab">hsd month</a></li>
</ul>
<div  id="tabs-1" class="tab-pane">
<div class="col-md-4 form-horizontal">
<form action="<?php
echo $editFormAction;
?>" method="post" name="form1" id="form1">
      
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Date(yyyy-mm-dd):</td>
          <td>        
          <input type="text"  class="form-control" name="date" id="date" value="<?php echo $row_Recordset7['date'] ?>"/>
 </td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Invoice no:</td>
          <td><input type="text" class="form-control" name="invoice_no" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Recipt no:</td>
          <td><input type="text" class="form-control" name="recipt_no" id="tags" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Open stock:</td>
          <td><input type="text" class="form-control" name="open_stock" value="<?php echo $row_Recordset3['close sock'] ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Sales:</td>
          <td><input type="text" class="form-control" name="sales" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Rate:</td>
          <td><input type="text" class="form-control" name="rate" value="<?php echo $row_Recordset3['rate'] ?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">&nbsp;</td>
          <td><input type="submit" value="Insert record"  class="btn btn-success"/></td>
        </tr>
      </table>
      <input type="hidden" name="MM_insert" value="form1" />
    </form>
    <p>&nbsp;</p>
</div><div class="col-md-8" style="overflow: scroll;height: 400px;">
 <a href="word/hsdtotal.php">genarate word</a>
  <table class="table table-striped">
    <tr >
      <td><b>Date</td>
      <td><b>Invoice no</td>
      <td><b>Recipt no</td>
      <td><b>Open stock</td>
      <td><b>Totalstock</td>
      <td><b>Sales</td>
      <td><b>Rate</td>
      <td><b>Amount</td>
      <td><b>Close sock</td>
      <td><b>Update</td>
      <td><b>Delete</td>
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
        <td class="active"><?php
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
?>&amp;type=hsd" class="btn btn-primary">update</a></td>
        <td><a href="delete.php?date=<?php
    echo $row_Recordset1['date'];
?>&amp;type=hsd" class="btn btn-primary">delete</a></td>
      </tr>
      <?php
} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));
?>
 </table>


</div></div>
<div  id="tabs-3" class="tab-pane" style="overflow: scroll;">
 <a href="word/hsdmonth.php">genarate report</a>
   <table border="1" class="table table-striped">
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
   </div>
</div></div>

</body>
</html>
<?php
mysql_free_result($Recordset1);
mysql_free_result($Recordset5);
mysql_free_result($Recordset3);
?>
