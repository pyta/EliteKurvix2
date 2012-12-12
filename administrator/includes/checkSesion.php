<?php
session_start();
//require_once '../../functions/sql-connect.php';
require_once 'exception.class.php';
if($_POST)
{
    if(isset($_POST['login']) && isset($_POST['pass']))
    {
        try
        {
            if($_POST['login'] && $_POST['pass'])
            {

				$host 		= "localhost"; 	//database location
				$user 		= "root"; 		//database username
				$pass 		= "vertrigo"; 	//database password
				$db_name 	= "vollserv"; 	//database name

				//database connection
				$link = mysql_connect($host, $user, $pass);
				if($link !== false)
				{
					mysql_select_db($db_name);
					mysql_query("SET NAMES utf8");

					$login = $_POST['login'];
					$pass = md5($_POST['pass']);
					$sql = "SELECT * FROM users WHERE UserLogin='$login' and UserPass='$pass' LIMIT 1";
					$query = mysql_query($sql);
					$result = mysql_fetch_array($query);
					if($result)
					{
						if($result['UserType'] == 1)
						{
							session_regenerate_id();
							$_SESSION['id']		= $result['UserID'];
							$_SESSION['login'] 	= $result['UserLogin'];
							$_SESSION['admin'] 	= 'ok';
							
							header('Location:' . $_SERVER['HTTP_REFERER']);
						}
						else
						{
							echo 'nie masz prawa do panelu...';
						}
						mysql_close($link);
					}
					else 
					{
						mysql_close($link);
						throw new noUser();
					}
				}
            }
            else
				throw new noValue();
        }
        catch(noUser $error) 
        {
            echo $error;
        }
        catch(noValue $error) 
        {
            echo $error;
        }
        catch(Exception $Error)	
        {
            echo 'Wystąpił poważny błąd. Proszę spróbować później...';
        }
    }
}
else
{
    header('Location:' . $_SERVER['HTTP_REFERER']);
}
?>
