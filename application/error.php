<!DOCTYPE HTML>
<html lang="en-US">
<head>
	<meta charset="UTF-8">
	<title>Error - Beanstalk Commits</title>
	<link rel="shortcut icon" href="favicon.ico" />
	<?php 
		$html = Html::getInstance();
		echo $html->css(); 
	?>
</head>
<body>
	<section class="container">
		<div class="error-message animated fadeInDown">
			<h2>Oh noes! Problemo!</h2>
			<p><?=$error_message?></p>
		</div>
	</section>
</body>
</html>