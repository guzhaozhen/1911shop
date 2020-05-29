<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <title>微商城- 商品分类</title>
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
<form class="form-horizontal" role="form" method="post" action="{{url('/cate/update/'.$cate->cate_id)}}">
@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">分类名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="firstname" name="cate_name"
				   placeholder="请输入品牌名称" value="{{$cate->cate_name}}">
                   <b style="color:red">{{$errors->first('cate_name')}}</b>
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">父级分类</label>
		<div class="col-sm-10">
            <select class="form-control" id="lastname" name="pid">
                <option value="0">--请选择--</option>
                @foreach($cateInfo as $k=>$v)
                <option value="{{$v->cate_id}}"{{$cate->pid==$v->cate_id?'selected':''}}>{{$v->cate_name}}</option>
                @endforeach
            </select>       
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否显示</label>
		<div class="col-sm-2">
			<input type="radio" id="lastname" name="is_show" value="1" {{$cate->is_show==1?'checked':""}}>√
            <input type="radio" id="lastname" name="is_show" value="2" {{$cate->is_show==2?'checked':""}}>×
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否导航显示</label>
		<div class="col-sm-10">
            <input type="radio" id="lastname" name="is_nav_show" value="1" {{$cate->is_nav_show==1?'checked':""}}>√
            <input type="radio" id="lastname" name="is_nav_show" value="2" {{$cate->is_nav_show==2?'checked':""}}>×
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">分类描述</label>
		<div class="col-sm-10">
			<textarea type="text" class="form-control" name="cate_desc" id="lastname">{{$cate->cate_desc}}</textarea>
            <b style="color:red">{{$errors->first('cate_desc')}}</b>
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