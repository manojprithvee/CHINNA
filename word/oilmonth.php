<?php require_once('../Connections/database.php'); ?>
<?php
session_start();
if(!isset($_SESSION[ 'username' ]))
{
  header( 'Location: ../login.php' );
}
 mysql_select_db($database_database, $database);


$query_Recordset1 = "SELECT monthname(date) AS month,year(date) AS year,sum(amount) AS amount,sum(sales) AS sales,sum(`recipt no`) AS recpitno FROM oil GROUP BY month(date),year(date);";
$Recordset1 = mysql_query($query_Recordset1, $database) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

  header("Content-type: application/vnd.ms-word");
  header("Content-Disposition: attachment; Filename=oilmonth.doc");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">
<title></title>
</head>
<body>
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
        <td><?php echo $row_Recordset1['month']; ?></td>
        <td><?php echo $row_Recordset1['year']; ?></td>
        <td><?php echo $row_Recordset1['recpitno']; ?></td>
        <td><?php echo $row_Recordset1['sales']; ?></td>
        <td><?php echo round($row_Recordset1['amount'], 2); ?></td>        
      </tr>
      <?php
} while ($row_Recordset1 = mysql_fetch_assoc($Recordset1));
?>
  </table>
</body></html>
    <?php
mysql_free_result($Recordset1);

?>