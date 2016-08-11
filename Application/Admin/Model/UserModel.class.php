<?php
namespace Admin\Model;
use Think\Model;
class UserModel extends Model{

	protected $_validate = array(
		array('username','require','用户名不得为空'),
		array('password','require','密码不得为空'),
		array('vcode','require','验证码不得为空'),
	);

	public function loginVerify($username,$password){
		$arr = $this->where("username='$username'")->find();
		dump($arr);
		if(md5($password)==$arr['password']){
			session('username',$username);
			session('userid',$arr['id']);
			return true;
		}else{
			return false;
		}
	}

}

