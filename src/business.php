<?php 
require '../../vendor/autoload.php';

function get_db()
{
	$mongo = new MongoDB\Client("mongodb://localhost:27017/wai",[
	'username' => 'wai_web',
	'password' => 'w@i_w3b']);
	$db=$mongo->wai;
	return $db;
}

/*function check()
{
	if(isset($_SESSION['login']) && empty($_SESSION['login']))
	{
		unset($_SESSION['login']);
	}
}*/

function spr($s)
{
	if(isset($_SESSION['zap']))
	{
		foreach($_SESSION['zap'] as $t)
		{
			if($t==$s) return true;
		}
	}
	return false;
}

function get_info($arr)
{
if(!empty($arr))
{
	$db=get_db();
	$i=0;
	foreach($arr as $dd)
	{
			$new=['_id'=>new MongoDB\BSON\ObjectID($dd)];
			$img=$db->image->findOne($new);
		
			$name=$img["_id"].".jpg";
		
			$path=$img['path']."small/".$name;
			$water=$img['path']."watermark/".$name;

			$imgg[$i]['water']=$water;
			$imgg[$i]['path']=$path;
			$imgg[$i]['_id']=$dd;
			$imgg[$i]['author']=$img['nick'];
			$imgg[$i]['title']=$img['title'];
			$i++;
	}

	return $imgg;
}
else return null;
}

function deletesession($string)
{
	if(isset($_SESSION[$string]))
	{
		unset($_SESSION[$string]);
	}
}
function get_nav()
{
	include 'views/partial/navbar.php';
}



function get_images($db)
{
	$i=0;
	$opt=['sort'=>['_id'=>-1]];
	$im=$db->image->find([],$opt);
	$imgag=[];
		  foreach($im as $img)
		  {
			  if(isset($img['path']))
			  {
				   $name=$img["_id"].".jpg";
				   $path=$img['path']."small/".$name;

				  if(file_exists($path))
				  {
					if($_SESSION['click']*10>$i && ($_SESSION['click']-1)*10<= $i )
					{
					  $author=$img['nick'];
					  $title=$img['title'];
					  $water=$img['path']."watermark/".$name;

						  if($img['show']=="1" )
						  {
							$imgag[$i]=['water'=>$water,'author'=>$author,'title'=>$title,'path'=>$path,'_id'=>$img['_id']];
						  }
						  else
						  {
		  					if(isset($_SESSION["login"]) )
							{
								if($_SESSION['login']==$img['nick'])
								{
									$imgag[$i]=['water'=>$water,'author'=>$author,'title'=>$title,'path'=>$path,'_id'=>$img['_id'],'pryw'=>'prywatne'];
								}
								else
								{
									$i--;
								}
							}
							else
							{
								$i--;
							}
						  }
					   }

					  $i++;
				  }
				  else
				  {
			  		  $db->image->deleteOne($img);
				  }
			  }
		  }

		  return $imgag;
}

