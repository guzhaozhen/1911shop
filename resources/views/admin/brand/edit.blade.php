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
            <li class="active"><a href="{{url('/brand/index')}}">商品品牌</a></li>
            <li><a href="{{url('/cate/index')}}">商品分类</a></li>
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
<h1>商品品牌</h1><hr/>
<span style="float:right;"><a href="{{url('/brand/index')}}">列表</a></span>
</center>

<form class="form-horizontal" role="form" method="post" action="{{url('/brand/update/'.$brand->brand_id)}}" enctype="multipart/form-data">
    @csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">品牌名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" value="{{$brand->brand_name}}" name="brand_name" id="firstname" 
				   placeholder="请输入品牌名称">
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">品牌网址</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" value="{{$brand->brand_url}}" name="brand_url" id="lastname" 
				   placeholder="请输入品牌网址">
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">品牌LOGO</label>
		<div class="col-sm-3">
			<input type="file" class="form-control" name="brand_logo" id="lastname">
		</div>
		@if($brand->brand_logo)
				<img src="{{env('UPLOADS_URL')}}{{$brand->brand_logo}}" height="50px" width="50px">
		@endif
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">品牌描述</label>
		<div class="col-sm-10">
			<textarea type="text" class="form-control" id="lastname" name="brand_desc">{{$brand->brand_desc}}</textarea>
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