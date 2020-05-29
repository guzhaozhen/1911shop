<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>微商城- 商品品牌</title>
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
            <li class="active"><a href="{{url('/brand/index')}}">商品品牌</a></li>
            <li><a href="{{url('/cate/index')}}">商品分类</a></li>
            <li><a href="{{url('/brand/index')}}">商品管理</a></li>
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
<h1>商品品牌</h1><hr/>
<span style="float:right;"><a href="{{url('/brand/index')}}">列表</a></span>
</center>

<!-- @if ($errors->any()) 
<div class="alert alert-danger"> 
	<ul>@foreach ($errors->all() as $error) 
		<li>{{ $error }}</li> @endforeach
	</ul>
 </div>
 @endif -->



<form class="form-horizontal" role="form" method="post" action="{{url('/brand/store')}}" enctype="multipart/form-data">
    @csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">品牌名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="brand_name" id="firstname" 
				   placeholder="请输入品牌名称">
				   <!-- 第二种验证方式 -->
				   <span style="color:red">{{$errors->first('brand_name')}}</span>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">品牌网址</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" name="brand_url" id="lastname" 
				   placeholder="请输入品牌网址">
				   <span style="color:red">{{$errors->first('brand_url')}}</span>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">品牌LOGO</label>
		<div class="col-sm-10">
			<input type="file" class="form-control" name="brand_logo" id="lastname">
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">品牌描述</label>
		<div class="col-sm-10">
			<textarea type="text" class="form-control" id="lastname" name="brand_desc"></textarea>
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
	$('input[name="brand_name"]').blur(function(){
		$(this).next().empty();
		var brand_name = $(this).val();
		// alert(brand_name);
		var reg = /^[\u4e00-\u9fa5\w]{2,50}$/;
		//验证规则
		if(!reg.test(brand_name)){
			$(this).next().text('品牌名称可以包含中文、数字、字母、下划线且唯一，长度范围为2-50位');
			return;
		}

		//验证唯一性
		$.ajaxSetup({ headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

		$.post('/brand/checkName',{brand_name:brand_name},function(res){
			// alert(res);
			if(res>0){
				$('input[name="brand_name"]').next().text('品牌名称已存在');
			}
		})
	})

	$('button').click(function(){
		var brand_name = $('input[name="brand_name"]').val();
		if(!brand_name){
			$('input[name="brand_name"]').next().text('品牌名称必填');
			return;
		}
		var reg = /^[\u4e00-\u9fa5\w]{2,50}$/;
		//验证规则
		if(!reg.test(brand_name)){
			$('input[name="brand_name"]').next().text('品牌名称可以包含中文、数字、字母、下划线且唯一，长度范围为2-50位');
			return;
		}

		var flag = true;
		//验证唯一性
		$.ajaxSetup({ headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
		$.ajax({
			type:"post",
			url:"/brand/checkName",
			data:{brand_name:brand_name},
			async:false,
			success:function(msg){
				//alert(msg);
				if(msg>0){
					$('input[name="brand_name"]').next().text('品牌名称已存在');
					flag = false;
				}
			}
		});

		if(!flag) return;

		var brand_url = $('input[name="brand_url"]').val();
		if(!brand_url){
			$('input[name="brand_url"]').next().text('品牌网站不能为空');
			return;
		}
		$('form').submit();
	})
</script>