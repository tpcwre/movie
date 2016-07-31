<?php if (!defined('THINK_PATH')) exit();?><!DOCTYPE html>
<html lang="zh-CN">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>影视在线</title>
<meta name='keywords' content='电视剧|影视在线|' />
<meta name='description' contents='看电视剧尽在影视在线' />
<link href="/obj/movie/Public/bootstrap/bootstrap.css" rel="stylesheet">
<script src="/obj/movie/Public/bootstrap/jquery.min.js"></script>
<script src="/obj/movie/Public/bootstrap/bootstrap.js"></script>

<!--[if lt IE 9]>
  <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
  <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
<![endif]-->
</head>
<style>
	[class*='col-']{
		margin-top:3px;
		
		word-break:break-all;
	}
	.vedio_list > div:nth-child(2),.vedio_list > div:nth-child(3){
		margin-top:8px;
	}
	.row b{
		color:red;

	}
	#footer{
		margin-bottom:40px;
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
	.p_i_2{
		color:blue;
		cursor:pointer;
	}
	.pis{
		display:none;
	}
</style>
<body>
<div class='container'>
 <h1>影视在线</h1>
 <div>
	<span>2016-07-10</span>
	<span class='blue3 pointers'>　影视在线</span>

 </div>
 <hr> 



<form class="form-inline" method='post' action='/obj/movie/Home/Index/index'>
  <div class="form-group">
    <input type="text" class="form-control" id="exampleInputName2" placeholder="查找......" name='searchContent' value='<?php echo ($searchContent); ?>'>
  </div>
  <div class="form-group">

	<select class="form-control" name='searchType'>
		<option value='pname' <?php echo ($pname); ?>>按片名</option>
		<option value='players' <?php echo ($players); ?>>按演员</option>
	</select>
  </div>
  <button type="submit" class="btn btn-default"><span class='glyphicon glyphicon-search'></span></button>
</form>










 

<br>
<div class='row'>
<?php if(is_array($data)): $i = 0; $__LIST__ = $data;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$vo): $mod = ($i % 2 );++$i;?><div class='col-sm-6 col-md-6 col-lg-4' style=';padding:10px;border:1px solid #ccc;margin-bottom:10px'>
		<div class='row'>
			<div class='col-xs-4 col-sm-4' style=''>
				<img src='<?php echo ($vo["img"]); ?>' width=100% height=100px/>
			</div>
			<div class='col-xs-8 col-sm-8' style=''>
				<div class='row'>
					<div class='col-xs-12'><b>片名：</b><?php echo ($vo["pname"]); ?></div>
					<div class='col-xs-12'><b>集数：</b><?php echo ($vo["pnum"]); ?></div>
					<div class='col-xs-12'><a href='/obj/movie/Home/Index/index2/pnow/<?php echo ($pnow); ?>/id/<?php echo ($vo["id"]); ?>' class='btn btn-info'>点击观看</a></div>
				</div>
			</div>
		</div>
			<div class='row p_i'>
				<div class='col-xs-12'><b>主演：</b><span id='p<?php echo ($a); ?>'></span><span class='p_i_2' id='pz<?php echo ($a); ?>'>.....展开</span><span class='pis p_i_2' id='ps<?php echo ($a); ?>'>　收起</span></div>
				<div class='col-xs-12'><b>简介：</b><span id='i<?php echo ($a); ?>'></span><span class='p_i_2' id='iz<?php echo ($a); ?>'>.....展开</span><span class='pis p_i_2' id='is<?php echo ($a); ?>'>　收起</span></div>
			</div>
	</div>
<script>
	$(function(){
		var strp = '<?php echo ($vo["players"]); ?>';
		var strp2 = strp.substring(0,3);
		$('#p<?php echo ($a); ?>').html(strp2);

		$('#pz<?php echo ($a); ?>').click(function(){
			$('#p<?php echo ($a); ?>').html(strp);
			$('#pz<?php echo ($a); ?>').hide();
			$('#ps<?php echo ($a); ?>').show();
		});
		$('#ps<?php echo ($a); ?>').click(function(){
			$('#p<?php echo ($a); ?>').html(strp2);
			$('#ps<?php echo ($a); ?>').hide();
			$('#pz<?php echo ($a); ?>').show();
		});
		var stri='<?php echo ($vo["info"]); ?>';
		var stri2 = stri.substring(0,15);
		$("#i<?php echo ($a); ?>").html(stri2);
		$('#iz<?php echo ($a); ?>').click(function(){
			$('#i<?php echo ($a); ?>').html(stri);
			$('#iz<?php echo ($a); ?>').hide();
			$('#is<?php echo ($a); ?>').show();
		});
		$('#is<?php echo ($a); ?>').click(function(){
			$('#i<?php echo ($a); ?>').html(stri2);
			$('#is<?php echo ($a); ?>').hide();
			$('#iz<?php echo ($a); ?>').show();
		});
	});

</script>
<div style='display:none'><?php echo ($a++); ?></div><?php endforeach; endif; else: echo "" ;endif; ?>
</div>
<br>

<nav>
  <ul class="pagination">
    <li>
      <a href="/obj/movie/Home/Index/index/pnow/<?php echo ($last); echo ($param); ?>" aria-label="Previous">
        <span aria-hidden="true">&laquo;</span>
      </a>
    </li>
    	<?php $__FOR_START_140061536__=$min;$__FOR_END_140061536__=$max;for($k=$__FOR_START_140061536__;$k <= $__FOR_END_140061536__;$k+=1){ if($pnow == $k): ?><li ><a style='background:#cff' href="/obj/movie/Home/Index/index/pnow/<?php echo ($k); echo ($param); ?>"><?php echo ($k); ?></a></li>
    		<?php else: ?>
    		<li><a href="/obj/movie/Home/Index/index/pnow/<?php echo ($k); echo ($param); ?>"><?php echo ($k); ?></a></li><?php endif; } ?>
    <li>
      <a href="/obj/movie/Home/Index/index/pnow/<?php echo ($next); echo ($param); ?>" aria-label="Next">
        <span aria-hidden="true">&raquo;</span>
      </a>
    </li>
    <li>
        <span aria-hidden="true">......</span>
    </li>

    <li>
    	<span aria-hidden="true">
        <select style='height:20px' id='go_v'>
        	<?php $__FOR_START_1766109323__=1;$__FOR_END_1766109323__=$pnum;for($k=$__FOR_START_1766109323__;$k <= $__FOR_END_1766109323__;$k+=1){ if($pnow == $k): ?><option selected><?php echo ($k); ?></option>
        		<?php else: ?>
					<option><?php echo ($k); ?></option><?php endif; } ?>
        </select>
    	</span>
    </li>
    <li>
      <a href="#" aria-label="Previous">
        <span aria-hidden="true" id='go'>go</span>
      </a>
      <script>
      	$(function(){
      		$('#go').click(function(){
      			var pv = $('#go_v').val();
      			location.href="/obj/movie/Home/Index/index/pnow/"+pv+'<?php echo ($param); ?>';
      		});
      	});
      </script>
    </li>
  </ul>
</nav>




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