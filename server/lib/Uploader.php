<?php

class Uploader{

	private $host;
	private $document_root;
	private $directory;
	private $current_folder;
	private $_uploads;
	private $hidden_image_path;
	private $thumbnail_info;

	public function __construct(){
		$this->document_root = $_SERVER['DOCUMENT_ROOT'];
		$this->directory = $this->document_root;
		//$this->directory = '/uploads';
		$this->host = 'http://' . $_SERVER['HTTP_HOST'];
        $this->hidden_image_path = $this->directory . '/images/hidden.png';

        //defautl thumbnail
        /*
         * key is thumbnail prefix (ex : filename . key . ext => uuid . _s . jpg)
         */
        $this->thumbnail_info = array(
            '_s' => array('width'=>50, 'height'=>50),
            '_n' => array('width'=>100, 'height'=>100),
            '_b' => array('width'=>200, 'height'=>200),
        );
	}

	public function __destruct(){
	}

	public function setThumbnail($thumbnail_info = false){
	    if($thumbnail_info === false || is_array($thumbnail_info) === false){
	        return false;
        }
        //배열검증
        foreach($thumbnail_info as $key=>$value){
	        if(empty($key) || is_array($value) === false){
	            return false;
            }
            if(!isset($value['width']) || !isset($value['height'])){
	            return false;
            }
        }
        $this->thumbnail_info = $thumbnail_info;
    }

	public function run($_uploads, $thumbnail = false, $folder = false, $directory=false, $document_root=false, $host=false){

		$this->_uploads = $_uploads;
		if($document_root !== false){
			$this->document_root = $document_root;
		}

		if($directory !== false){
			$this->directory = $directory;
		}

		if($host !== false){
			$this->host = $host;
		}

		if($folder === false){
			$folder = 'uploads/' . date('Y') . '/' . date('m');
		}

		$this->current_folder = $this->create_folder($folder);

		//$this->_uploads가 여러개 업로드인지 체크
		$result = array();
		if(count($this->_uploads['name']) > 1){
			$uploads_convert = $this->uploadFileConvert();
			for($i=0; $i<count($uploads_convert); $i++){
				$result[$i] = $this->upload($uploads_convert[$i], $thumbnail);
			}
		}else{
			$result = $this->upload($this->_uploads, $thumbnail);
		}
		return $result;
		
	}

	private function uploadFileConvert(){
		$file_ary = array();
		$file_count = count($this->_uploads['name']);
		$file_key = array_keys($this->_uploads);
		
		for($i=0;$i<$file_count;$i++)
		{
			foreach($file_key as $val)
			{
				$file_ary[$i][$val] = $this->_uploads[$val][$i];
			}
		}
		return $file_ary;
	}

	private function upload($file, $thumbnail = false){		
		$file_name = $file['name'];
		$file_type = $file['type'];
		$file_size = $file['size'];
		$file_tmp = $file['tmp_name'];
		$file_error = $file['error'];
		$file_rename = $this->uuid();
		$file_ext = $this->get_ext($file_name);

		$upload_result = move_uploaded_file($file_tmp, $this->document_root . $this->current_folder . '/' . $file_rename . $file_ext);
		if($upload_result){

			if($thumbnail){
			    $tmpUploadAbsolutePath = $this->document_root . '/' . $this->current_folder . '/';
			    foreach($this->thumbnail_info as $key=>$value){
                    $param = array(
                        'o_path' => $tmpUploadAbsolutePath . $file_rename . $file_ext,
                        'n_path' => $tmpUploadAbsolutePath . $file_rename . $key. $file_ext,
                        'width' => $value['width'],
                        'height' => $value['height'],
                        'mode' => 'ratio',
                        'fill_yn' => 'N',
                        'preview_yn' => 'Y'
                    );
                    $this->getThumb($param);
                }
				
//				$param['n_path'] = $tmpUploadAbsolutePath . $file_rename . '_n' . $file_ext;
//				$param['width'] = '100';
//				$this->getThumb($param);	//normal
//
//				$param['n_path'] = $tmpUploadAbsolutePath . $file_rename . '_b' . $file_ext;
//				$param['width'] = '200';
//				$this->getThumb($param);	//big

			}

			return array(
				'error' => false,
				'file_name'=> $this->current_folder . '/' . $file_name,
				'file_type' => $file_type,
				'file_size' => $file_size,
				'file_renmae' => $this->current_folder . '/' . $file_rename . $file_ext,
				'file_thumnail' => $this->current_folder . '/' . $file_rename . '_b' . $file_ext,
				'host' => $this->host,
			);
		}else{
			return array(
				'error' => true,
				'message' => $file_error
			);
		}
	
	}

	private function get_ext($file_name){
		$array_ext = explode('.', $file_name);
		return '.' . $array_ext[count($array_ext) - 1];
	}

