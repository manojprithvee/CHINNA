<?php
session_start();
if(isset($_SESSION['username']))
{
    if(!file_exists('users/' . md5($_SESSION['username']) . '.xml')){
    header('Location: login.php');
    die;
}
$file='logger.log';
            $fileh=fopen($file,'a+');
            fwrite($fileh, "\n[".date("d-m-Y h:i:s A")."]-".$_SERVER['REMOTE_ADDR'].":".$_SERVER['REMOTE_PORT']." accessed ".$_SERVER['PHP_SELF']);
            fclose($fileh);


$error = false;
if(isset($_POST['change'])){

    $old = md5($_POST['o_password']);
    $new = md5($_POST['n_password']);
    $c_new = md5($_POST['c_n_password']);
    $xml = new SimpleXMLElement('users/' . md5($_SESSION['username']) . '.xml', 0, true);
    if($old == $xml->password){
        if($new == $c_new){
            $xml->password = $new;
            $xml->asXML('users/' . md5($_SESSION['username']) . '.xml');
            $file='user.log';
            $fileh=fopen($file,'a+');
            fwrite($fileh, "\n[".date("d-m-Y h:i:s A")."]-".$_SESSION['username']."CHANGED PASSWORD FROM".$_SERVER['REMOTE_ADDR'].":".$_SERVER['REMOTE_PORT']);
            fclose($fileh);
            header('Location: logout.php');
            die;
        }
    }
    $error = true;
}
}
else
{header('Location:login.php');}

?>

<head>
</head>
<body>
    <span style='text-shadow: 1 0 0 black;'><font size=2>Change Password:</span>
    <form method="post" action="">
        <?php 
        if($error){
            echo '<p><u><h6>ERROR: A Password(s) has been typed Wrong! Try Again!</u></h6></p>';
        }
        ?>
        <p>Old password <input type="password" name="o_password" size=10 /></p>
        <p>New password <input type="password" name="n_password" size=10 /></p>
        <p>Confirm new password <input type="password" name="c_n_password" size=10 /></p>
        <p><input type="submit" name="change" value="Change Password" size=10 /></p>
    </form>
<hr />
<font size=1>IP Logged on you're Account: 
<?PHP

echo $_SERVER['REMOTE_ADDR'] ."<br>";
echo "[".date("d-m-Y h:i:s A")."]" ;


?>