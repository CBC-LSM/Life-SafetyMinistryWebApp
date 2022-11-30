<?php
/**
 * includes/load.php
 *
 * @package default
 * @see index.php
 */

$dayofweek = date('l'); // day of week
$result    = date('Y-m-d', strtotime(($day - $dayofweek).' day', strtotime($date)));
?>
<!DOCTYPE html>
<html>
<body>

<form action="upload.php" method="post" enctype="multipart/form-data">
  Select image to upload:
  <input type="file" name="fileToUpload" id="fileToUpload">
  <input type="submit" value="Upload Image" name="submit">
</form>

</body>
</html>