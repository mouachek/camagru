<HTML>
<meta charset="utf-8" />
<link rel="stylesheet" HREF="./assets/index.css"/>
	<NAV>
		<UL>
			<LI class="home"> <A HREF="./index.php?page=index"><IMG style="width:37px;height:37px;" SRC="./assets/img/home.png"></A>
				<UL class="onglet">
				</UL>
			</LI>
			</UL>
		<?php
        if (isset($_SESSION["connected"]) && $_SESSION["connected"] == true) {
            ?>
		<UL style="position:relative;float:right;padding: -5px 0px 0px 5px;">
			<LI >
				<A style="padding: 15px 30px 0px 10px;" HREF="./index.php?page=logout">
					<IMG style="width:60px;height:60px;" SRC="./assets/img/log_outt.png">
				</A>
			</LI>
		</UL>

		<UL style="position:relative;float:right;padding: -5px 0px 0px 5px;">
			<LI >
				<A style="padding: 15px 30px 0px 10px;" HREF="./index.php?page=settings">
					<IMG style="width:57px;height:57px;" SRC="./assets/img/setting.png">
				</A>
			</LI>
		</UL>

		<UL style="position:relative;float:right;padding: -5px 0px 0px 5px;">
			<LI >
				<A style="padding: 15px 30px 0px 10px;" HREF="./index.php?page=camera">
					<IMG style="width:70px;height:70px;" SRC="./assets/img/takepicture.png">
				</A>
			</LI>
		</UL>
		<?php
        } else {
            ?>

		<UL style="position:relative;float:right;padding: -5px 0px 0px 5px;">
			<LI >
				<A style="padding: 15px 30px 0px 10px;" HREF="./index.php?page=login">
					<IMG style="width:50px;height:50px;" SRC="./assets/img/loogin.png">
				</A>
			</LI>
		</UL>

		<UL style="position:relative;float:right;padding: -5px 0px 0px 5px;">
			<LI >
				<A style="padding: 15px 30px 0px 10px;" HREF="./index.php?page=create">
					<IMG style="width:50px;height:50px;" SRC="./assets/img/lol.png">
				</A>
			</LI>
		</UL>

		<?php
        }
        ?>

		<UL style="position:relative;float:right;padding: -5px 0px 0px 5px;">
			<LI >
				<A style="padding: 10px 0px 0px 10px;">
					<IMG style="width:200px;height:60px;" SRC="./assets/img/camagru2.png">
				</A>
			</LI>
		</UL>
</NAV>
<HTML>
