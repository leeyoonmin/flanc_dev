<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Ajax extends CI_Controller {

	function __construct()
  {
      parent::__construct();
      $this->load->helper('url','custlog');
      $this->load->model('admin_model');
  }

	public function ajaxGetOptionsByOptionSetID(){
		$OPTION_SET_ID = $this->input->post('OPTION_SET_ID');
		$result = $this->admin_model->getOptionsByOptionSetID($OPTION_SET_ID);
		echo json_encode(array('result'=>true, 'data'=>$result));
  }

	public function addBannerInfo(){
		$postData = $this->input->post();

		$uploads_dir = './resource/img/banner/';
		$allowed_ext = array('jpg','jpeg','png','gif','JPG','JPEG','PNG','GIF');
		$extArray = explode('.',$_FILES['PRD_IMG']['name']);
		$ext = $extArray[1];
		$name = $extArray[0];

		if(!is_dir($uploads_dir)){
			mkdir($uploads_dir,0777,true);
		}

		// 변수 정리
		$error = $_FILES['PRD_IMG']['error'];

		// 오류 확인
		if( $error != UPLOAD_ERR_OK ) {
			switch( $error ) {
				case UPLOAD_ERR_INI_SIZE:
				case UPLOAD_ERR_FORM_SIZE:
					$this->load->view('module/alert', array('text'=>'파일이 너무 큽니다.'));
					$this->load->view('module/redirect',  array('url'=>'/admin/addproduct'));
					break;
				case UPLOAD_ERR_NO_FILE:
					$this->load->view('module/alert', array('text'=>'파일이 첨부되지 않았습니다.'));
					$this->load->view('module/redirect',  array('url'=>'/admin/addproduct'));
					break;
				default:
					$this->load->view('module/alert', array('text'=>'파일이 제대로 업로드되지 않았습니다.'));
					$this->load->view('module/redirect',  array('url'=>'/admin/addproduct'));
			}
			exit;
		}

		// 확장자 확인
		if( !in_array($ext, $allowed_ext) ) {
			$this->load->view('module/alert', array('text'=>'허용되지 않는 확장자입니다.'));
			$this->load->view('module/redirect',  array('url'=>'/admin/addproduct'));
			exit;
		}

		/*
		if(true){

			if($ext == "jpg" || $ext == "jpeg"){
					$image = imagecreatefromjpeg($_FILES['PRD_IMG']['tmp_name']);
			}else if($ext == "png"){
					$image = imagecreatefrompng($_FILES['PRD_IMG']['tmp_name']);
			}else if($ext == "bmp" || $ext == "wbmp"){
					$image = imagecreatefromwbmp($_FILES['PRD_IMG']['tmp_name']);
			}else if($ext == "gif"){
					$image = imagecreatefromgif($_FILES['PRD_IMG']['tmp_name']);
			}

			if($ext != "png") $exif = exif_read_data($_FILES['PRD_IMG']['tmp_name']);
			if(!empty($exif['Orientation'])) {
					switch($exif['Orientation']) {
							case 8:
									$image = imagerotate($image,90,0);
									break;
							case 3:
									$image = imagerotate($image,180,0);
									break;
							case 6:
									$image = imagerotate($image,-90,0);
									break;
					}
					if($ext == "jpg" || $ext == "jpeg"){
							imagejpeg($image,$_FILES['PRD_IMG']['tmp_name']);
					}else if($ext == "png"){
							imagepng($image,$_FILES['PRD_IMG']['tmp_name']);
					}else if($ext == "bmp" || $ext == "wbmp"){
							imagewbmp($image,$_FILES['PRD_IMG']['tmp_name']);
					}else if($ext == "gif"){
							imagegif($image,$_FILES['PRD_IMG']['tmp_name']);
					}
				}
			}
			*/
		// 파일 이동
		move_uploaded_file( $_FILES['PRD_IMG']['tmp_name'], "$uploads_dir/$name.$ext");

		// 파일 리사이즈 후 복사하기
		$d = $this->compress("$uploads_dir/$name.$ext", "$uploads_dir/$name.$ext", 50);

		$BANNER_ID = $this->admin_model->makeBannerId();
		$BANNER_ORDER = $this->admin_model->getBannerOrderByType($postData['BANNER_TYPE']);

		$param = array(
			'BANNER_ID'=>$BANNER_ID,
			'BANNER_TYPE'=>$postData['BANNER_TYPE'],
			'BANNER_ORDER'=>$BANNER_ORDER,
			'IMG_NAME'=>$name,
			'IMG_EXTENSION' => $ext,
			'IMG_SIZE' =>  ceil($_FILES['PRD_IMG']['size']/1024),
			'LINK_URL'=>$postData['LINK_URL']
		);
		
		$this->admin_model->addBannerInfo($param);

		echo json_encode(array('result'=>true));
	}

	public function addProductInfo(){
		$postData = $this->input->post();
		$PRODUCT_ID = $this->admin_model->makeProductID();
		$param = array(
			'PRD_ID' => $PRODUCT_ID,
			'PRD_TYPE' => '01',
      'PRD_NAME' => $postData['PRODUCT_NAME'],
      'PRD_BRIEF_DESC' => $postData['PRODUCT_BRIEF_DESC'],
      'PRD_DESC' => $postData['PRODUCT_DESC']
    );
		$result = $this->admin_model->createProductBase($param);
		if($result){
			echo json_encode(array('result'=>true, 'data'=>$PRODUCT_ID));
		}else{
			echo json_encode(array('result'=>false, 'data'=>$PRODUCT_ID));
		}
	}

	public function updateProductPrice(){
		$postData = $this->input->post();
		$param = array(
			'PRD_ID' => $postData['PRD_ID'],
      'PRD_SUPPLY_PRICE' => $postData['PRODUCT_SUPPLY_PRICE'],
      'PRD_SALES_PRICE' => $postData['PRODUCT_SALES_PRICE'],
      'PRD_SAVINGS' => $postData['SAVINGS']
    );
		$result = $this->admin_model->updateProductPrice($param);
		if($result){
			echo json_encode(array('result'=>true, 'data'=>$result));
		}else{
			echo json_encode(array('result'=>false, 'data'=>$result));
		}
	}

	public function addProductImage(){
		$PRD_ID = $this->input->get('PRD_ID');
		$TYPE = $this->input->get('TYPE');
		$MODE = $this->input->get('MODE');
		$uploads_dir = './resource/img/product/'.$PRD_ID;
		$allowed_ext = array('jpg','jpeg','png','gif','JPG','JPEG','PNG','GIF');
		$ext = substr($_FILES['PRD_IMG']['name'],-3);
		$name = $TYPE.".".$ext;

		if($MODE == 'MODIFY'){
			unlink($uploads_dir."/".$name);
		}

		if(!is_dir($uploads_dir."/")){
			mkdir($uploads_dir."/",0777,true);
		}

		// 변수 정리
		$error = $_FILES['PRD_IMG']['error'];

		// 오류 확인
		if( $error != UPLOAD_ERR_OK ) {
			switch( $error ) {
				case UPLOAD_ERR_INI_SIZE:
				case UPLOAD_ERR_FORM_SIZE:
					$this->load->view('module/alert', array('text'=>'파일이 너무 큽니다.'));
					$this->load->view('module/redirect',  array('url'=>'/admin/addproduct'));
					break;
				case UPLOAD_ERR_NO_FILE:
					$this->load->view('module/alert', array('text'=>'파일이 첨부되지 않았습니다.'));
					$this->load->view('module/redirect',  array('url'=>'/admin/addproduct'));
					break;
				default:
					$this->load->view('module/alert', array('text'=>'파일이 제대로 업로드되지 않았습니다.'));
					$this->load->view('module/redirect',  array('url'=>'/admin/addproduct'));
			}
			exit;
		}

		// 확장자 확인
		if( !in_array($ext, $allowed_ext) ) {
			$this->load->view('module/alert', array('text'=>'허용되지 않는 확장자입니다.'));
			$this->load->view('module/redirect',  array('url'=>'/admin/addproduct'));
			exit;
		}


		/*
		if(true){

			if($ext == "jpg" || $ext == "jpeg"){
					$image = imagecreatefromjpeg($_FILES['PRD_IMG']['tmp_name']);
			}else if($ext == "png"){
					$image = imagecreatefrompng($_FILES['PRD_IMG']['tmp_name']);
			}else if($ext == "bmp" || $ext == "wbmp"){
					$image = imagecreatefromwbmp($_FILES['PRD_IMG']['tmp_name']);
			}else if($ext == "gif"){
					$image = imagecreatefromgif($_FILES['PRD_IMG']['tmp_name']);
			}

			if($ext != "png") $exif = exif_read_data($_FILES['PRD_IMG']['tmp_name']);
			if(!empty($exif['Orientation'])) {
					switch($exif['Orientation']) {
							case 8:
									$image = imagerotate($image,90,0);
									break;
							case 3:
									$image = imagerotate($image,180,0);
									break;
							case 6:
									$image = imagerotate($image,-90,0);
									break;
					}
					if($ext == "jpg" || $ext == "jpeg"){
							imagejpeg($image,$_FILES['PRD_IMG']['tmp_name']);
					}else if($ext == "png"){
							imagepng($image,$_FILES['PRD_IMG']['tmp_name']);
					}else if($ext == "bmp" || $ext == "wbmp"){
							imagewbmp($image,$_FILES['PRD_IMG']['tmp_name']);
					}else if($ext == "gif"){
							imagegif($image,$_FILES['PRD_IMG']['tmp_name']);
					}
				}
			}
		*/

		// 파일 이동
		move_uploaded_file( $_FILES['PRD_IMG']['tmp_name'], "$uploads_dir/$name");

		// 파일 리사이즈 후 복사하기
		//$d = $this->compress("$uploads_dir/$name", "$uploads_dir/$name", 50);
		$param = array(
			'PRD_ID' => $PRD_ID,
			'IMG_NAME' => $TYPE,
			'IMG_EXTENSION' => $ext,
			'IMG_SIZE' =>  ceil($_FILES['PRD_IMG']['size']/1024)
		);
		$IS_IMG = $this->admin_model->findProductImgByIdName($param);
		if($IS_IMG == "N"){
			$result = $this->admin_model->addProductImage($param);
		}else{
			$result = $this->admin_model->updateProductImage($param);
		}


		echo json_encode(array('result'=>true));
	}

	function deleteProductImage(){
		$PRD_ID = $this->input->get('PRD_ID');
		$TYPE = $this->input->get('TYPE');
		$uploads_dir = './resource/img/product/'.$PRD_ID;

		$param = array(
			'PRD_ID' => $PRD_ID,
			'IMG_NAME' => $TYPE,
		);

		$ext = $this->admin_model->findProductExtensionByIdName($param);
		$this->admin_model->deleteProductImage($param);

		$name = $TYPE.".".$ext;
		unlink($uploads_dir."/".$name);

		echo json_encode(array('result'=>true));
	}

	function compress($source, $destination, $quality) {
			$info = getimagesize($source);
			if ($info['mime'] == 'image/jpeg')
					$image = imagecreatefromjpeg($source);
			elseif ($info['mime'] == 'image/gif')
					$image = imagecreatefromgif($source);
			elseif ($info['mime'] == 'image/png')
					$image = imagecreatefrompng($source);
			imagejpeg($image, $destination, $quality);
			return $destination;
	}

	public function ajaxDeleteProduct(){
		$PRD_ID = $this->input->post('idxkey');
		$this->admin_model->deleteProductData($PRD_ID);
		$dir = './resource/img/product/'.$PRD_ID."/";
		if (is_dir($dir)){
		  if ($dh = opendir($dir)){
				$cnt = 0;
				$files = array();
		    while (($file = readdir($dh)) !== false){
					if($file != '.' && $file != '..'){
						$files[$cnt] = $file;
						$cnt++;
					}
		    }
		    closedir($dh);
		  }
			foreach($files as $file){
				unlink($dir.$file);
			}
			rmdir($dir);
		}
		echo json_encode(array('result'=>true));
	}

	public function addProductOption(){
		$postData = $this->input->post();
		foreach($postData['OPTION'] as $row){
			$param = array(
				'PRD_ID' => $postData['PRODUCT_ID'],
				'OPTION_SET_ID' => $postData['PRODUCT_OPTION_SET'],
				'OPTION_ID' => $row
			);
			$this->admin_model->addProductOption($param);
		}
		echo json_encode(array('result'=>true));
	}

	public function updateProductOption(){
		$postData = $this->input->post();
		var_dump($postData);
		$this->admin_model->deleteProductOptionByID($postData['PRD_ID']);
		if($postData['PRODUCT_OPTION_SET'] == '0000'){

		}else{
			foreach($postData['OPTION'] as $row){
				$param = array(
					'PRD_ID' => $postData['PRD_ID'],
					'OPTION_SET_ID' => $postData['PRODUCT_OPTION_SET'],
					'OPTION_ID' => $row
				);
				$this->admin_model->addProductOption($param);
			}
		}
		echo json_encode(array('result'=>true));
	}

	public function updateProductEtc(){
		$postData = $this->input->post();

		if(empty($postData['IS_NEW'])){
      $postData['IS_NEW'] = "N";
    }else{
      $postData['IS_NEW'] = "Y";
    }
    if(empty($postData['IS_RECOMMAND'])){
      $postData['IS_RECOMMAND'] = "N";
    }else{
      $postData['IS_RECOMMAND'] = "Y";
    }
    if(empty($postData['IS_SELL'])){
      $postData['IS_SELL'] = "N";
    }else{
      $postData['IS_SELL'] = "Y";
    }
    if(empty($postData['IS_DISPLAY'])){
      $postData['IS_DISPLAY'] = "N";
    }else{
      $postData['IS_DISPLAY'] = "Y";
    }
    if(empty($postData['IS_SOLDOUT'])){
      $postData['IS_SOLDOUT'] = "N";
    }else{
      $postData['IS_SOLDOUT'] = "Y";
    }

		$result = $this->admin_model->updateProductEtc($postData);
		if($result){
			echo json_encode(array('result'=>true, 'data'=>$result));
		}else{
			echo json_encode(array('result'=>false, 'data'=>$result));
		}
	}

	public function updateProductInfo(){
		$postData = $this->input->post();
		$param = array(
			'PRD_ID' => $postData['PRD_ID'],
			'PRD_TYPE' => '01',
      'PRD_NAME' => $postData['PRODUCT_NAME'],
      'PRD_BRIEF_DESC' => $postData['PRODUCT_BRIEF_DESC'],
      'PRD_DESC' => $postData['PRODUCT_DESC']
    );
		$result = $this->admin_model->updateProductBase($param);
		if($result){
			echo json_encode(array('result'=>true));
		}else{
			echo json_encode(array('result'=>false));
		}
	}

}
