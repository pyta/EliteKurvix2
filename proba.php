<script>
<!---
window.innerWidth = 20;
window.innerHeight = 20;
-->
</script>

<?php


if(isset($_POST['UserDictionary']))
{
	$login = $_POST['UserDictionary'];
	if(!empty($login))
	{
		if (mkdir("./users/$login", 0, true)) 
		{
			if(isset($_FILES["avatar"]))
			{
				if ($_FILES["avatar"]["error"] == 0)
				{
					$_FILES["avatar"]["name"] = 'avatar.jpg';
					if(move_uploaded_file($_FILES["avatar"]["tmp_name"], "./users/$login/".$_FILES["avatar"]["name"]))
						$avatar = $_FILES["avatar"]["name"];
				}
			}
		}
	}
}
?>

<script>
<!---
window.close();
-->
</script>