<?php
foreach ($messages["comments"] as $comment) {
    if ($comment["picture_id"] == $value["id"]) {
        ?>
          <span><?php echo $comment["username"] . " - " . $comment["comment"]; ?></span>
        </br>
        <?php
    }
}
?>

<form action="./index.php?page=index&cur_page=<?php echo isset($_GET["cur_page"]) ? $_GET["cur_page"] : 1 ?>" method="post" >
<fieldset>
  <label for="comments">Write a comment :</label>
  <textarea style="overflow:auto;resize:none" rows="4" cols="20" name="comment"></textarea>
</fieldset>

 <p>
   <input type="hidden" name= "img_id" value="<?php echo $value["id"]; ?>" />
 <input type="submit" name= "submit_comment" value="submit" />
 </p>
</form>
