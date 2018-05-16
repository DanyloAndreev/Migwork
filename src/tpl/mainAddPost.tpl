<div class="addPost">
	<form action="../pages/publish.php" method="post" enctype="multipart/form-data" name="addPost">
		<label for=""><textarea name="text" cols="60" rows="10" required></textarea></label>
		<br>
		<input type="hidden" name="MAX_FILE_SIZE" value="10000000" />
		<input type="file" accept="image/jpeg,image/png" name="postImg">
		<br>
		<input type="submit" class="btn_submit" name="submit_addPost" value="Добавить пост" >
	</form>
</div>