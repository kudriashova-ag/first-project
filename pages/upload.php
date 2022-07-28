<h1>Upload</h1>

<?php Message::get() ?>
<form action="index.php" method="POST" enctype="multipart/form-data">
  <div class="form-control">
    <input type="file" name="file">
  </div>

  <button class="btn btn-primary mt-3" name="action" value="uploadFile">Send</button>
</form>