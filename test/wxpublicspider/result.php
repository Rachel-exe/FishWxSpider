<?php
	$public_history_url = $_GET["data"];
	//����ʷ��Ϣurl����phantomjsת��Ϊ��ת���url
	$public_history_newurl = exec("curl 127.0.0.1:8787 -d \"$public_history_url\"");
	$public_history_newurl = json_decode($public_history_newurl);
	//��ȡ��ת��url�Ĺؼ�����������������ȡ��ʷ��Ϣ���ݵ�url
	$paraUrl = explode('?',$public_history_newurl);
	$para = $paraUrl[1];
	$paraList = explode('&',$para);
	var_dump($paraList);
	exit();
	$paraMap = array();
	foreach( $paraList as $paraSingle ){
		$paraMap[ substr($paraSingle,0,strpos($paraSingle,"=")) ] =
			substr($paraSingle,strpos($paraSingle,"=")+1);
	}
	$messageListUrl = "http://mp.weixin.qq.com/mp/getmasssendmsg?".
		"__biz=".$paraMap["__biz"].
		"&uin=".$paraMap["uin"].
		"&key=".$paraMap["key"].
		"&f=json&count=10";
	//��ȡ����
	//FIXME ����õ���������php��curl�⽫������������ŵ����ݿ�ģ���ֱ��Location���������ȡ��
	header("Location: ".$messageListUrl);
?>
