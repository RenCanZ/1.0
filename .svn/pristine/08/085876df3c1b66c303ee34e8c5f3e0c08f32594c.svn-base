<?php
	function sendMessage($p){
		//初始化必填
		//填写在开发者控制台首页上的Account Sid
		$options['accountsid']='80b8200cf268227c25ae0044bdae013d';
		//填写在开发者控制台首页上的Auth Token
		$options['token']='683f56ceaf0845984486ad3dba75f2e2';

		//初始化 $options必填
		$ucpass = new Ucpaas($options);

		$appid = "e4b8bcf7d9c54159b908bd575a39ee90";	//应用的ID，可在开发者控制台内的短信产品下查看
		//短信模板id
		$templateid = "366196";    //可在后台短信产品→选择接入的应用→短信模板-模板ID，查看该模板ID
		//校验码内容
		$param = rand(000000,999999); //多个参数使用英文逗号隔开（如：param=“a,b,c”），如为参数则留空
		//存储在cookie
		\Cookie::queue('param',$param,3);
		//接收短信校验码的手机号
		$mobile = $p;
		$uid = "";

		//70字内（含70字）计一条，超过70字，按67字/条计费，超过长度短信平台将会自动分割为多条发送。分割后的多条短信将按照具体占用条数计费。

		echo $ucpass->SendSms($appid,$templateid,$param,$mobile,$uid);
	}
 ?>