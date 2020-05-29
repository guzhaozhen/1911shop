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

<table class="table table-striped">
	<caption>分类管理</caption>
	<thead>
		<tr>
			<th>分类ID</th>
			<th>分类名称</th>
			<th>父级分类</th>
            <th>是否显示</th>
            <th>是否导航显示</th>
            <th>分类描述</th>
            <th>操作</th>
		</tr>
	</thead>
	<tbody>
        @foreach($cateInfo as $k=>$v)
		<tr @if($k%2==0) class="active" @else class="success" @endif>
			<td>{{$v->cate_id}}</td>
			<td>{{$v->cate_name}}</td>
			<td>{{str_repeat('|——',$v->level)}}{{$v->cate_name}}</td>
            <td>{{$v->is_show==1?'√':'×'}}</td>
            <td>{{$v->is_nav_show==1?'√':'×'}}</td>
            <td>{{$v->cate_desc}}</td>
            <td>
                <a class="btn btn-primary" href="{{url('cate/edit/'.$v->cate_id)}}">编辑</a>|
                <a class="btn btn-danger" id="{{$v->cate_id}}" href="javascript:void(0);">删除</a>
            </td>
		</tr>
        @endforeach
	</tbody>
</table>
</body>
</html>
<script>
$('.btn-danger').click(function(){
    // alert(11);
    var id = $(this).attr('id');
    
    if(confirm('您确定删除吗?')){
        $.get('/cate/destroy/'+id,function(res){
        // alert(res);
        
        if(res.code==1){
            location.href="/cate/index";
        }

     },'json')
    }
    
    
})
</script>

