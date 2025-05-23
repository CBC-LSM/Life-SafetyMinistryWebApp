<?php
/**
 * includes/upload.php
 *
 * @package default
 */


class Media {

	public $imageInfo;
	public $fileName;
	public $fileType;
	public $fileTempPath;
	//Set destination for upload
	public $userPath = SITE_ROOT.DS.'..'.DS.'/images/users';
	public $incidentPath = SITE_ROOT.DS.'..'.DS.'/incidentreporting/uploads';
	public $productPath = SITE_ROOT.DS.'..'.DS.'/images/products';


	public $errors = array();
	public $upload_errors = array(
		0 => 'There is no error, the file uploaded with success',
		1 => 'The uploaded file exceeds the upload_max_filesize directive in php.ini',
		2 => 'The uploaded file exceeds the MAX_FILE_SIZE directive that was specified in the HTML form',
		3 => 'The uploaded file was only partially uploaded',
		4 => 'No file was uploaded',
		6 => 'Missing a temporary folder',
		7 => 'Failed to write file to disk.',
		8 => 'A PHP extension stopped the file upload.'
	);
	public$upload_extensions = array(
		'gif',
		'jpg',
		'jpeg',
		'png',
	);

	/**
	 *
	 * @param unknown $filename
	 * @return unknown
	 */
	public function file_ext($filename) {
		$ext = strtolower(substr( $filename, strrpos( $filename, '.' ) + 1 ) );
		if (in_array($ext, $this->upload_extensions)) {
			return true;
		}
	}


	/**
	 *
	 * @param unknown $file
	 * @return unknown
	 */
	public function upload($file) {
		if (!$file || empty($file) || !is_array($file)):
			
			$this->errors[] = "No file was uploaded.";
		return false;
		elseif ($file['error'] != 0):
			$this->errors[] = $this->upload_errors[$file['error']];
		return false;
		elseif (!$this->file_ext($file['name'])):
			$this->errors[] = 'File not right format ';
		return false;
		else:
		$this->imageInfo = getimagesize($file['tmp_name']);
		$this->fileName  = basename($file['name']);
		$this->fileType  = $this->imageInfo['mime'];
		$this->fileTempPath = $file['tmp_name'];
		return true;
		endif;

	}


	/**
	 *
	 * @return unknown
	 */
	public function process() {

		if (!empty($this->errors)):
			return false;
		elseif (empty($this->fileName) || empty($this->fileTempPath)):
			$this->errors[] = "The file location was not available.";
		return false;
		elseif (!is_writable($this->productPath)):
			$this->errors[] = $this->productPath." Must be writable!!!.";
		return false;
		elseif (file_exists($this->productPath."/".$this->fileName)):
			$this->errors[] = "The file {$this->fileName} already exists.";
		return false;
		else:
			return true;
		endif;
	}


	/*--------------------------------------------------------------*/
	/* Function for Process media file
 /*--------------------------------------------------------------*/

	/**
	 *
	 * @return unknown
	 */
	public function process_media() {
		if (!empty($this->errors)) {
			return false;
		}
		if (empty($this->fileName) || empty($this->fileTempPath)) {
			$this->errors[] = "The file location was not available.";
			return false;
		}

		if (!is_writable($this->productPath)) {
			$this->errors[] = $this->productPath." Must be writable!!!.";
			return false;
		}

		if (file_exists($this->productPath."/".$this->fileName)) {
			$this->errors[] = "The file {$this->fileName} already exists.";
			return false;
		}

		if (move_uploaded_file($this->fileTempPath, $this->productPath.'/'.$this->fileName)) {

			if ($this->insert_media()) {
				unset($this->fileTempPath);
				return true;
			}

		} else {

			$this->errors[] = "The file upload failed, possibly due to incorrect permissions on the upload folder.";
			return false;
		}

	}


	/*--------------------------------------------------------------*/
	/* Function for Process user image
  /*--------------------------------------------------------------*/

