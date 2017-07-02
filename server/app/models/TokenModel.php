<?php

//https://github.com/illuminate/database/blob/master/Eloquent/Model.php

//https://laravel.kr/docs/5.2/eloquent

namespace App\Model;

use Illuminate\Database\Eloquent\Model as Model;

class TokenModel extends Model{

	protected $table = 'users_token';
	protected $primaryKey = 'idx';
	public $timestamps = false;
	public $fillable = ['users_idx', 'user_token', 'expire_date'];

	public function __construct(){
	}

	public function __destruct(){
	}

	public function info($data){
		$obj = $this;
		foreach($data as $key=>$value){
			$obj = $obj->where($key, $value);
		}
		return $obj->first();
	}

	public function join($data){		
		foreach($data as $key=>$value){
			$this->$key=$value;
		}
		return $this->save();
	}

}