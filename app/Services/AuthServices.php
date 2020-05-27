<?php
/*
*服务处理
*/
namespace App\Services;
use App\Repositories\UserRepositories;
class AuthServices{
	protected $userRepositories;
	public function __construct(){
		$this->userRepositories = new UserRepositories;
	}
	public function getUserName(array $data){
		return $this->userRepositories->getRegisterUsername($data);
	}
	public function setUserName(array $data){
		return $this->userRepositories->setRegisterUsername($data);
	}
	public function setLoginInfo(array $data){
		return $this->userRepositories->setLoginInfo($data);
	}
	public function payOrder(array $data){
		return $this->userRepositories->payOrder($data);

	}
}