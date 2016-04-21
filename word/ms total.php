<?php require_once('Connections/database.php'); ?>
<?php
session_start();
if(!isset($_SESSION[ 'username' ]))
{
  header( 'Location: login.php' );
}
 mysql_select_db($database_database, $database);


$query_Recordset1 = "SELECT * FROM ms group by date";
$Recordset1 = mysql_query($query_Recordset1, $database) or die(mysql_error());
$row_Recordset1 = mysql_fetch_assoc($Recordset1);
$totalRows_Recordset1 = mysql_num_rows($Recordset1);
?>
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
    <?php
mysql_free_result($Recordset1);

?>