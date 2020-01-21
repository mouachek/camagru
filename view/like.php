<span></BR><?php echo $value["likes"]; ?> likes</span>

<form action="./index.php?page=index&cur_page=<?php echo isset($_GET["cur_page"]) ? $_GET["cur_page"] : 1 ?>" method="post" >
  <input type="hidden" name= "img_id" value="<?php echo $value["id"]; ?>" />
  <input type="submit" name= "submit_like" value="♡" />
</form>
