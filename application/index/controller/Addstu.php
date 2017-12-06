<?php
namespace app\index\controller;
use think\Controller;
use think\Request;
use think\Db;
class AddStu extends Controller
{
	public function addstu(){
		return $this->fetch();
	}

	public function addstuDo(){
		$data = Request::instance()->param();
		$result = Db::table("student")->insert([
			'stu_num' => $data['stuNum'],
			'stu_name' => $data['name'],
			'stu_sex' => $data['sex'],
			'stu_class' => $data['class']	
		]);
		if ($result) {
			$this->success("添加成功","index\index");
		}else{
			$this->success("添加失败","index\index");
		}
	}
}