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
            <td>{{$v->admin_time}}</td>
			<td>
				<a class="btn btn-primary" href="{{url('admin/edit/'.$v->admin_id)}}">编辑</a>|<a class="btn btn-danger" href="{{url('admin/destroy/'.$v->admin_id)}}">删除</a>
			</td>
		</tr>
        @endforeach
		<tr>
			<td colspan=5 align="center">{{$adminInfo->links()}}</td>
		</tr>