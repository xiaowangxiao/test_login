<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Login extends Model
{
	protected $table = 'login';
	public $timestamps = false;
    public function setLoginInfo(array $data){
    	$login = new Login;
    	$login->username = $data['username'];
    	$login->logintime = date('Y-m-d H:i:s',time());
    	$login->save();
    }

}
