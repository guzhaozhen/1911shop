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
            <li><a href="{{url('/cate/index')}}">商品分类</a></li>
            <li class="active"><a href="{{url('/goods/index')}}">商品管理</a></li>
            <li><a href="{{url('/admin/index')}}">管理员管理</a></li>
            <li><a style="float:right">欢迎{{session('admin')->admin_name}}登录</a></li>
			<li><a href="{{url('/logout')}}">退出</a></li>

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
<h1><font color="red">商品管理--展示</font></h1><hr/>
 <span style="float:right;"><a href="{{url('/goods/create')}}">添加</a></span>


<form action="">
商品名称<input type="text" name="goods_name" placeholder="请输入商品名称" value="{{$goods_name}}">
商品分类<select name="cate_id">
				<option value="0">--请选择--</option>
				@foreach($cateInfo as $k=>$v)
					<option value="{{$v->cate_id}}" @if($v->cate_id==$cate_id) selected="selected"@endif>{{$v->cate_name}}</option>
				@endforeach	
	</select>
    <input type="text" name="startprice" value="{{$startprice}}" placeholder="请输入商品价格">——
    <input type="text" name="endprice" value="{{$endprice}}" placeholder="请输入商品价格">
    <button>搜索</button>
</form>

</center>

<table class="table table-striped">
	<caption>商品管理</caption>
	<thead>
		<tr>
			<th>商品ID</th>
			<th>商品名称</th>
            <th>商品货号</th>
			<th>商品分类</th>
            <th>商品品牌</th>
            <th>商品价格</th>
            <th>商品库存</th>
            <th>是否显示</th>
            <th>首页幻灯推荐位</th>
            <th>是否新品</th>
            <th>是否精品</th>
            <th>商品主图</th>
            <th>商品相册</th>
            <th>商品详情</th>
            <th>操作</th>
		</tr>
	</thead>
	<tbody>
        @foreach($goodsInfo as $k=>$v)
		<tr @if($k%2==0) class="active" @else class="success" @endif>
			<td>{{$v->goods_id}}</td>
			<td>{{$v->goods_name}}</td>
            <td>{{$v->goods_sn}}</td>
			<td>{{str_repeat('|——',$v->level)}}{{$v->cate_name}}</td>
            <td>{{$v->brand_name}}</td> 
            <td>{{$v->goods_price}}</td>
            <td>{{$v->goods_number}}</td>
            <td>{{$v->is_on_sale==1?'√':'×'}}</td>
            <td>{{$v->is_slice==1?'√':'×'}}</td>
            <td>{{$v->is_new==1?'√':'×'}}</td>
            <td>{{$v->is_best==1?'√':'×'}}</td>
            <td>
                @if($v->goods_img)
				<img src="{{env('UPLOADS_URL')}}{{$v->goods_img}}" height="50px" width="50px">
				@endif
            </td> 
            <td>
                @if($v->goods_imgs)
                @php $imgarr = explode('|',$v->goods_imgs);@endphp
                @foreach($imgarr as $img)
                <img src="{{env('UPLOADS_URL')}}{{$img}}" height="50px" width="50px">
                @endforeach
                @endif
            
            </td> 
            <td>{{$v->content}}</td>
            <td>
                <a class="btn btn-primary" href="{{url('goods/edit/'.$v->goods_id)}}">编辑</a>|
                <a class="btn btn-danger" id="{{$v->goods_id}}" href="javascript:void(0)">删除</a>
            </td>
		</tr>
        @endforeach

        

        <tr>
			<td colspan=14 align="center">{{$goodsInfo->appends(['goods_name'=>$goods_name,'cate_id'=>$cate_id])->links()}}</td>
		</tr>

	</tbody>
</table>

</body>
</html>
<script>
    $(document).on('click','.page-item a',function(){
        // alert(11);
        var url = $(this).attr('href');
        // alert(112);
        $.get(url,function(res){
            // console.log(res);
            $('tbody').html(res);
        });
        return false;
    })

    $(document).on('click','.btn-danger',function(){
        // alert(55);
        var id = $(this).attr('id');
        var obj = $(this);
        // alert(id);

        if(confirm('您确定要删除吗?')){
             $.get('/goods/destroy/'+id,function(res){
            // alert(res);
            if(res.code=='00000'){
                // location.href="/goods/index";
                obj.parents('tr').hide();
            }
        },'json')
      }    
    })


</script>
