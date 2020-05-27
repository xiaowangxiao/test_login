<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Register extends Model
{
	protected $table = 'register';
	public $timestamps = false;
    //查询用户是否存在
    public function getRegisterUsername(array $data){
    	$userInfo = Register::where('username',$data['username'])->first();
    	return $userInfo;
    }
    public function setRegisterUserName(array $data){
    	$register = new Register;
    	$register->username = $data['username'];
    	$register->password = md5($data['password']);
    	$register->ctime = date('Y-m-d H:i:s',time());
    	$register->save();
    }
    
}
