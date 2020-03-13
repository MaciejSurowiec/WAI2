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

		   <form  method="post">
				 <p>Login: <input class="right in" type="text"  name="log" value="<?php if(isset($_POST['login']))echo $_POST['login'];?>" required></p>
				 <p>E-mail:<input class="right in" type="email" name="mail" vaue="<?php if(isset($_SESSION['mail'])) echo $_SESSION['mail']?>" required></p>
				 <p>Hasło: <input class="right in" type="password"  name="pass" required></p>
				 <p>Powtórz Hasło: <input class="right in" type="password"  name="repass" required></p>
				 <div class="centerr"><input  type="submit" value="Wyslij" name="send"></div>
			</form>
				<?php if(isset($_SESSION['errorr'])):?>
					<p  class='small red'><?=$_SESSION['errorr']?></p>
				<?php endif ?>
				<?php deletesession('errorr');?>
			</div>

       

    </div>
    <div id="dial"></div>

    <footer>
        Maciej Surowiec

        <div id="schowek"><p id="czas"></p></div>
    </footer>
   
</body>
</html>