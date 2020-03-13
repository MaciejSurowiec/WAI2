<?php

require_once "../business.php";


function index(&$model)
{
return 'index';
}

function Historia(&$model)
{
	return 'Historia';
}

function Profile(&$model)
{

	 if(isset($_POST['usun']) && $_SERVER['REQUEST_METHOD']=="POST" && isset($_SESSION['zap']) && isset($_POST['usuwanie']))
	 {
	
		foreach($_SESSION['zap'] as $zap)
		{
		
				for($j=0;$j<sizeof($_POST['usuwanie']);$j++)
				{
					if($_POST['usuwanie'][$j]==$zap)
					{
						unset($_SESSION['zap'][$zap]);
					}
				}	
		}

		unset($zap);

	 }

	return 'Profile';
}

function Galeria(&$model)
{
	$db=get_db();
	$size=$db->image->count();

	if(!isset($_SESSION['click']))
	{
		$_SESSION['click']=1;
	}
	else
	{
		if($_SERVER['REQUEST_METHOD']=="GET" && isset($_GET['page']))
		{
			$_SESSION['click']=$_GET['page'];
		}
	}

	if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST["zapamietaj"]))
	{
		
		foreach($_POST['tab'] as $el)
		{
			$_SESSION['zap'][$el]=$el;
		}
	}

	$images=get_images($db);
	$model['images']= $images;
	$model['size']=$size;
	return 'Galeria';
}

function Wyloguj(&$model)
{
	if(isset($_POST['send']) && isset($_SESSION['login']) && $_SERVER['REQUEST_METHOD']=="POST")
	{
		session_destroy();
		return 'redirect:/';
	}

	return $_GET['action'];
}

function Zaloguj(&$model)
{
			$db=get_db();
				if(isset($_POST['send']) && $_SERVER['REQUEST_METHOD']=="POST")
					{
						$_SESSION['temp']=$_POST['login'];
						
						$temp=['login'=>$_POST['login']];
						$spr=$db->users->findOne($temp);
						if($spr!=NULL)
						{
							if(password_verify($_POST['password'],$spr['password']))
							{
								unset($_SESSION['temp']);
								$_SESSION['login']=$_POST['login'];
								return 'redirect:/';
							}
							else
							{						
								$_SESSION['error']="Błędne hasło";
								return 'Zaloguj';
							}
						}
						else 
						{
							$_SESSION['error']="Błędna nazwa użytkownika";
							return "Zaloguj";
						}
					}

	return 'Zaloguj';
}

function Style(&$model)
{
	return 'Style';
}

function Rejestracja(&$model)
{
	if(isset($_POST['send']) && $_SERVER['REQUEST_METHOD']=="POST")
	{
		if(!empty($_POST['log']) && !empty($_POST['pass']) && !empty($_POST['repass']) && !empty($_POST['mail']))
		{	
			if($_POST['pass']==$_POST['repass'])
			{
				$db=get_db();
				$temp=['login'=>$_POST['log']];
				if($db->users->findOne($temp)==NULL)
				{
					if(strlen($_POST['pass'])>=8)
					{
						$user=['login'=>$_POST['log'],'password'=>password_hash($_POST['pass'], PASSWORD_DEFAULT)];
						$db->users->insertOne($user);
						$_SESSION['login']=$_POST['log'];
						return "redirect:/";
					}
					else
					{
						$_SESSION['errorr']="Hasło powinno skladać się z conajmniej 8 znaków";
					}
				}
				else
				{
					$_SESSION['errorr']="istnieje już użytkownik o podanej nazwie";
					unset($_POST['login']);
				}
			}
			else 
			{
				$_SESSION['errorr']="hasla sa inne";
			}
		}
		else
		{
			$_SESSION['errorr']="uzupelnij dane";
		}
	}
					

	return 'Rejestracja';
}

