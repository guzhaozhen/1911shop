@extends('index.layouts.shop')
@section('title',$goods->goods_name)
@section('content')
     <header>
      <a href="javascript:history.back(-1)" class="back-off fl"><span class="glyphicon glyphicon-menu-left"></span></a>
      <div class="head-mid">
       <h1>产品详情</h1>
      </div>
     </header>
     <div id="sliderA" class="slider">
        @if($goods->goods_imgs)
        @php $imgs = explode('|',$goods->goods_imgs);  @endphp 
        @foreach($imgs as $v)
      <img src="{{env('UPLOADS_URL')}}{{$v}}" />
      @endforeach
      @endif
     
     </div><!--sliderA/-->
     <table class="jia-len">
      <tr>
       <th><strong class="orange">{{$goods->goods_price}}</strong></th>
       <td>
        <input type="text" class="spinnerExample" />
       </td>
      </tr>
      <tr>
       <td>
        <strong>{{$goods->goods_name}}</strong>
        <p class="hui">富含纤维素，平衡每日膳食</p>  当前访问量：{{$visit}}
       </td>
       <td align="right">
        <a href="javascript:;" class="shoucang"><span class="glyphicon glyphicon-star-empty"></span></a>
       </td>
      </tr>
     </table>
     <div class="height2"></div>
     <h3 class="proTitle">商品规格</h3>
     <ul class="guige">
      <li class="guigeCur"><a href="javascript:;">50ML</a></li>
      <li><a href="javascript:;">100ML</a></li>
      <li><a href="javascript:;">150ML</a></li>
      <li><a href="javascript:;">200ML</a></li>
      <li><a href="javascript:;">300ML</a></li>
      <div class="clearfix"></div>
     </ul><!--guige/-->
     <div class="height2"></div>
     <div class="zhaieq">
      <a href="javascript:;" class="zhaiCur">商品简介</a>
      <a href="javascript:;">商品参数</a>
      <a href="javascript:;" style="background:none;">订购列表</a>
      <div class="clearfix"></div>
     </div><!--zhaieq/-->
     <div class="proinfoList">
     {{$goods->content}}
     
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息....
     </div><!--proinfoList/-->
     <div class="proinfoList">
      暂无信息......
     </div><!--proinfoList/-->
     <table class="jrgwc">
      <tr>
       <th>
        <a href="index.html"><span class="glyphicon glyphicon-home"></span></a>
       </th>
       <td><a id="addcar" goods_id="{{$goods->goods_id}}" href="javascript:void(0);">加入购物车</a></td>
      </tr>
     </table>
    </div><!--maincont-->
    <script>
        $('#addcar').click(function(){
            // alert(55);
            var goods_id = $(this).attr('goods_id');
            var buy_number = $('.spinnerExample').val();
            // alert(buy_number);

            $.get('/addcar',{goods_id:goods_id,buy_number:buy_number},function(res){
                // alert(res);
                if(res.code=='1'){
                    if(confirm('您当前未登录,是否跳转到登录页面')){
                        location.href="/login?refer="+location.href;
                    }
                }
                if(res.code=='2' || res.code=='3'){
                    alert(res.msg);
                }

                if(res.code=='4'){
                    alert(res.msg);
                    location.href="/cart";
                }

            },'json')
        })
    </script>
    @include('index.common.footer')
    @endsection