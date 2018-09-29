<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>用户列表</title>
	<link rel="stylesheet" type="text/css" href="/bootstrap/dist/css/bootstrap.min.css">
	<script src="/jquery/dist/jquery.min.js"></script>
	<style>
		.col-center {
		    float: none;
		    display: block;
		    margin: 30px auto;
		}
	</style>

</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-8 col-center">
				<form action="/user" method="get" class="form-inline">
					<div class="form-group">
						<input type="text" name="name" value="{{$request['name'] or ''}}" class="form-control">
					</div>
					<button class="btn btn-default">搜索</button>
				</form>
			</div>
		</div>
		<div class="row">
			<div class="col-md-8  col-center">
				<table class="table table-bordered table-hover">
					<tr>
						<th>ID</th>
						<th>用户名</th>
						<th>密码</th>
						<th>操作</th>
					</tr>
					@foreach($user as $v)
					<tr>
						<td>{{$v->id}}</td>
						<td class="info" name="name">{{$v->name}}</td>
						<td class="info" name="pass">{{$v->pass}}</td>
						<td><a href="javascript:viod(0)" class="btn btn-danger del">删除</a></td>
					</tr>
					@endforeach
					<tr>
						<td colspan="3">{{$user->appends($request)->render()}}</td>
						<td><a href="/user/create" class="btn btn-success">添加</a></td>
					</tr>
				</table>
			</div>
		</div>
	</div>
</body>
	<script>
		$(".del").click(function(){
			del = $(this);
			id = del.parents('tr').find('td:first').html();
			$.ajax({
				type:"post",
				dataType:'json',
				data:{'_method':'delete','_token':'{{csrf_token()}}','id':id},
				url:'/user/destroy',
				success:function(data){
							if(data==1){
								alert('删除成功');
								del.parents('tr').remove();
							}
						}
			});
		});


		$(".info").dblclick(function(){
			user = $(this);
			info=user.html();
			if(info=='<input type="text">'){
				info='';
			}
			input=$("<input type='text'>");
			user.empty();
			input.val(info);
			user.append(input);
			input.blur(function(){
				id=$(this).parents('tr').find('td:first').html();
				newInfo=$(this).val();
				if($(this).parents('td').attr('name')=='name'){
					var type=1;
				}else if($(this).parents('td').attr('name')=='pass'){
					var type=2;
				}
				$.ajax({
					type:'post',
					dataType:'json',
					data:{'_method':'put','_token':'{{csrf_token()}}','id':id,'info':newInfo,'type':type},
					url:'/user/update',
					success:function(data){
								if(data==1){
									alert('修改成功');
									user.html(newInfo);
								}else{
									alert('修改失败');
									user.html(info);
								}
							}
				});
			});
		});
	
	</script>
</html>