<HTML>
	<HEAD>
		<TITLE>Camagru</TITLE>
	</HEAD>
	<BODY style="background-color:#fafafa;">
		<meta charset="utf-8">
		<?php require_once('./partial/menu.php');?>

		<div align="center">
	    <img style="float:center;top:15%;width:480px;height:160px;" src="./assets/img/confirmation_email.png">
			<br />

      <p>
      <?php
      if (isset($messages)) {
          if (isset($messages["ok"])) {
              echo $messages["ok"];
          }
          if (isset($messages["account_already_validated"])) {
              echo $messages["account_already_validated"];
          }
      }
      ?>
      </p>
			<NAV class="footer">
				<img src="./assets/img/foot.png"/>
				</NAV>
			</div>
</BODY>
</HTML>
