<!doctype html>
<html>
<head>
    <meta charset="UTF-8" />
    <link rel=" stylesheet" type="text/css" href="static/css/main.css">
    <title>Style Piwa</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="static/css/jquery-ui.css" rel="stylesheet" type="text/css">
    <script src="static/js/jquery-3.4.1.min.js"></script>
    <script src="static/js/main.js"></script>
    <script src="static/js/jquery-ui.js"></script>
</head>
<body>
    <div id="wrapper">
        <header id="poczatek">
            <h1>Kraftpedia</h1>
        </header>
        <div id="tlo"><img class="zdj" src="static/img/tlo.jpg"></div>
		<nav id="navbar">
			<?php get_nav();?>
		</nav>
        <div id="content">
           <h2>Zdjęcia użytkowników</h2>

		   </br>
		  <div class="text"><div class='centerr'> <a href="Wysylanie">Wyślij swoje zdjęcie</a></div>
		 <form action="Galeria" method="GET"><table><tr>
		  <?php   if($_SESSION['click']>1):?>
			<th><input  type="submit" name="page" value="<?=($_SESSION['click']-1)?>"></th>
			<th class="but"><?= $_SESSION['click']?></th>
		  <?php else: ?>
			<th class="but"><?=$_SESSION['click']?></th>
		  <?php endif ?>
		  <?php if($size>($_SESSION['click']*10)):?>
			<th><input name="page" value="<?=($_SESSION['click']+1)?>" type="submit"></th>
		  <?php else: ?>
			<th class="but"><?=($_SESSION['click']+1)?></th>
		  <?php endif ?>
		 </tr></table></form>

		  <form action="Galeria" method="POST">
			  <div class="bot">
				  <div>
					  <?php if(!empty($images)):?>
						  <?php foreach($images as $img):?>
						  <div class="galeria"><?php if(isset($img['pryw'])):?><p class="smaller center"><?=$img['pryw'] ?></p><?php endif ?><a href="<?= $img['water']?>" target="_blank"><img src="<?=$img['path']?>"></a><div class="blue"><div class="czkbx"><?php if(isset($_SESSION['login'])){echo'<p><input name="tab[]" value='.$img["_id"].' class="right" type="checkbox"';} if(spr($img["_id"])){echo' checked>';}  echo'</p>';?><p class="right smaller"> <?=$img['author']?></p></div><p class="margn"><?=$img['title']?></p></div></div>
							<?php endforeach ?>
					  <?php endif ?>
				 </div>
				<?php if(isset($_SESSION['login'])):?><div class="centerr"><input type="submit" name="zapamietaj" value="zapamietaj zaznaczone"></div><?php endif ?>
			  </div>
		  </form>
		  </div>

    </div>
    <div id="dial"></div>

    <footer>
        Maciej Surowiec

        <div id="schowek"><p id="czas"></p></div>
    </footer>
   
</body>
</html>