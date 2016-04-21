<?php
require_once('../Connections/database.php');
?>
<?php
session_start();
if (!isset($_SESSION['username'])) {
    header('Location: login.php');
}
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
    $insertSQL = sprintf("INSERT INTO ms (`date`, `invoice no`, `recipt no`, `open stock`, totalstock, sales, rate, amount, `close sock`) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)", GetSQLValueString($_POST['date'], "date"), GetSQLValueString($_POST['invoice_no'], "int"), GetSQLValueString($_POST['recipt_no'], "int"), GetSQLValueString($_POST['open_stock'], "double"), $_POST['recipt_no'] + $_POST['open_stock'], GetSQLValueString($_POST['sales'], "double"), GetSQLValueString($_POST['rate'], "double"), $_POST['sales'] * $_POST['rate'], ($_POST['recipt_no'] + $_POST['open_stock']) - $_POST['sales']);
    
    mysql_select_db($database_database, $database);
    $Result1 = mysql_query($insertSQL, $database) or die(mysql_error());
    
    $insertGoTo = "home.php";
    if (isset($_SERVER['QUERY_STRING'])) {
        $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
        $insertGoTo .= $_SERVER['QUERY_STRING'];
    }
    header(sprintf("Location: %s", $insertGoTo));
}

if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form2")) {
    $insertSQL = sprintf("INSERT INTO hsd (`date`, `invoice no`, `recipt no`, `open stock`, totalstock, sales, rate, amount, `close sock`) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)", GetSQLValueString($_POST['date'], "date"), GetSQLValueString($_POST['invoice_no'], "int"), GetSQLValueString($_POST['recipt_no'], "int"), GetSQLValueString($_POST['open_stock'], "double"), $_POST['recipt_no'] + $_POST['open_stock'], GetSQLValueString($_POST['sales'], "double"), GetSQLValueString($_POST['rate'], "double"), $_POST['sales'] * $_POST['rate'], ($_POST['recipt_no'] + $_POST['open_stock']) - $_POST['sales']);
    mysql_select_db($database_database, $database);
    $Result1 = mysql_query($insertSQL, $database) or die(mysql_error());
    
    $insertGoTo = "home.php";
    if (isset($_SERVER['QUERY_STRING'])) {
        $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
        $insertGoTo .= $_SERVER['QUERY_STRING'];
    }
    header(sprintf("Location: %s", $insertGoTo));
}
if ((isset($_POST["MM_insert"])) && ($_POST["MM_insert"] == "form3")) {
    $insertSQL = sprintf("INSERT INTO oil (`date`, `invoice no`, `recipt no`, `open stock`, totalstock, sales, rate, amount, `close sock`) VALUES (%s, %s, %s, %s, %s, %s, %s, %s, %s)", GetSQLValueString($_POST['date'], "date"), GetSQLValueString($_POST['invoice_no'], "int"), GetSQLValueString($_POST['recipt_no'], "int"), GetSQLValueString($_POST['open_stock'], "double"), $_POST['recipt_no'] + $_POST['open_stock'], GetSQLValueString($_POST['sales'], "double"), GetSQLValueString($_POST['rate'], "double"), $_POST['sales'] * $_POST['rate'], ($_POST['recipt_no'] + $_POST['open_stock']) - $_POST['sales']);
    mysql_select_db($database_database, $database);
    $Result1 = mysql_query($insertSQL, $database) or die(mysql_error());
    
    $insertGoTo = "home.php";
    if (isset($_SERVER['QUERY_STRING'])) {
        $insertGoTo .= (strpos($insertGoTo, '?')) ? "&" : "?";
        $insertGoTo .= $_SERVER['QUERY_STRING'];
    }
    header(sprintf("Location: %s", $insertGoTo));
}
$query_Recordset1 = "SELECT * FROM ms group by date";
$Recordset1 = mysql_query($query_Recordset1, $database) or die(mysql_error());
$row_Recordset1       = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

$query_Recordset2 = "SELECT * FROM hsd group by date";
$Recordset2 = mysql_query($query_Recordset2, $database) or die(mysql_error());
$row_Recordset2       = mysql_fetch_assoc($Recordset2);
$totalRows_Recordset2 = mysql_num_rows($Recordset2);

$query_Recordset3 = "SELECT * FROM ms ORDER BY `date` DESC LIMIT 1;";
$Recordset3 = mysql_query($query_Recordset3, $database) or die(mysql_error());
$row_Recordset3       = mysql_fetch_assoc($Recordset3);
$totalRows_Recordset3 = mysql_num_rows($Recordset3);

$query_Recordset4 = "SELECT * FROM hsd ORDER BY `date` DESC LIMIT 1;";
$Recordset4 = mysql_query($query_Recordset4, $database) or die(mysql_error());
$row_Recordset4       = mysql_fetch_assoc($Recordset4);
$totalRows_Recordset4 = mysql_num_rows($Recordset4);

