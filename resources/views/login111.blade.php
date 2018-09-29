<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>登录</title>
	<link rel="stylesheet" type="text/css" href="/bootstrap/dist/css/bootstrap.min.css">
	<script src="/jquery/dist/jquery.min.js"></script>
	<style>
		.col-center {
		    float: none;
		    display: block;
		    margin: 150px auto;
		}
</style>

</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-4  col-center">
				<form action="/admin/dologin" method="post" id="login">
				{{csrf_field()}}
				<div class="form-group">
					<label>用户名</label>
					<input type="text" name="name" id="" class="form-control"><span></span>
				</div>
				<div class="form-group">
					<label>密码</label>
					<input type="password" name="pass" class="form-control"><span></span>
				</div>
				<div class="form-group">
					<input type="submit" value="登录" class="form-control btn btn-info">
				</div>
				</form>
			</div>
		</div>
	</div>
</body>
	<script>
		// $("input[name=name]").blur(function(){
		// 	nameInput=$(this);
		// 	name=nameInput.val();
		// 	if(name==false){
		// 		nameInput.next('span').css('color','red').html("用户不能为空");
		// 	}else{
		// 		$.post('/uname',{name:name},function(data){
		// 			if(data.data==0){
		// 				nameInput.next('span').css('color','green').html("用户名可用");
		// 			}else{
		// 				nameInput.next('span').css('color','red').html('用户名已存在');
		// 			}
		// 		});
		// 	}
			
		// });

		
	</script>
</html>