	private function create_folder($folder){
		$tmp = strpos('/', $folder);
		if($tmp === false || $tmp === 0){
			$folder = '/' . $folder;
		}

		if (!file_exists($this->directory . $folder)) {
			mkdir($this->directory. $folder, 0777, true);
		}
		//return $this->directory . $folder;
		return $folder;
	}

	private function uuid(){
		// Windows
		if (function_exists('com_create_guid') === true) {
			if ($trim === true){
				return trim(com_create_guid(), '{}');
			}else{
				return com_create_guid();
			}
		}

		// OSX/Linux
		if (function_exists('openssl_random_pseudo_bytes') === true) {
			$data = openssl_random_pseudo_bytes(16);
			$data[6] = chr(ord($data[6]) & 0x0f | 0x40);    // set version to 0100
			$data[8] = chr(ord($data[8]) & 0x3f | 0x80);    // set bits 6-7 to 10
			return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
		}

		// Fallback (PHP 4.2+)
		mt_srand((double)microtime() * 10000);
		$charid = strtolower(md5(uniqid(rand(), true)));
		$hyphen = chr(45);                  // "-"
		$lbrace = $trim ? "" : chr(123);    // "{"
		$rbrace = $trim ? "" : chr(125);    // "}"
		$guidv4 = $lbrace.
				  substr($charid,  0,  8).$hyphen.
				  substr($charid,  8,  4).$hyphen.
				  substr($charid, 12,  4).$hyphen.
				  substr($charid, 16,  4).$hyphen.
				  substr($charid, 20, 12).
				  $rbrace;
		return $guidv4;
	}

