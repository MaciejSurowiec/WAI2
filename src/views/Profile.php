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
		<h2>Zaznaczone przez ciebie zdjęcia</h2>
			<div class="text">
			<form action="Profile" method="POST">
			<div class="bot">
			<div>
				<?php if(isset($_SESSION['zap'])):
					$im=get_info($_SESSION['zap']);
					if(!empty($im)):
					?>
				
					<?php  foreach($im as $img):?>
						<div class="galeria"><a href="<?= $img['water']?>" target="_blank"><img src="<?=$img['path']?>"></a><div class="blue"><div class="czkbx"><p><input name="usuwanie[]" value='<?=$img["_id"]?>' class="right" type="checkbox"></p><p class="right smaller"><?=$img['author']?></p></div><p class="margn"><?=$img['title']?></p></div></div>
					<?php endforeach ?>
				<?php endif ?>
				<?php endif ?>
			</div>
			<div class="centerr"><input type="submit" name="usun" value="usun zaznaczone"></div>
			
			</div>
			</form>
			</div>
            
        </div>
    </div>
    
        <div id="dial"></div>

    <footer>
        Maciej Surowiec

        <div id="schowek"><p id="czas"></p></div>
    </footer>

</body>
</html>