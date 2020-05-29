<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8"> 
	<title>微商城- 商品品牌</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
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
            <li><a href="{{url('/cate/index')}}">商品分类</a></li>
            <li><a href="{{url('/goods/index')}}">商品管理</a></li>
            <li class="active"><a href="{{url('/admin/index')}}">管理员管理</a></li>

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
<h1>管理员管理</h1><hr/>
<span style="float:right;"><a href="{{url('/admin/index')}}">列表</a></span>
</center>

<!-- @if ($errors->any()) 
<div class="alert alert-danger"> 
	<ul>@foreach ($errors->all() as $error) 
		<li>{{ $error }}</li> @endforeach
	</ul>
 </div>
 @endif -->



<form class="form-horizontal" role="form" method="post" action="{{url('/admin/update/'.$adminInfo->admin_id)}}" enctype="multipart/form-data">
    @csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">管理员名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" value="{{$adminInfo->admin_name}}" name="admin_name" id="firstname" 
				   placeholder="请输入管理员名称">
				   <!-- 第二种验证方式 -->
				   <b style="color:red">{{$errors->first('admin_name')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">管理员手机号</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" value="{{$adminInfo->admin_tel}}" name="admin_tel" id="lastname" 
				   placeholder="请输入管理员手机号">
				   <b style="color:red">{{$errors->first('admin_tel')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">管理员邮箱</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" value="{{$adminInfo->admin_email}}" name="admin_email" id="lastname" 
				   placeholder="请输入管理员邮箱">
				   <b style="color:red">{{$errors->first('admin_email')}}</b>
		</div>
	</div>
	
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">管理员头像</label>
		<div class="col-sm-2">
			<input type="file" class="form-control" name="admin_logo" id="lastname">
           
		</div>
 @if($adminInfo->admin_logo)
				<img src="{{env('UPLOADS_URL')}}{{$adminInfo->admin_logo}}" height="50px" width="50px">
		    @endif
        
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">管理员密码</label>
		<div class="col-sm-10">
			<input type="password" class="form-control" value="{{$adminInfo->admin_pwd}}" name="admin_pwd" id="lastname">
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">提交</button>
		</div>
	</div>
</form>

</body>
</html>