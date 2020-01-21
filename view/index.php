<HTML>
	<HEAD>
		<TITLE>Camagru</TITLE>
		<link rel="stylesheet" HREF="./assets/form_comment_css.css"/>
		<meta charset="utf-8">
	</HEAD>
	<BODY style="background-color:#fafafa;">
		<?php require_once('./partial/menu.php'); ?>
		<div align="center">
			<DIV style="">
				<BR />
				<?php
                if (isset($messages)) {
                    if (isset($messages["incomplete_form"])) {
                        echo $messages["incomplete_form"];
                    }
                    if (isset($messages["already_like"])) {
                        echo $messages["already_like"];
                    }
                }
                    ?>
				<TABLE id="images_table">
				<?php
                if (isset($messages['images']) && !empty($messages['images'])) {
                    foreach ($messages['images'] as $key => $value) {
                        if ($key % 3 == 0) {
                            echo '<TR>';
                        }
                        echo '<TH>';
                        echo '<img style="width:200px;height:200px;margin-left:50px;margin-top:50px" src="data:image/jpeg;base64,' . $value["img_blob"] . '" />';
                        echo '</br>';
                        if (isConnected()) {
                            include("./view/like.php");
                            include("./view/comment.php");
                        }
                        echo '</TH>';
                        if ($key + 1 % 3 == 0 && $key != 0) {
                            echo '</TR>';
                        }
                    }
                }
                ?>
				</TABLE>
			</DIV>
			<?php
            if (isset($messages)) {
                if (isset($messages["pagination"])) {
                    for ($i=1;$i<=$messages["pagination"]["total_page"];$i++) {
                        if ($i == $messages["pagination"]["current_page"]) {
                            echo $i.' ';
                        } else {
                            echo '<a href="index.php?page=index&cur_page='.$i.'">'.$i.'</a> ';
                        }
                    }
                }
            }
       ?>
		 </BR> </BR>
			<NAV class="footer">
				<img src="./assets/img/foot.png"/>
				</NAV>
			</BR> </BR> </BR> </BR>
			</div>
</BODY>
</HTML>
