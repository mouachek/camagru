<HTML>
	<HEAD>
		<HEAD>
			<TITLE>Camagru</TITLE>
			<meta charset="utf-8">
			<link rel="stylesheet" href="./assets/form_style.css" media="screen" type="text/css" />
		</HEAD>
	<BODY style="background-color:#fafafa;">
	<?php require_once('./partial/menu.php');?>

  <div align="center">
    <img style="float:center;top:15%;width:480px;height:160px;" src="./assets/img/change_password.png">
		<br />

		<p>
		<?php
        if (isset($messages)) {
            if (isset($messages["incomplete_form"])) {
                echo $messages["incomplete_form"];
            }
            if (isset($messages["invalid_token"])) {
                echo $messages["invalid_token"];
            }
            if (isset($messages["password_not_secure"])) {
                echo $messages["password_not_secure"];
            }
            if (isset($messages["password_not_matching"])) {
                echo $messages["password_not_matching"];
            }
            if (isset($messages["ok"])) {
                echo $messages["ok"];
            }
        }
        ?>
		</p>
			<BR />
			<FORM action="index.php?page=change_password&token=<?php if (isset($_GET["token"])) {
            echo $_GET["token"];
        } ?>" method="post">
				<BR />
        New password: &emsp; &emsp; <input type="password" name="new_password" id="password"/>
				<BR />
         password confirmation: <input type="password" name="new_password_confirmation"/>
				<BR /> <BR />
				<input type="submit" name="submit" value="OK"/>
			</FORM>
			<NAV class="footer">
				<img src="./assets/img/foot.png"/>
				</NAV>
			</div>
	</BODY>
</HTML>
