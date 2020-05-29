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
 <span style="float:right;"><a href="{{url('/brand/create')}}">添加</a></span>
</center>
<form action="">
	<input type="text" name="brand_name" value="{{$brand_name}}" placeholder="请输入关键字">
	<button>搜索</button>
</form>

<table class="table">
	<caption>品牌</caption>
	<thead>
		<tr>
			<th>品牌ID</th>
			<th>品牌名称</th>
            <th>品牌网址</th>
            <th>品牌LOGO</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
    @foreach ($brand as $k=>$v)
		<tr @if($k%2==0) class="active" @else class="success" @endif>
			<td>{{$v->brand_id}}</td>
			<td>{{$v->brand_name}}</td>
            <td>{{$v->brand_url}}</td>
			<td>
				@if($v->brand_logo)
				<img src="{{env('UPLOADS_URL')}}{{$v->brand_logo}}" height="50px" width="50px">
				@endif
			</td>
			<td>
				<a class="btn btn-primary" href="{{url('brand/edit/'.$v->brand_id)}}">编辑</a>|<a class="btn btn-danger" href="{{url('brand/destroy/'.$v->brand_id)}}">删除</a>
			</td>
		</tr>
        @endforeach
		<tr>
			<td colspan=5 align="center">{{$brand->appends(['brand_name'=>$brand_name])->links()}}</td>
		</tr>
	</tbody>
</table>

</body>
</html>
<script>
	//无刷新分页
	$(document).on('click','.page-item a',function(){
		// alert(11);
		var url = $(this).attr('href');
		console.log(url);

		$.get(url,function(res){
			// alert(res);
			$('tbody').html(res);
		});

		return false;
	})
</script>