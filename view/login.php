<HTML>
	<HEAD>
		<TITLE>Camagru</TITLE>
		<meta charset="utf-8">
		<link rel="stylesheet" href="./assets/form_style.css" media="screen" type="text/css" />
	</HEAD>
	<BODY style="background-color:#fafafa;">
		<?php require_once('./partial/menu.php');?>

		<div align="center">
			<img style="float:center;top:15%;width:480px;height:160px;" src="./assets/img/login_page.png">
			<p>
			<?php
            if (isset($messages)) {
                if (isset($messages["incomplete_form"])) {
                    echo $messages["incomplete_form"];
                }
                if (isset($messages["wrong_login"])) {
                    echo $messages["wrong_login"];
                }
                if (isset($messages["account_not_validated"])) {
                    echo $messages["account_not_validated"];
                }
                if (isset($messages["password_not_secure"])) {
                    echo $messages["password_not_secure"];
                }
                if (isset($messages["username_not_valid"])) {
                    echo $messages["username_not_valid"];
                }
            }
            ?>
			</p>

		<form method="POST" action="./index.php?page=login">
		<table>
			<tr>
				<td>
					<label>Username :</label>
				</td>
				<td align="right">
					<input type="text" name="username" placeholder="Your username"/>
				</td>
			</tr>
			<tr>
				<td>
					<label>Password :</label>
				</td>
				<td align="right">
					<input type="password" name="password" placeholder="Your password"/>
				</td>
			</tr>
		</table>
		<br />
		<input type="submit" name="submit" value="Log in" />
		</form>
		<br />
		<a href="./index.php?page=forget_password"><img src="./assets/img/password.png"/></a>
		<br /> <br /> <br />
		<NAV class="footer">
			<img src="./assets/img/foot.png"/>
			</NAV>
		</div>
</BODY>
</HTML>
