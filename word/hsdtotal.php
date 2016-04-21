<?php require_once('../Connections/database.php'); ?>
<?php
session_start();
if(!isset($_SESSION[ 'username' ]))
{
  header( 'Location: ../login.php' );
}
 mysql_select_db($database_database, $database);


$query_Recordset1 = "SELECT * FROM hsd group by date";
$Recordset1 = mysql_query($query_Recordset1, $database) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);

	header("Content-type: application/vnd.ms-word");
	header("Content-Disposition: attachment; Filename=hsdtotal.doc");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv=\"Content-Type\" content=\"text/html; charset=Windows-1252\">
<title>Saves as a Word Doc</title>
</head>
<body>
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
    </tr>
    <?php do { ?>
      <tr>
        <td><?php echo $row_Recordset1['date']; ?></td>
        <td><?php echo $row_Recordset1['invoice no']; ?></td>
        <td><?php echo $row_Recordset1['recipt no']; ?></td>
        <td><?php echo $row_Recordset1['open stock']; ?></td>
        <td><?php echo $row_Recordset1['totalstock']; ?></td>
        <td><?php echo $row_Recordset1['sales']; ?></td>
        <td><?php echo $row_Recordset1['rate']; ?></td>
        <td><?php echo $row_Recordset1['amount']; ?></td>
        
      </tr>
      <?php } while ($row_Recordset1 = mysql_fetch_assoc($Recordset1)); ?>
  </table>
</body></html>
    <?php
mysql_free_result($Recordset1);

?>
