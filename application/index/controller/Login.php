<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\Login as LoginModel;


class Login extends Controller{

	public function login(){
		return $this->fetch();
	}

	public function check(){
		$data = input("post.");
		$login = new LoginModel();
	    $result = $login->where("username",$data['username'])->find();
	    if ($result) {
	    	if ($result["password"] == $data["password"]) {
	    		if(!captcha_check($data['core'])){
	    		 	$this->error("验证码不正确");
	    	    }else{
	    	    	session("username",$data['username']);
	    		   $this->success("登陆成功","index\index");
	    	    }
	    	}else{
	    		$this->error("密码不正确");
	    	}
	    }else{
           $this->error("用户名不存在");
	    }
	}




}
?>