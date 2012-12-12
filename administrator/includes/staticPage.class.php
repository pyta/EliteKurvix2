<?php
class staticPage
{
    public static function getArticle($tabble)
    {
        $connect = sqlConnect(); 
        $result = @$connect->query("SELECT id, title, content FROM $tabble LIMIT 1");
        $all = $result->num_rows;
        if($all <= 0)
            echo Show::ShowMessage ("Brak artykułów do wyświetlenia...", false);
        else
        {
            if ($result === false)
            {
                throw new sqlQueryError();
                $connect -> close();
            }
            else 
            {
                $art = $result->fetch_assoc();
                Show::article($all, $art['id'], $art['title'], $art['content'], $tabble);
                $result -> close();
                $connect -> close();
            }
        }
    }
    
    public static function edit($tabble, $id, $title, $content, $action)
    {
        if(!empty($action))
        {
            try
            {
                $host 		= "localhost"; 	//database location
				$login 		= "root"; 		//database username
				$password 	= "vertrigo"; 	//database password
				$database 	= "vollserv"; 	//database name
			
				@$db = new mysqli($host, $login, $password, $database);
				if(mysqli_connect_errno()) {
					echo Show::ShowMessage ("Nie udało się połczyć z baza...", false);
				}
				else
				{
					$query = "UPDATE $tabble SET title='$title', content='$content'";
					$result = @$connect->query($query);
					$result->close();
					$db->close();
					Show::ShowMessage('Pomyślnie uaktualniono dane w bazie danych....', true);
				}
            }
            catch(Exception $Error)	
            {
                echo Show::ShowMessage('Wystąpił poważny błąd. Proszę spróbować później...', false);
            }
        }
        else
        {
            try
            {
                $host 		= "localhost"; 	//database location
				$login 		= "root"; 		//database username
				$password 	= "vertrigo"; 	//database password
				$database 	= "vollserv"; 	//database name
			
				@$db = new mysqli($host, $login, $password, $database);
				if(mysqli_connect_errno()) {
					echo Show::ShowMessage ("Nie udało się połczyć z baza...", false);
				}
				else
				{
					@$db->query("SET NAMES utf8");
					$query = "SELECT NewsID, NewsTitle, NewsContent FROM news";
					$result = @$db->query($query);
					$all = $result->num_rows;
					if ($result === false)
					{
						throw new sqlQueryError();
						$db->close();
					}
					else
					{
						$edit = $result->fetch_assoc();
						$result->close();
						Show::showEdit($edit['NewsID'], $edit['NewsTitle'], $edit['NewsContent'], $tabble);
					}
				}
				$db->close();
			}				
            catch(Exception $Error)	
            {
                echo Show::ShowMessage('Wystąpił poważny błąd. Proszę spróbować później...', false);
            }
        }  
    }
}
?>
