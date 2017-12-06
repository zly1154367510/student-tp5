<?php
namespace app\index\controller;
use think\Controller;
use think\Model;
use think\Db;
use think\Request;

class Cjmanage extends Controller
{
  public function CJview(){
  	$result = Db::table('student s,km k,km_student_cj ksc')->where("s.stu_num=ksc.stu_num and k.id = ksc.km_id")->select();
  
  	$this->assign("res",$result);
  	return $this->fetch();
  }
  // public function CJview1(){
  // 	$name = Request::instance()->param();
  //   $name1 = $name['name'];
  // 	$result = Db::table('student s,km k,km_student_cj ksc')->
  // 	where("s.stu_num=ksc.stu_num and k.id = ksc.km_id  ")->
  // 	where('stu_name',$name1)->
  // 	find();
  // 	    echo $name1;
	 //    echo '<table border="1" class="table" />';
		// echo '<tr><td>学号</td><td>姓名</td></tr>';
		// echo '<tr>';
		// echo '<td>'.$result['stu_num'].'</td>';
		// echo '<td>'.$result['stu_name'].'</td>';
		// echo '</tr>';
	
  // }
   public function CJview2(){
  	$num = Request::instance()->param();
    $num1 = $num['num'];
  	$result = Db::table('student s,km k,km_student_cj ksc')->
  	where("s.stu_num=ksc.stu_num and k.id = ksc.km_id  ")->
  	where('s.stu_num',$num1)->
  	select(); 
  	echo '<table border="1" class="table" />';
		echo '<tr><td>学号</td><td>姓名</td><td>班级</td><td>科目</td><td>成绩</td></tr>';
  	foreach ($result as $value) {	
	   
		echo '<tr>';
		echo '<td>'.$value['stu_num'].'</td>';
		echo '<td>'.$value['stu_name'].'</td>';
		echo '<td>'.$value['stu_class'].'</td>';
		echo '<td>'.$value['km_name'].'</td>';
		echo '<td>'.$value['cj'].'</td>';
		echo '</tr>';
		}
  }

  public function index(){
  	   $this->redirect("index\index\index");
  }

  public function deletecj(){
  	$id = Request::instance()->param();
    $result = Db::table('km_student_cj')->where('id',$id['id'])->delete();

    if ($result) {
    	$this->success("删除成功","index\Cjmanage\CJview");
    }else{
    	$this->success("删除失败","index\Cjmanage\CJview");
    }
  }

  public function editcj(){
  	$id = Request::instance()->param();
  	$id1 = $id['id'];
  	$result = Db::table('km_student_cj ksc,km k')->where("ksc.km_id = k.id and ksc.id = $id1")->find();
    $this->assign("res",$result);
    $this->assign("id",$id1);
    return $this->fetch();    
  }

  public function editcjdo(){
    $newCj = Request::instance()->param();
    $newKM = $newCj['km'];
    if ($newKM == "数学") {
    	# code...
    	$n = 1;
    }else if($newKM == "语文"){
    	$n = 2;
    }else{
    	$n = 3;
    }
    $result = Db::table("km_student_cj")->where("id",$newCj['id'])->update([
    	'km_id'=>$n,
        'cj'=>$newCj['cj']    
    	]);
  	 if ($result) {
    	$this->success("修改成功","index\Cjmanage\CJview");
    }else{
    	$this->success("修改失败","index\Cjmanage\CJview");
    }
  }
}
