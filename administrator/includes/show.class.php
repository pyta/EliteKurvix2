<?php
class Show 
{
    public static function LoginForm()
    {
        echo 
        '
            <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
                <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
                <title>Logowanie do Panelu Administratora</title>
                <link rel="stylesheet" href="style.css" type="text/css" media="all" />
                <link rel="stylesheet" href="uni-form/default.uni-form.css" type="text/css" media="all" />
                <link rel="stylesheet" href="uni-form/uni-form.css" type="text/css" media="all" />
            </head>
            <body>	
            <div id="content" class="shell">
                <div class="log">
                    <div class="login">
                        <div class="login-head">
                                <h2>Logowanie do Panelu</h2>
                        </div>
                        <div class="login-content">
                            <form action="includes/checkSesion.php" class="uniForm" method="post"> 
                            <fieldset class="inlineLabels"> 
                                <div class="ctrlHolder"> 
                                    <label>login</label> 
                                    <input type="text" id="login" name="login" class="textInput"/> 
                                 </div>
                                <div class="ctrlHolder"> 
                                    <label>hasło</label> 
                                    <input type="password" id="pass" name="pass" class="textInput"/>  
                                </div> 
                                <br />
                                <div class="buttonHolder"> 
                                    <a id="passwordForgot" href="../">powrót na stronę główną</a>
                                    <button id="login" type="submit" class="primaryAction">Zaloguj</button> 
                                </div> 
                            </fieldset> 
                            </form>		
                        </div>
                    </div>
                </div>
            </div>
            <div id="footer">
                <p>Copyright &copy; 2012-2013 Serwis ligi siatrakskiej - praca inżynierska</p>
            </div>
            </body>
            </html>
        ';
    }
    
    private static function showDate()
    {
        $dzien = date('d');
        $dzien_tyg = date('l');
        $miesiac = date('n');
        $rok = date('Y');
        $miesiac_pl = array(1 => 'stycznia', 'lutego', 'marca', 'kwietnia', 'maja', 'czerwca', 'lipca', 'sierpnia', 'września', 'października', 'listopada', 'grudnia');
        $dzien_tyg_pl = array('Monday' => 'poniedziałek', 'Tuesday' => 'wtorek', 'Wednesday' => 'środa', 'Thursday' => 'czwartek', 'Friday' => 'piątek', 'Saturday' => 'sobota', 'Sunday' => 'niedziela');
        echo $dzien_tyg_pl[$dzien_tyg].", ".$dzien." ".$miesiac_pl[$miesiac]." ".$rok."r.";
    }