$query_Recordset5 = "SELECT monthname(date) AS month,year(date) AS year,sum(amount) AS amount,sum(sales) AS sales,sum(`recipt no`) AS recpitno FROM ms GROUP BY month(date),year(date);";
$Recordset5 = mysql_query($query_Recordset5, $database) or die(mysql_error());
$row_Recordset5       = mysql_fetch_assoc($Recordset5);
$totalRows_Recordset5 = mysql_num_rows($Recordset5);

$query_Recordset6 = "SELECT monthname(date) AS month,year(date) AS year,sum(amount) AS amount,sum(sales) AS sales,sum(`recipt no`) AS recpitno FROM hsd GROUP BY month(date),year(date);";
$Recordset6 = mysql_query($query_Recordset6, $database) or die(mysql_error());
$row_Recordset6       = mysql_fetch_assoc($Recordset6);
$totalRows_Recordset6 = mysql_num_rows($Recordset6);

$query_Recordset7 = "SELECT * FROM oil ORDER BY `date` DESC LIMIT 1;";
$Recordset7 = mysql_query($query_Recordset7, $database) or die(mysql_error());
$row_Recordset7       = mysql_fetch_assoc($Recordset7);
$totalRows_Recordset7 = mysql_num_rows($Recordset7);

$query_Recordset8 = "SELECT * FROM oil group by date";
$Recordset8 = mysql_query($query_Recordset8, $database) or die(mysql_error());
$row_Recordset8       = mysql_fetch_assoc($Recordset8);
$totalRows_Recordset8 = mysql_num_rows($Recordset8);

$query_Recordset9 = "SELECT monthname(date) AS month,year(date) AS year,sum(amount) AS amount,sum(sales) AS sales,sum(`recipt no`) AS recpitno FROM oil GROUP BY month(date),year(date);";
$Recordset9 = mysql_query($query_Recordset9, $database) or die(mysql_error());
$row_Recordset9       = mysql_fetch_assoc($Recordset9);
$totalRows_Recordset9 = mysql_num_rows($Recordset9);
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<link  href="jquery/jquery-ui-1.10.4.custom/css/ui-lightness/jquery-ui.css" rel="stylesheet" type="text/css"/>
<link href="SpryAssets/SpryValidationTextField.css" rel="stylesheet" type="text/css" />
<script src="jquery/jquery-ui-1.10.4.custom/js/jquery-1.10.2.js"></script>
<script src="jquery/jquery-ui-1.10.4.custom/js/jquery-ui.js"></script>
<script>
$(function() {
$( "#tabs" ).tabs();
});</script>
<script>
$(document).ready(function(){
$("#date").datepicker({
     changeMonth:true,
     changeYear:true,
     yearRange:"-100:+0",
     dateFormat:"yy-mm-dd"
  })
  $("#date1").datepicker({
     changeMonth:true,
     changeYear:true,
     yearRange:"-100:+0",
     dateFormat:"yy-mm-dd"
  })
  $("#date2").datepicker({
     changeMonth:true,
     changeYear:true,
     yearRange:"-100:+0",
     dateFormat:"yy-mm-dd"
  })});
</script>

</head>

<body background="BG.jpg">
<div style="margin-left:50px;margin-right: 50px; background-color:#FFF;"><h1 style="font-family: Trebuchet MS,Tahoma,Verdana,Arial,sans-serif;color: #F00" align="center" >CHINNARAJU TRADERS</h1>
<p align="right"><a href="logout.php" style="margin-right:10px">logout</a></p>
<br />
<div id="tabs">
<ul>
<li><a href="#tabs-1">ms</a></li>
<li><a href="#tabs-2">hsd</a></li>
<li><a href="#tabs-3">oil</a></li>
<li><a href="#tabs-4">ms total</a></li>
<li><a href="#tabs-5">hsd total</a></li>
<li><a href="#tabs-6">oil total</a></li>
<li><a href="#tabs-7">ms month</a></li>
<li><a href="#tabs-8">hsd month</a></li>
<li><a href="#tabs-9">oil month</a></li>

</ul>
<div id="tabs-1">
<form action="<?php
echo $editFormAction;
?>" method="post" name="form1" id="form1">
      <table align="center">
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Date(yyyy-mm-dd):</td>
          <td>        
          <input type="text" name="date" id="date"/>
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
          <td><input type="text" name="open_stock" value="<?php
echo htmlentities($row_Recordset3['close sock'], ENT_COMPAT, 'utf-8');
?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Sales:</td>
          <td><input type="text" name="sales" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Rate:</td>
          <td><input type="text" name="rate" value="<?php
echo htmlentities($row_Recordset3['rate'], ENT_COMPAT, 'utf-8');
?>" size="32" /></td>
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
<div id="tabs-2">
  <form action="<?php
echo $editFormAction;
?>" method="post" name="form2" id="form2">
<table align="center">
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Date(yyyy-mm-dd):</td>
          <td><input type="text" name="date" id="date1"/></td>
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
          <td><input type="text" name="open_stock" value="<?php
echo htmlentities($row_Recordset4['close sock'], ENT_COMPAT, 'utf-8');
?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Sales:</td>
          <td><input type="text" name="sales" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Rate:</td>
          <td><input type="text" name="rate" value="<?php
