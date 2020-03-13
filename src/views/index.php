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
			<?php
			if(isset($_SESSION['login']))
			{
				echo"<h2> Witaj ".$_SESSION['login']."</h2>";
			}

			?>

            <p class="text">
                Na tej stronie znajdują się informacje dotyczące piwa: style piwne i określenia używane przy opisywaniu ich, oraz zdjęcia przesłane przez użytkowników serwisu.
				<a href="Wysylanie">formularz wysyłania zdjęć</a></p>
				<br/>
				<h2>Najnowsze zdjęcia przesłane przez użytkownikow</h2>


				<div class="text"><p>Więcej zdjęć w <a href="Galeria">galeri</a>. </p></div>
				</br>
				</br>
				</br>

        </div>
    </div>
    
        <div id="dial"></div>

    <footer>
        Maciej Surowiec

        <div id="schowek"><p id="czas"></p></div>
    </footer>

</body>
</html>