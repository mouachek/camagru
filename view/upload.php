<!DOCTYPE html>
<HTML>
<HEAD>
		<TITLE>Camagru</TITLE>
		<meta charset="utf-8">
		<style="background-color:#fafafa;">
			<?php require_once('./partial/menu.php');?>
			<div align="center">
		    <img style="float:center;top:15%;width:480px;height:160px;" src="./assets/img/take_picture.png">
			 </HEAD>
			 <BODY>
         <form action="./index.php?page=upload" method="post" enctype="multipart/form-data">
              Select image to upload:
             <input type="file" name="fic" accept="image/jpg,image/jpeg,image/png" id="fic">
             <input type="submit" value="Upload Image" name="submit">
         		<br /> <br /> <br />
             <img style="width:200px;height:200px;" src="./assets/img/cadre1.png">
             <input type="radio" name="radio" value="cadre1">
             <label for="cadre1">1</label>
             <img style="width:200px;height:200px;" src="./assets/img/cadre2.png">
             <input type="radio" name="radio" value="cadre2">
             <label for="cadre2">2</label>
             </form>
                <BR /><BR />
                <span>
            				 <?php
                  if (isset($messages)) {
                      if (isset($messages["bad_type"])) {
                          echo $messages["bad_type"];
                      }
                      if (isset($messages["not_filter_selected"])) {
                          echo $messages["not_filter_selected"];
                      }
                  }
                              ?>
                </span>

		<DIV align="center">
				<BR />
				<TABLE id="images_table">
				<?php
                    foreach ($messages['images'] as $key => $value) {
                        if ($key % 3 == 0) {
                            echo '<TR>';
                        }
                        echo '<TH>';
                        echo '<img width="150px" height="150px" src="data:image/jpeg;base64,' . $value['img_blob'] . '" />'; ?>
												<form method="POST" action="./index.php?page=upload">
												<input type="hidden" name= "img_id" value="<?php echo $value["id"]; ?>" />
												<input type="submit" name="submit_delete" value="Delete" />
												</form>
												<?php
                        echo '</TH>';
                        if ($key + 1 % 3 == 0 && $key != 0) {
                            echo '</TR>';
                        }
                    }
                ?>
				</TABLE>
			</DIV>
			<BR /><BR /><BR /><BR /><BR /><BR />
			<NAV class="footer">
				<img src="./assets/img/foot.png"/>
				</NAV>
			</div>
</BODY>
</HTML>
