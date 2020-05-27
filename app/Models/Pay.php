<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;
class Pay extends Model
{
	protected $table = 'pay';
	public $timestamps = false;
	public function payOrder(array $data){
		$pay = new Pay;
		$pay->username = $data['username'];
		$pay->order = $this->create_order();
		$pay->money = $data['money'];
		$pay->ctime = date('Y-m-d H:i:s',time());
		return $pay->save();
	}
	public function create_order(){
		mt_srand((double) microtime() * 1000000);
    	/* 年月日 + 6位随机数 */
    	return  date('Ymd') . str_pad(mt_rand(1, 999999), 6, '0', STR_PAD_LEFT);
	}
}