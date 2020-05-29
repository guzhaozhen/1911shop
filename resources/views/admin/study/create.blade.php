<form action="{{url('/study/store')}}" method="post">
@csrf 
<input type="text" name="name">
<button>提交</button>
</form>
