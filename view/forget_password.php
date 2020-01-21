<HTML>
	<HEAD>
		<TITLE>Camagru</TITLE>
		<meta charset="utf-8">
		<link rel="stylesheet" href="./assets/form_style.css" media="screen" type="text/css" />
	</HEAD>
	<BODY style="background-color:#fafafa;">
		<?php require_once('./partial/menu.php');?>

		<div align="center">
	    <img style="float:center;top:15%;width:480px;height:160px;" src="./assets/img/reset_password.png">
			<br />

			<p>
			<?php
            if (isset($messages)) {
                if (isset($messages["incomplete_form"])) {
                    echo $messages["incomplete_form"];
                }
                if (isset($messages["ok"])) {
                    echo $messages["ok"];
                }
            }
            ?>
			</p>

		<form method="POST" action="./index.php?page=forget_password">
		<table>
			<tr>
				<td>
					<label>Your account email adress :</label>
				</td>
				<td align="right">
					<input type="email" name="email" placeholder="Your email"/>
				</td>
			</tr>
		</table>
		<br />
		<input type="submit" name="submit" value="Send" />
		</form>
		<br /> <br />
		<NAV class="footer">
			<img src="./assets/img/foot.png"/>
			</NAV>
		</div>
</BODY>
</HTML>
