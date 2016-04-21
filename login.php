<?php
$file  = 'logger.log';
$fileh = fopen( $file, 'a+' );
fwrite( $fileh, "\n[" . date( "d-m-Y h:i:s A" ) . "]-" . $_SERVER[ 'REMOTE_ADDR' ] . ":" . $_SERVER[ 'REMOTE_PORT' ] . " accessed " . $_SERVER[ 'PHP_SELF' ] );
fclose( $fileh );
?>
<?php
$error = false;
if ( isset( $_POST[ 'login' ] ) )
                {
                
                $username = preg_replace( '/[^A-Za-z]/', '', $_POST[ 'username' ] );
                $username = md5($username);
                $password = md5( $_POST[ 'password' ] );
                if ( file_exists( 'users/' . $username . '.xml' ) )
                                {
                                $xml = new SimpleXMLElement( 'users/' . $username . '.xml', 0, true );
                                if ( $password == $xml->password )
                                                {
                                                session_start();
                                                $_SESSION[ 'username' ] = $username;$_COOKIE[ 'username' ]=$username;
                                                $file                   = 'user.log';
                                                $fileh                  = fopen( $file, 'a+' );
                                                fwrite( $fileh, "\n[" . date( "d-m-Y h:i:s A" ) . "]-" . $_POST[ 'username' ] . " LOGGEDIN FROM " . $_SERVER[ 'REMOTE_ADDR' ] . ":" . $_SERVER[ 'REMOTE_PORT' ] );
                                                fclose( $fileh );
												if($_POST['mobile']==0)
                                                {$_POST = array();header( 'Location: ms.php' );}
												if($_POST['mobile']==1)
												{header(
'Location:www.chinnarajutraders.t15.org/ms.php' );}
                                                die;
                                                }
                                }
                $error = true;
				if($_POST['mobile']==1)
				{
					header( 'Location: www.chinnarajutraders.t15.org/home.php' );
                }
                }
?>


<html>
<head><link  href="bootstrap.css" rel="stylesheet" type="text/css"/><title>Login-Chinnarajutraders</title><meta name="viewport" content="width=device-width, initial-scale=1"></head>
<body background="BG.jpg" class="container" >
<div class="jumbotron col-md-6 col-md-offset-3" style="margin-top:10%;margin-bottom:10%;"><h1 style="font-family: Trebuchet MS,Tahoma,Verdana,Arial,sans-serif;color: #F00" align="center" >CHINNARAJU TRADERS</h1>
<br />
<div align="center"><form method="post" action="">
<input type="hidden" name="mobile" value="0">
        <p>Username <input type="text" placeholder="Username" class="form-control" name="username" size="20" /></p>
        <p>Password <input type="password" name="password" class="form-control" placeholder="Password"  size="20" /></p>
        <?php
if ( $error )
                {
                echo '<p>Invalid username and/or password</p>';
                }
?>
       <p><input type="submit" value="Login" name="login" class="btn btn-success"/></p>
    </form></div></div><div style="position:absolute bottom:0; right:0;opacity: 0;"><a href="http://www.freedomain.co.nr/" target="_blank" title="Free Domain Name" rel="nofollow"><img src="http://cuznrza.imdrv.net/coimage.gif" width="88" height="31" border="0" alt="Free Domain Name" /></a></div>
