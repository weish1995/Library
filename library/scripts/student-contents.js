/* student-passwd.php 修改密码页面 */
//判断两次输入的密码是否一致
$('.frm-passwd').on('submit', function() {
	if ($('.frm-passwd-newpwd').val() != $('.frm-passwd-newagain').val()) {
		alert('两次密码输入不一致!');
		return false;
	}

	return true;
});

/* 所有需要进行排序的页面 即运用了 .mytable-th-td类的页面 */

/*
* @func splitParam
* @desc 用于分解url里面的参数部分
* @param {String} $param url的参数部分
* @return {Object} 返回一个对象 包含url的参数
*
* 例子：分解 http://localhost/library/library/students/student-loginfo.php?page=1&sort=logDate&sortType=desc
*/
var splitParam = function($param='') { // 这里的$param = page=1&sort=logDate&sortType=desc
	var $paramAll = $param.split('&'), // 数组，以&符号进行分隔的各部分，$paramAll = ['page=1', 'sort=logDate', 'sortType=desc']
		retObj = {}; // 要返回的对象

	// 遍历$paramAll数组
	for (var $i = 0; $i < $paramAll.length; $i++) { // 以 'page=1' 为例
		var $paEvery = $paramAll[$i].split('='); // 数组 以=进行分隔 ['page', '1']
		retObj[$paEvery[0]] = $paEvery[1]; // 相当于 retObj.page = 1;
	}

	return retObj;
};

// 点击表头进行排序
$('.mytable-th-td').on('click', function() {
	var $url = window.location.href, // 获取url
		$urlAddr = $url.split('?')[0], // url地址部分 ?前面的部分
		$urlParam = $url.split('?')[1]; // url参数部分 ?后面的部分

	var $paramObj = splitParam($urlParam); // 调用分解参数的函数

	$paramObj.sort = $(this).attr('alt');

	if (!$(this).attr('alt'))
		return;

	if ($paramObj.sortType != 'desc') {
		$paramObj.sortType = 'desc'; // 之前不是逆序排序的，则改为逆序排序，否则改为正序排序
	} else {
		$paramObj.sortType = 'asc';
	}

	if (!$paramObj.page) {
		$paramObj.page = 1;
	}

	// 将$paramObj对象转换为url 例如：$paramObj = ['page=1', 'sort=logDate', 'sortType=desc']
	$urlAddr += '?page=' + $paramObj.page + '&sort=' + $paramObj.sort + '&sortType=' + $paramObj.sortType;
	
	top.location = $urlAddr;
});


/* student-current.php 当前借阅页面 */
$('.current-table-renew').on('click', function(e) {
	if (!confirm('是否要续借?')) { // 弹出框点击的是“否”，则阻止链接跳转
		e.preventDefault();
	}
});