function Wysylanie(&$model)
{
	$h=0;
	$db=get_db();
	 if(isset($_POST['send']) && $_SERVER['REQUEST_METHOD']=="POST")
	 {
		if(isset($_POST['tytul']))
		{
			if(strlen($_POST['tytul'])>=3)
			{
				if(strlen($_POST['tytul']<=20))
				{
					$_SESSION['tytul']=$_POST['tytul'];
					if(isset($_SESSION['errort']))unset($_SESSION['errort']);
					$h+=1;
				}
				else
				{
					$_SESSION['errort']="tytul powienien miec mniej niz lub rowno 20 znakow";
					return "Wysylanie";
				}
			}
			else
			{
				$_SESSION['errort']="tytul powinien miec co najmniej 3 znaki";
				return "Wysylanie";
			}
		}
		else
		{
			$_SESSION['errort']="Nie podano tytulu";
			return "Wysylanie";
		}

		if(isset($_POST['nick']) || isset($_SESSION['login']))
		{
			if(isset($_SESSION['login']))
			{
				$_SESSION['pryw']=$_POST['pryw'];
				$_SESSION['nick']=$_SESSION['login'];
				if(isset($_SESSION['errorn']))unset($_SESSION['errorn']);
				$h+=1;
			}
			else
			{
				$q=['login'=>$_POST['nick']];
				if(strlen($_POST['nick'])>=3 && ($db->users->findone($q))==NULL)
				{
					if(strlen($_POST['nick'])<=12)
					{
						$_SESSION['nick']=$_POST['nick'];
						$_SESSION['pryw']=1;
						if(isset($_SESSION['errorn']))unset($_SESSION['errorn']);

						$h+=1;
					}
					else
					{
						$_SESSION['errorn']="nick powinien byc ktotszy niz 13 znakow";
						return "Wysylanie";
					}
				}
				else
				{
					if(strlen($_POST['nick'])<3) $_SESSION['errorn']="podany nick jest za krotki";
					else $_SESSION['errorn']="istnieje juz uzytkownk o tym nicku";

					return "Wysylanie";
				}
			}

		}
		else
		{
			$_SESSION['errorn']="Nie podano autora";
		}
		
		if(isset($_POST['znak']))
		{
			if(strlen($_POST['znak'])<3)
			{
			
				$_SESSION['errorz']="znak wodny jest za krotki";
				return "Wysylanie";
			}
			else{
				if(strlen($_POST['znak'])<30)
				{
					$_SESSION['znak']=$_POST['znak'];
					if(isset($_SESSION['errorz']))unset($_SESSION['errorz']);
					$h+=1;
				}
				else
				{
					$_SESSION['errorz']="znak wodny jest za dlugi";
					return "Wysylanie";
				}
			}
		}
		else
		{
			$_SESSION['errorz']="nie podano znaku wodnego";
			return "Wysylanie";
		}

		if(!empty($_FILES['fileU']['tmp_name']))
		{
			$target_dir = "static/img/Uploaded/";
			$name=basename($_FILES["fileU"]["name"]);
			$target_file = $target_dir."original/".$name; //zamiast base name dac id z bazy
			$uploadOk = 1;
			$imageFileType = finfo_file(finfo_open(FILEINFO_MIME_TYPE),$_FILES['fileU']['tmp_name']);
		
			if ($_FILES["fileU"]["size"] > 1000000)
			{
				$_SESSION['errorf']="plik przekroczyl 1mb";
				$uploadOk = 0;
			}

			if($imageFileType != "image/jpg" && $imageFileType != "image/png" && $imageFileType != "image/jpeg") 
			{
				$_SESSION['errorf']="zły format Pliku";
				$uploadOk = 0;
			}

			if($uploadOk==0) return "Wysylanie";
			else $h+=1;
		}
		else
		{
			$_SESSION['errorf']="nie podano pilku";
			$h=0;
			return "Wysylanie";
		}

		if($h==4)
		{
		$target_file = $target_dir."original/".$name;
		if (!move_uploaded_file($_FILES["fileU"]["tmp_name"], $target_file)) 
				{
					$_SESSION['errorf']='Wystąpił problem z wysłaniem pliku';
					return "Wysylanie";
				}

			$user= (isset($_SESSION['login'])) ? 1:0;
			$image=['nick'=>$_SESSION['nick'],'title'=>$_SESSION['tytul'],'show'=>$_SESSION['pryw'],'path'=>$target_dir,'user'=>$user];
			$insert=$db->image->insertone($image);
			$dd=$insert->getInsertedId();
			$ima=['_id'=>$dd];
			$img=$db->image->findOne($ima);
			$name=$img['_id'].".jpg";
			

				

			$miniatura= imagecreatefromjpeg($target_file);
			$miniatura=imagescale($miniatura,200,125);
			imagejpeg($miniatura,$target_dir."small/".$name);
			imagedestroy($miniatura);
			
			$watermark=imagecreatefromjpeg($target_file);
			
			$x=imagesx($watermark);
			$y=imagesy($watermark);
			$marge_right = 10;
			$marge_bottom = 10;
			$color=imagecreatetruecolor(300,50);
			imagefilledrectangle($color, 0, 0, imagesx($color), imagesy($color), 0xFFFFFF);
			imagestring($color, 7, 20, 20, $_SESSION['znak'], 0x706056);
			$color=imagescale($color,$x*(0.5),$y*(0.3));
			//imagestring($color,12,10,10,$_SESSION['znak']);
			
			imagecopymerge($watermark, $color, imagesx($watermark) - imagesx($color) - $marge_right, imagesy($watermark) - imagesy($color) - $marge_bottom, 0, 0, imagesx($color), imagesy($color), 35);
			imagejpeg($watermark,$target_dir."watermark/".$name);
			imagedestroy($watermark);

			unset($_SESSION['znak']);
			unset($_SESSION['nick']);
			unset($_SESSION['tytul']);

			return "redirect:Galeria";
		}
	 }
	 else
	 {
	 	return "Wysylanie";
	 }



	return 'Wysylanie';
}