    public static function DiplayHeader($user)
    {
        echo
        '
            <!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
            <html xmlns="http://www.w3.org/1999/xhtml">
            <head>
                <meta http-equiv="Content-type" content="text/html; charset=utf-8" />
                <title>Panel Administratora</title>
                <link rel="stylesheet" href="style.css" type="text/css" media="all" />
                <link rel="stylesheet" href="uni-form/default.uni-form.css" type="text/css" media="all" />
                <link rel="stylesheet" href="uni-form/uni-form.css" type="text/css" media="all" />
                <script type="text/javascript" src="js/jquery-1.5.1.min.js"></script>
				<script type="text/javascript" src="ckeditor/ckeditor.js"></script>
				<script type="text/javascript" src="ckeditor/adapters/jquery.js"></script>
				<script language="javascript">
						$(document).ready(function(){
							$(\'textarea\').ckeditor({ height : 300 });
						});
				</script>
            </head>
            <body>
                <!-- Header -->
                <div id="header">
                    <div class="shell">
                        <div id="head">
                            <h1><a href="index.php">Panel Administratora</a></h1>
                            <div class="right">
                                <p>
                                    Zalogowano jako: <strong>',$user,'</strong> | ';
                                    Show::showDate();
                                    echo ' | <a href="../index.php" target="_new" >Zobacz stronę główną</a> |
                                    
                                    <a href="logout.php">Wyloguj</a>
                                </p>
                            </div>
                        </div>
                        <!-- Navigation -->
                        <div id="navigation">
                            <ul>
                                <li><a href="index.php"><span>Strona główna</span></a></li>
								<li><a href="index.php?admin=start"><span>Powitania</span></a></li>
                                <li><a href="index.php?admin=news"><span>Aktualności</span></a></li>
								<li><a href="index.php?admin=teams"><span>Drużyny</span></a></li>
								<li><a href="index.php?admin=players"><span>Zawodnicy</span></a></li>
                                <li><a href="index.php?admin=matches"><span>Mecze</span></a></li>
								<li><a href="index.php?admin=arbiters"><span>Sędziowie</span></a></li>
                                <li><a href="index.php?admin=pitches"><span>Boiska</span></a></li>
                                <li><a href="index.php?admin=films"><span>Galeria filmów</span></a></li>
                                <li><a href="index.php?admin=gallery"><span>Galeria zdjęć</span></a></li>
                            </ul>
                        </div>
                        <!-- End Navigation -->
                    </div>
                </div>
                <!-- End Header -->
                <!-- Content -->
                <div id="content" class="shell">';
    } 

    public static function DiplayFooter()
    {
        echo '
            <!-- End Content -->
            </div>
            <!-- Footer -->
            <div id="footer">
                <p>Copyright &copy; 2012 Created by <a href="mailto:piociw@gmail.com">Piotr Ciwiś</a></p>
            </div>
            <!-- End Footer -->
            </body>
            </html>';
    }
    
    public static function ShowMessage($text, $option)
    {
        if($option == false)
        {
            echo '
                <div class="message error-message">
                    <div class="erroricon">
                    <p><strong>',$text,'</strong></p>
                    </div>
		</div> ';
        }
        else
        {
            echo '
                <div class="message thank-message">
                    <div class="successicon">
                    <p><strong>',$text,'</strong></p>
                    </div>
		</div>';
        }
    }
    
    public static function Dashboard()
    {
        echo '
            <div class="round">
                <div class="round-head">
                        <h2>Tablica Administratora</h2>
                    </div>

                    <div class="round-content">
                        <div id="icondock">
                            <ul>
                            <center>
								<li><a href="index.php?admin=start" title="Edycja strony powitalnej"><img src="images/icons/pen.png" alt="Powitania"><br>Powitania</a></li> 
                                <li><a href="index.php?admin=news" title="Zarządzanie aktualnościami strony głównej"><img src="images/icons/pen.png" alt="Aktualności"><br>Aktualności</a></li> 
								<li><a href="index.php?admin=teams" title="Zarządzanie drużynami"><img src="images/icons/pen.png" alt="Drużyny"><br>Drużyny</a></li> 
								<li><a href="index.php?admin=players" title="Zarządzanie zawodnikami"><img src="images/icons/pen.png" alt="Zawodnicy"><br>Zawodnicy</a></li> 
								<li><a href="index.php?admin=matches" title="Zarządzanie meczami"><img src="images/icons/pen.png" alt="Mecze"><br>Mecze</a></li>
								<li><a href="index.php?admin=arbiters" title="Zarządzanie sędziami"><img src="images/icons/pen.png" alt="Sędziowie"><br>Sędziowie</a></li> 
								<li><a href="index.php?admin=pitches" title="Zarządzanie boiskami"><img src="images/icons/pen.png" alt="Boiska"><br>Boiska</a></li>
								<li><a href="index.php?admin=films" title="Zarządzanie galeriami filmów"><img src="images/icons/photos.png" alt="Galeria Filmów"><br>Gal. Filmów</a></li>
                                <li><a href="index.php?admin=gallery&action=showCat" title="Zarządzanie galeriami zdjęć"><img src="images/icons/photos.png" alt="Galeria Zdjęć"><br>Galeria Zdjęć</a></li>
                            </ul>
                            </center>
                            <div class=\"clear\"></div>
                        </div>
                    </div>
            </div> ';
			
			//<li><a href="index.php?admin=podstrony" title="Zarządzanie podstronami"><img src="images/icons/attachment.png" alt="Podstrony"><br>Podstrony</a></li> 
    }
    
    public static function Podstrony()
    {
        echo '
            <div class="round">
                <div class="round-head">
                        <h2>Podstrony</h2>
                    </div>

                    <div class="round-content">
                        <div id="icondock">
                            <ul>
                            <center>
                                <li><a href="index.php?admin=jednaidea&action=show" title="Jedna idea"><img src="images/icons/pen.png" alt="Jedna idea"><br>Jedna idea</a></li> 
                                <li><a href="index.php?admin=dlaFirm&action=show" title="Idea dla Firm"><img src="images/icons/pen.png" alt="Idea dla Firm"><br>Idea dla Firm</a></li> 
                                <li><a href="index.php?admin=pop&action=show" title="POP"><img src="images/icons/pen.png" alt="POP"><br>POP</a></li>
                                <li><a href="index.php?admin=gallery&action=showCat" title="Galeria Zdjęć"><img src="images/icons/photos.png" alt="Galeria Zdjęć"><br>Galeria Zdjęć</a></li>
                            </ul>
                            </center>
                            <div class=\"clear\"></div>
                        </div>
                    </div>
            </div> ';
    }
    
    /*public static function News($action)
    {
		if(!empty($action))
		{
			//echo '<div id="lewy">';
				switch($action)
				{
					case 'showNews':
						AdminNews::showNews();
						break;
					
					case 'add':
						Show::showAddForm();
						break;
					
					case 'addNews':
						AdminNews::addNews($_POST['title'], $_POST['content'], $_GET['accept']);
						break;
					
					case 'delAll':
						if(isset($_GET['accept']))
							AdminNews::deleteAllNews($_GET['accept']);
						else
							AdminNews::deleteAllNews('');	
						break;
					
					case 'delete':
						if(isset($_GET['accept']))
							AdminNews::deleteNews($_GET['id'], $_GET['accept']);
						else
							AdminNews::deleteNews($_GET['id'], '');
						break;
					
					case 'edit':
						AdminNews::editNews($_GET['id'], $_POST['title'], $_POST['content'], $_GET['accept']);
						break;
					
					case 'editStatic':
						if(isset($_POST['title']))
							staticPage::edit($_GET['admin'], $_GET['id'], $_POST['title'], $_POST['content'], $_GET['accept']);
						else
							staticPage::edit($_GET['admin'], $_GET['id'], '', '', '');
						break;
				  
					default:
						Show::ShowMessage("ERROR 404 - BRAK PODANEJ STRONY", false);
				}
		}
		else
		{
				
			echo '</div>
				<div id="prawy">
				<div class="sidebar_box">
						<div class="sidebar_box_top"></div>
						<div class="sidebar_box_content">
							<h3>Artykuły</h3>
							<img src="images/info.png" alt="" title="" class="sidebar_icon_right" />
								<ul>
									<li><a href="index.php?admin=news&action=add" title="Dodaj artykuł">Dodaj nowy artykuł</a></li>
									<li><a href="index.php?admin=news&action=showNews" title="Wyświetl wszystkie artykuły z bazy">Wyświetl artykuły</a></li>
									<li><a href="index.php?admin=news&action=delAll" title="!!USUWA WSZYSTKIE ARTYKUŁY Z BAZY DANYCH!!">Usuń wszystkie</a></li>
								</ul>
						</div>
						<div class="sidebar_box_bottom"></div>
					</div>
				</div>
				<div style="clear: both;"></div>';
		}
	}*/
    
    public static function showNewsFunct($i, $id, $title, $content, $addDate, $author)
    {
        if (!$i <= 0)
        {
            echo
            '
                <tr>
                    <td align="center">',$id,'</td>
                    <td>',$title,'</td>
                    <td>',$content,'</td>
                    <td align="center">',$addDate,'</td>
                    <td align="center">',$author,'</td>
                    <td align="center"><a href="index.php?admin=news&action=update&id=',$id,'"><img src="images/user_edit.png" alt="Edytuj artykuł..." title="Edytuj artykuł..." border="0" /></a></td>
                    <td align="center"><a href="index.php?admin=news&action=del&id=',$id,'" class="ask"><img src="images/trash.png" alt="Usuń artykuł..." title="Usuń artykuł..." border="0" /></a></td>
                </tr>  
            ';
        }
        else
        {
            echo Show::ShowMessage ("Brak artykułów do wyświetlenia...", false);
        }
    }
    
    public static function showAddForm()
    {
        echo
        '
            <div class="round">
                <div class="round-head">
                    <h2>Dodaj Artykuł</h2>
                </div>

                <div class="round-content">
                    <form action="index.php?admin=news&action=addNews&accept=yes" class="uniForm" method="post"> 
                    <fieldset class="inlineLabels"> 
                        <div class="ctrlHolder"> 
                            <label>tytuł:</label> 
                            <input type="text" id="title" name="title" class="textInput"/> 
                         </div>
                        <div class="ctrlHolder"> 
                            <textarea id="content" name="content" class="textInput"/></textarea>
                        </div>
                        <br />
                        <div class="buttonHolder"> 
                            <a id="passwordForgot" href="index.php?admin=news&action=showNews">anuluj dodawanie artykułu</a>
                            <button id="login" type="submit" class="primaryAction">Dodaj artykuł</button> 
                            <button id="reset" type="reset" class="primaryAction">Zresetuj formularz</button>
                        </div> 
                    </fieldset> 
                    </form>
                </div>
            </div>
        ';
    }
    
    public static function showEditForm($id, $title, $content, $addDate, $author)
    {
        echo
        '
            <div class="round">
                <div class="round-head">
                    <h2>Edytuj Artykuł</h2>
                </div>

                <div class="round-content">
                    <form action="index.php?admin=news&action=edit&id=',$id,'&accept=yes" class="uniForm" method="post"> 
                    <fieldset class="inlineLabels"> 
                        <div class="ctrlHolder"> 
                            <label>tytuł:</label> 
                            <input type="text" id="title" value="',$title,'" name="title" class="textInput"/> 
                         </div>
                        <div class="ctrlHolder"> 
                            <textarea id="content" name="content" class="textInput"/>',$content,'</textarea>
                        </div>
                        <br />
                        <div class="buttonHolder"> 
                            <a id="passwordForgot" href="index.php?admin=news&action=showNews">anuluj edycje artykułu</a>
                            <button id="login" type="submit" class="primaryAction">Edytuj artykuł</button> 
                            <button id="reset" type="reset" class="primaryAction">Zresetuj formularz</button>
                        </div> 
                    </fieldset> 
                    </form>
                </div>
            </div>
        ';
    }
    
    public static function staticPage($action, $tabble)
    {
        //echo '<div id="lewy">';
            switch($action)
            {
                case 'show':
                    staticPage::getArticle($tabble);
                    break;
                
                case 'edit':
                    staticPage::edit($_GET['admin'], $_GET['id'], $_POST['title'], $_POST['content'], $_GET['accept']);
                    break;
              
                default:
                    Show::ShowMessage("ERROR 404 - BRAK PODANEJ STRONY", false);
            }
            
        echo
            '</div>
                <div id="prawy">
        	<div class="sidebar_box">
                    <div class="sidebar_box_top"></div>
                    <div class="sidebar_box_content">
                        <h3>Artykuł</h3>
                        <img src="images/info.png" alt="" title="" class="sidebar_icon_right" />
                            <ul>
                                <li><a href="index.php?admin=',$tabble,'&action=edit&id=1" title="Edytuj artykuł">Edytuj artykuł</a></li>
                            </ul>
                    </div>
                    <div class="sidebar_box_bottom"></div>
                </div>
            </div>
            <div style="clear: both;"></div>
        ';
    }
    
    public static function article($i, $id, $title, $content, $tabble)
    {
        if (!$i <= 0)
        {
            echo 
            '
                <div id="lewy">
                    <div class="round">
                        <div class="round-head">
                            <h2>',$title,'</h2>
                        </div>
                        <div class="round-content">
                            ',$content,'
                        </div>
                    </div>
                </div>';
        }
        else
        {
            echo Show::ShowMessage ("Brak artykułów do wyświetlenia...", false);
        }
    }
    
    public static function showEdit($id, $title, $content, $tabble)
    {
        echo
        '
            <div class="round">
            <div class="round-head">
                <h2>Edytuj Artykuł</h2>
            </div>

            <div class="round-content">
                <form action="index.php?admin=',$tabble,'&action=edit&id=',$id,'&accept=yes" class="uniForm" method="post"> 
                <fieldset class="inlineLabels"> 
                    <div class="ctrlHolder"> 
                        <label>tytuł:</label> 
                        <input type="text" id="title" value="',$title,'" name="title" class="textInput"/> 
                     </div>
                    <div class="ctrlHolder"> 
                        <textarea id="content" name="content" class="textInput"/>',$content,'</textarea>
                    </div>
                    <br />
                    <div class="buttonHolder"> 
                        <a id="passwordForgot" href="index.php?admin=',$tabble,'&action=showNews">anuluj edycje artykułu</a>
                        <button id="login" type="submit" class="primaryAction">Edytuj artykuł</button> 
                        <button id="reset" type="reset" class="primaryAction">Zresetuj formularz</button>
                    </div> 
                </fieldset> 
                </form>
            </div>
        </div>
        ';
    }
    
    public static function Galeria($action)
    {
		if(!empty($action))
		{
			//echo '<div id="lewy">';
            switch($action)
            {
                case 'showCat':
                    adminGallery::getCategory();
                    break;
                
                case 'add':
                    Show::showAddCat();
                    break;
                
                case 'addCat':
                    adminGallery::addCat($_POST['idtekst'], $_POST['title'], $_POST['description'], $_POST['addDate'], $_POST['patch'], $_POST['thumb'], $_GET['accept']);
                    break;
                
                case 'delAll':
                    adminGallery::deleteAllCat($_GET['accept']);
                    break;
                
                case 'delete':
                    adminGallery::deleteCat($_GET['id'], $_GET['accept']);
                    break;
                
                case 'edit':
                    adminGallery::editCategory($_GET['id'], $_POST['idtekst'], $_POST['title'], $_POST['description'], $_POST['addDate'], $_POST['patch'], $_POST['thumb'], $_GET['accept']);
                    break;
                
                case 'addPhoto':
                    Show::showAddPhoto();
                    break;
                
                case 'addPhotos':
                    adminGallery::addPhoto($_POST['cat'], $_POST['cat'], $_POST['name'], $_POST['url'], $_POST['description'], $_POST['addDate'], $_POST['thumbnail'], $_GET['accept']);
                    break;
                
                case 'delAllPhoto':
                    adminGallery::deleteAllPhoto($_GET['accept']);
                    break;
                
                case 'deletePhoto':
                    adminGallery::deletePhoto($_GET['id'], $_GET['accept']);
                    break;
                
                case 'showPhotos':
                    adminGallery::getPhoto();
                    break;
                
                case 'editPhoto':
                    adminGallery::editPhoto($_GET['id'], $_POST['cat'], $_POST['cat'], $_POST['name'], $_POST['url'], $_POST['description'], $_POST['addDate'], $_POST['thumbnail'], $_GET['accept']);
                    break;
              
                default:
                    Show::ShowMessage("ERROR 404 - BRAK PODANEJ STRONY", false);
            }
			//echo '</div>';
		}
        else
		{
			echo
				'</div>
				<div id="prawy">
				<div class="sidebar_box">
						<div class="sidebar_box_top"></div>
						<div class="sidebar_box_content">
							<h3>Galeria Zdjęć</h3>
							<img src="images/info.png" alt="" title="" class="sidebar_icon_right" />
								<ul>
									Kategorie:
									<li><a href="index.php?admin=gallery&action=add" title="Dodaj kategorie">Dodaj nową kategorie</a></li>
									<li><a href="index.php?admin=gallery&action=showCat" title="Wyświetl wszystkie kategorie z bazy">Wyświetl kategorie</a></li>
									<li><a href="index.php?admin=gallery&action=delAll" title="!!USUWA WSZYSTKIE KATEGORIE Z BAZY DANYCH!!">Usuń wszystkie</a></li>
									<br />Zdjęcia:
									<li><a href="index.php?admin=gallery&action=addPhoto" title="Dodaj zdjęcie">Dodaj nową zdjęcie</a></li>
									<li><a href="index.php?admin=gallery&action=showPhotos" title="Wyświetl wszystkie zdjęcia z bazy">Wyświetl zdjęcia</a></li>
									<li><a href="index.php?admin=gallery&action=delAllPhoto" title="!!USUWA WSZYSTKIE ZDJECIA Z BAZY DANYCH!!">Usuń wszystkie</a></li>
								</ul>
						</div>
						<div class="sidebar_box_bottom"></div>
					</div>
				</div>
				<div style="clear: both;"></div>
			';
		}
    }
    
    public static function showGalleryKat($i, $id, $title, $desctiption, $addDate, $patch)
    {
        if (!$i <= 0)
        {
            echo
            '
                <tr>
                    <td align="center">',$id,'</td>
                    <td>',$title,'</td>
                    <td>',$desctiption,'</td>
                    <td align="center">',$addDate,'</td>
                    <td align="center">',$patch,'</td>
                    <td align="center"><a href="index.php?admin=gallery&action=edit&id=',$id,'"><img src="images/user_edit.png" alt="Edytuj kategorie..." title="Edytuj kategorie..." border="0" /></a></td>
                    <td align="center"><a href="index.php?admin=gallery&action=delete&id=',$id,'" class="ask"><img src="images/trash.png" alt="Usuń kategorie..." title="Usuń kategorie..." border="0" /></a></td>
                </tr>  
            ';
        }
        else
        {
            echo Show::ShowMessage ("Brak kategorii do wyświetlenia...", false);
        }
    }
    
    public static function showGalleryPhoto($i, $id, $name, $url, $thumb, $desctiption, $addDate)
    {
        if ($i <= 0)
        {
            echo
            '
                <tr>
                    <td align="center">',$id,'</td>
                    <td>',$name,'</td>
                    <td>',$url,'</td>
                    <td align="center">',$thumb,'</td>
                    <td align="center"><a href="index.php?admin=gallery&action=editPhoto&id=',$id,'"><img src="images/user_edit.png" alt="Edytuj kategorie..." title="Edytuj kategorie..." border="0" /></a></td>
                    <td align="center"><a href="index.php?admin=gallery&action=deletePhoto&id=',$id,'" class="ask"><img src="images/trash.png" alt="Usuń kategorie..." title="Usuń kategorie..." border="0" /></a></td>
                </tr>  
            ';
        }
        else
        {
            echo Show::ShowMessage ("Brak kategorii do wyświetlenia...", false);
        }
    }
    
    public static function showEditCat($id, $id_tekst, $title, $description, $addDate, $patch, $thumb)
    {
        echo
        '
            <div class="round">
                <div class="round-head">
                    <h2>Edytuj Kategorie</h2>
                </div>

                <div class="round-content">
                    <form action="index.php?admin=gallery&action=edit&id=',$id,'&accept=yes" class="uniForm" method="post"> 
                    <fieldset class="inlineLabels"> 
                        <div class="ctrlHolder"> 
                            <label>tytuł:</label> 
                            <input type="text" id="title" value="',$title,'" name="title" class="textInput"/> 
                         </div>
                        <div class="ctrlHolder"> 
                            <label>id tekstowe:</label> 
                            <input type="text" id="idtekst" name="idtekst" value="',$id_tekst,'" class="textInput"/>  
                        </div> 
                        <div class="ctrlHolder"> 
                            <label>data dodania:</label> 
                            <input type="text" id="addDate" name="addDate" value="',$addDate,'" class="textInput"/>  
                        </div> 
                        <div class="ctrlHolder"> 
                            <label>katalog na serwerze:</label> 
                            <input type="text" id="patch" name="patch" value="',$patch,'" class="textInput"/>  
                        </div> 
                        <div class="ctrlHolder"> 
                            <label>miniatura zdjęcia:</label> 
                            <input type="text" id="thumb" name="thumb" value="',$thumb,'" class="textInput"/>  
                        </div> 
                        <div class="ctrlHolder"> 
                            <textarea id="description" name="description" class="textInput"/>',$description,'</textarea>
                        </div>
                        <br />
                        <div class="buttonHolder"> 
                            <a id="passwordForgot" href="index.php?admin=gallery&action=showCat">anuluj edycje artykułu</a>
                            <button id="login" type="submit" class="primaryAction">Edytuj kategorie</button> 
                            <button id="reset" type="reset" class="primaryAction">Zresetuj formularz</button>
                        </div> 
                    </fieldset> 
                    </form>
                </div>
            </div>
        ';
    }
    
    public static function showAddCat()
    {
        echo
        '
            <div class="round">
                <div class="round-head">
                    <h2>Dodaj Kategorie</h2>
                </div>

                <div class="round-content">
                    <form action="index.php?admin=gallery&action=addCat&accept=yes" class="uniForm" method="post"> 
                    <fieldset class="inlineLabels"> 
                        <div class="ctrlHolder"> 
                            <label>tytuł:</label> 
                            <input type="text" id="title" name="title" class="textInput"/> 
                         </div>
                        <div class="ctrlHolder"> 
                            <label>id tekstowe:</label> 
                            <input type="text" id="idtekst" name="idtekst" class="textInput"/>  
                        </div> 
                        <div class="ctrlHolder"> 
                            <label>data dodania:</label> 
                            <input type="text" id="addDate" name="addDate"value="'; echo date('Y-n-d'); echo'" class="textInput"/>  
                        </div> 
                        <div class="ctrlHolder"> 
                            <label>katalog na serwerze:</label> 
                            <input type="text" id="patch" name="patch" class="textInput"/>  
                        </div> 
                        <div class="ctrlHolder"> 
                            <label>miniatura zdjęcia:</label> 
                            <input type="text" id="thumb" name="thumb" class="textInput"/>  
                        </div> 
                        <div class="ctrlHolder"> 
                            <textarea id="description" name="description" class="textInput"/></textarea>
                        </div>
                        <br />
                        <div class="buttonHolder"> 
                            <a id="passwordForgot" href="index.php?admin=gallery&action=showCat">anuluj edycje artykułu</a>
                            <button id="login" type="submit" class="primaryAction">Dodaj kategorie</button> 
                            <button id="reset" type="reset" class="primaryAction">Zresetuj formularz</button>
                        </div> 
                    </fieldset> 
                    </form>
                </div>
            </div>
        ';
    }
    
    public static function showAddPhoto()
    {
        echo
        '
            <div class="round">
                <div class="round-head">
                    <h2>Dodaj Zdjęcie</h2>
                </div>

                <div class="round-content">
                    <form action="index.php?admin=gallery&action=addPhotos&accept=yes" class="uniForm" method="post"> 
                    <fieldset class="inlineLabels"> 
                        <div class="ctrlHolder"> 
                            ',Show::getCats(),'
                         </div>
                        <div class="ctrlHolder"> 
                            <label>nazwa:</label> 
                            <input type="text" id="name" name="name" class="textInput"/> 
                         </div>
                        <div class="ctrlHolder"> 
                            <label>adres dużego zdjęcia:</label> 
                            <input type="text" id="url" name="url" class="textInput"/>  
                        </div> 
                        <div class="ctrlHolder"> 
                            <label>adres miniatury:</label> 
                            <input type="text" id="thumbnail" name="thumbnail" class="textInput"/>  
                        </div> 
                        <div class="ctrlHolder"> 
                            <label>data dodania zdjęcia:</label> 
                            <input type="text" id="addDate" name="addDate"value="'; echo date('Y-n-d'); echo'"class="textInput"/>  
                        </div>  
                        <div class="ctrlHolder"> 
                            <label>opis zdjęcia:</label> 
                                <textarea id="description" name="description" class="textInput"/></textarea>
                        </div>
                        <br />
                        <div class="buttonHolder"> 
                            <a id="passwordForgot" href="index.php?admin=gallery&action=showCat">anuluj edycje artykułu</a>
                            <button id="login" type="submit" class="primaryAction">Dodaj zdjęcie</button> 
                            <button id="reset" type="reset" class="primaryAction">Zresetuj formularz</button>
                        </div> 
                    </fieldset> 
                    </form>
                </div>
            </div>
        ';
    }
    
    public static function showEditPhoto($id, $tit_cat_id, $category, $name, $url, $description, $addDate, $thumb)
    {
        echo
        '
            <div class="round">
                <div class="round-head">
                    <h2>Edytuj Zdjęcie</h2>
                </div>

                <div class="round-content">
                    <form action="index.php?admin=gallery&action=editPhoto&id=',$id,'&accept=yes" class="uniForm" method="post"> 
                    <fieldset class="inlineLabels"> 
                        <div class="ctrlHolder"> 
                            ',Show::getCats(),'
                         </div>
                        <div class="ctrlHolder"> 
                            <label>nazwa:</label> 
                            <input type="text" value="',$name,'" id="name" name="name" class="textInput"/> 
                         </div>
                        <div class="ctrlHolder"> 
                            <label>adres dużego zdjęcia:</label> 
                            <input type="text" value="',$url,'" id="url" name="url" class="textInput"/>  
                        </div> 
                        <div class="ctrlHolder"> 
                            <label>adres miniatury:</label> 
                            <input type="text" id="thumbnail" name="thumbnail" value="',$thumb,'" class="textInput"/>  
                        </div> 
                        <div class="ctrlHolder"> 
                            <label>data dodania zdjęcia:</label> 
                            <input type="text" id="addDate" name="addDate" value="',$addDate,'" class="textInput"/>  
                        </div>  
                        <div class="ctrlHolder"> 
                            <label>opis zdjęcia:</label> 
                                <textarea id="description" name="description" class="textInput"/>',$description,'</textarea>
                        </div>
                        <br />
                        <div class="buttonHolder"> 
                            <a id="passwordForgot" href="index.php?admin=gallery&action=showPhotos">anuluj edycje zdjęcia</a>
                            <button id="login" type="submit" class="primaryAction">Edytuj zdjęcie</button> 
                            <button id="reset" type="reset" class="primaryAction">Zresetuj formularz</button>
                        </div> 
                    </fieldset> 
                    </form>
                </div>
            </div>
        ';
    }
    
    private static function getCats()
    {
        $connect = sqlConnect(); 
        $result = @$connect->query("select tit_id, title from gallery_category");
        $all = $result->num_rows;
        if($all <= 0)
        {
            echo Show::ShowMessage ("Brak artykułów kategorii do wyświetlenia...", false);
            exit;
        }
        else
        {
            echo '<label>wybierz kategorie:</label>';
            echo '<select name="cat" class="textInput" />';
            while (($cat = $result->fetch_assoc()) !== null)
            {    
                echo '<option value="',$cat[tit_id],'">',$cat[title],'</option>';
            }
            echo '</select>';
        }
    }
	
	public static function Films($action)
    {
		if(!empty($action))
		{
			if(isset($_GET['id'])) $id = $_GET['id'];
		
			//echo '<div id="lewy">';
            switch($action)
            {
                case 'showFilmsCat':
                    AdminFilms::showFilmsCat();
                    break;
					
				case 'showFilms':
					AdminFilms::showFilms();
					break;
					
				case 'addFilm':
					AdminFilms::addFilm();
					break;
					
				case 'addFilmsCat':
					AdminFilms::addFilmsCat();
					break;
					
				case 'editC':
					AdminFilms::editFilmsCategory($id);
					break;
					
				case 'editF':
					AdminFilms::editFilm();
					break;
					
				case 'deleteC':
					AdminFilms::delFilmsCat($id);
					break;	
					
				case 'deleteF':
					AdminFilms::delFilm($id);
					break;
              
                default:
                    Show::ShowMessage("ERROR 404 - BRAK PODANEJ STRONY", false);
            }   
			//echo '</div>';
		}
		else
		{
			echo
				'</div>
				<div id="prawy">
				<div class="sidebar_box">
						<div class="sidebar_box_top"></div>
						<div class="sidebar_box_content">
							<h3>Galeria Filmów</h3>
							<img src="images/info.png" alt="" title="" class="sidebar_icon_right" />
								<ul>
									Kategorie:
									<li><a href="index.php?admin=films&action=addFilmsCat" title="Dodaj kategorie">Dodaj nową kategorie</a></li>
									<li><a href="index.php?admin=films&action=showFilmsCat" title="Wyświetl wszystkie kategorie z bazy">Wyświetl kategorie</a></li>
									<br />Filmy:
									<li><a href="index.php?admin=films&action=addFilm" title="Dodaj film">Dodaj nowy film</a></li>
									<li><a href="index.php?admin=films&action=showFilms" title="Wyświetl wszystkie filmy z bazy">Wyświetl filmy</a></li>
								</ul>
						</div>
						<div class="sidebar_box_bottom"></div>
					</div>
				</div>
				<div style="clear: both;"></div>
			';
		}
	}
	
	public static function Events($action)
    {
		if(!empty($action))
		{
			if(isset($_GET['id'])) $id = $_GET['id'];
		
			//echo '<div id="lewy">';
            switch($action)
            {
                case 'showEvents':
                    AdminEvents::showEvents();
                    break;
				
				case 'addEvents':
                    AdminEvents::addEvents();
                    break;
					
				case 'deleteE':
					AdminEvents::delEvent($id);
					break;
					
				case 'editE':
					AdminEvents::editEvent($id);
					break;
					              
                default:
                    Show::ShowMessage("ERROR 404 - BRAK PODANEJ STRONY", false);
            }    
			//echo '</div>';
		}
		else
		{
			echo
				'</div>
				<div id="prawy">
					<div class="sidebar_box">
						<div class="sidebar_box_top"></div>
						<div class="sidebar_box_content">
							<h3>Wydarzenia</h3>
							<img src="images/info.png" alt="" title="" class="sidebar_icon_right" />
								<ul>
									<li><a href="index.php?admin=events&action=showEvents" title="Pokaż wydarzenia">Pokaż wydarzenia</a></li>
									<li><a href="index.php?admin=events&action=addEvents" title="Dodaj wydarzenie">Dodaj wydarzenie</a></li>
								</ul>
						</div>
						<div class="sidebar_box_bottom"></div>
					</div>
				</div>
				<div style="clear: both;"></div>
			';
		}
	}
	
	// Edycja strony powitalnej
	public static function Start($action)
	{
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
				if(empty($action))
				{
					// Strona podstawowa (wyświetlenie wszystkich powitań)
					@$db->query("SET NAMES utf8");
					$query = "Select * From start";
					$result = @$db->query($query);
					$counter = 1;
					
					$all = $result->num_rows;
					
					if($all == 0)
					{
						echo
						'<div class="round">
							<div class="round-head">
								<h2>Powitania w bazie</h2>
							</div>
							<div class="round-content">
								<center>
								<table width="100%" id="rounded-corner">
								<thead>
									<tr>
										<th align="center" class="rounded-company" scope="col">Brak powitań!</td>
									</tr>
								</thead>
								<tfoot>
								</tfoot>
								<tbody>
									<tr>
										<td align="center"><a href = "index.php?admin=start&action=add">Dodaj</a></td>
									</tr>
								</tbody>
								</table>
								</center>
							</div>
						</div>';
					}
					else
					{
						echo 
						'<div class="round">
							<div class="round-head">
								<h2>Powitania w bazie</h2>
							</div>
							<div class="round-content">
								<center>
								<table width="100%" id="rounded-corner">
								<thead>
									<tr>
										<th width="5%" class="rounded-company" scope="col">ID</th>
										<th width="25%" class="rounded" scope="col" align="center">Tytuł</th>
										<th width="35%" class="rounded" scope="col" align="center">Treść(skrocóna)</th>
										<th width="5%" class="rounded" scope="col" align="center">Wybierz</th>	
										<th width="5%" class="rounded" scope="col" align="center">Edytuj</th>								
										<th width="5%" class="rounded-q4" scope="col" align="center">Usuń</th>
									</tr>
								</thead>
								<tfoot>
								</tfoot>
								<tbody>';
						while(($start = $result->fetch_assoc()) !== null)
						{    
							echo
							'<tr>
								<td align="center">',$counter,'</td>
								<td>',$start['StartTitle'],'</td>
								<td>',$start['StartContent'],'</td>
								<td align="center"><a href="index.php?admin=start&action=select&id=',$start['StartID'],'"><img src="images/icons/small/check.png" alt="Wybierz powitanie..." title="Wybierz powitanie..." border="0" /></a></td>
								<td align="center"><a href="index.php?admin=start&action=update&id=',$start['StartID'],'"><img src="images/user_edit.png" alt="Edytuj powitanie..." title="Edytuj powitanie..." border="0" /></a></td>
								<td align="center"><a href="index.php?admin=start&action=del&id=',$start['StartID'],'" class="ask"><img src="images/trash.png" alt="Usuń powitanie..." title="Usuń powitanie..." border="0" /></a></td>
							</tr>';
							++$counter;
						}
						
						echo 
									"<tr>
										<td align='center' colspan = '6'><a href = 'index.php?admin=start&action=add'>Dodaj</a></td>
									</tr>
								</tbody>
								</table>
								</center>
							</div>
						</div>";
					}
				}
				else
				{
					switch($action)
					{
						case 'select':
							if(isset($_GET['id']))
							{
								$ID = $_GET['id'];
							
								@$db->query("SET NAMES utf8");
								$query = "Update start Set StartSelected = IF(StartID = $ID, 1, 0)";
								$result = @$db->query($query);
								if($result) {
									echo Show::ShowMessage('Wybrano powitanie!', true);
								} else {
									echo Show::ShowMessage('blad.', false);
								}
							}
						break;
						case 'add':
							echo
							'<div class="round">
								<div class="round-head">
									<h2>Dodaj Stronę powitalną</h2>
								</div>
								<div class="round-content">
									<form action="index.php?admin=start&action=addSave" class="uniForm" method="post"> 
										<fieldset class="inlineLabels">
											<div class="ctrlHolder"> 
												<label>Tytuł</label> 
												<input type="text" id="title" name="title" class="textInput"/> 
											</div>
											<br />
											<div class="ctrlHolder">
												<textarea id="content" name="content" class="textInput"/></textarea>
											</div>
											<br />
											<div class="buttonHolder">
												<a id="passwordForgot" href="index.php?admin=start">anuluj dodawanie strony powitalnej</a>
												<button id="login" type="submit" class="primaryAction">Dodaj stronę powitalną</button>
												<button id="reset" type="reset" class="primaryAction">Zresetuj formularz</button>
											</div>
										</fieldset> 
									</form>
								</div>
							</div>';
						break;
						case 'addSave':
							if(isset($_POST['title']))
							{
								$title = $_POST['title'];
								$content = $_POST['content'];
								
								@$db->query("SET NAMES utf8");
								$query = "Insert Into start Set StartTitle = '$title', StartContent = '$content'";
								$result = @$db->query($query);
								if($result) {
									echo Show::ShowMessage('Pomyśnie dodano powitanie do bazy danych...', true);
								} else {
									echo Show::ShowMessage('blad.', false);
								}
							}
						break;
						case 'updateSave':
							if(isset($_POST['title']) && isset($_GET['id']))
							{
								$title = $_POST['title'];
								$content = $_POST['content'];
								$id = $_GET['id'];
								
								@$db->query("SET NAMES utf8");
								$query = "Update start Set StartTitle = '$title', StartContent = '$content' Where StartID = '$id'";
								$result = @$db->query($query);
								if($result) {
									echo Show::ShowMessage('Pomyśnie zmodyfikowno powitanie w bazie danych...', true);
								} else {
									echo Show::ShowMessage('blad.', false);
								}
							}
						break;
						case 'update':
							if(isset($_GET['id']))
							{
								$ID = $_GET['id'];
							
								$content 	= "";
								$title 		= "";
					
								@$db->query("SET NAMES utf8");
								$query = "Select StartTitle, StartContent From start Where StartID = $ID";
								$result = @$db->query($query);
								if ($result !== false)
								{
									if(($start = $result->fetch_assoc()) !== null)
									{
										$content 	= $start['StartContent'];
										$title 		= $start['StartTitle'];
									}
								}
								
								echo
								'<div class="round">
									<div class="round-head">
										<h2>Edytuj Stronę powitalną</h2>
									</div>
									<div class="round-content">
										<form action="index.php?admin=start&action=updateSave&id='.$ID.'" class="uniForm" method="post"> 
											<fieldset class="inlineLabels">
												<div class="ctrlHolder"> 
													<label>Tytuł</label> 
													<input type="text" value="',$title,'" id="title" name="title" class="textInput"/> 
												</div>
												<br />
												<div class="ctrlHolder">
													<textarea id="content" name="content" class="textInput"/>',$content,'</textarea>
												</div>
												<br />
												<div class="buttonHolder">
													<a id="passwordForgot" href="index.php?admin=start">anuluj edycje strony powitalnej</a>
													<button id="login" type="submit" class="primaryAction">Edytuj stronę powitalną</button>
													<button id="reset" type="reset" class="primaryAction">Zresetuj formularz</button>
												</div>
											</fieldset> 
										</form>
									</div>
								</div>';
							}
						break;
						case 'del':
							if(isset($_GET['id']))
							{	
								$ID = $_GET['id'];
								
								@$db->query("SET NAMES utf8");
								$query = "Delete From start Where StartID = '$ID'";
								$result = @$db->query($query);
								if($result) {
									echo Show::ShowMessage('Pomyśnie usunięto powitanie z bazy danych...', true);
								} else {
									echo Show::ShowMessage('blad.', false);
								}
							}
						break;
					}
				}
			}
		}
		catch(Exception $Error)	
		{
			echo Show::ShowMessage('Wystapil powazny błąd....', false);
		}
	}
	
	// Edycja drużyn
	public static function Teams($action)
	{
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
				if(empty($action))
				{
					// Strona podstawowa (wyświetlenie wszystkich drużyn)
					@$db->query("SET NAMES utf8");
					$query = "Select t.TeamID, t.TeamName, CONCAT(p.PlayerSurname, ' ', p.PlayerForname) As PlayerName, t.TeamCode, t.TeamImage, t.TeamLogo From teams t Left Join players p Using (PlayerID)";
					$result = @$db->query($query);
					$counter = 1;
					
					$all = $result->num_rows;
					
					if($all == 0)
					{
						echo
						'<div class="round">
							<div class="round-head">
								<h2>Drużyny w bazie</h2>
							</div>
							<div class="round-content">
							<center>
								<table width="100%" id="rounded-corner">
								<thead>
									<tr>
										<th align="center">Brak drużyn!</th>
									</tr>
								</thead>
								<tfoot>
								</tfoot>
								<tbody>
									<tr>
										<td align="center"><a href = "index.php?admin=teams&action=add">Dodaj</a></td>
									</tr>
								</tbody>
								</table>
							</center>
							</div>
						</div>';
					}
					else
					{
						echo 
						'<div class="round">
							<div class="round-head">
								<h2>Drużyny w bazie</h2>
							</div>
							<div class="round-content">
							<center>
								<table width="100%" id="rounded-corner">
								<thead>
									<tr>
										<th width="5%" class="rounded-company" scope="col">ID</th>
										<th width="20%" class="rounded" scope="col" align="center">Nazwa</th>
										<th width="20%" class="rounded" scope="col" align="center">Kapitan</th>
										<th width="15%" class="rounded" scope="col" align="center">Kod</th>
										<th width="15%" class="rounded" scope="col" align="center">Obrazek</th>
										<th width="15%" class="rounded" scope="col" align="center">Logo</th>											
										<th width="5%" class="rounded" scope="col" align="center">Edytuj</th>								
										<th width="5%" class="rounded-q4" scope="col" align="center">Usuń</th>
									</tr>
								</thead>
								<tfoot>
								</tfoot>
								<tbody>';
						while(($teams = $result->fetch_assoc()) !== null)
						{    
							echo
							'<tr>
								<td align="center">',$counter,'</td>
								<td>',$teams['TeamName'],'</td>
								<td>',$teams['PlayerName'],'</td>
								<td>',$teams['TeamCode'],'</td>
								<td>',$teams['TeamImage'],'</td>
								<td>',$teams['TeamLogo'],'</td>
								<td align="center"><a href="index.php?admin=teams&action=update&id=',$teams['TeamID'],'"><img src="images/user_edit.png" alt="Edytuj drużynę..." title="Edytuj drużynę..." border="0" /></a></td>
								<td align="center"><a href="index.php?admin=teams&action=del&id=',$teams['TeamID'],'" class="ask"><img src="images/trash.png" alt="Usuń drużynę..." title="Usuń dużynę..." border="0" /></a></td>
							</tr>';
							++$counter;
						}
						
						echo 
									"<tr>
										<td align='center' colspan = '8'><a href = 'index.php?admin=teams&action=add'>Dodaj</a></td>
									</tr>
								</tbody>
								</table>
							</center>
							</div>
						</div>";
					}
				}
				else
				{
					switch($action)
					{
						case 'select':
							if(isset($_GET['id']))
							{
								$ID = $_GET['id'];
							
								@$db->query("SET NAMES utf8");
								$query = "Update start Set StartSelected = IF(StartID = $ID, 1, 0)";
								$result = @$db->query($query);
								if($result) {
									echo Show::ShowMessage('Wybrano powitanie!', true);
								} else {
									echo Show::ShowMessage('blad.', false);
								}
							}
						break;
						case 'add':
							echo
							'<div class="round">
								<div class="round-head">
									<h2>Dodaj Drużynę</h2>
								</div>
								<div class="round-content">
									<form action="index.php?admin=teams&action=addSave" class="uniForm" method="post" enctype = "multipart/form-data"> 
										<fieldset class="inlineLabels">
											<div class="ctrlHolder"> 
												<label>Nazwa</label> 
												<input type="text" id="name" name="name" class="textInput"/> 
											</div>
											<br />
											<div class="ctrlHolder"> 
												<label>Kod drużyny</label> 
												<input type="text" id="code" name="code" class="textInput"/> 
											</div>
											<br />
											<div class="ctrlHolder"> 
												<label>Zdjęcie całego składu</label> 
												<input type="file" id="image" name="image" class="textInput"/> 
											</div>
											<br />
											<div class="ctrlHolder"> 
												<label>Logo</label> 
												<input type="file" id="logo" name="logo" class="textInput"/> 
											</div>
											<br />
											<div class="buttonHolder">
												<a id="passwordForgot" href="index.php?admin=teams">anuluj dodawanie drużyny</a>
												<button id="login" type="submit" class="primaryAction">Dodaj drużynę</button>
												<button id="reset" type="reset" class="primaryAction">Zresetuj formularz</button>
											</div>
										</fieldset> 
									</form>
								</div>
							</div>';
						break;
						case 'addSave':
							if(isset($_POST['name']))
							{
								$name = $_POST['name'];
								$code = $_POST['code'];
								$image = "";
								$logo = "";
								$addDate = date('Y-m-d H:i:s');
								
								// Dodawanie obrazka
								if (mkdir("../teams/$name", 0, true)) 
								{
									if(isset($_FILES["image"]))
									{
										if ($_FILES["image"]["error"] == 0)
										{
											$_FILES["image"]["name"] = "$name.jpg";
											if(move_uploaded_file($_FILES["image"]["tmp_name"], "../teams/$name/".$_FILES["image"]["name"]))
												$image = $_FILES["image"]["name"];
										}
									}
									if(isset($_FILES["logo"]))
									{
										if ($_FILES["logo"]["error"] == 0)
										{
											$_FILES["logo"]["name"] = $name."Logo.jpg";
											if(move_uploaded_file($_FILES["logo"]["tmp_name"], "../teams/$name/".$_FILES["logo"]["name"]))
												$logo = $_FILES["logo"]["name"];
										}
									}
								}
								
								@$db->query("SET NAMES utf8");
								$query = "Insert Into teams Set TeamName = '$name', TeamAddDate = '$addDate', TeamCode = '$code', TeamImage = '$image', TeamLogo = '$logo'";
								$result = @$db->query($query);
								if($result) {
									echo Show::ShowMessage('Pomyśnie dodano drużynę do bazy danych...', true);
								} else {
									echo Show::ShowMessage('blad.', false);
								}
							}
						break;
						case 'updateSave':
							if(isset($_POST['name']) && isset($_GET['id']))
							{
								$name = $_POST['name'];
								$code = $_POST['code'];
								$image = "";
								$logo = "";
								$id = $_GET['id'];
								$oldName = $_GET['oldName'];
								
								// Dodawanie obrazka
								if (rename("../teams/$oldName", "../teams/$name")) 
								{
									if(isset($_FILES["image"]))
									{
										if ($_FILES["image"]["error"] == 0)
										{
											$_FILES["image"]["name"] = "$name.jpg";
											if(move_uploaded_file($_FILES["image"]["tmp_name"], "../teams/$name/".$_FILES["image"]["name"]))
												$image = $_FILES["image"]["name"];
										}
										unlink("../teams/$oldName.jpg");
									}
									else
									{
										rename("../teams/$name/$oldName.jpg", "../teams/$name/$name.jpg");
										$image = "$name.jpg";
									}
									
									if(isset($_FILES["logo"]))
									{
										if ($_FILES["logo"]["error"] == 0)
										{
											$_FILES["logo"]["name"] = $name."Logo.jpg";
											if(move_uploaded_file($_FILES["logo"]["tmp_name"], "../teams/$name/".$_FILES["logo"]["name"]))
												$logo = $_FILES["logo"]["name"];
										}
										unlink("../teams/".$oldName."Logo.jpg");
									}
									else
									{
										rename("../teams/$name/".$oldName."Logo.jpg", "../teams/$name/".$name."Logo.jpg");
										$logo = $name."Logo.jpg";
									}	
								}
								
								@$db->query("SET NAMES utf8");
								$query = "Update teams Set TeamName = '$name', TeamCode = '$code', TeamImage = '$image', TeamLogo = '$logo' Where TeamID = '$id'";
								$result = @$db->query($query);
								if($result) {
									echo Show::ShowMessage('Pomyśnie zmodyfikowno drużynę w bazie danych...', true);
								} else {
									echo Show::ShowMessage('blad.', false);
								}
							}
						break;
						case 'update':
							if(isset($_GET['id']))
							{
								$ID = $_GET['id'];
							
								$name 	= "";
								$code 	= "";
								$image 	= "";
					
								@$db->query("SET NAMES utf8");
								$query = "Select TeamName, TeamCode, TeamImage From teams Where TeamID = $ID";
								$result = @$db->query($query);
								if ($result !== false)
								{
									if(($team = $result->fetch_assoc()) !== null)
									{
										$name 	= $team['TeamName'];
										$code 	= $team['TeamCode'];
										$image 	= $team['TeamImage'];
									}
								}
								
								echo
								'<div class="round">
									<div class="round-head">
										<h2>Edytuj drużynę</h2>
									</div>
									<div class="round-content">
										<form action="index.php?admin=teams&action=updateSave&id='.$ID.'&oldName='.$name.'" class="uniForm" method="post"> 
											<fieldset class="inlineLabels">
												<div class="ctrlHolder"> 
													<label>Nazwa</label> 
													<input type="text" value="',$name,'" id="name" name="name" class="textInput"/> 
												</div>
												<br />
												<div class="ctrlHolder"> 
													<label>Kod</label> 
													<input type="text" value="',$code,'" id="code" name="code" class="textInput"/> 
												</div>
												<br />
												<div class="buttonHolder">
													<a id="passwordForgot" href="index.php?admin=teams">anuluj edycje drużyny</a>
													<button id="login" type="submit" class="primaryAction">Edytuj drużynę</button>
													<button id="reset" type="reset" class="primaryAction">Zresetuj formularz</button>
												</div>
											</fieldset> 
										</form>
									</div>
								</div>';
							}
						break;
						case 'del':
							if(isset($_GET['id']))
							{	
								$ID = $_GET['id'];
								
								@$db->query("SET NAMES utf8");
								$query = "Delete From teams Where TeamID = '$ID'";
								$result = @$db->query($query);
								if($result) {
									echo Show::ShowMessage('Pomyśnie usunięto drużynę z bazy danych...', true);
								} else {
									echo Show::ShowMessage('blad.', false);
								}
							}
						break;
					}
				}
			}
		}
		catch(Exception $Error)	
		{
			echo Show::ShowMessage('Wystapil powazny błąd....', false);
		}
	}
	
	// Edycja aktualności
	public static function News($action)
	{
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
				if(empty($action))
				{
					@$db->query("SET NAMES utf8");
					$query = "Select n.NewsID, n.NewsTitle, n.NewsContent, n.NewsAddDate, u.UserLogin From news n Inner Join users u On n.UserID = u.UserID Order By n.NewsAddDate";
					$result = @$db->query($query);
					$all = $result->num_rows;
					if($all == 0)
					{
						echo
						'<div class="round">
							<div class="round-head">
								<h2>Aktualności w bazie</h2>
							</div>
							<div class="round-content">
							<center>
								<table width="100%" id="rounded-corner">
								<thead>
									<tr>
										<th align="center">Brak wpisów!</td>
									</tr>
								</thead>
								<tfoot>
								</tfoot>
								<tbody>
									<tr>
										<td align="center"><a href = "index.php?admin=news&action=add">Dodaj</a></td>
									</tr>
								</tbody>
								</table>
							</center>
							</div>
						</div>';
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
							'<div class="round">
								<div class="round-head">
									<h2>Aktualności w bazie</h2>
								</div>
								<div class="round-content">
									<center>
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
										<tbody>';
							
							while(($news = $result->fetch_assoc()) !== null)
							{    
								Show::showNewsFunct($all, $news['NewsID'], $news['NewsTitle'], substr($news['NewsContent'],0,20).'...', $news['NewsAddDate'], $news['UserLogin']);
							}
							echo
							'
											<tr>
												<td align="center" colspan = "7"><a href = "index.php?admin=news&action=add">Dodaj</a></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>';
							
							$result->close();
							$db->close();
						}
					}
				}
				else
				{
					switch($action)
					{
						case 'add':
							echo
							'<div class="round">
								<div class="round-head">
									<h2>Dodaj Artykuł</h2>
								</div>
								<div class="round-content">
									<form action="index.php?admin=news&action=addSave&accept=yes" class="uniForm" method="post"> 
									<fieldset class="inlineLabels"> 
										<div class="ctrlHolder"> 
											<label>tytuł:</label> 
											<input type="text" id="title" name="title" class="textInput"/> 
										</div>
										<div class="ctrlHolder"> 
											<textarea id="content" name="content" class="textInput"/></textarea>
										</div>
										<br />
										<div class="buttonHolder"> 
											<a id="passwordForgot" href="index.php?admin=news">anuluj dodawanie artykułu</a>
											<button id="login" type="submit" class="primaryAction">Dodaj artykuł</button> 
											<button id="reset" type="reset" class="primaryAction">Zresetuj formularz</button>
										</div> 
									</fieldset> 
									</form>
								</div>
							</div>';
						break;
						case 'addSave':
							if(isset($_POST['title']) && isset($_SESSION['id']))
							{
								try
								{
									$title 		= $_POST['title'];
									$content 	= $_POST['content'];
									$userId		= $_SESSION['id'];
								
									if(empty($title) || empty($content)) 
										throw new Value();
									
									$addDate 	= date('Y-m-d H:i:s');
								
									@$db->query("SET NAMES utf8");
									$result = @$db->query("INSERT INTO news SET NewsTitle = '$title', NewsContent = '$content', NewsAddDate = '$addDate', UserID = '$userId'");
									if($result) {
										echo Show::ShowMessage('Pomyśnie dodano artykuł do bazy danych...', true);
									} else {
										echo Show::ShowMessage('blad.', false);
									}
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
						break;
						case 'updateSave':
							if(isset($_POST['title']) && isset($_GET['id']))
							{
								$title 		= $_POST['title'];
								$content 	= $_POST['content'];
								$id 		= $_GET['id'];
								
								@$db->query("SET NAMES utf8");
								$query = "Update news Set NewsTitle = '$title', NewsContent = '$content' Where NewsID = '$id'";
								$result = @$db->query($query);
								if($result) {
									echo Show::ShowMessage('Pomyśnie zmodyfikowno wpis w bazie danych...', true);
								} else {
									echo Show::ShowMessage('blad.', false);
								}
							}
						break;
						case 'update':
							if(isset($_GET['id']))
							{
								$ID = $_GET['id'];
							
								$title 		= "";
								$content 	= "";
					
								@$db->query("SET NAMES utf8");
								$query = "Select NewsTitle, NewsContent From news Where NewsID = $ID";
								$result = @$db->query($query);
								if ($result !== false)
								{
									if(($news = $result->fetch_assoc()) !== null)
									{
										$title 	= $news['NewsTitle'];
										$content 	= $news['NewsContent'];
									}
								}
								
								echo
								'<div class="round">
									<div class="round-head">
										<h2>Edytuj Artykuł</h2>
									</div>
									<div class="round-content">
										<form action="index.php?admin=news&action=updateSave&id=',$ID,'&accept=yes" class="uniForm" method="post"> 
										<fieldset class="inlineLabels"> 
											<div class="ctrlHolder"> 
												<label>tytuł:</label> 
												<input type="text" id="title" value="',$title,'" name="title" class="textInput"/> 
											 </div>
											<div class="ctrlHolder"> 
												<textarea id="content" name="content" class="textInput"/>',$content,'</textarea>
											</div>
											<br />
											<div class="buttonHolder"> 
												<a id="passwordForgot" href="index.php?admin=news">anuluj edycje artykułu</a>
												<button id="login" type="submit" class="primaryAction">Edytuj artykuł</button> 
												<button id="reset" type="reset" class="primaryAction">Zresetuj formularz</button>
											</div> 
										</fieldset> 
										</form>
									</div>
								</div>';
							}
						break;
						case 'del':
							if(isset($_GET['id']))
							{	
								$ID = $_GET['id'];
								
								@$db->query("SET NAMES utf8");
								$query = "Delete From news Where NewsID = '$ID'";
								$result = @$db->query($query);
								if($result) {
									echo Show::ShowMessage('Pomyśnie usunięto wpis z bazy danych...', true);
								} else {
									echo Show::ShowMessage('blad.', false);
								}
							}
						break;
					}
				}
			}
		}
		catch(Exception $Error)	
		{
			echo Show::ShowMessage('Wystapil powazny błąd....', false);
		}
	}

	// Edycja zawodników
	public static function Players($action)
	{
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
				if(empty($action))
				{
					@$db->query("SET NAMES utf8");
					$query = "Select p.PlayerID, CONCAT(p.PlayerForname, ' ', p.PlayerSurname) As PlayerName, p.PlayerBornDate, ";
					$query .= "p.PlayerHeight, p.PlayerWage, p.PlayerNumber, t.TeamName From players As p ";
					$query .= "Left Join teams As t Using(TeamID)";
					$result = @$db->query($query);
					$all = $result->num_rows;
					if($all == 0)
					{
						echo
						'<div class="round">
							<div class="round-head">
								<h2>Zawodnicy w bazie</h2>
							</div>
							<div class="round-content">
							<center>
								<table width="100%" id="rounded-corner">
								<thead>
									<tr>
										<th align="center">Pusto tu :C</td>
									</tr>
								</thead>
								<tfoot>
								</tfoot>
								<tbody>
									<tr>
										<td align="center"><a href = "index.php?admin=players&action=add">Dodaj</a></td>
									</tr>
								</tbody>
								</table>
							</center>
							</div>
						</div>';
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
							'<div class="round">
								<div class="round-head">
									<h2>Zawodnicy w bazie</h2>
								</div>
								<div class="round-content">
									<center>
									<table width="100%" id="rounded-corner">
										<thead>
											<tr>
												<th width="5%" class="rounded-company" scope="col">ID</th>
												<th width="20%" class="rounded" scope="col" align="center">Imie i nazwisko</th>
												<th width="20%" class="rounded" scope="col" align="center">Data ur.</th>
												<th width="10%" class="rounded" scope="col" align="center">Wzrost</th>
												<th width="10%" class="rounded" scope="col" align="center">Waga</th>
												<th width="5%" class="rounded" scope="col" align="center">Numer</th>
												<th width="20%" class="rounded" scope="col" align="center">Drużyna</th>
												<th width="5%" class="rounded" scope="col" align="center">Edytuj</th>
												<th width="5%" class="rounded-q4" scope="col" align="center">Usuń</th>
											</tr>
										</thead>
										<tfoot>
										</tfoot>
										<tbody>';
							
										$counter = 1;
										while(($players = $result->fetch_assoc()) !== null)
										{
											if($players['TeamName'] == null)
												$players['TeamName'] = '[BRAK]';
												
											echo
											'<tr>
												<td align="center">',$counter,'</td>
												<td align="center">',$players['PlayerName'],'</td>
												<td align="center">',$players['PlayerBornDate'],'</td>
												<td align="center">',$players['PlayerHeight'],'</td>
												<td align="center">',$players['PlayerWage'],'</td>
												<td align="center">',$players['PlayerNumber'],'</td>
												<td align="center">',$players['TeamName'],'</td>
												<td align="center"><a href="index.php?admin=players&action=update&id=',$players['PlayerID'],'"><img src="images/user_edit.png" alt="Edytuj..." title="Edytuj..." border="0" /></a></td>
												<td align="center"><a href="index.php?admin=players&action=del&id=',$players['PlayerID'],'" class="ask"><img src="images/trash.png" alt="Usuń..." title="Usuń..." border="0" /></a></td>
											</tr>';
											++$counter;
										}
										
										echo
										'
											<tr>
												<td align="center" colspan = "9"><a href = "index.php?admin=players&action=add">Dodaj</a></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>';
							
							$result->close();
							$db->close();
						}
					}
				}
				else
				{
					switch($action)
					{
						case 'add':
						
							$selectTeam = "<select name = 'team'><option value = '0' selected>BRAK</option>";
						
							@$db->query("SET NAMES utf8");
							$query = "Select TeamID, TeamName From teams";
							$result = @$db->query($query);
							if ($result !== false)
							{
								while(($teams = $result->fetch_assoc()) !== null)
								{
									$TeamID 	= $teams['TeamID'];
									$TeamName 	= $teams['TeamName'];
									
									$selectTeam .= "<option value = '$TeamID'>$TeamName</option>";
								}
							}
							
							$selectTeam .= "</select>";
						
							echo
							'<div class="round">
								<div class="round-head">
									<h2>Dodaj Zawodnika</h2>
								</div>
								<div class="round-content">
									<form action="index.php?admin=players&action=addSave&accept=yes" class="uniForm" method="post"> 
									<fieldset class="inlineLabels"> 
										<div class="ctrlHolder"> 
											<label>Imię</label> 
											<input type="text" id="forname" name="forname" class="textInput"/> 
										</div>
										<div class="ctrlHolder"> 
											<label>Nazwisko</label> 
											<input type="text" id="surname" name="surname" class="textInput"/> 
										</div>
										<div class="ctrlHolder"> 
											<label>Data urodzenia</label> 
											<input type="text" id="borndate" name="borndate" class="textInput"/> 
										</div>
										<div class="ctrlHolder"> 
											<label>Numer</label> 
											<input type="text" id="number" name="number" class="textInput"/> 
										</div>
										<div class="ctrlHolder"> 
											<label>Wzorst</label> 
											<input type="text" id="height" name="height" class="textInput"/> 
										</div>
										<div class="ctrlHolder"> 
											<label>Waga</label> 
											<input type="text" id="wage" name="wage" class="textInput"/> 
										</div>
										<div class="ctrlHolder"> 
											<label>Zdjęcie</label> 
											<input type="file" id="foto" name="foto" class="textInput"/> 
										</div>
										<div class="ctrlHolder"> 
											<label>Drużyna</label>'. 
											$selectTeam
										.'</div>
										<div class="ctrlHolder"> 
											<label>PESEL</label> 
											<input type="text" id="pesel" name="pesel" class="textInput"/> 
										</div>
										<div class="buttonHolder"> 
											<a id="passwordForgot" href="index.php?admin=players">anuluj</a>
											<button id="login" type="submit" class="primaryAction">Dodaj</button> 
											<button id="reset" type="reset" class="primaryAction">Zresetuj formularz</button>
										</div> 
									</fieldset> 
									</form>
								</div>
							</div>';
						break;
						case 'addSave':
							if(isset($_POST['forname']) && isset($_SESSION['id']))
							{
								try
								{
									$forname 	= $_POST['forname'];
									$surname 	= $_POST['surname'];
									$bornDate 	= $_POST['borndate'];
									$number		= $_POST['number'];
									$height 	= $_POST['height'];
									$wage 		= $_POST['wage'];
									$pesel 		= $_POST['pesel'];
									$team 		= $_POST['team'];
									$foto		= "";
								
									if(empty($forname) || empty($surname) || empty($pesel)) 
										throw new Value();
										
									if(isset($_FILES["foto"]))
									{
										if ($_FILES["foto"]["error"] == 0)
										{
											$_FILES["foto"]["name"] = "$pesel.jpg";
											if(move_uploaded_file($_FILES["foto"]["tmp_name"], "../players/".$_FILES["foto"]["name"]))
												$foto = $_FILES["foto"]["name"];
										}
									}
								
									@$db->query("SET NAMES utf8");
									$query = "INSERT INTO players SET PlayerForname = '$forname', PlayerSurname = '$surname', ";
									$query .= "PlayerBornDate = '$bornDate', PlayerNumber = '$number', PlayerHeight = '$height', ";
									$query .= "PlayerWage = '$wage', PlayerFoto = '$foto', PlayerPESELNumber = '$pesel'";
									$result = @$db->query($query);
									if($result) {
										echo Show::ShowMessage('Pomyśnie dodano zawodnika do bazy danych...', true);
									} else {
										echo Show::ShowMessage('blad.', false);
									}
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
						break;
						case 'updateSave':
							if(isset($_POST['forname']) && isset($_GET['id']))
							{
								$forname 	= $_POST['forname'];
								$surname 	= $_POST['surname'];
								$bornDate 	= $_POST['borndate'];
								$number		= $_POST['number'];
								$height 	= $_POST['height'];
								$wage 		= $_POST['wage'];
								$pesel 		= $_POST['pesel'];
								$foto		= "";
								$team 		= $_POST['team'];
								$id 		= $_GET['id'];
								$oldPESEL 	= $_GET['oldPESEL'];
								
								if(isset($_FILES["foto"]))
								{
									if ($_FILES["foto"]["error"] == 0)
									{
										$_FILES["foto"]["name"] = "$pesel.jpg";
										if(move_uploaded_file($_FILES["foto"]["tmp_name"], "../players/".$_FILES["foto"]["name"]))
											$foto = $_FILES["foto"]["name"];
									}
								}
								else
								{
									if(file_exists("../players/".$oldPESEL.".jpg"))
									{
										rename("../players/".$oldPESEL.".jpg", "../players/".$pesel.".jpg");
										$foto = $pesel.".jpg";
									}
								}
								
								@$db->query("SET NAMES utf8");
								$query = "Update players SET PlayerForname = '$forname', PlayerSurname = '$surname', PlayerBornDate = '$bornDate', PlayerNumber = '$number', PlayerHeight = '$height', PlayerWage = '$wage', PlayerFoto = '$foto', TeamID = '$team', PlayerPESELNumber = '$pesel' Where PlayerID = '$id'";
								$result = @$db->query($query);
								if($result) {
									echo Show::ShowMessage('Pomyśnie zmodyfikowno dane o zawodniku w bazie danych...', true);
								} else {
									echo Show::ShowMessage('blad.', false);
								}
							}
						break;
						case 'update':
							if(isset($_GET['id']))
							{
								$ID = $_GET['id'];
					
								@$db->query("SET NAMES utf8");
								$query = "Select p.PlayerForname, p.PlayerSurname, p.PlayerBornDate, p.PlayerHeight, ";
								$query .= "p.PlayerWage, p.PlayerNumber, t.TeamName, p.UserID, p.PlayerFoto, p.PlayerPESELNumber ";
								$query .= "From players As p Left Join teams As t Using(TeamID) Where p.PlayerID = $ID";
								$result = @$db->query($query);
								if ($result !== false)
								{
									if(($player = $result->fetch_assoc()) !== null)
									{
										$forname = $player['PlayerForname'];
										$surname = $player['PlayerSurname'];
										$bornDate = $player['PlayerBornDate'];
										$height = $player['PlayerHeight'];
										$wage = $player['PlayerWage'];
										$number = $player['PlayerNumber'];
										$team = $player['TeamName'];
										$foto = $player['PlayerFoto'];
										$pesel = $player['PlayerPESELNumber'];
										$userID = $player['UserID'];
										
										$selectTeam = "<select name = 'team'>";
						
										if(empty($TeamName ))
											$selectTeam .= "<option value = '0' selected>BRAK</option>";
										else
											$selectTeam .= "<option value = '0'>BRAK</option>";
						
										@$db->query("SET NAMES utf8");
										$query = "Select TeamID, TeamName From teams";
										$result = @$db->query($query);
										if ($result !== false)
										{
											while(($teams = $result->fetch_assoc()) !== null)
											{
												$TeamID 	= $teams['TeamID'];
												$TeamName 	= $teams['TeamName'];
												
												if($TeamName == $team)
													$selectTeam .= "<option value = '$TeamID' selected>$TeamName</option>";
												else
													$selectTeam .= "<option value = '$TeamID'>$TeamName</option>";
											}
										}
										
										$selectTeam .= "</select>";
										
										echo
								'<div class="round">
									<div class="round-head">
										<h2>Edytuj informacje o zawodniku:</h2>
									</div>
									<div class="round-content">
										<form action="index.php?admin=players&action=updateSave&id=',$ID,'&accept=yes&oldPESEL=$pesel" class="uniForm" method="post"> 
										<fieldset class="inlineLabels"> 
											<div class="ctrlHolder"> 
												<label>Imie:</label> 
												<input type="text" id="forname" value="',$forname,'" name="forname" class="textInput"/> 
											</div>
											<div class="ctrlHolder"> 
												<label>Nazwisko:</label> 
												<input type="text" id="forname" value="',$surname,'" name="surname" class="textInput"/> 
											</div>
											<div class="ctrlHolder"> 
												<label>Data urodzenia(RRRR-MM-DD):</label> 
												<input type="text" id="forname" value="',$bornDate,'" name="borndate" class="textInput"/> 
											</div>
											<div class="ctrlHolder"> 
												<label>Wzrost:</label> 
												<input type="text" id="forname" value="',$height,'" name="height" class="textInput"/> 
											</div>
											<div class="ctrlHolder"> 
												<label>Waga:</label> 
												<input type="text" id="forname" value="',$wage,'" name="wage" class="textInput"/> 
											</div>
											<div class="ctrlHolder"> 
												<label>Numer:</label> 
												<input type="text" id="forname" value="',$number,'" name="number" class="textInput"/> 
											</div>
											<div class="ctrlHolder"> 
												<label>Drużyna:</label>'
												.$selectTeam.
											'</div>
											<div class="ctrlHolder"> 
												<label>Numer PESEL:</label> 
												<input type="text" id="forname" value="',$pesel,'" name="pesel" class="textInput"/> 
											</div>
											<br />
											<div class="buttonHolder"> 
												<a id="passwordForgot" href="index.php?admin=news">anuluj</a>
												<button id="login" type="submit" class="primaryAction">Edytuj</button> 
												<button id="reset" type="reset" class="primaryAction">Zresetuj formularz</button>
											</div> 
										</fieldset> 
										</form>
									</div>
								</div>';
									}
								}
							}
						break;
						case 'del':
							if(isset($_GET['id']))
							{	
								$ID = $_GET['id'];
								
								@$db->query("SET NAMES utf8");
								$query = "Delete From players Where PlayerID = '$ID'";
								$result = @$db->query($query);
								if($result) {
									echo Show::ShowMessage('Pomyśnie usunięto zawodnika z bazy danych...', true);
								} else {
									echo Show::ShowMessage('blad.', false);
								}
							}
						break;
					}
				}
			}
		}
		catch(Exception $Error)	
		{
			echo Show::ShowMessage('Wystapil powazny błąd....', false);
		}
	}
	
	// Edycja meczów
	public static function Matches($action)
	{
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
				if(empty($action))
				{
					@$db->query("SET NAMES utf8");
					$query = "Select m.MatchID, m.MatchDate, t1.TeamName As TeamA, t2.TeamName As TeamB, m.TeamASetWin, m.TeamBSetWin From (matches As m ";
					$query .= "Inner Join teams As t1 on m.TeamID_A = t1.TeamID) Inner Join teams As t2 on m.TeamID_B = t2.TeamID";
					$result = @$db->query($query);
					$all = $result->num_rows;
					if($all == 0)
					{
						echo
						'<div class="round">
							<div class="round-head">
								<h2>Mecze w bazie</h2>
							</div>
							<div class="round-content">
							<center>
								<table width="100%" id="rounded-corner">
								<thead>
									<tr>
										<th align="center">Pusto tu :C</td>
									</tr>
								</thead>
								<tfoot>
								</tfoot>
								<tbody>
									<tr>
										<td align="center"><a href = "index.php?admin=matches&action=add">Dodaj</a></td>
									</tr>
								</tbody>
								</table>
							</center>
							</div>
						</div>';
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
							'<div class="round">
								<div class="round-head">
									<h2>Mecze w bazie</h2>
								</div>
								<div class="round-content">
									<center>
									<table width="100%" id="rounded-corner">
										<thead>
											<tr>
												<th width="5%" class="rounded-company" scope="col">Lp.</th>
												<th width="25%" class="rounded" scope="col" align="center">Data</th>
												<th width="60%" class="rounded" scope="col" align="center">Wynik</th>
												<th width="5%" class="rounded" scope="col" align="center">Edytuj</th>
												<th width="5%" class="rounded-q4" scope="col" align="center">Usuń</th>
											</tr>
										</thead>
										<tfoot>
										</tfoot>
										<tbody>';
							
										$counter = 1;
										while(($data = $result->fetch_assoc()) !== null)
										{
											if($data['TeamName'] == null)
												$data['TeamName'] = '[BRAK]';
												
											echo
											'<tr>
												<td align="center">',$counter,'</td>
												<td align="center">',$data['MatchData'],'</td>
												<td align="center">',$data['TeamA'].' ('.$data['TeamASetWin'].' : '.$data['TeamBSetWin'].') '.$data['TeamB'],'</td>
												<td align="center"><a href="index.php?admin=matches&action=update&id=',$data['MatchID'],'"><img src="images/user_edit.png" alt="Edytuj..." title="Edytuj..." border="0" /></a></td>
												<td align="center"><a href="index.php?admin=matches&action=del&id=',$data['MatchID'],'" class="ask"><img src="images/trash.png" alt="Usuń..." title="Usuń..." border="0" /></a></td>
											</tr>';
											++$counter;
										}
										
										echo
										'
											<tr>
												<td align="center" colspan = "9"><a href = "index.php?admin=matches&action=add">Dodaj</a></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>';
							
							$result->close();
							$db->close();
						}
					}
				}
				else
				{
					switch($action)
					{
						case 'add':
						
							$selectTeamA = "<select name = 'teamA'>";
							$selectTeamB = "<select name = 'teamB'>";
							$selectPitch = "<select name = 'pitch'>";
							$selectArbiter = "<select name = 'arbiter'>";
						
							@$db->query("SET NAMES utf8");
							$query = "Select TeamID, TeamName From teams";
							$result = @$db->query($query);
							if ($result !== false)
							{
								while(($teams = $result->fetch_assoc()) !== null)
								{
									$TeamID 	= $teams['TeamID'];
									$TeamName 	= $teams['TeamName'];
									
									$selectTeamA .= "<option value = '$TeamID'>$TeamName</option>";
								}
							}
							
							$selectTeamA .= "</select>";
							
							@$db->query("SET NAMES utf8");
							$query = "Select TeamID, TeamName From teams";
							$result = @$db->query($query);
							if ($result !== false)
							{
								while(($teams = $result->fetch_assoc()) !== null)
								{
									$TeamID 	= $teams['TeamID'];
									$TeamName 	= $teams['TeamName'];
									
									$selectTeamB .= "<option value = '$TeamID'>$TeamName</option>";
								}
							}
							
							$selectTeamB .= "</select>";
							
							@$db->query("SET NAMES utf8");
							$query = "Select ArbiterID, Concat(ArbiterForname, ' ', ArbiterSurname) As ArbiterName From arbiters";
							$result = @$db->query($query);
							if ($result !== false)
							{
								while(($arbiters = $result->fetch_assoc()) !== null)
								{	
									$selectArbiter .= "<option value = '".$arbiters['ArbiterID']."'>".$arbiters['ArbiterName']."</option>";
								}
							}
							
							$selectArbiter .= "</select>";
							
							@$db->query("SET NAMES utf8");
							$query = "Select PitchID, PitchName From pitches";
							$result = @$db->query($query);
							if ($result !== false)
							{
								while(($pitches = $result->fetch_assoc()) !== null)
								{
									$selectPitch .= "<option value = '".$pitches['PitchID']."'>".$pitches['PitchName']."</option>";
								}
							}
							
							$selectPitch .= "</select>";
						
							echo
							'<div class="round">
								<div class="round-head">
									<h2>Dodaj Mecz</h2>
								</div>
								<div class="round-content">
									<form action="index.php?admin=matches&action=addSave&accept=yes" class="uniForm" method="post"> 
									<fieldset class="inlineLabels"> 
										<div class="ctrlHolder"> 
											<label>Drużyna A</label>',
											$selectTeamA,
										'</div>
										<div class="ctrlHolder"> 
											<label>Drużyna B</label>',
											$selectTeamB,
										'</div>
										<div class="ctrlHolder"> 
											<label>Data rozegrania</label> 
											<input type="text" id="matchdate" name="matchdate" class="textInput"/> 
										</div>
										<div class="ctrlHolder"> 
											<label>Sędzia</label>',
											$selectArbiter,
										'</div>
										<div class="ctrlHolder"> 
											<label>Boisko</label>',
											$selectPitch,
										'</div>
										<div class="ctrlHolder"> 
											<label>Wygrane sety przez drużynę A</label> 
											<input type="text" id="number" name="SetA" class="textInput"/> 
										</div>
										<div class="ctrlHolder"> 
											<label>Wygrane sety przez drużynę B</label> 
											<input type="text" id="height" name="SetB" class="textInput"/> 
										</div>
										<div class="ctrlHolder"> 
											<label>Punkty w secie 1. (drużyna A)</label> 
											<input type="text" id="wage" name="Set1A" class="textInput"/> 
										</div>
										<div class="ctrlHolder"> 
											<label>Punkty w secie 2. (drużyna A)</label> 
											<input type="text" id="wage" name="Set2A" class="textInput"/> 
										</div>
										<div class="ctrlHolder"> 
											<label>Punkty w secie 3. (drużyna A)</label> 
											<input type="text" id="wage" name="Set3A" class="textInput"/> 
										</div>
										<div class="ctrlHolder"> 
											<label>Punkty w secie 4. (drużyna A)</label> 
											<input type="text" id="wage" name="Set4A" class="textInput"/> 
										</div>
										<div class="ctrlHolder"> 
											<label>Punkty w secie 5. (drużyna A)</label> 
											<input type="text" id="wage" name="Set5A" class="textInput"/> 
										</div>
										<div class="ctrlHolder"> 
											<label>Punkty w secie 1. (drużyna B)</label> 
											<input type="text" id="wage" name="Set1B" class="textInput"/> 
										</div>
										<div class="ctrlHolder"> 
											<label>Punkty w secie 2. (drużyna B)</label> 
											<input type="text" id="wage" name="Set2B" class="textInput"/> 
										</div>
										<div class="ctrlHolder"> 
											<label>Punkty w secie 3. (drużyna B)</label> 
											<input type="text" id="wage" name="Set3B" class="textInput"/> 
										</div>
										<div class="ctrlHolder"> 
											<label>Punkty w secie 4. (drużyna B)</label> 
											<input type="text" id="wage" name="Set4B" class="textInput"/> 
										</div>
										<div class="ctrlHolder"> 
											<label>Punkty w secie 5. (drużyna B)</label> 
											<input type="text" id="wage" name="Set5B" class="textInput"/> 
										</div>
										<div class="buttonHolder"> 
											<a id="passwordForgot" href="index.php?admin=matches">anuluj</a>
											<button id="login" type="submit" class="primaryAction">Dodaj</button> 
											<button id="reset" type="reset" class="primaryAction">Zresetuj formularz</button>
										</div> 
									</fieldset> 
									</form>
								</div>
							</div>';
						break;
						case 'addSave':
							if(isset($_POST['matchdate']) && isset($_SESSION['id']))
							{
								try
								{
									$date 		= $_POST['matchdate'];
									$teamA 		= $_POST['teamA'];
									$teamB 		= $_POST['teamB'];
									$setA		= $_POST['SetA'];
									$setB 		= $_POST['SetB'];
									$set1A 		= $_POST['Set1A'];
									$set2A 		= $_POST['Set2A'];
									$set3A 		= $_POST['Set3A'];
									$set4A 		= $_POST['Set4A'];
									$set5A 		= $_POST['Set5A'];
									$set1B 		= $_POST['Set1B'];
									$set2B 		= $_POST['Set2B'];
									$set3B 		= $_POST['Set3B'];
									$set4B 		= $_POST['Set4B'];
									$set5B 		= $_POST['Set5B'];
									$pitch 		= $_POST['pitch'];
									$arbiter 	= $_POST['arbiter'];
								
									if(empty($teamA) || empty($teamB)) 
										throw new Value();
								
									@$db->query("SET NAMES utf8");
									$query = "INSERT INTO matches SET MetchDate = '$date', TeamID_A = '$teamA', ";
									$query .= "TeamID_A = '$teamB', TeamASetWin = '$setA', TeamBSetWin = '$setB', ";
									$query .= "TeamASet1 = '$set1A', TeamASet2 = '$set2A', TeamASet3 = '$set3A', ";
									$query .= "TeamASet4 = '$set4A', TeamASet5 = '$set5A', TeamBSet1 = '$set1B', ";
									$query .= "TeamBSet2 = '$set1B', TeamBSet3 = '$set3B', TeamBSet4 = '$set4B', ";
									$query .= "TeamBSet5 = '$set5B', PitchID = '$pitch', ArbiterID = '$arbiter'";
									$result = @$db->query($query);
									if($result) {
										echo Show::ShowMessage('Pomyśnie dodano informacje o meczu do bazy danych...', true);
									} else {
										echo Show::ShowMessage('blad.', false);
									}
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
						break;
						case 'updateSave':
							if(isset($_POST['matchdate']) && isset($_GET['id']))
							{
								$id = $_GET['id'];
							
								$date 		= $_POST['matchdate'];
								$teamA 		= $_POST['teamA'];
								$teamB 		= $_POST['teamB'];
								$setA		= $_POST['SetA'];
								$setB 		= $_POST['SetB'];
								$set1A 		= $_POST['Set1A'];
								$set2A 		= $_POST['Set2A'];
								$set3A 		= $_POST['Set3A'];
								$set4A 		= $_POST['Set4A'];
								$set5A 		= $_POST['Set5A'];
								$set1B 		= $_POST['Set1B'];
								$set2B 		= $_POST['Set2B'];
								$set3B 		= $_POST['Set3B'];
								$set4B 		= $_POST['Set4B'];
								$set5B 		= $_POST['Set5B'];
								$pitch 		= $_POST['pitch'];
								$arbiter 	= $_POST['arbiter'];
								
								@$db->query("SET NAMES utf8");
								$query = "UPDATE matches SET MetchDate = '$date', TeamID_A = '$teamA', ";
								$query .= "TeamID_A = '$teamB', TeamASetWin = '$setA', TeamBSetWin = '$setB', ";
								$query .= "TeamASet1 = '$set1A', TeamASet2 = '$set2A', TeamASet3 = '$set3A', ";
								$query .= "TeamASet4 = '$set4A', TeamASet5 = '$set5A', TeamBSet1 = '$set1B', ";
								$query .= "TeamBSet2 = '$set1B', TeamBSet3 = '$set3B', TeamBSet4 = '$set4B', ";
								$query .= "TeamBSet5 = '$set5B', PitchID = '$pitch', ArbiterID = '$arbiter' Where MatchID = '$id'";
								$result = @$db->query($query);
								if($result) {
									echo Show::ShowMessage('Pomyśnie zmodyfikowno dane o meczu w bazie danych...', true);
								} else {
									echo Show::ShowMessage('blad.', false);
								}
							}
						break;
						case 'update':
							if(isset($_GET['id']))
							{
								$selectTeamA = "<select name = 'teamA'>";
								$selectTeamB = "<select name = 'teamB'>";
								$selectPitch = "<select name = 'pitch'>";
								$selectArbiter = "<select name = 'arbiter'>";
							
								$ID = $_GET['id'];
					
								@$db->query("SET NAMES utf8");
								$query = "Select * From matches Where MatchID = '$ID'";
								$result = @$db->query($query);
								if ($result !== false)
								{
									if(($match = $result->fetch_assoc()) !== null)
									{										
										$date 		= $match['MatchDate'];
										$teamA 		= $match['TeamID_A'];
										$teamB 		= $match['TeamID_B'];
										$setA		= $match['TeamASetWin'];
										$setB 		= $match['TeamBSetWin'];
										$set1A 		= $match['TeamASet1'];
										$set2A 		= $match['TeamASet2'];
										$set3A 		= $match['TeamASet3'];
										$set4A 		= $match['TeamASet4'];
										$set5A 		= $match['TeamASet5'];
										$set1B 		= $match['TeamBSet1'];
										$set2B 		= $match['TeamBSet2'];
										$set3B 		= $match['TeamBSet3'];
										$set4B 		= $match['TeamBSet4'];
										$set5B 		= $match['TeamBSet5'];
										$pitch 		= $match['PitchID'];
										$arbiter 	= $match['ArbiterID'];
										
										$selectTeamA = "<select name = 'team'>";
										@$db->query("SET NAMES utf8");
										$query = "Select TeamID, TeamName From teams";
										$result = @$db->query($query);
										if ($result !== false)
										{
											while(($teams = $result->fetch_assoc()) !== null)
											{
												$TeamID 	= $teams['TeamID'];
												$TeamName 	= $teams['TeamName'];
												
												if($TeamID == $teamA)
													$selectTeamA .= "<option value = '$TeamID' selected>$TeamName</option>";
												else
													$selectTeamA .= "<option value = '$TeamID'>$TeamName</option>";
											}
										}
										$selectTeamA .= "</select>";
										
										$selectTeamB = "<select name = 'team'>";
										@$db->query("SET NAMES utf8");
										$query = "Select TeamID, TeamName From teams";
										$result = @$db->query($query);
										if ($result !== false)
										{
											while(($teams = $result->fetch_assoc()) !== null)
											{
												$TeamID 	= $teams['TeamID'];
												$TeamName 	= $teams['TeamName'];
												
												if($TeamID == $teamB)
													$selectTeamB .= "<option value = '$TeamID' selected>$TeamName</option>";
												else
													$selectTeamB .= "<option value = '$TeamID'>$TeamName</option>";
											}
										}
										$selectTeamB .= "</select>";
										
										@$db->query("SET NAMES utf8");
										$query = "Select ArbiterID, Concat(ArbiterForname, ' ', ArbiterSurname) As ArbiterName From arbiters";
										$result = @$db->query($query);
										if ($result !== false)
										{
											while(($arbiters = $result->fetch_assoc()) !== null)
											{	
												$selectArbiter .= "<option value = '".$arbiters['ArbiterID']."'>".$arbiters['ArbiterName']."</option>";
											}
										}
										$selectArbiter .= "</select>";
										
										@$db->query("SET NAMES utf8");
										$query = "Select PitchID, PitchName From pitches";
										$result = @$db->query($query);
										if ($result !== false)
										{
											while(($pitches = $result->fetch_assoc()) !== null)
											{
												$selectPitch .= "<option value = '".$pitches['PitchID']."'>".$pitches['PitchName']."</option>";
											}
										}
										$selectPitch .= "</select>";
										
										echo
										'<div class="round">
											<div class="round-head">
												<h2>Edytuj Mecz</h2>
											</div>
											<div class="round-content">
												<form action="index.php?admin=matches&action=updateSave&accept=yes" class="uniForm" method="post"> 
												<fieldset class="inlineLabels"> 
													<div class="ctrlHolder"> 
														<label>Drużyna A</label>',
														$selectTeamA,
													'</div>
													<div class="ctrlHolder"> 
														<label>Drużyna B</label>',
														$selectTeamB,
													'</div>
													<div class="ctrlHolder"> 
														<label>Data rozegrania</label> 
														<input type="text" id="matchdate" name="matchdate" class="textInput"/> 
													</div>
													<div class="ctrlHolder"> 
														<label>Sędzia</label>',
														$selectArbiter,
													'</div>
													<div class="ctrlHolder"> 
														<label>Boisko</label>',
														$selectPitch,
													'</div>
													<div class="ctrlHolder"> 
														<label>Wygrane sety przez drużynę A</label> 
														<input type="text" id="number" name="SetA" class="textInput"/> 
													</div>
													<div class="ctrlHolder"> 
														<label>Wygrane sety przez drużynę B</label> 
														<input type="text" id="height" name="SetB" class="textInput"/> 
													</div>
													<div class="ctrlHolder"> 
														<label>Punkty w secie 1. (drużyna A)</label> 
														<input type="text" id="wage" name="Set1A" class="textInput"/> 
													</div>
													<div class="ctrlHolder"> 
														<label>Punkty w secie 2. (drużyna A)</label> 
														<input type="text" id="wage" name="Set2A" class="textInput"/> 
													</div>
													<div class="ctrlHolder"> 
														<label>Punkty w secie 3. (drużyna A)</label> 
														<input type="text" id="wage" name="Set3A" class="textInput"/> 
													</div>
													<div class="ctrlHolder"> 
														<label>Punkty w secie 4. (drużyna A)</label> 
														<input type="text" id="wage" name="Set4A" class="textInput"/> 
													</div>
													<div class="ctrlHolder"> 
														<label>Punkty w secie 5. (drużyna A)</label> 
														<input type="text" id="wage" name="Set5A" class="textInput"/> 
													</div>
													<div class="ctrlHolder"> 
														<label>Punkty w secie 1. (drużyna B)</label> 
														<input type="text" id="wage" name="Set1B" class="textInput"/> 
													</div>
													<div class="ctrlHolder"> 
														<label>Punkty w secie 2. (drużyna B)</label> 
														<input type="text" id="wage" name="Set2B" class="textInput"/> 
													</div>
													<div class="ctrlHolder"> 
														<label>Punkty w secie 3. (drużyna B)</label> 
														<input type="text" id="wage" name="Set3B" class="textInput"/> 
													</div>
													<div class="ctrlHolder"> 
														<label>Punkty w secie 4. (drużyna B)</label> 
														<input type="text" id="wage" name="Set4B" class="textInput"/> 
													</div>
													<div class="ctrlHolder"> 
														<label>Punkty w secie 5. (drużyna B)</label> 
														<input type="text" id="wage" name="Set5B" class="textInput"/> 
													</div>
													<div class="buttonHolder"> 
														<a id="passwordForgot" href="index.php?admin=matches">anuluj</a>
														<button id="login" type="submit" class="primaryAction">Dodaj</button> 
														<button id="reset" type="reset" class="primaryAction">Zresetuj formularz</button>
													</div> 
												</fieldset> 
												</form>
											</div>
										</div>';
									}
								}
							}
						break;
						case 'del':
							if(isset($_GET['id']))
							{	
								$ID = $_GET['id'];
								
								@$db->query("SET NAMES utf8");
								$query = "Delete From matches Where MatchID = '$ID'";
								$result = @$db->query($query);
								if($result) {
									echo Show::ShowMessage('Pomyśnie usunięto informacje o meczu z bazy danych...', true);
								} else {
									echo Show::ShowMessage('blad.', false);
								}
							}
						break;
					}
				}
			}
		}
		catch(Exception $Error)	
		{
			echo Show::ShowMessage('Wystapil powazny błąd....', false);
		}
	}
	
	// Edycja sędziów
	public static function Arbiters($action)
	{
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
				if(empty($action))
				{
					@$db->query("SET NAMES utf8");
					$query = "Select ArbiterID, CONCAT(ArbiterForname, ' ', ArbiterSurname) As ArbiterName, ArbiterBornDate, ArbiterPESELNumber From arbiters";
					$result = @$db->query($query);
					$all = $result->num_rows;
					if($all == 0)
					{
						echo
						'<div class="round">
							<div class="round-head">
								<h2>Sędziowie</h2>
							</div>
							<div class="round-content">
							<center>
								<table width="100%" id="rounded-corner">
								<thead>
									<tr>
										<th align="center">Pusto tu :C</td>
									</tr>
								</thead>
								<tfoot>
								</tfoot>
								<tbody>
									<tr>
										<td align="center"><a href = "index.php?admin=arbiters&action=add">Dodaj</a></td>
									</tr>
								</tbody>
								</table>
							</center>
							</div>
						</div>';
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
							'<div class="round">
								<div class="round-head">
									<h2>Sędziowie</h2>
								</div>
								<div class="round-content">
									<center>
									<table width="100%" id="rounded-corner">
										<thead>
											<tr>
												<th width="5%" class="rounded-company" scope="col">Lp.</th>
												<th width="25%" class="rounded" scope="col" align="center">Imię i nazwisko</th>
												<th width="30%" class="rounded" scope="col" align="center">Data urodzenia</th>
												<th width="30%" class="rounded" scope="col" align="center">PESEL</th>
												<th width="5%" class="rounded" scope="col" align="center">Edytuj</th>
												<th width="5%" class="rounded-q4" scope="col" align="center">Usuń</th>
											</tr>
										</thead>
										<tfoot>
										</tfoot>
										<tbody>';
							
										$counter = 1;
										while(($data = $result->fetch_assoc()) !== null)
										{
											echo
											'<tr>
												<td align="center">',$counter,'</td>
												<td align="center">',$data['ArbiterName'],'</td>
												<td align="center">',$data['ArbiterBornDate'],'</td>
												<td align="center">',$data['ArbiterPESELNumber'],'</td>
												<td align="center"><a href="index.php?admin=arbiters&action=update&id=',$data['ArbiterID'],'"><img src="images/user_edit.png" alt="Edytuj..." title="Edytuj..." border="0" /></a></td>
												<td align="center"><a href="index.php?admin=arbiters&action=del&id=',$data['ArbiterID'],'" class="ask"><img src="images/trash.png" alt="Usuń..." title="Usuń..." border="0" /></a></td>
											</tr>';
											++$counter;
										}
										
										echo
										'
											<tr>
												<td align="center" colspan = "6"><a href = "index.php?admin=arbiters&action=add">Dodaj</a></td>
											</tr>
										</tbody>
									</table>
								</div>
							</div>';
							
							$result->close();
							$db->close();
						}
					}
				}
				else
				{
					switch($action)
					{
						case 'add':
						
							echo
							'<div class="round">
								<div class="round-head">
									<h2>Dodaj sędziego</h2>
								</div>
								<div class="round-content">
									<form action="index.php?admin=arbiters&action=addSave&accept=yes" class="uniForm" method="post" enctype = "multipart/form-data"> 
									<fieldset class="inlineLabels"> 
										<div class="ctrlHolder"> 
											<label>Imię</label>
											<input type="text" id="matchdate" name="forname" class="textInput"/> 
										</div>
										<div class="ctrlHolder"> 
											<label>Nazwisko</label>
											<input type="text" id="matchdate" name="surname" class="textInput"/> 
										</div>
										<div class="ctrlHolder"> 
											<label>Data urodzenia</label> 
											<input type="text" id="matchdate" name="borndate" class="textInput"/> 
										</div>
										<div class="ctrlHolder"> 
											<label>PESEL</label> 
											<input type="text" id="matchdate" name="pesel" class="textInput"/> 
										</div>
										<div class="ctrlHolder"> 
											<label>Zdjęcie</label> 
											<input type="file" id="foto" name="foto" class="textInput"/> 
										</div>
										<div class="buttonHolder"> 
											<a id="passwordForgot" href="index.php?admin=arbiters">anuluj</a>
											<button id="login" type="submit" class="primaryAction">Dodaj</button> 
											<button id="reset" type="reset" class="primaryAction">Zresetuj formularz</button>
										</div> 
									</fieldset> 
									</form>
								</div>
							</div>';
						break;
						case 'addSave':
							if(isset($_POST['forname']) && isset($_SESSION['id']))
							{
								try
								{
									$date 		= $_POST['borndate'];
									$forname 	= $_POST['forname'];
									$surname 	= $_POST['surname'];
									$foto 		= "";
									$pesel     	= $_POST['pesel'];
								
									if(empty($forname) || empty($surname)) 
										throw new Value();
								
									if(isset($_FILES["foto"]))
									{
										if ($_FILES["foto"]["error"] == 0)
										{
											$_FILES["foto"]["name"] = "$pesel.jpg";
											if(move_uploaded_file($_FILES["foto"]["tmp_name"], "../arbiters/"))
												$foto = $_FILES["foto"]["name"];
										}
									}
								
									@$db->query("SET NAMES utf8");
									$query = "INSERT INTO arbiters SET ArbiterForname = '$forname', ArbiterSurname = '$surname', ";
									$query .= "ArbiterFoto = '$foto', ArbiterPESELNumber = '$pesel', ArbiterBornDate = '$date'";
									$result = @$db->query($query);
									if($result) {
										echo Show::ShowMessage('Pomyśnie dodano sędziego do bazy danych...', true);
									} else {
										echo Show::ShowMessage('blad.', false);
									}
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
						break;
						case 'updateSave':
							if(isset($_POST['forname']) && isset($_GET['id']))
							{
								$id = $_GET['id'];
							
								$date 		= $_POST['borndate'];
								$forname 	= $_POST['forname'];
								$surname 	= $_POST['surname'];
								$foto 		= "";
								$pesel     	= $_POST['pesel'];
								
								@$db->query("SET NAMES utf8");
								$query = "Update arbiters SET ArbiterForname = '$forname', ArbiterSurname = '$surname', ";
								$query .= "ArbiterFoto = '$foto', ArbiterPESELNumber = '$pesel', ArbiterBornDate = '$date' Where ArbiterID = '$id'";
								$result = @$db->query($query);
								if($result) {
									echo Show::ShowMessage('Pomyśnie zmodyfikowno dane sędziego w bazie danych...', true);
								} else {
									echo Show::ShowMessage('blad.', false);
								}
							}
						break;
						case 'update':
							if(isset($_GET['id']))
							{
								$ID = $_GET['id'];
					
								@$db->query("SET NAMES utf8");
								$query = "Select * From arbiters Where ArbiterID = '$ID'";
								$result = @$db->query($query);
								if ($result !== false)
								{
									if(($data = $result->fetch_assoc()) !== null)
									{										
										$id = $_GET['id'];
							
										$date 		= $data['ArbiterBornDate'];
										$forname 	= $data['ArbiterForname'];
										$surname 	= $data['ArbiterSurname'];
										$foto 		= $data['ArbiterFoto'];
										$pesel     	= $data['ArbiterPESELNumber'];
										
										echo
										'<div class="round">
											<div class="round-head">
												<h2>Edytuj dane sędziego</h2>
											</div>
											<div class="round-content">
												<form action="index.php?admin=arbiters&action=updateSave&accept=yes&id=',$ID,'" class="uniForm" method="post" enctype = "multipart/form-data"> 
												<fieldset class="inlineLabels"> 
													<div class="ctrlHolder"> 
														<label>Imię</label>
														<input type="text" id="matchdate" name="forname" value = "'.$forname.'" class="textInput"/> 
													</div>
													<div class="ctrlHolder"> 
														<label>Nazwisko</label>
														<input type="text" id="matchdate" name="surname" value = "'.$surname.'" class="textInput"/> 
													</div>
													<div class="ctrlHolder"> 
														<label>Data urodzenia</label> 
														<input type="text" id="matchdate" name="borndate" value = "'.$date.'" class="textInput"/> 
													</div>
													<div class="ctrlHolder"> 
														<label>PESEL</label> 
														<input type="text" id="matchdate" name="pesel" value = "'.$pesel.'" class="textInput"/> 
													</div>
													<div class="ctrlHolder"> 
														<label>Zdjęcie</label> 
														<input type="file" id="foto" name="foto" class="textInput"/> 
													</div>
													<div class="ctrlHolder"> 
														<img src = "../arbiters/'.$pesel.'.jpg" width = "100" height = "75"/>
													</div>
													<div class="buttonHolder"> 
														<a id="passwordForgot" href="index.php?admin=arbiters">anuluj</a>
														<button id="login" type="submit" class="primaryAction">Edytuj</button> 
														<button id="reset" type="reset" class="primaryAction">Zresetuj formularz</button>
													</div> 
												</fieldset> 
												</form>
											</div>
										</div>';
									}
								}
							}
						break;
						case 'del':
							if(isset($_GET['id']))
							{	
								$ID = $_GET['id'];
								
								@$db->query("SET NAMES utf8");
								$query = "Delete From arbiters Where ArbiterID = '$ID'";
								$result = @$db->query($query);
								if($result) {
									echo Show::ShowMessage('Pomyśnie usunięto informacje sędzinie z bazy danych...', true);
								} else {
									echo Show::ShowMessage('blad.', false);
								}
							}
						break;
					}
				}
			}
		}
		catch(Exception $Error)	
		{
			echo Show::ShowMessage('Wystapil powazny błąd....', false);
		}
	}
}
?>
