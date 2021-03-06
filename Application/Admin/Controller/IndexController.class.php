<?php
namespace Admin\Controller;
use Think\Controller;
class IndexController extends Controller {
    private function fpage($count,$pcount,$order=5){
        $pnum = ceil($count/$pcount);   //总页数
        $pnow = I('get.pnow')?:1;       //当前页
        $pnow = $pnow>0?$pnow:1;
        $order1 = ($order-1)/2;
        $order2 = $order-1;

        if($pnow-$order1>0){
            $min = $pnow-$order1;
        }else{
            $min = 1;
        }

        if($min+$order2<$pnum){
            $max = $min+$order2;
        }else{
            $max = $pnum;
        }
        if($pnum > $order2 && $pnow > $pnum-$order1){
            $min = $pnum-$order2;
        }

        return array('pnow'=>$pnow,'min'=>$min,'max'=>$max,'pnum'=>$pnum);
    }

    public function islogin(){
        if(!I('session.username')){
            $this->redirect('login_begin');exit;
        }
    }

    public function index(){
        $this->islogin();
        $m = M(C('t1'));
        $pcount = 12;                    //每页条数
        $vsum =5;                       //要显示页数
        $arra1 = I('post.');
        if(!$arra1['searchContent'] || !$arra1['searchType']){
                $where='';
        }else{
                $str = '%'.$arra1['searchContent'].'%';
                $map[$arra1['searchType']]=array('like',$str);
                $this->assign('searchContent',$arra1['searchContent']);
                $this->assign('searchType',$arra1['searchType']);
                $param = '/searchContent/'.$arra1['searchContent'].'/searchType/'.$arra1['searchType'];
                $this->assign('param',$param);
                if($arra1['searchType']=='players'){
                        $this->assign('players','selected');
                }else{
                        $this->assign('pname','selected');
                }
        }
        if(I('get.searchContent')){
                $param = '/searchContent/'.I('get.searchContent').'/searchType/'.I('get.searchType');
                $this->assign('param',$param);
                $this->assign('searchContent',I('get.searchContent'));
                $this->assign('searchType',I('get.searchType'));
                $str = '%'.I('get.searchContent').'%';
                $map[I('get.searchType')]=array('like',$str);
                if(I('get.searchType')=='players'){
                        $this->assign('players','selected');
                }else{
                        $this->assign('pname','selected');
                }
        }
        $count = $m->where($map)->count();           //总条数
        $arr = $this->fpage($count,$pcount,$vsum);
        $data = $m->page($arr['pnow'],$pcount)->order('id desc')->where($map)->select();
        $last = $arr['pnow']-5;
        $next = $arr['pnow']+5<$arr['pnum']?$arr['pnow']+5:$arr['pnum'];
        $this->assign('last',$last);
        $this->assign('next',$next);
        $this->assign('pnow',$arr['pnow']);
        $this->assign('max',$arr['max']);
        $this->assign('min',$arr['min']);
        $this->assign('pnum',$arr['pnum']);
        session('data',$data);
        $this->assign('data',$data);
        $this->assign('a',1);
        $this->display();
    }


    //专辑编辑
    public function edit(){

        $this->islogin();
        $pnow = I('get.pnow');
    	$id = I('get.id');
        $m = M(C('t1'));
        $arr = $m->where("id=$id")->select();
    	$this->assign('pnow',$pnow);
    	$this->assign('data2',$arr[0]);
    	$this->display();
    }




    //专辑编辑处理
    public function edit_c(){
        $this->islogin();
        $pnow = I('get.pnow');
        $data = I('post.');
        $id = $data['id'];
        unset($data['id']);
        $m = M(C('t1'));
        $stat = $m->data($data)->where("id=$id")->save();
        $this->redirect('index',array('pnow'=>$pnow));
    }





    //添加专辑
    public function add(){
        $this->islogin();
        $this->display();        
    }

    //添加专辑处理
    public function add_c(){
        $this->islogin();
        $arr = I('post.');
        $arr['id']=null;
        $m = M(C('t1'));
        $stst = $m->data($arr)->add();
        $this->redirect('index');
    }




    //删除专辑
    public function del(){
        $this->islogin();
        $pnow = I('get.pnow');
        $id = I('get.id');
        $m1 = M(C('t2'));
        $arr = $m1->where("uid=$id")->limit(1)->select();
        if(!$arr){
            $m2 = M('Index1');
            $m2->where("id=$id")->delete();
        }
        $this->redirect('index',array('pnow'=>$pnow));
    }






    //专辑管理主页面
    public function control(){
        $this->islogin();
        $pnow = I('get.pnow');
        $uid = I('get.id');
        $m1 = M(C('t1'));
        $data = $m1->where("id=$uid")->select();
        $m2 = M(C('t2'));
        $data2 = $m2->where("uid=$uid")->select();
        for($i=0;$i<count($data2)-1;$i++){
            for($j=0;$j<count($data2)-1;$j++){
                if($data2[$j]['porder'] > $data2[$j+1]['porder']){
                    $tmp = $data2[$j];
                    $data2[$j]=$data2[$j+1];
                    $data2[$j+1]=$tmp;
                }
            }
        }
       
        $this->assign('data2',$data2);
        $this->assign('pnow',$pnow);
        $this->assign('data',$data[0]);
        $this->display();
    }




    //专辑管理-添加单集
    public function control_add(){
        $this->islogin();
        $arr = I('post.');
        $arr['id']=null;
       // msg($arr);
        $m = M(C('t2'));
        $m->data($arr)->add();
        $this->redirect('control',array('id'=>$arr['uid']));
    }



    //专辑管理-删除
    public function control_del(){
        $this->islogin();
        $delid = I('get.delid');
        $id = I('get.id');
        if($id){
            $m = M(C('t2'));
            $m->where("id=$delid")->delete();
        }
        $this->redirect('control',array('id'=>$id));

    }


    //专辑管理-删除全部
    public function delAll(){
        $this->islogin();
        $uid = I('get.uid');
        $m = M(C('t2'));
        $m->where("uid=$uid")->delete();
        $this->redirect('control',array('id'=>$uid));
    }



    //验证码
    public function verify(){
        ob_clean();
        $config = array(
            'imageH'=>50,       //设置图片高度
            'imagew'=>120,      //设置图片宽度
            'fontttf'=>'6.ttf', //设置字体 
            'length'    =>  4,               // 验证码位数
            'useCurve'  =>  false,            // 是否画混淆曲线
        );
        $verify = new \Think\Verify($config);   //使用自定义样式
        $verify->entry();       //生成验证码
    }


    public function login_begin(){
       // echo 1;
        header('location:'.U('login'));
    }


    //登陆
    public function login(){
        if(I('session.loginError')){
            $this->assign('loginError',I('session.loginError'));
        }
        $this->display();
    }


    public function login_c(){
        $arr = I('post.');

        $d = D('User');
        $z = $d->create();
        if(!$z){
            $loginError = $d->getError();
            session('loginError',$loginError);
            $this->redirect('login');exit;
        }
        $verify = new \Think\Verify();
        if(!$verify->check($arr['vcode'])){
            session('loginError','验证码输入不正确！');
            $this->redirect('login');exit;
        }
        session('loginError',null);
        $st = $d->loginVerify($arr['username'],$arr['password']);
        if($st){
          //  echo 1;exit;
            $this->redirect('index');exit;
        }else{
          //  echo 2;exit;
            session('loginError','用户名或密码不正确！');
            $this->redirect('login');exit;
        }

    }



    //退出 
    public function exits(){
        session(null);
        header("location:".U('login_begin'));
    }

}
