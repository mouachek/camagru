<HTML>
	<HEAD>
		<TITLE>Camagru</TITLE>
		<meta charset="utf-8">
		<link rel="stylesheet" href="./assets/form_style.css" media="screen" type="text/css" />
	</HEAD>
	<BODY style="background-color:#fafafa;">
	<?php require_once('./partial/menu.php');?>

	<div align="center">
		<img style="float:center;top:15%;width:480px;height:160px;" src="./assets/img/inscription_page.png">
		<p>
		<?php
        if (isset($messages)) {
            if (isset($messages["incomplete_form"])) {
                echo $messages["incomplete_form"];
            }
            if (isset($messages["password_not_matching"])) {
                echo $messages["password_not_matching"];
            }
            if (isset($messages["password_not_secure"])) {
                echo $messages["password_not_secure"];
            }
            if (isset($messages["email_not_valid"])) {
                echo $messages["email_not_valid"];
            }
            if (isset($messages["username_not_valid"])) {
                echo $messages["username_not_valid"];
            }
            if (isset($messages["email_exist"])) {
                echo $messages["email_exist"];
            }
            if (isset($messages["username_exist"])) {
                echo $messages["username_exist"];
            }
            if (isset($messages["ok"])) {
                echo $messages["ok"];
            }
        }
        ?>
	</p>

		<form method="POST" action="./index.php?page=create">
				<table>
					<tr>
						<td>
							<label>Username :</label>
						</td>
						<td align="right">
							<input type="text" name="username" placeholder="Your username" />
						</td>
					</tr>
					<tr>
						<td>
							<label>E-mail :</label>
						</td>
						<td align="right">
							<input type="email" name="email" placeholder="Your E-mail" />
						</td>
					</tr>
					<tr>
						<td>
							<label>Password :</label>
						</td>
						<td align="right">
							<input type="password" name="password" placeholder="Your password" />
						</td>
					</tr>
					<tr>
						<td>
							<label>Confirm:</label>
						</td>
						<td align="right">
							<input type="password" name="password_confirmation" placeholder="Password confirmation" />
						</td>
					</tr>
				</table>
		<br />
		<input type="submit" name="submit" value="Sign up" />
		</form>
		<br />
		<br />
		<NAV class="footer">
			<img src="./assets/img/foot.png"/>
			</NAV>
		</div>
</BODY>
</HTML>
