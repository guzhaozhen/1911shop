@foreach($goodsInfo as $k=>$v)
		<tr @if($k%2==0) class="active" @else class="success" @endif>
			<td>{{$v->goods_id}}</td>
			<td>{{$v->goods_name}}</td>
            <td>{{$v->goods_sn}}</td>
			<td>{{str_repeat('|——',$v->level)}}{{$v->cate_id}}</td>
            <td>{{$v->brand_id}}</td> 
            <td>{{$v->goods_price}}</td>
            <td>{{$v->goods_number}}</td>
            <td>{{$v->is_on_sale==1?'√':'×'}}</td>
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
			<td colspan=14 align="center">{{$goodsInfo->links()}}</td>
		</tr>