<!DOCTYPE HTML>
<html lang="{{ app()->getLocale() }}">
<head>
	<meta charset="UTF-8">
	<meta name="_token" content="{{ csrf_token() }}"/>
	<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1,maximum-scale=1,user-scalable=no" />
	<title>后台模板</title>
	<link rel="stylesheet" href="/zht/public/font-awesome-4.7.0/css/font-awesome.min.css" />
	<link rel="stylesheet" href="/zht/public/loadingstyle.css" />
	<link rel="stylesheet" href="/zht/public/css/style.css">
	<!-- <script src="https://unpkg.com/vue"></script> -->
	<script src="/zht/public/font-awesome-4.7.0/js/jquery-3.3.1.min.js"></script>
	<script type="text/javascript" src="/zht/public/vue.js?as=12"></script>
	<script type="text/javascript" src="/zht/public/base64.js"></script>
	
</head>
<body>
	<div class="page block-col">
		<!-- 顶部导航条 -->
		<div class="header block-row-colcenter">
			<div class="block-row-colcenter" style="flex:1">
				<span class="logoicon icon fa-rebel " style="font-size:30px;"></span>
				<span class="txt-18">后台模板</span>
			</div>
			<div style="width:40px;" class="block-row-bothcenter">
				<!-- <span class="icon fa-power-off"></span> -->
				<span class="menu-icon" @click="menuIconClick()">
                    <svg viewBox="0 0 18 15" width="18px" height="15px">
                        <path fill="white" d="M18,1.484c0,0.82-0.665,1.484-1.484,1.484H1.484C0.665,2.969,0,2.304,0,1.484l0,0C0,0.665,0.665,0,1.484,0 h15.031C17.335,0,18,0.665,18,1.484L18,1.484z"/>
                        <path fill="white" d="M18,7.516C18,8.335,17.335,9,16.516,9H1.484C0.665,9,0,8.335,0,7.516l0,0c0-0.82,0.665-1.484,1.484-1.484 h15.031C17.335,6.031,18,6.696,18,7.516L18,7.516z"/>
                        <path fill="white" d="M18,13.516C18,14.335,17.335,15,16.516,15H1.484C0.665,15,0,14.335,0,13.516l0,0 c0-0.82,0.665-1.484,1.484-1.484h15.031C17.335,12.031,18,12.696,18,13.516L18,13.516z"/>
					</svg>
				</span>				
			</div>
		</div>
		<!-- 顶部导航条 -->
		
		<!-- 主体内容 -->
		<div class="center block-row">
			<!-- 左侧菜单 -->
			<div class="left-menu bkcolor-black color-white" v-if="leftMenu" >
				<a class="left-menu-item" href="dealer" v-if="{{ Session::get('type')}} == 1">
					<span class="icon  fa-sitemap left-menu-icon"></span>
					经销商				
				</a>
				<a class="left-menu-item" href="merchant" v-if="{{ Session::get('type')}} != 3">
					<span class="icon  fa-magnet left-menu-icon"></span>
					商户				
				</a>
				<a class="left-menu-item" href="program">
					<span class="icon fa-paper-plane left-menu-icon"></span>
					小程序				
				</a>
				<a class="left-menu-item" href="user" v-if="{{ Session::get('type')}} == 1">
					<span class="icon fa-user left-menu-icon"></span>
					用户				
				</a>
				<a class="left-menu-item" href="coupons">
					<span class="icon fa-credit-card left-menu-icon"></span>
					优惠券				
				</a>
				<a class="left-menu-item" href="userCoupons">
					<span class="icon fa-database left-menu-icon"></span>
					已领取优惠券				
				</a>
				<a class="left-menu-item" href="use">
					<span class="icon fa-check-square-o left-menu-icon"></span>
					已使用优惠券				
				</a>
				<a class="left-menu-item left-menu-item-active" href="psw">
					<span class="icon fa-cog left-menu-icon"></span>
					修改密码				
				</a>
			</div>
			<!-- 左侧菜单 -->
			
			<!-- 中间显示部分 -->
			<div class="main bkcolor-gray block-col">
				<div class="main-content  bkcolor-white">
					<div class="popup-level" v-if="!dialogconfig.isClose">
						<!-- 对话框 -->
						<div class="popup-dialog bkcolor-white" v-if="'popup-dialog'==dialogconfig.handle">
							<div class="dialog-title">
								@{{ dialogconfig.title }}
							</div>
							<p class="dialog-info block-row-center">
								@{{ dialogconfig.info }}
							</p>
							<!-- 按钮组 -->
							<div class="dialog-buttons">
								<div @click="dialogconfig.btnClick(btnid)" v-for="(btn,btnid) in dialogconfig.buttons">@{{ btn }}</div>
							</div>
							<!-- 按钮组 -->
						</div>
						<!-- 对话框 -->
					</div>
					<div class="my-dialog bkcolor-white" v-if="'my-dialog'==dialogconfig.handle">
						<div class="edit-title">
							<div style="width:3px;height:60%;background-color:#44ABF7;margin-right:10px;"></div>
							<div>修改密码</div>
						</div>
						<form @submit.prevent="mySubmit()" class="line-layout" style="flex:1;overflow:auto;">
							<input type="hidden"  v-model="formItem.id" />
							{{csrf_field()}}
							<div class="form-div col-12">
								<div class="form-title col-2">原密码</div>
								<input type="password" class="form-input" v-model="formItem.old_password" />
							</div>
							<div class="form-div col-12">
								<div class="form-title col-2">修改密码</div>
								<input type="password" class="form-input" v-model="formItem.new_password" />
							</div>	
							<div class="form-div col-12">
								<button class="btn form-btn">保存</button>
							</div>
						</form>
					</div>
				</div>
			</div>
			<!-- 中间显示部分 -->
		</div>
		<!-- 主体内容 -->
		
		<!--加载中-->
		<div class="loading" v-if="dialogconfig.showloading">
			<div class="container">
				<div class="gearbox">
					<div class="overlay"></div>
						<div class="gear one">
							<div class="gear-inner">
								<div class="bar"></div>
								<div class="bar"></div>
								<div class="bar"></div>
							</div>
						</div>
						<div class="gear two">
							<div class="gear-inner">
							<div class="bar"></div>
							<div class="bar"></div>
							<div class="bar"></div>
						</div>
					</div>
					<div class="gear three">
						<div class="gear-inner">
							<div class="bar"></div>
							<div class="bar"></div>
							<div class="bar"></div>
						</div>
					</div>
					<div class="gear four large">
						<div class="gear-inner">
							<div class="bar"></div>
							<div class="bar"></div>
							<div class="bar"></div>
							<div class="bar"></div>
							<div class="bar"></div>
							<div class="bar"></div>
						</div>
					</div>
				</div>
				<h1 class="load-txt">Loading...</h1>
			</div>
		</div>

	</div>
	
	<script type="text/javascript">
	window.onresize = function(){
		var width=document.documentElement.clientWidth;
		//var str="宽度："+width+"，高度："+document.documentElement.clientHeight;
		if(width<500){
			vm.leftMenu=false;
		}else{
			vm.leftMenu=true;
		}
	}
	var dialogconfig={
		showloading:false,
		buttons:['取消','确定'],
		isClose:true,
		title:'',
		info:'',
		handle:'my-dialog',
		callBack:function(){},
		showDialog:function(option){
			this.isClose=false;
			if(option){
				if('handle' in option){
					this.handle=option.handle;
				}
				if('title' in option){
					this.title=option.title;
				}
				if('info' in option){
					this.info=option.info;
				}
				if('buttons' in option){
					this.buttons=option.buttons;
					if(this.buttons.length<1){
						var _this=this;
						window.setTimeout(function(){
							_this.closeDialog();
						},1000);
					}
				}else{
					this.buttons=['取消','确定'];
				}
				if('success' in option){
					this.callBack=option.success;
				}
			}
		},
		closeDialog:function(){
			this.isClose=true;
		},
		btnClick:function(btnid){
			this.closeDialog();
			this.callBack(btnid);
		}
		
	}
	var vm=new Vue({
		el:'.page',
		data:{
			dialogconfig:dialogconfig,
			list:[],
			nowid:-1,
			formItem:{},
			page:1,
			pagecount:'',
			num:'20',
			column:'',
			leftMenu:true,
			screen:[]
		},
		created:function(){
			// this.loadList();
		},
		methods:{
			menu1Click:function(){
				this.dialogconfig.showDialog({
					handle:'my-dialog',
					title:'提示信息',
					info:'您确定要删除该项吗？',
					success:function(btnid){
						alert(btnid);
					}
				});
			},
			isShowPage:function(item){
				if(this.page<4&&item<8){
					return true;
				}else if(this.page>this.pagecount-4&&item>this.pagecount-7){
					return true;
				}else if(item>this.page-4&&item<this.page+4){
					return true;
				}
				return false;
			},
			loadPage:function(p){
				this.page=p;
				this.loadList();
			},
			loadList:function(){
				var _this=this;
				downList(this.screen,function(list){
					_this.column = list.length;
					_this.list = list.splice((_this.page - 1)*_this.num,_this.num);
					_this.pagecount = Math.ceil(_this.column / _this.num);
				});
			},
			mySubmit:function(){
				try{
					var _this=this;
					downList(this.formItem);
				}catch(ex){
					console.log(ex);
				}
				dialogconfig.closeDialog();
				return false;
			},
			menuIconClick:function(){
				this.leftMenu=!this.leftMenu;
			}
		}
	});

	function downList(obj){
		var list=[];			
		$.ajax({
			url:'http://juke.saoyidian.cn/zht/public/admin/mpsw',
			data:{
				'old_password': obj.old_password,
				'new_password': obj.new_password,
				'usertype': {{ Session::get('type') }},
				'userid': {{ Session::get('userid') }}
			},
			type:'get',
			success:function (res) {
				if(res == 1) {
					location.href='http://juke.saoyidian.cn/zht/public/login';
				}else {
					alert('修改失败');
				}
			},
			error:function(data){
                alert("修改失败");
            }
		});
	}
	
	
	function cloneObj(obj){
		if(isArrayFn(obj)){				
			var list=[];
			for(var i=0;i<obj.length;i++){			
				list[i]=cloneObj(obj[i]);
			}
			return list;
		}else if((typeof obj)=='object'){
			var rs={};
			
			for(var name in obj){					
				rs[name]=cloneObj(obj[name]);				
			}
			return rs;
		}else{

			return obj;
		}
	}
	function isArrayFn(value){
		if (typeof Array.isArray === "function") {
			return Array.isArray(value);
		}else{
			return Object.prototype.toString.call(value) === "[object Array]";
		}
	}


	</script>
</body>
</html>