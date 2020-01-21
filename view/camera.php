<!DOCTYPE html>
<HTML>
<HEAD>
		<TITLE>Camagru</TITLE>
		<meta charset="utf-8">
		<style="background-color:#fafafa;">
			<?php require_once('./partial/menu.php'); ?>
			<div align="center">
		    <img style="float:center;top:15%;width:480px;height:160px;" src="./assets/img/take_picture.png">
				<A HREF="./index.php?page=upload"><IMG style="width:100px;height:100px;" SRC="./assets/img/upload.png"></A>

			 </HEAD>
			 <BODY>
				 <div class="video-wrap">
				     <video id="video" playsinline autoplay></video>
				     <!-- Webcam video snapshot -->
				     <canvas id="canvas" width="400" height="400"></canvas>
				 </div>

				 <!-- Trigger canvas web API -->
				 <div class="controller">
				     <button id="snap">Capture</button>
				     <button id="save" style="display:none;">Publish</button>
						 <br /> <br />
						 <span id="publish_error"></span>
				 </div>
				 <script>
		'use strict';

		const video = document.getElementById('video');
		const canvas = document.getElementById('canvas');
		const snap = document.getElementById("snap");
		const save = document.getElementById("save");
		const errorMsgElement = document.querySelector('span#errorMsg');

		const constraints = {
		  audio: false,
		  video: {
		    width: 400, height: 400
		  }
		};

		// Access webcam
		async function init() {
		  try {
		    const stream = await navigator.mediaDevices.getUserMedia(constraints);
		    handleSuccess(stream);
		  } catch (e) {
		    errorMsgElement.innerHTML = `navigator.getUserMedia error:${e.toString()}`;
		  }
		}

		// Success
		function handleSuccess(stream) {
		  window.stream = stream;
		  video.srcObject = stream;
		}

		function publishPicture(blob) {
			var xhr = new XMLHttpRequest();
			var fd  = new FormData();

			// add our data into our FormData object
			//filtre push radio check
			fd.append('submit_upload', true);
			fd.append('data', blob);
            const filter = document.querySelector('input[name="radio"]:checked');
            fd.append('filter', filter ? filter.value : null);

			// Define what happens in case of error
			xhr.addEventListener('error', function(event) {
				// Quand y'a une erreur
				alert('Oops! Something went wrong.');
			});

			// Set up our request
			xhr.open('POST', './index.php?page=publish');

			xhr.onreadystatechange = function() {
				if (xhr.readyState == XMLHttpRequest.DONE) {
                console.log(xhr.responseText);
					const messages = JSON.parse(xhr.responseText);
					if (messages['no_image']) {
						document.getElementById('publish_error').textContent = messages['no_image'];
						return;
					}
					if (messages['no_filter']) {
						document.getElementById('publish_error').textContent = messages['no_filter'];
						return;
					}
					location.reload();
				}
			}

			// Send our FormData object; HTTP headers are set automatically
			xhr.send(fd);
		}

		// Load init
		init();

		// Draw image
		var context = canvas.getContext('2d');
		snap.addEventListener("click", function()
		{
			context.drawImage(video, 0, 0, 400, 400);
		  save.style.display = 'block';
		});

		save.addEventListener("click", function() {
			canvas.toBlob(publishPicture);
		});
		</script>
            <BR /><BR /><BR />
             <img style="width:200px;height:200px;" src="./assets/img/cadre1.png">
             <input type="radio" name="radio" value="cadre1">
             <label for="cadre1">1</label>
             <img style="width:200px;height:200px;" src="./assets/img/cadre2.png">
             <input type="radio" name="radio" value="cadre2">
             <label for="cadre2">2</label>
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
												<form method="POST" action="./index.php?page=camera">
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
