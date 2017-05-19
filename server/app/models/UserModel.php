<?php

//https://github.com/illuminate/database/blob/master/Eloquent/Model.php

//https://laravel.kr/docs/5.2/eloquent

namespace App\Model;

use Illuminate\Database\Eloquent\Model as Model;

class UserModel extends Model{

	protected $table = 'users';
	protected $primaryKey = 'idx';
	public $timestamps = false;
	public $fillable = ['user_id', 'user_pwd', 'user_name', 'user_perm', 'reg_date'];

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

	public function modify($data, $where = array()){		
		$obj = $this;
		foreach($where as $key=>$value){
			$obj = $obj->where($key, $value);
		}
		return $obj->update($data);
	}

}