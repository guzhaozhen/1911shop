<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>文章</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>



<center>
<h1>文章展示</h1><hr/>
 <span style="float:right;"><a href="{{url('/article/create')}}">添加</a></span>
</center>
<table class="table">
	<caption>文章</caption>
	<thead>
		<tr>
			<th>文章ID</th>
			<th>文章标题</th>
            <th>文章分类</th>
            <th>文章重要性</th>
            <th>是否显示</th>
            <th>文章作者</th>
            <th>文章email</th>
            <th>关键字</th>
            <th>上传文件</th>
            <th>文章详情</th>
            <th>添加时间</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
    @foreach ($articleInfo as $k=>$v)
		<tr @if($k%2==0) class="active" @else class="success" @endif>
			<td>{{$v->w_id}}</td>
			<td>{{$v->w_title}}</td>
            <td>{{$v->c_name}}</td>
            <td>{{$v->is_zy==1?'普通':'置顶'}}</td>
            <td>{{$v->is_show==1?'√':'×'}}</td>
            <td>{{$v->w_author}}</td>
            <td>{{$v->w_email}}</td>
            <td>{{$v->w_keyword}}</td>
            <td>
				@if($v->w_logo)
				<img src="{{env('UPLOADS_URL')}}{{$v->w_logo}}" height="50px" width="50px">
				@endif
			</td>
            <td>{{$v->w_desc}}</td>
            <td>{{date("Y-m-d H:i:s",$v->w_time)}}</td>
			<td>
				<a class="btn btn-primary" href="{{url('article/edit/'.$v->w_id)}}">编辑</a>|<a class="btn btn-danger" href="{{url('article/destroy/'.$v->w_id)}}">删除</a>
			</td>
		</tr>
        @endforeach
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