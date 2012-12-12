<?php
class AdminNews 
{
    public static function showNews()
    {
		if($_SESSION['id'])
		{
			$usersId = $_SESSION['id'];
		
			$host 		= "localhost"; 	//database location
			$login 		= "root"; 		//database username
			$password 	= "vertrigo"; 	//database password
			$database 	= "vollserv"; 	//database name
			
			try
			{
				@$db = new mysqli($host, $login, $password, $database);
				if(mysqli_connect_errno()) {
					echo Show::ShowMessage ("Nie udało się połczyć z baza...", false);
				}
				else
				{
					@$db->query("SET NAMES utf8");
					$query = "Select n.NewsID, n.NewsTitle, n.NewsContent, n.NewsAddDate, u.UserLogin From news n Inner Join users u On n.UserID = u.UserID Order By n.NewsAddDate";
					$result = @$db->query($query);
					$all = $result->num_rows;
					if($all <= 0) {
						echo Show::ShowMessage ("Brak artukułów do wyświetlenia...", false);
					}
					else
					{
						if ($result === false)
						{
							throw new sqlQueryError();
							$db->close();
						}
						else 
						{
							echo 
							'
								<table width="100%" id="rounded-corner">
								<thead>
									<tr>
										<th width="5%" class="rounded-company" scope="col">ID</th>
										<th width="15%" class="rounded" scope="col" align="center">Tytuł</th>
										<th width="35%" class="rounded" scope="col" align="center">Treść(skrocóna)</th>
										<th width="15%" class="rounded" scope="col" align="center">Data Dodania</th>
										<th width="15%" class="rounded" scope="col" align="center">Autor</th>
										<th width="5%" class="rounded" scope="col" align="center">Edytuj</th>
										<th width="5%" class="rounded-q4" scope="col" align="center">Usuń</th>
									</tr>
								</thead>
								<tfoot>
								</tfoot>
								<tbody>
							';
							
							while(($news = $result->fetch_assoc()) !== null)
							{    
								Show::showNewsFunct($all, $news['NewsID'], $news['NewsTitle'], substr($news['NewsContent'],0,20).'...', $news['NewsAddDate'], $news['UserLogin']);
							}
							echo
							'
								   </tbody>
							</table>
							';
							$result->close();
							$db->close();
						}
					}
				}
			}
			catch(Exception $Error)	
			{
				echo Show::ShowMessage('Wystapil powazny błąd....', false);
			}
		}
		else
		{
			echo Show::ShowMessage('Nie powinno Cię tu być..', false);
		}
    }
    
    public static function addNews($title, $content, $accept)
    {
		if(isset($_SESSION['id']))
		{
			$usersId = $_SESSION['id'];
			if(isset($accept))
			{
				try
				{
					if(empty($title) || empty($content)) throw new Value();
					
					$addDate 	= date('Y-m-d H:i:s');
					
					$host 		= "localhost"; 	//database location
					$login 		= "root"; 		//database username
					$password 	= "vertrigo"; 	//database password
					$database 	= "vollserv"; 	//database name
				
					@$db = new mysqli($host, $login, $password, $database);
					if(mysqli_connect_errno()) {
						echo Show::ShowMessage ("Nie udało się połczyć z bazą...", false);
					}
					else
					{
						@$db->query("SET NAMES utf8");
						$result = @$db->query("INSERT INTO news SET NewsTitle = '$title', NewsContent = '$content', NewsAddDate = '$addDate', UserID = '$usersId'");
						if($result) {
							echo Show::ShowMessage('Pomyśnie dodano artykuł do bazy danych...', true);
						} else {
							echo Show::ShowMessage('blad.', false);
						}
					}
					$db->close();
				}
				catch(Value $Error)	
				{
					echo Show::ShowMessage($Error, false);
				}
				catch(Exception $Error)	
				{
					echo Show::ShowMessage('Wystapił poważny błąd.', false);
				} 
			}
		}
		else
		{
			echo Show::ShowMessage('Nie powinno Cię tu być..', false);
		}
    }