	/*
		Function	: getThumb($param)
		Param		: $param['o_path'] = 원본 파일 경로
					  $param['n_path'] = 새 파일 경로
					  $param['width'] = 썸네일 이미지 넓이
					  $param['height'] = 썸네일 이미지 높이
					  $param['mode'] = ratio or fixed	(ratio => 비율유지, fixed => 파라메터의 크기로 강제 변경)
					  $param['fill_yn'] = 'Y' or 'N'	(mode가 ratio일 경우 부족한부분 투명 배경처리)
					  $param['preview_yn'] = 'Y' or 'N' (미리보기 방지 여부 => 미리보기방지 대체 이미지 제공)
		Return		: array('bool' => true or false, 'src' => 썸네일 이미지 url, 'msg' => 성공, 실패 메세지)
	*/
	private function getThumb($param){
		if(empty($param['o_path']))		return array('bool' => false, 'msg' => '원본 파일 경로가 없습니다.');
		if(empty($param['n_path']))		return array('bool' => false, 'msg' => '원본 파일 경로가 없습니다.');
		if(!in_array($param['mode'], array('ratio', 'fixed')))	$param['mode'] = 'ratio';
		if(empty($param['width']))		$param['width'] = 300;
		if(empty($param['height']))		$param['height'] = 300;
		if(!in_array($param['fill_yn'], array('Y', 'N')))		$param['fill_yn'] = 'N';
		if(!in_array($param['preview_yn'], array('Y', 'N')))	$param['preview_yn'] = 'Y';

		// 미리보기 방지 이미지 url
		if($param['preview_yn'] == 'N')	$param['o_path'] = $this->hidden_image_path;

		$src = array();
		$dst = array();

		$src['path'] = $param['o_path'];
		$dst['path'] = $param['n_path'];

		// 썸네일 이미지 갱신 기간 (1주일)
		if(file_exists($dst['path'])){
			if(mktime() - filemtime($dst['path']) < 60 * 60 * 24 * 7)	return array('bool' => true, 'src' => $dst['path']);
		}

		$imginfo = getimagesize($src['path']);
		$src['mime'] = $imginfo['mime'];

		// 원본 이미지 리소스 호출
		switch($src['mime']){
			case 'image/jpeg' :	$src['img'] = imagecreatefromjpeg($src['path']);	break;
			case 'image/gif' :	$src['img'] = imagecreatefromgif($src['path']);		break;
			case 'image/png' :	$src['img'] = imagecreatefrompng($src['path']);		break;
			case 'image/bmp' :	$src['img'] = imagecreatefrombmp($src['path']);		break;
			// mime 타입이 해당되지 않으면 return false
			default :		return array('bool' => false, 'msg' => '이미지 파일이 아닙니다.');						break;
		}

		// 원본 이미지 크기 / 좌표 초기값
		$src['w'] = $imginfo[0];
		$src['h'] = $imginfo[1];
		$src['x'] = 0;
		$src['y'] = 0;

		// 썸네일 이미지 좌표 초기값 설정
		$dst['x'] = 0;
		$dst['y'] = 0;

		// 썸네일 이미지 가로, 세로 비율 계산
		$dst['ratio']['w'] = $src['w'] / $param['width'];
		$dst['ratio']['h'] = $src['h'] / $param['height'];

		switch($param['mode']){
			case 'ratio' :
				// 썸네일 이미지의 비율계산 (가로 == 세로)
				if($dst['ratio']['w'] == $dst['ratio']['h']){
					$dst['w'] = $param['width'];
					$dst['h'] = $param['height'];
				}
				// 썸네일 이미지의 비율계산 (가로 > 세로)
				elseif($dst['ratio']['w'] > $dst['ratio']['h']){
					$dst['w'] = $param['width'];
					$dst['h'] = round(($param['width'] * $src['h']) / $src['w']);
				}
				// 썸네일 이미지의 비율계산 (가로 < 세로)
				elseif($dst['ratio']['w'] < $dst['ratio']['h']){
					$dst['w'] = round(($param['height'] * $src['w']) / $src['h']);
					$dst['h'] = $param['height'];
				}

				if($param['fill_yn'] == 'Y'){
					$dst['canvas']['w'] = $param['width'];
					$dst['canvas']['h'] = $param['height'];
					$dst['x'] = $param['width'] > $dst['w'] ? ($param['width'] - $dst['w']) / 2 : 0;
					$dst['y'] = $param['height'] > $dst['h'] ? ($param['height'] - $dst['h']) / 2 : 0;
				}
				else{
					$dst['canvas']['w'] = $dst['w'];
					$dst['canvas']['h'] = $dst['h'];
				}
				break;
			case 'fixed' :
				// 썸네일 이미지의 비율계산 (가로 == 세로)
				if($dst['ratio']['w'] == $dst['ratio']['h']){
					$dst['w'] = $param['width'];
					$dst['h'] = $param['height'];
				}
				// 썸네일 이미지의 비율계산 (가로 > 세로)
				elseif($dst['ratio']['w'] > $dst['ratio']['h']){
					$dst['w'] = $src['w'] / $dst['ratio']['h'];
					$dst['h'] = $param['height'];

					$src['x'] = ($dst['w'] - $param['width']) / 2;
				}
				// 썸네일 이미지의 비율계산 (가로 < 세로)
				elseif($dst['ratio']['w'] < $dst['ratio']['h']){
					$dst['w'] = $param['width'];
					$dst['h'] = $src['h'] / $dst['ratio']['w'];

					$dst['y'] = 0;
				}
				$dst['canvas']['w'] = $param['width'];
				$dst['canvas']['h'] = $param['height'];
				break;
		}

		// 썸네일 이미지 리소스 생성
		$dst['img'] = imagecreatetruecolor($dst['canvas']['w'], $dst['canvas']['h']);

		// 배경색 처리
		if(in_array($src['mime'], array('image/png', 'image/gif'))){
			// 배경 투명 처리
			imagetruecolortopalette($dst['img'], false, 255);
			$bgcolor = imagecolorallocatealpha($dst['img'], 255, 255, 255, 127);
			imagefilledrectangle($dst['img'], 0, 0, $dst['canvas']['w'],$dst['canvas']['h'], $bgcolor);	
		}
		else{
			// 배경 흰색 처리
			$bgclear = imagecolorallocate($dst['img'],255,255,255);
			imagefill($dst['img'],0,0,$bgclear);
		}

		// 원본 이미지 썸네일 이미지 크기에 맞게 복사
		imagecopyresampled($dst['img'] ,$src['img'] ,$dst['x'] ,$dst['y'] ,$src['x'] ,$src['y'] ,$dst['w'] ,$dst['h'] ,$src['w'] ,$src['h']);

		// imagecopyresampled 함수 사용 불가시 사용
		//imagecopyresized($dst['img'] ,$src['img'] ,$dst['x'] ,$dst['y'] ,$src['x'] ,$src['y'] ,$dst['w'] ,$dst['h'] ,$src['w'] ,$src['h']);

		ImageInterlace($dst['img']);

		// 썸네일 이미지 리소스를 기반으로 실제 이미지 생성
		switch($src['mime']){
			case 'image/jpeg' :	imagejpeg($dst['img'], $dst['path']);	break;
			case 'image/gif' :	imagegif($dst['img'], $dst['path']);	break;
			case 'image/png' :	imagepng($dst['img'], $dst['path']);	break;
			case 'image/bmp' :	imagebmp($dst['img'], $dst['path']);	break;
		}

		// 원본 이미지 리소스 종료
		imagedestroy($src['img']);
		// 썸네일 이미지 리소스 종료
		imagedestroy($dst['img']);

		// 썸네일 파일경로 존재 여부 확인후 리턴
		return file_exists($dst['path']) ? array('bool' => true, 'src' => $dst['path']) : array('bool' => false, 'msg' => '파일 생성에 실패하였습니다.');
	}

}
