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

	// 需要检索时
	if ($paramObj.txtSearch) {
		$urlAddr += '&txtSearch=' + $paramObj.txtSearch;
	}
	
	top.location = $urlAddr;
});


/* student-current.php 当前借阅页面 */
$('.current-table-renew').on('click', function(e) {
	if (!confirm('确认要续借吗?')) { // 弹出框点击的是“否”，则阻止链接跳转
		e.preventDefault();
	}
});

/* 删除询问 */
$('.delete').on('click', function(e) {
	if (!confirm('确认要删除吗?')) { // 弹出框点击的是“否”，则阻止链接跳转
		e.preventDefault();
	}
});

/* student-recomment.php 我的推荐页面 */
// 查看详情
$('.click-detail').on('click', function() {
	var $reason = $(this).parent().attr('alt'), // 理由 存储在li，即它的父元素的alt属性里面
		$bookName = $(this).parent().prevAll('.mytable-th-td-large').html(); // 获取书籍名

	$('.pop-content-item-reson').html($reason); // 将.pop-content-item-reson的内容替换成$reason
	$('.pop-content-item-book').html($bookName);

	$('.pop-wrap').slideDown(800); // 用时800ms，展开.pop-wrap
});

/* student-recomall.php 推荐页面 */
$('.recomall-table-agree').on('click', function(e) {
	if (!confirm('确认要推荐吗？')) { // 弹出框点击的是“否”，则阻止链接跳转
		e.preventDefault();
	}
});

/* student-new-recomment.php 添加推荐页面 */
$('.wrap-new-recom').on('submit', function() {
	if ($('#txtReason').val().length > 500) {
		alert('推荐理由不能超过500字');
		return false;
	}

	if ($('#txtName').val().length > 50) {
		alert('书籍名不能超过50字');
		return false;
	}

	if ($('#txtAuthor').val().length > 50) {
		alert('作者名不能超过50字');
		return false;
	}

	if ($('#txtIbsn').val().length > 50) {
		alert('IBSN不能超过50字');
		return false;
	}

	return true;
});

/* student-order.php 预约记录页面 */
$('.order-table-cancel').on('click', function(e) {
	if (!confirm('确认要取消预约吗?')) { // 弹出框点击的是“否”，则阻止链接跳转
		e.preventDefault();
	}
});