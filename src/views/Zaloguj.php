<?php 
if(isset($_SESSION['login']))header("Location:index.php");

?>

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
           
           <div class="text center">
		   <form   method="post">
				<p>Login: <input class="right in" name="login" type="text" value="<?php if(isset($_SESSION['temp']))echo $_SESSION['temp'];?>"></p>
				<p>Hasło:  <input class="right in" name="password" type="password"></p>
				<div class="center"><input class="sto" type="submit" name="send"  value="Wyslij"></div>
				<p class="smaller center stoo" > Nie masz konta? <a href="Rejestracja.php" class="small">zarejestruj się!</a></p>
				<?php if(isset($_SESSION['error'])):?>
					<p class='small red'><?= $_SESSION['error']?></p>
				<?php endif ?>
				<?php deletesession('error');?>
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