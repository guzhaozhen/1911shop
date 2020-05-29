<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title>新闻列表</title>
	<link rel="stylesheet" href="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/css/bootstrap.min.css">  
	<script src="https://cdn.staticfile.org/jquery/2.1.1/jquery.min.js"></script>
	<script src="https://cdn.staticfile.org/twitter-bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<center>
<h1>新闻列表</h1>
</center>

<form>
	<input type="text" name="title" value="{{$title}}" placeholder="请输入关键字">
	<button>搜索</button>
</form>

<table class="table">
	<caption>新闻</caption>
	<thead>
		<tr>
			<th>ID</th>
			<th>标题</th>
            <th>作者</th>
            <th>内容</th>
            <th>时间</th>
			<th>操作</th>
		</tr>
	</thead>
	<tbody>
    @foreach ($news as $k=>$v)
		<tr @if($k%2==0) class="active" @else class="success" @endif>
			<td>{{$v->n_id}}</td>
			<td>{{$v->title}}</td>
            <td>{{$v->author}}</td>
			<td>{{$v->content}}</td>
            <td>{{$v->addtime}}</td>
			<td>
				<a class="btn btn-primary" href="{{url('news/edit/'.$v->n_id)}}">编辑</a>|
                <a class="btn btn-danger" href="{{url('news/destroy/'.$v->n_id)}}">删除</a>
			</td>
		</tr>
        @endforeach
		<tr>
			<td colspan=5 align="center">{{$news->appends(['title'=>$title])->links()}}</td>
		</tr>
	</tbody>
</table>

</body>
</html>