echo htmlentities($row_Recordset4['rate'], ENT_COMPAT, 'utf-8');
?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">&nbsp;</td>
          <td><input type="submit" value="Insert record" /></td>
        </tr>
      </table>
    <input type="hidden" name="MM_insert" value="form2" />
  </form>
  <p>&nbsp;</p>
</div>
<div id="tabs-3">
<form action="<?php
echo $editFormAction;
?>" method="post" name="form3" id="form3">
      <table align="center">
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Date(yyyy-mm-dd):</td>
          <td>        
          <input type="text" name="date" id="date2"/>
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
          <td><input type="text" name="open_stock" value="<?php
echo htmlentities($row_Recordset7['close sock'], ENT_COMPAT, 'utf-8');
?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Sales:</td>
          <td><input type="text" name="sales" value="" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">Rate:</td>
          <td><input type="text" name="rate" value="<?php
echo htmlentities($row_Recordset7['rate'], ENT_COMPAT, 'utf-8');
?>" size="32" /></td>
        </tr>
        <tr valign="baseline">
          <td nowrap="nowrap" align="right">&nbsp;</td>
          <td><input type="submit" value="Insert record" /></td>
        </tr>
      </table>
      <input type="hidden" name="MM_insert" value="form3" />
    </form>
    <p>&nbsp;</p>
</div>
<div id="tabs-4">
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
?>&amp;type=ms">update</a></td>
        <td><a href="delete.php?date=<?php
    echo $row_Recordset1['date'];
?>&amp;type=ms">delete</a></td>
      </tr>
      <?php
} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));
?>
 </table>
</div>
<div id="tabs-5">
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
    echo $row_Recordset2['date'];
?></td>
        <td><?php
    echo $row_Recordset2['invoice no'];
?></td>
        <td><?php
    echo $row_Recordset2['recipt no'];
?></td>
        <td><?php
    echo $row_Recordset2['open stock'];
?></td>
        <td><?php
    echo $row_Recordset2['totalstock'];
?></td>
        <td><?php
    echo $row_Recordset2['sales'];
?></td>
        <td><?php
    echo $row_Recordset2['rate'];
?></td>
        <td><?php
    echo $row_Recordset2['amount'];
?></td>
        <td><?php
    echo $row_Recordset2['close sock'];
?></td>
        <td><a href="update.php?date=<?php
    echo $row_Recordset2['date'];
?>&amp;type=hsd">update</a></td>
        <td><a href="delete.php?date=<?php
    echo $row_Recordset2['date'];
?>&amp;type=hsd">delete</a></td>
      </tr>
      <?php
} while ($row_Recordset2 = mysql_fetch_assoc($Recordset2));
?>
 </table>
</div>
<div id="tabs-6">
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
    echo $row_Recordset8['date'];
?></td>
        <td><?php
    echo $row_Recordset8['invoice no'];
?></td>
        <td><?php
    echo $row_Recordset8['recipt no'];
?></td>
        <td><?php
    echo $row_Recordset8['open stock'];
?></td>
        <td><?php
    echo $row_Recordset8['totalstock'];
?></td>
        <td><?php
    echo $row_Recordset8['sales'];
?></td>
        <td><?php
    echo $row_Recordset8['rate'];
?></td>
        <td><?php
    echo $row_Recordset8['amount'];
?></td>
        <td><?php
    echo $row_Recordset8['close sock'];
?></td>
        <td><a href="update.php?date=<?php
    echo $row_Recordset8['date'];
?>&amp;type=oil">update</a></td>
        <td><a href="delete.php?date=<?php
    echo $row_Recordset8['date'];
?>&amp;type=oil">delete</a></td>
      </tr>
      <?php
} while ($row_Recordset8 = mysql_fetch_assoc($Recordset8));
?>
 </table>
</div>
<div id="tabs-7">
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
</div>
<div id="tabs-8">
   <table border="1">
    <tr>
      <td>date</td>
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
    echo $row_Recordset6['month'];
?></td>
        <td><?php
    echo $row_Recordset6['year'];
?></td>
        <td><?php
    echo $row_Recordset6['recpitno'];
?></td>
        <td><?php
    echo $row_Recordset6['sales'];
?></td>
        <td><?php
    echo round($row_Recordset6['amount'], 2);
?></td>        
      </tr>
      <?php
} while ($row_Recordset6 = mysql_fetch_assoc($Recordset6));
?>
 </table>
</div>
<div id="tabs-9">
   <table border="1">
    <tr>
      <td>date</td>
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
    echo $row_Recordset9['month'];
?></td>
        <td><?php
    echo $row_Recordset9['year'];
?></td>
        <td><?php
    echo $row_Recordset9['recpitno'];
?></td>
        <td><?php
    echo $row_Recordset9['sales'];
?></td>
        <td><?php
    echo round($row_Recordset9['amount'], 2);
?></td>        
      </tr>
      <?php
} while ($row_Recordset9 = mysql_fetch_assoc($Recordset9));
?>
 </table>
</div>
</div></div>

</body>
</html>
<?php
mysql_free_result($Recordset1);
mysql_free_result($Recordset5);
mysql_free_result($Recordset2);
mysql_free_result($Recordset3);
mysql_free_result($Recordset4);

?>