	/**
	 *
	 * @param unknown $id
	 * @return unknown
	 */
	public function process_user($id) {

		if (!empty($this->errors)) {
			return false;
		}
		if (empty($this->fileName) || empty($this->fileTempPath)) {
			$this->errors[] = "The file location was not available.";
			return false;
		}
		if (!is_writable($this->userPath)) {
			$this->errors[] = $this->userPath." Must be writable!!!.";
			return false;
		}
		if (!$id) {
			$this->errors[] = " Missing user id.";
			return false;
		}

		$ext = explode(".", $this->fileName);
		// var_dump($ext);
		// echo "<br>".$id."<br>";
		$new_name = randString(8).$id.'.' . end($ext);
		// die(print_r($new_name));
		$this->fileName = $new_name;
		if ($this->user_image_destroy($id)) {
			if (move_uploaded_file($this->fileTempPath, $this->userPath.'/'.$this->fileName)) {

				if ($this->update_userImg($id)) {
					unset($this->fileTempPath);
					return true;
				}

			} else {
				$this->errors[] = "The file upload failed, possibly due to incorrect permissions on the upload folder.";
				return false;
			}
		}
	}
	/*--------------------------------------------------------------*/
	/* Function for Process Incident image
  /*--------------------------------------------------------------*/

	/**
	 *
	 * @param unknown $id
	 * @return unknown
	 */
	public function processIncidentImg() {

		if (!empty($this->errors)) {
			echo print_r($this->errors);
			// echo "this uploaded somewhere...";
			return false;
		}
		if (empty($this->fileName) || empty($this->fileTempPath)) {
			$this->errors[] = "The file location was not available.";
			return false;
		}
		if (!is_writable($this->incidentPath)) {
			$this->errors[] = $this->incidentPath." Must be writable!!!.";
			return false;
		}

		$ext = explode(".", $this->fileName);
		$new_name = randString(8).$id.'.' . end($ext);
		$this->fileName = $new_name;
		global $imageFullPath;
		$imageFullPath = $this->incidentPath.'/'.$this->fileName;
		if (move_uploaded_file($this->fileTempPath, $imageFullPath)) {
			echo "this uploaded somewhere...";
			return true;
		} else {
			echo "failed....";
			$this->errors[] = "The file upload failed, possibly due to incorrect permissions on the upload folder.";
			return false;
		}

	}

	/*--------------------------------------------------------------*/
	/* Function for Update user image
 /*--------------------------------------------------------------*/

	/**
	 *
	 * @param unknown $id
	 * @return unknown
	 */
	private function update_userImg($id) {
		global $db;
		$sql = "UPDATE users SET";
		$sql .=" img='{$db->escape($this->fileName)}'";
		$sql .=" WHERE id='{$db->escape($id)}'";
		$result = $db->query($sql);
		return $result && $db->affected_rows() === 1 ? true : false;

	}


	/*--------------------------------------------------------------*/
	/* Function for Delete old image
 /*--------------------------------------------------------------*/

	/**
	 *
	 * @param unknown $id
	 * @return unknown
	 */
	public function user_image_destroy($id) {
		$image = find_by_id('users', $id);
		// die(print_r($image));
		if ($image['img'] === 'no_image.jpg' || $image['img']==="") {
			return true;
		} else {
			unlink($this->userPath.'/'.$image['image']);
			return true;
		}

	}


	/*--------------------------------------------------------------*/
	/* Function for insert media image
/*--------------------------------------------------------------*/

	/**
	 *
	 * @return unknown
	 */
	private function insert_media() {

		global $db;
		$sql  = "INSERT INTO media ( file_name,file_type )";
		$sql .=" VALUES ";
		$sql .="(
                  '{$db->escape($this->fileName)}',
                  '{$db->escape($this->fileType)}'
                  )";
		return $db->query($sql) ? true : false;

	}


	/*--------------------------------------------------------------*/
	/* Function for Delete media by id
/*--------------------------------------------------------------*/

	/**
	 *
	 * @param unknown $id
	 * @param unknown $file_name
	 * @return unknown
	 */
	public function media_destroy($id, $file_name) {
		$this->fileName = $file_name;
		if (empty($this->fileName)) {
			$this->errors[] = "The Photo file Name missing.";
			return false;
		}
		if (!$id) {
			$this->errors[] = "Missing Photo id.";
			return false;
		}
		if (delete_by_id('media', $id)) {
			unlink($this->productPath.'/'.$this->fileName);
			return true;
		} else {
			$this->error[] = "Photo deletion failed Or Missing Prm.";
			return false;
		}

	}



}


?>
