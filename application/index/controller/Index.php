<?php
namespace app\index\controller;
use think\Controller;
use think\Db;
use think\Request;


class Index extends Controller
{
    public function index(){
        $result = Db::table('student')->select();

        $this->assign("res",$result);
        return $this->fetch();    
    }

    //退出登录
    public function canceLogin(){
        session(null);
        $this->success("退出登录成功","index\login\login");
       
    }

    //修改密码界面
    public function editpwdye(){
        return $this->fetch();
    }

    //修改密码
    public function EditPwdYeDo(){
        $username = session("username");
        $password = Db::table("login")->where("username",$username)->find();
        $newPWD = Request::instance()->param();
        if ($password['password'] == $newPWD['password']&&$newPWD['newPWD'] == $newPWD['newPWD1']) {
           $result = Db::table("login")->where("username",$username)->update(['password'=>$newPWD['newPWD']
            ]);
           if ($result) {
                session(null);
                return $this->success("修改成功请重新登录","index\login\login");
           }else{
              return $this->success("修改失败","index\index\EditPWDYe");
           }
        }else{
             return $this->success("原密码错误","index\index\EditPWDYe");
        }
       
    }
    //修改学生信息界面
    public function EditStu(){
        $stu_num = Request::instance()->param("num");
        $result = Db::table('student')->where("stu_num",$stu_num)->find();
        $this->assign("r",$result);
        return $this->fetch();
    }
     
    public function EditStuDo(){
        $postRequest = Request::instance()->param();
        $result = Db::table("student")->where("stu_num",$postRequest['num'])->update([
            'stu_name'=>$postRequest['name'],
            'stu_sex'=>$postRequest['sex'],
            'stu_class'=>$postRequest['class']
            ]);
        if ($result) {
            # code...
            $this->success("更新成功","index\index");
        }else{
             $this->success("更新失败","index\index");
        }
    }

    //删除学生信息
    function deleteStu(){
        $stu_num = Request::instance()->param();
        $result = Db::table("student")->where("stu_num",$stu_num['num'])->delete();
        if ($result) {
           $this->success("删除成功","index\index");
        }else{
             $this->success("删除失败","index\index");
        }
    }

    //跳转到添加学生信息界面
    function addStu(){
        $this->redirect("index\AddStu\addstu");
    }

     function Cjmanage(){
        $this->redirect("index\Cjmanage\cjview");
    }


  
          

    public function db(){
    	//助手函数
    	$db = db('think_user');
    	$db->insert(["username"=>"222","password"=>"222"]);
    	//Db::table 选择查询数据库
    	//插入数据
    	// $result = Db::table("think_user")->insert(['username'=>'111','password'=>'1111']);
    	
    	// dump($result);

    	//查询数据 
    	//where条件
    	//update 更新内容
    	// $result=Db::table('think_user')->where('username', '111')->update(['username' => 'thinkphp']);

    	//查询
        //where查询条件
        //select()执行查询
    	// $result = Db::table("think_user")->where("username","thinkphp")->select();
    	// dump($result);

    	//删除
    	//table
    	//where
    	//delete
    	// $result = Db::table("think_user")->where("id",2)->delete();
    	
    }
}
