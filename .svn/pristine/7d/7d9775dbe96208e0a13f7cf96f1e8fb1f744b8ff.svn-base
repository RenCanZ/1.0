<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>注册</title>
	<link rel="stylesheet" type="text/css" href="/bootstrap/dist/css/bootstrap.min.css">
	<script src="/jquery/dist/jquery.min.js"></script>
	<style>
		.col-center {
		    float: none;
		    display: block;
		    margin: 50px auto;
		}
</style>

</head>
<body>
	<div class="container">
		<div class="row">
			<div class="col-md-4  col-center">
				<form action="/dosignup" method="post" class="sign">
				{{ csrf_field() }}
				<div class="form-group">
					<label>手机号</label>
					<input type="text" name="phone" class="form-control"><span></span>
				</div>
				<div class="form-group">
					<label>验证码</label>
					<div class="form-inline">
						<input type="text" name="yzm" class="form-control" style="width:55%"><a href="javascript:void(0)" class="form-control btn btn-info yz" style="width:45%">单击发送</a>
					</div>
					<span></span>
				</div>
				<div class="form-group">
					<label>用户名</label>
					<input type="text" name="name" id="" class="form-control"><span></span>
				</div>
				<div class="form-group">
					<label>密码</label>
					<input type="password" name="pass" class="form-control"><span></span>
				</div>
				<div class="form-group">
					<input type="submit" value="注册" class="form-control btn btn-info">
				</div>
				</form>
			</div>
		</div>
	</div>
</body>
	<script>
		//设置表单提交条件
		var flag=false;
		var flags=false;

		//判断用户名是否可用
		$("input[name=name]").blur(function(){
			nameInput=$(this);
			name=nameInput.val();
			if(name==false){
				nameInput.next('span').css('color','red').html("用户不能为空");
			}else{
				$.get('/uname',{'name':name},function(data){
					if(data==0){
						flags=true;
						nameInput.next('span').css('color','green').html("用户名可用");
					}else{
						nameInput.next('span').css('color','red').html('用户名已存在');
					}
				});
			}
			
		});

		//判断密码是否符合规则
		

		//发送验证码
		$(".yz").click(function(){
			phone=$("input[name=phone]").val();
			obj=$(this);
			$.ajax({
				url:"proof",
				type:"post",
				data:{'_token':'{{csrf_token()}}','phone':phone},
				dataType:'json',
				success:function(data){
					if(data.code==0){
						var s=180;
						mytime=setInterval(function(){
							s--;
							obj.html(s+"秒后重新发送");
							obj.addClass('disabled');
							if(s<=0){
								clearInterval(mytime);
								obj.html('重新发送');
								obj.removeClass('disabled');
							}
						},1000);	
					}
				}
			});
		});

		//验证码对比
		$('input[name=yzm]').blur(function(){
			o=$(this);
			yzm=o.val();
			$.ajax({
				url:'/doproof',
				type:'get',
				data:{'yzm':yzm},
				success:function(data){
					if(data==0){
						o.parents('div .form-inline').next('span').css('color','red').html('验证码有误');
					}else if(data==1){
						o.parents('div .form-inline').next('span').css('color','green').html('验证码正确');
						flag = true;
					}else if(data==2){
						o.parents('div .form-inline').next('span').css('color','red').html('验证码不能为空');

					}else if(data==3){
						o.parents('div .form-inline').next('span').css('color','red').html('验证码已过期');
					}
				}
			});
		});

		//表单提交事件
		$('form .sign').submit(function(){
			$('input[name=yzm]').trigger('blur');
			$('input[name=name]').trigger('blur');
			if(flag==true&&flags==true){
				return true;
			}
		});

	</script>
</html>