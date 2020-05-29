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


<center>
<h1>文章添加</h1>
</center>

<form class="form-horizontal" role="form" method="post" action="{{url('/article/update/'.$articleInfo->w_id)}}" enctype="multipart/form-data">
@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">文章标题</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" value="{{$articleInfo->w_title}}" id="firstname" name="w_title"
				   placeholder="请输入文章标题">
                   <sapn style="color:red">{{$errors->first('w_title')}}</span>
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">文章分类</label>
		<div class="col-sm-10">
			<select name="c_id">
				<option value="">--请选择--</option>
				@foreach($atypeInfo as $k=>$v)
				<option value="{{$v->c_id}}" @if($articleInfo->c_id==$v->c_id)selected @endif>{{$v->c_name}}</option>
				@endforeach
					
			</select>
             <b style="color:red">{{$errors->first('c_id')}}</b>
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">文章重要性</label>
		<div class="col-sm-2">
			<input type="radio" id="lastname" name="is_zy" value="1" {{$articleInfo->is_zy==1?'checked':''}}>普通
            <input type="radio" id="lastname" name="is_zy" value="2" {{$articleInfo->is_zy==2?'checked':''}}>置顶
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否显示</label>
		<div class="col-sm-10">
            <input type="radio" id="lastname" name="is_show" value="1" {{$articleInfo->is_show==1?'checked':''}}>√
            <input type="radio" id="lastname" name="is_show" value="2" {{$articleInfo->is_show==2?'checked':''}}>×
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">文章作者</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" value="{{$articleInfo->w_author}}" id="firstname" name="w_author"
				   placeholder="请输入文章作者">
                   <span style="color:red">{{$errors->first('w_author')}}</span>
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">文章email</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" value="{{$articleInfo->w_email}}" id="firstname" name="w_email"
				   placeholder="请输入文章作者">
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">关键字</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" value="{{$articleInfo->w_keyword}}" id="firstname" name="w_keyword"
				   placeholder="请输入商品库存">
		</div>
	</div>
  

    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">上传文件</label>
		<div class="col-sm-10">
			<input type="file" class="form-control" id="firstname" name="w_logo">
            @if($articleInfo->w_logo)
				<img src="{{env('UPLOADS_URL')}}{{$articleInfo->w_logo}}" height="50px" width="50px">
				@endif
		</div>
	</div>
  
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">文章详情</label>
		<div class="col-sm-10">
			<textarea type="text" class="form-control" name="w_desc" id="lastname">{{$articleInfo->w_desc}}</textarea>
            <b style="color:red">{{$errors->first('w_desc')}}</b>
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