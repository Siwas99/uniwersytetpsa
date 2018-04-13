<?php
	// Message Vars
	$msg = '';
	$msgClass = '';

	// Check For Submit
	if(filter_has_var(INPUT_POST, 'submit')){
		// Get Form Data
		$name = htmlspecialchars($_POST['name']);
		$email = htmlspecialchars($_POST['email']);
		$number = htmlspecialchars($_POST['number']);
		$message = htmlspecialchars($_POST['message']);

		// Check Required Fields
		if(!empty($email) && !empty($name) && !empty($number) && !empty($message)){
			// Passed
			// Check Email
			if(filter_var($email, FILTER_VALIDATE_EMAIL) === false){
				// Failed
				$msg = 'Proszę wprwadzić poprawny adres email';
				$msgClass = 'danger';
			} else {
                if(filter_var(strlen($number)!=9 && !is_int($number))){
				// Failed
				$msg = 'Proszę wprwadzić poprawny numer telefonu';
				$msgClass = 'danger';
			 } else {
                    // Passed
                    $toEmail = 'uniwersytetpsa@gmail.com';
                    $subject = 'Wiadomość od '.$name;
                    $body = '<h2>Prośba o kontakt</h2>
                        <h4>Imię</h4><p>'.$name.'</p>
                        <h4>Email</h4><p>'.$email.'</p>
                        <h4>Numer</h4><p>'.$number.'</p>
                        <h4>Wiadmość</h4><p>'.$message.'</p>
                    ';

                    // Email Headers
                    $headers = "MIME-Version: 1.0" ."\r\n";
                    $headers .="Content-Type:text/html;charset=UTF-8" . "\r\n";

                    // Additional Headers
                    $headers .= "Od: " .$name. "<".$email.">". "\r\n";

                    if(mail($toEmail, $subject, $body, $headers)){
                        // Email Sent
                        $msg = 'Twój email został wysłany';
                        $msgClass = 'success';
                    } else {
                        // Failed
                        $msg = 'Twój email nie został wysłany';
                        $msgClass = 'danger';
                    }
				}
			}
		} else {
			// Failed
			$msg = 'Proszę wypełnić wszystkie pola';
			$msgClass = 'danger';
		}
	}
?>

    <!DOCTYPE HTML>
    <html lang="pl">

    <head>
        <meta charset="utf-8">
        <title>Uniwersytet Twojego Psa </title>
        <meta name="keywords" content="szkolenie psów,tresura psów, szkolenie psów Śląsk, tresura psów Śląsk, szkoła dla psów, psie przedszkole, psie przedszkole Śląsk, szkolenie metodą pozytywną, kynoterapia Śląsk, testy predyspozycji szczeniąt, wyszkolenie psa, porady behawioralne dla psów, indywidualne szkolenie psów, ułożenie psa Śląsk, dogoterapia Śląsk, profesjonalne szkolenie psów, pies rodzinny, pies terapeutyczny, jak wyszkolić psa, kurs podstawowy dla psa, szkolenie psów dorosłych, szkolenie szczeniąt, socjalizacja szczeniąt, specjalistyczne szkolenie psów, szkolenie psów terapeutycznych">
        <meta name="descripson" content="W twoim domu pojawił się wymarzony szczeniak? Czy twój pies ciągnie na smyczy? Masz psa lękliwego lub agresywnego? Jeżeli tak to doskonale trafiłeś! Uniwersytet Twojego Psa pomoże Ci dogadać się ze swoim czworonogiem i nawiązać z nim specjalną więź. Nauczysz się tu komunikować ze swoim psem i nie tylko!">
        <meta name="author" content="Dawid Wożncia">
        <link rel="stylesheet" href="style.css" type="text/css">
        <link rel="shortcut icon" type="image/png" href="favicon.ico">
        <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
        <script src="jquery-3.3.1.min.js"></script>
        <script src="script.js"></script>
        <link href="https://fonts.googleapis.com/css?family=Nunito+Sans" rel="stylesheet">

    </head>

    <body>

        <main>
            <header>
                <div class="part1">
                </div>
                <div class="part2">
                    <div class="logoTxt">
                        <span style="font-family:Myriad; letter-spacing: 2px;">Uniwersytet</span>Twojego Psa
                    </div>

                    <nav>
                        <div class="buttonHolder">
                            <p> <span style="font-family:Myriad; letter-spacing: 2px;">Uniwersytet</span>Twojego Psa</p>
                            <button id="hamburger" class="hamburgerOpen">
                            <span></span>
                            <span></span>
                            <span></span>
                        </button>
                        </div>

                        <div id="navList">
                            <p> <span style="font-family:Myriad; letter-spacing: 2px;">Uniwersytet</span>Twojego Psa</p>
                            <a href="index.html" class="menuButton buttonHover">Start</a>
                            <a href="training.html" class="menuButton buttonHover">Szkolenia</a>
                            <a href="gallery.html" class="menuButton buttonHover">Galeria</a>
                            <a href="about.html" class="menuButton buttonHover">O nas</a>
                            <a href="contact.php" class="menuButton buttonHover">Kontakt</a>
                        </div>
                    </nav>
                </div>
            </header>
            <div class="content">
                <h1>Kontakt</h1>
                
                <form method="post" action="<?php echo $_SERVER['PHP_SELF']; ?>">
                    <div class="smallForm">
                        <div class="form-group">
                            <label>Imię</label>
                            <input type="text" name="name" class="form-control" value="<?php echo isset($_POST['name']) ? $name : ''; ?>">
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input type="text" name="email" class="form-control" value="<?php echo isset($_POST['email']) ? $email : ''; ?>">
                        </div>
                        <div class="form-group">
                            <label>Numer telefonu:</label>
                            <input type="text" name="number" class="form-control" value="<?php echo isset($_POST['number']) ? $number : ''; ?>">
                        </div>
                    </div>
                    <div class="bigForm">
                        <div class="form-group">
                            <label>Wiadomość</label>
                            <textarea name="message" class="form-control"><?php echo isset($_POST['message']) ? $message : ''; ?></textarea>
                        </div>
                           <button type="submit" name="submit" class="btn btn-primary">Wyślij!</button>
                        <?php if($msg != ''): ?>
                        <div class="alert <?php echo $msgClass; ?>">
                            <?php echo $msg; ?>
                            <script>
                                $('.alert').animate({
                                    opacity: 0
                                }, 5000);
                            </script>
                        </div>
                        <?php endif; ?>    
                </div>
                </form>
                
                <div class="address">
                    Świderska Magdalena<br>
                    Uniwersytet Twojego Psa<br>
                    tel. 609 522 727<br>
                    uniwersytetpsa@gmail.com<br>
                </div>
            </div>


            <footer>
                <div class="social">
                    <a href="https://www.facebook.com/Uniwersytet-Twojego-Psa-142492129726727/" target="_blank"><i  class="socialIcon fab fa-facebook-square fa-4x"></i></a>
                    <a href="contact.php"><i class="socialIcon fas fa-envelope fa-4x"></i></a>
                    <a href="https://www.youtube.com" target="_blank"><i class="socialIcon fab fa-youtube fa-4x"></i></a>
                    <a href="https://www.instagram.com/matka_wariatka_i_dwa_psy/?hl=pl" target="_blank"><i class="socialIcon fab fa-instagram fa-4x"></i></a>
                </div>
                <div class="copy">
                    &copy; Uniwersytet Twojego Psa 2018
                </div>
            </footer>

        </main>

    </body>

    </html>
