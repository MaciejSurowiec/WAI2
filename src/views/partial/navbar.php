

		<div class="specjal">
		<div class="list">
		<ul id="menu">
                <li><a href="/">Strona Główna</a></li>
                <li><a href="Historia">Historia Piwa</a></li>
				<li><a href="Galeria">Galeria</a></li>
                <li><a href="Style">Style Piwa</a>
                    <ul id="rozwin">
                        <li><a href="Style#porter">Porter</a></li>
                        <li><a href="Style#pilzner">Pilzner</a></li>
                        <li><a href="Style#gose">Gose</a></li>
                        <li><a href="Style#lambic">Lambic</a></li>
                        <li><a href="Style#stout">Stout</a></li>
                        <li><a href="Style#witbier">Witbier</a></li>
                        <li><a href="Style#ipa">IPA</a></li>
                        <li><a href="Style#apa">APA</a></li>
                        <li><a href="Style#ris">RIS</a></li>
                    </ul>
                </li>
            </ul>
            </div>
				<div class="marg">
				<?php if(!isset($_SESSION['login'])):?>
				<p class="right small login"><a href="Zaloguj">Zaloguj</a></p>
				<p class="right smaller login"><a href="Rejestracja">Stwórz konto</a></p>
				<?php else: ?>
					<p class="right small login"><a href="Profile">Profil</a></p>
					<form action="Wyloguj" class="smaller" method="post"><input class="sub" name="send" type="submit" value="Wyloguj"></form>
				<?php endif ?>
				</div>
				</div>

		<script>

			window.onscroll = function () { myFunction() };
			var navbar = document.getElementById("navbar");


			var sticky = navbar.offsetTop;


			function myFunction() {
				if (window.pageYOffset >= sticky) {
					navbar.classList.add("sticky")
				} else {
					navbar.classList.remove("sticky");
				}
			}
		</script>

