<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use DB;
use App\Services\AuthServices;
class UserController extends Controller{
	public function show($tips=array()){
		return view('user.show',['tips'=>array_values($tips)]);
	}
	/*
	*注册接口
	*/
	public function register(AuthServices $authServices,Request $request){
		$a =1222;
		$message = [
			'username.required'=>'用户名不能为空',
			'password.required'=>'密码不能为空',
			'username.unique'=>'用户名已存在',
		];
		$params = $request->all();
		$validator = Validator::make($params,['username'=>'required|unique:register',
				'password'=>'required'],$message);
		if($validator->fails()){
			return redirect('user/show')->withErrors($validator)->withInput();
		}
		
		//services验证账号是否存在
		// $user = $authServices->getUserName($params); //测试service处理业务，repositories处理数据。
		// if($user){
		// 	//账号存在
		// 	return view('register.show',['tips'=>'账号已存在']);
		// }
		$result = $authServices->setUserName($params);
		return view('user.register',['result'=>$result]);

	}
	/*
	*登录接口
	*/
	public function login(AuthServices $authServices,Request $request){
		$a =1222;
		$message = [
			'username.required'=>'用户名不能为空',
			'password.required'=>'密码不能为空',
		];
		$params = $request->all();
		$validator = Validator::make($params,['username'=>'required',
				'password'=>'required'],$message);
		if($validator->fails()){
			return redirect('user/show')->withErrors($validator)->withInput();
		}

		$user = $authServices->getUserName($params);
		if(!$user || $user['password'] != md5($params['password'])){
			//账号存在
			return view('user.show',['tips'=>'账号或密码错误']);
		}
		$authServices->setLoginInfo($params);
		return view('user.login',['user'=>$user]);

	}
	/*
	*下单
	*/
	public function pay(AuthServices $authServices,Request $request){
		$a=222;
		$message = [
			'username.required'=>'用户名不能为空',
			'money.required'=>'下单金额不能为空',
			'money.numeric' => '下单金额必须为整数'
		];
		$params = $request->all();
		$validator = Validator::make($params,[
			'username'=>'required',
			'money'=>'required|numeric'
		],$message);
		if($validator->fails()){
			return redirect('user/show')->withErrors($validator)->withInput();
		}
		$user = $authServices->getUserName($params);
		if(!$user){
			return view('user.show',['tips'=>'账号不存在']);
		};

		//下单
		$payInfo = $authServices->payOrder($params);
		if($payInfo){
			$tips = '下单成功';
		}else{
			$tips = '下单失败';
		}
		return view('user/show',['tips'=>$tips]);

	}
	  public function sql_dump()
	  {  

	  	dd(111122);
	    \DB::listen(function ($sql) {
	      $i = 0;
	      $bindings = $sql->bindings;
	      $rawSql = preg_replace_callback('/\?/', function ($matches) use ($bindings, &$i) {
	        $item = isset($bindings[$i]) ? $bindings[$i] : $matches[0];
	        $i++;
	        return gettype($item) == 'string' ? "'$item'" : $item;
	      }, $sql->sql);
	      echo $rawSql, "\n<br /><br />\n";
	    }); 
	}
}