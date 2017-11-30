<?php
//print_r($_FILES);
//echo json_encode(print_r($_FILES));

/**
 * 生成唯一字符串
 * @return string
 */
function getUniName() {
	return md5(uniqid(microtime(true), true));
}

/**
 * 得到文件的扩展名
 * @param string $filename
 * @return string
 */
function getExt($filename) {
	$hz = explode(".", $filename);
	return strtolower(end($hz));
}

/**
 * 构建上传文件信息
 * @return array
 */

function buildInfo() {
	if (!$_FILES) {
		return;
	}
	$i = 0;
	foreach ($_FILES as $v) {
		//单文件
		if (is_string($v['name'])) {
			$files[$i] = $v;
			$i++;
		} else {
			//多文件
			foreach ($v['name'] as $key => $val) {
				$files[$i]['name'] = $val;
				$files[$i]['size'] = $v['size'][$key];
				$files[$i]['tmp_name'] = $v['tmp_name'][$key];
				$files[$i]['error'] = $v['error'][$key];
				$files[$i]['type'] = $v['type'][$key];
				$i++;
			}
		}
	}
	return $files;
}

function uploadFile($path = "../uploads", $allowExt = array("gif","jpeg","png","jpg","wbmp"), $maxSize = 2097152, $imgFlag = true) {
	if (!file_exists($path)) {//判断是否有$path文件夹，没有则创建
		mkdir($path, 0777, true);
		//0777表示最大权限
	}
	$i = 0;
	$files = buildInfo();
	if (!($files && is_array($files))) {
		return;
	}
	foreach ($files as $file) {
		if ($file['error'] === UPLOAD_ERR_OK) {//就是0
			$ext = getExt($file['name']);
			//检测文件的扩展名
			if (!in_array($ext, $allowExt)) {
				exit("非法文件类型");
			}
			//校验是否是一个真正的图片类型
			if ($imgFlag) {
				if (!getimagesize($file['tmp_name'])) {
					exit("不是真正的图片类型");

				} else {
					$file["filesize"] = getimagesize($file['tmp_name']);
					//把文件信息付给$file 传到前台返回时数组
					//如 [720, 1280, 2, "width="720" height="1280"", 8, 3, "image/jpeg"]
				}
			}
			//上传文件的大小
			if ($file['size'] > $maxSize) {
				exit("上传文件过大");
			}
			if (!is_uploaded_file($file['tmp_name'])) {
				exit("不是通过HTTP POST方式上传上来的");
			}
			$filename = getUniName() . "." . $ext;
			//改文件重新命名
			$destination = $path . "/" . $filename;
			if (move_uploaded_file($file['tmp_name'], $destination)) {
				$file['name'] = $filename;
				$file['path_name'] = $destination;
				unset($file['tmp_name'], $file['size'], $file['type']);
				//去除不需要传给的信息
				$uploadedFiles[$i] = $file;
				$i++;
			}
		} else {
			switch($file['error']) {
				case 1 :
					$mes = "超过了配置文件上传文件的大小";
					//UPLOAD_ERR_INI_SIZE
					break;
				case 2 :
					$mes = "超过了表单设置上传文件的大小";
					//UPLOAD_ERR_FORM_SIZE
					break;
				case 3 :
					$mes = "文件部分被上传";
					//UPLOAD_ERR_PARTIAL
					break;
				case 4 :
					$mes = "没有文件被上传1111";
					//UPLOAD_ERR_NO_FILE
					break;
				case 6 :
					$mes = "没有找到临时目录";
					//UPLOAD_ERR_NO_TMP_DIR
					break;
				case 7 :
					$mes = "文件不可写";
					//UPLOAD_ERR_CANT_WRITE;
					break;
				case 8 :
					$mes = "由于PHP的扩展程序中断了文件上传";
					//UPLOAD_ERR_EXTENSION
					break;
			}
			echo $mes;
		}
	}
	return $uploadedFiles;
};

$rows = uploadFile($path = "../uploads", $allowExt = array("gif", "jpeg", "png", "jpg", "wbmp"), $maxSize = 2097152, $imgFlag = true);

//echo json_encode($rows);
?>