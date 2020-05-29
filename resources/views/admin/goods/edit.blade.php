<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
    <title>微商城- 商品分类</title>
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
            <li><a href="{{url('/brand')}}">商品品牌</a></li>
            <li><a href="{{url('/cate')}}">商品分类</a></li>
            <li class="active"><a href="{{url('/goods')}}">商品管理</a></li>
            <li><a href="{{url('/admin')}}">管理员管理</a></li>

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
<h1>商品管理</h1>
</center>

<form class="form-horizontal" role="form" method="post" action="{{url('/goods/store')}}" enctype="multipart/form-data">
@csrf
	<div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品名称</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" value="{{$goodsInfo->goods_name}}" id="firstname" name="goods_name"
				   placeholder="请输入商品名称">
            <b style="color:red">{{$errors->first('goods_name')}}</b>
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品货号</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" value="{{$goodsInfo->goods_sn}}" id="firstname" name="goods_sn"
				   placeholder="请输入商品货号">
                   <b style="color:red">{{$errors->first('goods_sn')}}</b>
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品分类</label>
		<div class="col-sm-10">
			<select name="cate_id">
				<option value="0">--请选择--</option>
				@foreach($cateInfo as $k=>$v)
					<option value="{{$v->cate_id}}"{{$goodsInfo->cate_id==$v->cate_id?'selected':''}}>{{$v->cate_name}}</option>
				@endforeach	
			</select>
             <b style="color:red">{{$errors->first('cate_id')}}</b>
		</div>
       
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品品牌</label>
		<div class="col-sm-10">
		<select name="brand_id">
				<option value="">--请选择--</option>
				@foreach($brandInfo as $k=>$v)
					<option value="{{$v->brand_id}}" @if($v->brand_id==$goodsInfo->brand_id)selected @endif>{{$v->brand_name}}</option>
				@endforeach	
			</select>
             <b style="color:red">{{$errors->first('brand_id')}}</b>
		</div>
        
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品价格</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" value="{{$goodsInfo->goods_price}}" id="firstname" name="goods_price"
				   placeholder="请输入商品价格">
                   <b style="color:red">{{$errors->first('goods_price')}}</b>
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品库存</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" value="{{$goodsInfo->goods_number}}" id="firstname" name="goods_number"
				   placeholder="请输入商品价格">
                   <b style="color:red">{{$errors->first('goods_price')}}</b>
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否上架</label>
		<div class="col-sm-2">
			<input type="radio" id="lastname" name="is_on_sale" value="1" {{$goodsInfo->is_on_sale==1?'checked':""}}>√
            <input type="radio" id="lastname" name="is_on_sale" value="2" {{$goodsInfo->is_on_sale==2?'checked':""}}>√
		</div>
	</div>
	<div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">首页幻灯推荐位</label>
		<div class="col-sm-10">
            <input type="radio" id="lastname" name="is_slice" value="1" {{$goodsInfo->is_slice==1?'checked':""}}>√
            <input type="radio" id="lastname" name="is_slice" value="2" {{$goodsInfo->is_slice==2?'checked':""}}>√
		</div>
	</div>


    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否新品</label>
		<div class="col-sm-10">
            <input type="radio" id="lastname" name="is_new" value="1" {{$goodsInfo->is_new==1?'checked':""}}>√
            <input type="radio" id="lastname" name="is_new" value="2" {{$goodsInfo->is_new==1?'checked':""}}>√
		</div>
	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">是否精品</label>
		<div class="col-sm-10">
            <input type="radio" id="lastname" name="is_best" value="1" {{$goodsInfo->is_best==1?'checked':""}}>√
            <input type="radio" id="lastname" name="is_best" value="2" {{$goodsInfo->is_best==1?'checked':""}}>√
		</div>
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品主图</label>
		<div class="col-sm-2">
			<input type="file" class="form-control" id="firstname" name="goods_img">
		</div>
		@if($goodsInfo->goods_img)
				<img src="{{env('UPLOADS_URL')}}{{$goodsInfo->goods_img}}" height="50px" width="50px">
		@endif
	</div>
    <div class="form-group">
		<label for="firstname" class="col-sm-2 control-label">商品相册</label>
		<div class="col-sm-2">
			<input type="file" class="form-control" id="firstname" name="goods_imgs[]" multiple>
		</div>
		@if($goodsInfo->goods_imgs)
                @php $imgarr = explode('|',$goodsInfo->goods_imgs);@endphp
                @foreach($imgarr as $img)
                <img src="{{env('UPLOADS_URL')}}{{$img}}" height="50px" width="50px">
                @endforeach
                @endif

	</div>
    <div class="form-group">
		<label for="lastname" class="col-sm-2 control-label">商品详情</label>
		<div class="col-sm-10">
			<textarea type="text" class="form-control" name="content" id="lastname">{{$goodsInfo->content}}</textarea>
            <b style="color:red">{{$errors->first('content')}}</b>
		</div>
	</div>
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">提交</button>
		</div>
	</div>
</form>

<script>
	$('input[name="goods_name"]').blur(function(){
		$(this).next().empty();
		var goods_name = $(this).val();
		// alert(goods_name);
		var reg = /^[\u4e00-\u9fa5\w]{2,50}$/;
		//验证规则
		if(!reg.test(goods_name)){
			$(this).next().text('商品名称可以包含中文、数字、字母、下划线且唯一，长度范围为2-50位');
			return;
		}

		//验证唯一性
		$.ajaxSetup({ headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});

		$.post('/goods/checkName',{goods_name:goods_name},function(res){
			// alert(res);
			if(res>0){
				$('input[name="goods_name"]').next().text('商品名称已存在');
			}
		})
	})

	$('button').click(function(){
		var goods_name = $('input[name="goods_name"]').val();
		var reg = /^[\u4e00-\u9fa5\w]{2,50}$/;
		//验证规则
		if(!reg.test(goods_name)){
			$('input[name="goods_name"]').next().text('商品名称可以包含中文、数字、字母、下划线且唯一，长度范围为2-50位');
			return;
		}

		var flag = true;
		//验证唯一性
		$.ajaxSetup({ headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')}});
		$.ajax({
			type:"post",
			url:"/goods/checkName",
			data:{goods_name:goods_name},
			async:false,
			success:function(msg){
				if(msg>0){
					$('input[name="goods_name"]').next().text('商品名称已存在');
					flag = false;
				}
			}
		});

		if(!flag) return;

		var goods_sn = $('input[name="goods_sn"]').val();
		if(!goods_sn){
			$('input[name="goods_sn"]').next().text('商品货号不能为空');
			return;
		}

		$('form').submit();



	})
</script>

</body>
</html>
