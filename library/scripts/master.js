var $headerMenuCate = $('.header-menu-cate'); // 获取左侧菜单的一级菜单li

$headerMenuCate.on('click', function() {
	var $category = $(this).find('ul'); // 一级菜单对应下的二级菜单

	// 检测二级菜单是否显示
	if ($category.css('display') == 'none') {
		$headerMenuCate.removeClass('click');
		$headerMenuCate.find('ul').slideUp(500); // 关闭所有标签

		$(this).addClass('click'); // 隐藏时 点击 则显示并加上click类
		$category.slideDown(500);
	} 
	// else {
	// 	$(this).removeClass('click'); // 显示时 点击 则隐藏并加上click类
	// 	$category.slideUp(500);
	// }
});

// 定位当前页面所对应的菜单项
var $contentTitle = $('.content-title').html(), // 获取当前页面的标题
	$menus = [
		['我的首页', '我的资料', '修改密码', '登录日志'], 
		['当前借阅', '历史借阅', '预约记录', '超期信息', '欠款记录'],
		['我的推荐', '电子订单推荐']
	]; // 菜单信息

	/* 通过使用两次循环找到当前页面在菜单中的位置
	* 第一次循环找到当前页面在一级菜单中的index
	* 第二次循环找到当前页面在二级菜单中的index
	*/

	for (var $i = 0; $i < $menus.length; $i++) {
		if ($menus[$i].indexOf($contentTitle) != -1) {
			$($headerMenuCate[$i]).addClass('click'); // 为当前一级菜单添加click类
			$($headerMenuCate[$i]).find('ul').show(); // 显示二级菜单

			var $category = $($headerMenuCate[$i]).find('li'); // 获取当前一级菜单下面所有二级菜单

			for (var $j = 0; $j < $category.length; $j++) {
				if ($($category[$j]).find('span').html() == $contentTitle) { // 判断当前二级菜单的值（存在span标签中）是否是当前页面的标题值
					$($category[$j]).addClass('active'); // 为当前二级菜单添加actiive类
					break;
				}
			}

			break;
		}
	}

// 退出登录按钮
$('.logout').on('click', function() {
	if (confirm('确定要退出吗？')) { // 弹出对话框 是否退出
		location.href = '../login.php';
	}
});
