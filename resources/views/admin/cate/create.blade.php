<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <title>微商城- 商品分类</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>
<body>

<nav class="navbar navbar-inverse" role="navigation">
	<div class="container-fluid">
    <div class="navbar-header">
        <a class="navbar-brand" href="#">微商城</a>
    </div>
    <div>
        <ul class="nav navbar-nav">
            <li><a href="{{url('/brand/index')}}">商品品牌</a></li>
            <li class="active"><a href="{{url('/cate/index')}}">商品分类</a></li>
            <li><a href="{{url('/goods/index')}}">商品管理</a></li>
            <li><a href="{{url('/admin/index')}}">管理员管理</a></li>

            <!-- <li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                    Java <b class="caret"></b>
                </a>
                <ul class="dropdown-menu">
                    <li><a href="#">jmeter</a></li>
                    <li><a href="#">EJB</a></li>
                    <li><a href="#">Jasper Report</a></li>
                    <li class="divider"></li>
                    <li><a href="#">分离的链接</a></li>
                    <li class="divider"></li>
                    <li><a href="#">另一个分离的链接</a></li>
                </ul>
            </li> -->
        </ul>
    </div>
	</div>
</nav>

<center>
<h1>分类管理</h1>
</center>
<form class="form-horizontal" role="form" method="post" action="{{url('/cate/store')}}">
@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">分类名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="firstname" name="cate_name"
				   placeholder="请输入分类名称">
                   <span style="color:red">{{$errors->first('cate_name')}}</span>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">父级分类</label>
		<div class="col-sm-10">
            <select class="form-control" id="lastname" name="pid">
                <option value="0">--请选择--</option>
                @foreach($cateInfo as $k=>$v)
                <option value="{{$v->cate_id}}">{{str_repeat('|——',$v->level)}}{{$v->cate_name}}</option>
                @endforeach
            </select>
            <b style="color:red">{{$errors->first('pid')}}</b>       
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否显示</label>
		<div class="col-sm-2">
			<input type="radio" id="lastname" name="is_show" value="1" checked>是
            <input type="radio" id="lastname" name="is_show" value="2">否
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否导航显示</label>
		<div class="col-sm-10">
            <input type="radio" id="lastname" name="is_nav_show" value="1">显示
            <input type="radio" id="lastname" name="is_nav_show" value="2" checked>不显示
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">分类描述</label>
		<div class="col-sm-10">
			<textarea type="text" class="form-control" name="cate_desc" id="lastname"></textarea>
            <span style="color:red">{{$errors->first('cate_desc')}}</span>
		</div>
	</div>
	
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="button" class="btn btn-default">提交</button>
		</div>
	</div>
</form>

</body>
</html>
<script>
	$('input[name="cate_name"]').blur(function(){
		$(this).next().empty();
		var cate_name = $(this).val();
		// alert(cate_name);
		var reg = /^[\u4e00-\u9fa5\w]{2,50}$/;
		//验证规则
		if(!reg.test(cate_name)){
			$(this).next().text('分类名称可以包含中文、数字、字母、下划线且唯一，长度范围为2-50位');
			return;
		}

		//验证唯一性
		$.ajaxSetup({ headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

		$.post('/cate/checkName',{cate_name:cate_name},function(res){
			// alert(res);
			if(res>0){
				$('input[name="cate_name"]').next().text('分类名称已存在');
			}
		})
	})

	$('button').click(function(){
		var cate_name = $('input[name="cate_name"]').val();
		if(!cate_name){
			$('input[name="cate_name"]').next().text('分类名称必填');
			return;
		}
		var reg = /^[\u4e00-\u9fa5\w]{2,50}$/;
		//验证规则
		if(!reg.test(cate_name)){
			$('input[name="cate_name"]').next().text('分类名称可以包含中文、数字、字母、下划线且唯一，长度范围为2-50位');
			return;
		}

		var flag = true;
		//验证唯一性
		$.ajaxSetup({ headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
		$.ajax({
			type:"post",
			url:"/cate/checkName",
			data:{cate_name:cate_name},
			async:false,
			success:function(msg){
				//alert(msg);
				if(msg>0){
					$('input[name="cate_name"]').next().text('分类名称已存在');
					flag = false;
				}
			}
		});

		if(!flag) return;

		var cate_desc = $('textarea[name="cate_desc"]').val();
		if(!cate_desc){
			$('textarea[name="cate_desc"]').next().text('分类描述不能为空');
			return;
		}

		$('form').submit();



	})
</script>