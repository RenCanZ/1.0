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
				<a class="left-menu-item left-menu-item-active" href="dealer" v-if="{{ Session::get('type')}} == 1">
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
				<a class="left-menu-item" href="psw">
					<span class="icon fa-cog left-menu-icon"></span>
					修改密码				
				</a>
			</div>
			<!-- 左侧菜单 -->
			
			<!-- 中间显示部分 -->
			<div class="main bkcolor-gray block-col">
				<div class="main-title bkcolor-white">
					经销商添加
					<span @click="addClick" class="icon fa-plus" style="margin-left:10px;color:#4b981b;"></span>
					<form @submit.prevent="myScreen()" style="display: initial;">
						姓名: <input type="text" v-model="screen.name">
						地区: <input type="text" v-model="screen.area">
						<button class="btn form-btn" style="display: initial;">查找</button>
					</form>
				</div>
				<div class="main-content  bkcolor-white">
					<table role="table">
						<thead role="rowgroup">
							<tr role="row">
							<th role="columnheader">名称</th>
							<th role="columnheader" v-if="{{ Session::get('type')}} == 1">等级</th>
							<th role="columnheader">地区</th>
							<th role="columnheader">客服id</th>
							<th role="columnheader">销售数量</th>
							<th role="columnheader">操作</th>
							</tr>
						</thead>
						<tbody role="rowgroup">
							<tr role="row" v-for="(item,id) in list" v-if="id+(page-1)*num>=(page-1)*num && id+(page-1)*num<page*num">
								<td role="cell">@{{ item.name }}</td>
								<td role="cell" v-if="{{ Session::get('type')}} == 1">@{{ item.level }}</td>
								<td role="cell">@{{ item.area }}</td>
								<td role="cell">@{{ item.cs_id }}</td>
								<td role="cell">@{{ item.program_num }}</td>
								<td role="cell">
									<span title="编辑" @click="editClick(item,id)" class="icon fa-pencil-square-o" style="margin-left:10px;color:#15d03e;"></span>
									<span @click="delClick(item,id)" class="icon fa-times" style="margin-left:10px;color:#f00;"></span>
									<span title="添加商户" @click="addMerClick(item,id)" class="icon fa-magnet" style="margin-left:10px;color:#15d03e;"></span>
									
								</td>
							</tr>
							
						</tbody>
					</table>
					<div class="block-row-colcenter" style="height:30px;border-top:solid 1px #e0e0e0;">
						<div class="col-3">共@{{ column }}条记录，@{{ page }}/@{{ pagecount }}页</div> 
						<div class="col-8 block-row" style="justify-content:flex-end;">
							<button style="margin-left:5px;" @click="loadPage(1)">首页</button>
							<button :class="item==page?'btn':''" @click="loadPage(item)" v-for="item in pagecount" v-if="isShowPage(item)" style="margin-left:5px;">@{{ item }}</button>							
							<button style="margin-left:5px;" @click="loadPage(pagecount)">末页</button>
						</div> 
					</div>
				</div>
			</div>
			<!-- 中间显示部分 -->
		</div>
		<!-- 主体内容 -->
		
		<!-- 弹窗 -->
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
			
			<!-- 编辑、添加对话框 -->
			<div class="my-dialog bkcolor-white" v-if="'my-dialog'==dialogconfig.handle">
				<div class="edit-title">
					<div style="width:3px;height:60%;background-color:#44ABF7;margin-right:10px;"></div>
					<div>经销商信息</div>
				</div>
				<form @submit.prevent="mySubmit()" class="line-layout" style="flex:1;overflow:auto;">
					<input type="hidden"  v-model="formItem.id" />
					<div class="form-div col-12">
						<div class="form-title col-2">名称</div>
						<input type="text" class="form-input" v-model="formItem.name" />
					</div>
					<div class="form-div col-12">
						<div class="form-title col-2">等级</div>
						<input type="text" class="form-input" required v-model="formItem.level" />
					</div>
					<div class="form-div col-12">
						<div class="form-title col-2">地区</div>
						<input type="text" class="form-input" v-model="formItem.area" />
					</div>
					<div class="form-div col-12">
						<div class="form-title col-2">客服id</div>
						<input type="text" class="form-input" v-model="formItem.cs_id" />
					</div>
					<div class="form-div col-12">
						<button class="btn form-btn" v-if="!formItem.id">添加</button>
						<button class="btn form-btn" v-if="formItem.id">保存</button>
						<button class="btn form-btn" type="button" onclick="dialogconfig.closeDialog()">取消</button>
					</div>
				</form>
			</div>
			<!-- 编辑、添加对话框 -->
			<div class="my-dialog bkcolor-white" v-if="'addCou'==dialogconfig.handle">
				<div class="edit-title">
					<div style="width:3px;height:60%;background-color:#44ABF7;margin-right:10px;"></div>
					<div>添加商户</div>
				</div>
				<form @submit.prevent="MerSubmit()" class="line-layout" style="flex:1;overflow:auto;">
					<input type="hidden"  v-model="formItem.id" />
					<div class="form-div col-12">
						<div class="form-title col-2">经销商</div>
						<input type="text" class="form-input" v-model="formItem.name" readonly/>
					</div>
					<div class="form-div col-12">
						<div class="form-title col-2">法人</div>
						<input type="text" class="form-input" v-model="formItem.merchant_name" />
					</div>
					<div class="form-div col-12">
						<div class="form-title col-2">手机号</div>
						<input type="text" class="form-input" required v-model="formItem.phone" />
					</div>
					<div class="form-div col-12">
						<div class="form-title col-2">营业执照</div>
						<input type="text" class="form-input" v-model="formItem.business_license" />
					</div>
					<div class="form-div col-12">
						<div class="form-title col-2">公司</div>
						<input type="text" class="form-input" v-model="formItem.company" />
					</div>
					<div class="form-div col-12">
						<div class="form-title col-2">地址</div>
						<input type="text" class="form-input" v-model="formItem.address" />
					</div>							
					<div class="form-div col-12">
						<button class="btn form-btn" v-if="!formItem.id">添加1</button>
						<button class="btn form-btn" v-if="formItem.id">添加</button>
						<button class="btn form-btn" type="button" onclick="dialogconfig.closeDialog()">取消</button>
					</div>
				</form>
			</div>
		</div>
		<!-- 弹窗 -->
		
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
			this.loadList();
		},
		methods:{
			login:function(){
				
			},
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
					// console.log(list);
					// var _list = list;
					_this.column = list.length;
					_this.list = list.splice((_this.page - 1)*_this.num,_this.num);
					_this.pagecount = Math.ceil(_this.column / _this.num);
				});
			},
			addClick:function(){
				this.formItem={};
				this.nowid=-1;
				dialogconfig.showDialog({
					handle:'my-dialog'
				});
			},
			delClick:function(item,id){
				var _this=this;
				dialogconfig.showDialog({
					handle:'popup-dialog',
					title:'警告！',
					info:'您确定要删除该项吗？',
					success:function(e){
						if(e==1){
							delItem(item.id,function(){
								_this.list.splice(id,1);
								_this.column -= 1;
								_this.pagecount = Math.ceil(_this.column / _this.num);
								_this.loadList();
							});
						}
					}
				});
			},
			editClick:function(item,id){
				this.formItem=cloneObj(item);
				this.nowid=id;
				dialogconfig.showDialog({
					handle:'my-dialog'
				});
			},
			addMerClick:function(item,id){
				this.formItem=addMerObj(item);
				this.nowid=id;
				dialogconfig.showDialog({
					handle:'addCou'
				});
			},
			mySubmit:function(){
				try{
					var _this=this;
					if(this.formItem.id>0){
						//保存
						saveItem(this.formItem,function(){
							_this.list[_this.nowid]=_this.formItem;
							_this.formItem={};
							_this.nowid=-1;
						});
						
						
					}else{
						//添加
						addItem(this.formItem,function(res){
							_this.formItem.id=res.id;
							_this.list.push(res);
							// _this.formItem={};
							_this.column += 1;
							//_this.list = _this.list.splice((_this.page - 1)*_this.num,_this.num);
							_this.pagecount = Math.ceil(_this.column / _this.num);
							_this.nowid=-1;
						});
					}
				}catch(ex){
					console.log(ex);
				}
				dialogconfig.closeDialog();
				return false;
			},
			myScreen:function(){
				try{
					var _this=this;
					downList(this.screen,function(list){
						_this.column = list.length;
						_this.list = list.splice((_this.page - 1)*_this.num,_this.num);
						_this.pagecount = Math.ceil(_this.column / _this.num);
					});
				}catch(ex){
					console.log(ex);
				}
				dialogconfig.closeDialog();
				return false;
			},
			MerSubmit:function(){
				try{
					var _this=this;
					if(this.formItem.id>0){
						//添加
						addMerItem(this.formItem);						
					}
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
	
	
	function saveItem(obj,callback){
		// console.log(obj);
		$.ajax({
			url:'http://juke.saoyidian.cn/zht/public/admin/savedealer',
			data:{
				'level' : obj.level,
				'area' : obj.area,
				'cs_id' : obj.cs_id,
				'name' : obj.name,
				'id': obj.id
			},
			type:'get',
			success:function (res) {
				// var res = $.parseJSON(res);
				dialogconfig.showloading=true;
				setTimeout(function(){
					dialogconfig.showloading=false;					
					if(callback){
						callback();
					}
				},1000);
			},
			error:function(data){
                alert("用户名提交出现了错误！");
            }
		});		
	}
	function addItem(obj,callback){
		$.ajax({
			url:'http://juke.saoyidian.cn/zht/public/admin/adddealer',
			data:{
				'level' : obj.level,
				'area' : obj.area,
				'cs_id' : obj.cs_id,
				'name' : obj.name,
				'_token' : "{{csrf_token()}}"
			},
			type:'get',
			success:function (res) {
				var res = $.parseJSON(res);
				dialogconfig.showloading=true;
				setTimeout(function(){
					dialogconfig.showloading=false;
					if(callback){
						callback(res);
					}
				},1000);
			},
			error:function(data){
                alert("用户名提交出现了错误！");
            }
		});
	}
	function addMerItem(obj){
		$.ajax({
			url:'http://juke.saoyidian.cn/zht/public/admin/addmerchant',
			data:{
				'name' : obj.merchant_name,
				'phone' : obj.phone,
				'business_license': obj.business_license,
				'company': obj.company,
				'address': obj.address,
				'dealer_id': obj.id
			},
			type:'get',
			success:function (res) {
				dialogconfig.showloading=true;
				setTimeout(function(){
					dialogconfig.showloading=false;
				},1000);
			},
			error:function(data){
                alert("用户名提交出现了错误！");
            }
		});		
	}
	function delItem(pid,callback){
		$.ajax({
			url:'http://juke.saoyidian.cn/zht/public/admin/deldealer',
			data:{
				'id' : pid,
			},
			type:'get',
			success:function () {
				// var res = $.parseJSON(res);
				dialogconfig.showloading=true;
				setTimeout(function(){
					dialogconfig.showloading=false;
					if(callback){
						callback();
					}
				},1000);
			},
			error:function(data){
                alert("删除数据错误！");
            }
		});
	}
	function downList(obj,callback){
		var list=[];
		$.ajax({
			url:'http://juke.saoyidian.cn/zht/public/admin/downList',
			data:{
				'name' : obj.name,
				'area': obj.area
			},
			type:'get',
			success:function (res) {
				if(callback){
					callback(res);
				}
			},
			error:function(data){
                alert("数据获取失败");
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
	function addMerObj(obj){
		if(isArrayFn(obj)){				
			var list=[];
			for(var i=0;i<obj.length;i++){			
				list[i]=addMerObj(obj[i]);
			}
			return list;
		}else if((typeof obj)=='object'){
			var rs={};
			
			for(var name in obj){					
				rs[name]=addMerObj(obj[name]);				
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