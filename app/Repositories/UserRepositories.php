<?php
namespace App\Repositories;
use App\Models\Register;
use App\Models\Login;
use App\Models\Pay;
class UserRepositories{
	protected $register;
	protected $login;
	protected $pay;
	public function __construct(){
		$this->register = new Register;
		$this->login = new Login;
		$this->pay = new Pay;
	}
	//校验用户名
	public function getRegisterUsername(array $user){
		return $this->register->getRegisterUsername($user);
	}
	//记录注册
	public function setRegisterUserName(array $user){
		return $this->register->setRegisterUserName($user);
	}
	//记录登录
	public function setLoginInfo(array $user){
		return $this->login->setLoginInfo($user);
	}
	//下单
	public function payOrder(array $data){
		return $this->pay->payOrder($data);
	}
}