    public static function deleteNews($id, $accept)
    {
		if($_SESSION['id'])
		{
			$usersId = $_SESSION['id'];
		
			$host 		= "localhost"; 	//database location
			$login 		= "root"; 		//database username
			$password 	= "vertrigo"; 	//database password
			$database 	= "vollserv"; 	//database name
			
			if(!empty($accept))
			{
				try
				{
					@$db = new mysqli($host, $login, $password, $database);
					if(mysqli_connect_errno()) {
						echo Show::ShowMessage ("Nie udało się połczyć z bazą...", false);
					}
					else
					{
						@$db->query("SET NAMES utf8");
						$query = "DELETE FROM news WHERE NewsID='$id'";
						$result = @$db->query($query);
						if(!$result) {
							echo Show::ShowMessage('Nie udało się usunąć artykułu...', false);
						} else {
							echo Show::ShowMessage('Pomyślnie usunięto artykuł z bazy danych!', true);
						}
						$db->close();
					}
				}
				catch(Exception $Error)	
				{
					echo Show::ShowMessage('Wystąpił poważny błąd. Proszę spróbować później...', false);
				}
			}
			else
			{
				echo 
				'Chcesz skasować newsa?<br />
					<p align=center>
					[<a href=index.php?admin=news&action=delete&id=',$id,'&accept=yes>tak</a> / <a href=index.php?admin=news&action=showNews>nie</a>]
					</p>
				';
			}
		}
		else
		{
			echo Show::ShowMessage('Nie powinno Cię tu być..', false);
		}
    }
    
    public static function deleteAllNews($accept)
    {
		if($_SESSION['id'])
		{
			$usersId = $_SESSION['id'];
		
			$host 		= "localhost"; 	//database location
			$login 		= "root"; 		//database username
			$password 	= "vertrigo"; 	//database password
			$database 	= "vollserv"; 	//database name
			
			if(!empty($accept))
			{
			   try
				{
					@$db = new mysqli($host, $login, $password, $database);
					if(mysqli_connect_errno()) {
						echo Show::ShowMessage ("Nie udało się połczyć z bazą...", false);
					}
					else
					{
						@$db->query("SET NAMES utf8");
						$query = "DELETE FROM news";
						$result = @$db->query($query);
						if(!$result) {
							echo Show::ShowMessage('Nie udało się usunąć wszystkich artykułów...', false);
						} else {
							echo Show::ShowMessage('Pomyślnie usunięto wszystkie artykuły z bazy danych!', true);
						}
						$db->close();
					}
				}
				catch(Exception $Error)	
				{
					echo Show::ShowMessage('Wystąpił poważny błąd. Proszę spróbować później...', false);
				}
			}
			else
			{
				echo 
				'Chcesz skasować wszystkie newsy?<br />
					<p align=center>
					[<a href=index.php?admin=news&action=delAll&accept=yes>tak</a> / <a href=index.php?admin=news&action=showNews>nie</a>]
					</p>
				';
			}
		}
		else
		{
			echo Show::ShowMessage('Nie powinno Cię tu być..', false);
		}
    }
    
    public static function editNews($id, $title, $content, $action)
    {
		if($_SESSION['id'])
		{
			$usersId = $_SESSION['id'];
		
			$host 		= "localhost"; 	//database location
			$login 		= "root"; 		//database username
			$password 	= "vertrigo"; 	//database password
			$database 	= "vollserv"; 	//database name
				
			if(isset($action))
			{
				try
				{
					@$db = new mysqli($host, $login, $password, $database);
					if(mysqli_connect_errno()) {
						echo Show::ShowMessage ("Nie udało się połczyć z bazą...", false);
					}
					else
					{
						@$db->query("SET NAMES utf8");
						$query = "UPDATE news SET NewsTitle='$title', NewsContent='$content' WHERE NewsID='$id'";
						$result = @$db->query($query);
						if(!$result) {
							echo Show::ShowMessage('Nie udało się zaktualizować artykułu...', false);
						} else {
							echo Show::ShowMessage('Pomyślnie zaktualizowano artykuł!', true);
						}
						$db->close();
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
					@$db = new mysqli($host, $login, $password, $database);
					if(mysqli_connect_errno()) {
						echo Show::ShowMessage ("Nie udało się połczyć z bazą...", false);
					}
					else
					{
						@$db->query("SET NAMES utf8");
						$query = "Select n.id, n.title, n.content, n.data From news n WHERE id='$id'";
						$result = $db->query($query);
						$edit = $result->fetch_assoc();
						Show::showEditForm($edit['id'], $edit['title'], $edit['content'], $edit['data'], $edit['login']);                
						$result->close();
						$db->close();
					}
				}
				catch(Exception $Error)	
				{
					echo Show::ShowMessage('Wystąpił poważny błąd. Proszę spróbować później...', false);
				}
			}
		}
		else
		{
			echo Show::ShowMessage('Nie powinno Cię tu być..', false);
		}
    }
}
?>
