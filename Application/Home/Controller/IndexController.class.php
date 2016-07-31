<?php
namespace Home\Controller;
use Think\Controller;
use Think\Model;
class IndexController extends Controller {

/*
*分页设置
*@param     $count      总条数
*@param     $pcount     每页条数
*@param     $order      要显示的页数，默认为5页
*@retrun    pnow        当前页
*           min         遍历起始数
*           max         遍历最大数
*           pnum        总页数
*
*/
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


    public function index(){
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
//	$data = $m->where($map)->select();
    
	
        $last = $arr['pnow']-5;
        $next = $arr['pnow']+5<$arr['pnum']?$arr['pnow']+5:$arr['pnum'];

        $this->assign('last',$last);
        $this->assign('next',$next);
        $this->assign('pnow',$arr['pnow']);
        $this->assign('max',$arr['max']);
        $this->assign('min',$arr['min']);
        $this->assign('pnum',$arr['pnum']);
 
      //  dump($data);exit;
    	session('data',$data);
    	$this->assign('data',$data);
        $this->assign('a',1);
        $this->display();
    }







    public function index2(){
    	$id = I('get.id');
        $pnow = I('get.pnow');
        $m = M(C('t1'));
        $data1 = $m->where("id=$id")->select();
       // msg($data1);
        $m2 = M(C('t2'));
        $data2 = $m2->where("uid=$id")->select();
       // msg($data2);
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
        $this->assign('data',$data1[0]);
    	$this->display('index2');
   
    }




}
