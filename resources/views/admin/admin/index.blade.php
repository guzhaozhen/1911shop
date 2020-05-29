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
 <span style="float:right;"><a href="{{url('/admin/create')}}">添加</a></span>
</center>
<table class="table">
	<caption>管理员</caption>
	<thead>
		<tr>
			<th>管理员ID</th>
			<th>管理员名称</th>
            <th>管理员手机号</th>
            <th>管理员头像</th>
			<th>管理员邮箱</th>
            <th>添加时间</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
    @foreach ($adminInfo as $k=>$v)
		<tr @if($k%2==0) class="active" @else class="success" @endif>
			<td>{{$v->admin_id}}</td>
			<td>{{$v->admin_name}}</td>
            <td>{{$v->admin_tel}}</td>
			<td>
				@if($v->admin_logo)
				<img src="{{env('UPLOADS_URL')}}{{$v->admin_logo}}" height="50px" width="50px">
				@endif
			</td>
			<td>{{$v->admin_email}}</td>
            <td>{{date("Y-m-d H:i:s",$v->admin_time)}}</td>
			<td>
				<a class="btn btn-primary" href="{{url('admin/edit/'.$v->admin_id)}}">编辑</a>|<a class="btn btn-danger" href="{{url('admin/destroy/'.$v->admin_id)}}">删除</a>
			</td>
		</tr>
        @endforeach
		<tr>
			<td colspan=5 align="center">{{$adminInfo->links()}}</td>
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
		// console.log(url);

		$.get(url,function(res){
			// alert(res);
			$('tbody').html(res);
		});

		return false;
	})
</script>