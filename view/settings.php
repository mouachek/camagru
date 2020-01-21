<HTML>
	<HEAD>
		<TITLE>Camagru</TITLE>
		<meta charset="utf-8">
		<link rel="stylesheet" href="./assets/form_style.css" media="screen" type="text/css" />
	</HEAD>
	<BODY style="background-color:#fafafa;">
	<?php require_once('./partial/menu.php');?>

  <div align="center">
    <img style="align:center;top:15%;width:480px;height:160px;" src="./assets/img/settings_page.png">
		<br /> <br />

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
            if (isset($messages["password_not_old"])) {
                echo $messages["password_not_old"];
            }
            if (isset($messages["ok_password"])) {
                echo $messages["ok_password"];
            }
            if (isset($messages["ok_email"])) {
                echo $messages["ok_email"];
            }
            if (isset($messages["same_email"])) {
                echo $messages["same_email"];
            }
            if (isset($messages["same_username"])) {
                echo $messages["same_username"];
            }
            if (isset($messages["ok_username"])) {
                echo $messages["ok_username"];
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
            if (isset($messages["email_not_valid"])) {
                echo $messages["email_not_valid"];
            }
            if (isset($messages["ok_email_comment"])) {
                echo $messages["ok_email_comment"];
            }
            if (isset($messages["wrong_email_comment"])) {
                echo $messages["wrong_email_comment"];
            }
        }
        ?>

      <form action="./index.php?page=settings" method="post">
          <H4 align="center">receive an email each time a user comments on one of your photos </H4>
          <input type="radio" name="state" value="1">
          <label for="yes">yes</label>
          <input type="radio" name="state" value="0">
          <label for="no">no</label>
          <input type="submit" name="submit_comment_email" value="OK"/>
      </form>
						<BR />
		</p>
			<H1 align="center">Change username</H1>
      <BR />
			<FORM action="./index.php?page=settings" method="post">
        New username: <input type="text" name="new_username" value=""/>
        <BR /> <BR /> <BR />
        <input type="submit" name="submit_username" value="OK"/>
      </FORM>

    <H1 align="center">Change password</H1>
			<BR />
			<FORM action="./index.php?page=settings" method="post">
				Old password:&emsp; &emsp; &ensp; <input type="password" name="current_password" id=password/>
				<BR />
        New password: &emsp; &emsp; <input type="password" name="new_password" id="password"/>
				<BR />
         password confirmation: <input type="password" name="new_password_confirmation"/>
				<BR /> <BR />
				<input type="submit" name="submit_password" value="OK"/>
			</FORM>

			<H1 align="center">Change e-mail</H1>
          <BR />
          <FORM action="./index.php?page=settings" method="post">
            New e-mail: <input type="email" name="new_email" value=""/>
            <BR /> <BR /> <BR />
            <input type="submit" name="submit_email" value="OK"/>
          </FORM>
					<NAV class="footer">
						<img src="./assets/img/foot.png"/>
						</NAV>
						<BR /><BR /><BR />
					</div>
	</BODY>
</HTML>
