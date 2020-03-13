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
		<form  method="post" enctype="multipart/form-data">
           <div class="text wys">
		   
				<p>Tytuł zdjęcia  <input class="right in" name="tytul" type="text" value="<?php if(isset($_SESSION['tytul']))echo $_SESSION['tytul'];?>" required></p>
				<?php if(isset($_SESSION['errort'])):?> <p class='small red'><?=$_SESSION['errort']?></p><?php endif ?>

				<p>Nick  <input class="right in" name="nick" type="text" value="<?php if(isset($_SESSION['login'])){echo $_SESSION['login'];}elseif(isset($_SESSION['nick']))echo $_SESSION['nick'];?>" <?php if(isset($_SESSION['login'])) echo "disabled";?>></p>
				<?php if(isset($_SESSION['errorn'])):?> <p class='small red'><?=$_SESSION['errorn']?></p><?php endif ?>

				<p>Znak wodny  <input class="right in" name="znak" type="text" value="<?php if(isset($_SESSION['znak']))echo $_SESSION['znak'];?>" required></p>
				<?php if(isset($_SESSION['errorz'])):?> <p class='small red'><?=$_SESSION['errorz']?></p><?php endif ?>

				<?php if(isset($_SESSION['login'])): ?>
					<p class='small'><input type='radio' name='pryw' value='0' required>Prywatne</p>
					<p class='small'><input type='radio' name='pryw' value='1' required>Publiczne</p>
				<?php endif ?>

				<input type="file" name="fileU" required>
				<?php if(isset($_SESSION['errorf'])):?>
					<p class='small red'><?=$_SESSION['errorf']?></p>
				<?php endif ?>
				<div class="center"><input class="sto" type="submit" name="send" value="Wyslij"></div>
				<?php
					deletesession('errort');
					deletesession('errorn');
					deletesession('errorz');
					deletesession('errorf');
				?>
		</div>
		</form>
    </div>
    <div id="dial"></div>

    <footer>
        Maciej Surowiec

        <div id="schowek"><p id="czas"></p></div>
    </footer>
   
</body>
</html>