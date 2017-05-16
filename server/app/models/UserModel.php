<?php

//https://github.com/illuminate/database/blob/master/Eloquent/Model.php

//https://laravel.kr/docs/5.2/eloquent

namespace App\Model;

use Illuminate\Database\Eloquent\Model as Model;

class UserModel extends Model{

	protected $table = 'user_info';
	protected $primaryKey = 'idx';
	public $timestamps = false;

	public function __construct(){
	}

	public function __destruct(){
	}

}