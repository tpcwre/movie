<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title><?php echo ($data["pname"]); ?></title>
<meta name='keywords' content='影视|影视在线|<?php echo ($data["pname"]); ?>' />
<meta name='description' contents='影视在线-><?php echo ($data["pname"]); ?>' />
<link href="/obj/movie/Public/bootstrap/bootstrap.css" rel="stylesheet">
<script src="/obj/movie/Public/bootstrap/jquery.min.js"></script>
<script src="/obj/movie/Public/bootstrap/bootstrap.js"></script>

<!--[if lt IE 9]>
  <script src="http://cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="http://cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<style>
[class*='col-']{
		margin-top:3px;
	}
  .row b{
    color:red;
  }
  #footer{
    margin-bottom:40px;
  }

  .p_i_s{
    color:blue;
    cursor:pointer;
  }
  #is,#ps{
    display:none;
  }
  .gay3{
    color:#A88CA8;
  }
  .pointers{
    cursor:pointer;
  }
  .blue3{
    color:#339BD5;
  }
</style>
<body>



<div class='container'>
 <h1><?php echo ($data["pname"]); ?></h1>
 <div>
	<span>2016-07-10</span>
	<span class='blue3 pointers'>　影视在线</span>
 </div>
 <hr> 
 
  <div style='margin-bottom:10px'>
	<span><a href='/obj/movie/Home/Index/index/pnow/<?php echo ($pnow); ?>'>影视在线</a></span>->
	<span><?php echo ($data["pname"]); ?></span>

 </div>
  <div class='row'>
  <div class='col-xs-4 col-sm-2'>
	<div style='border:1px solid;height:100px;'>
		<img src='<?php echo ($data["img"]); ?>' width=100% height=100px/>
	</div>
  </div>
  
  <div class='col-xs-8 col-sm-10 '>
	<div class='row vedio_list'>
		<div class='col-xs-12'><b>片名：</b><?php echo ($data["pname"]); ?></div>
		<div class='col-xs-12'><b>集数：</b><?php echo ($data["pnum"]); ?></div>
		<div class='col-xs-12'><b>播放次数：</b>3515</div>
	</div>
  </div>
</div>
<div class='row' id='p_i'>
	<div class='col-xs-12'><b>主演：</b><?php echo ($data["players"]); ?></div>
	<div class='col-xs-12'><b>简介：</b><?php echo ($data["info"]); ?></div>
</div>
<hr>

 
<div class='row'>
  <?php if(is_array($data2)): $i = 0; $__LIST__ = $data2;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo2): $mod = ($i % 2 );++$i;?><div class='col-md-1 col-sm-2 col-xs-3'><a href='<?php echo ($vo2["plink"]); ?>' class='btn btn-success'>第<?php echo ($vo2["porder"]); ?>集</a></div><?php endforeach; endif; else: echo "" ;endif; ?>
</div>



 <div id='footer' class='row' style='margin-top:20px'>
  <div class='col-xs-9 gay3' >
    <span>阅读 100000+　</span>
    
    <span class='pointers'>
    <img src='http://qianxing.b0.upaiyun.com/public/zhan1.png' align='bottom'>
    <span >100000+</span>
    <span>
    
  </div>
  <div class='col-xs-3 text-right'>
    <span class='pointers blue3' style=''>举报</span>
  </div>
 </div>

</div>











</body>
</html>