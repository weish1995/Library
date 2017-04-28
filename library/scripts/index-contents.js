// 点击搜索键
$('.search-button').on('click', function() {
	searchBook();
});

// 回车搜索
$(document).on('keyup', function(e) {
    if (e.keyCode === 13) {
        searchBook();
    }
});

/*
* @func searchBook
* @desc 搜索操作
*/
function searchBook() {
	if ($('#searchInput').val() != '') {
		var $key = $('.search-select').val(), // 获取下拉框的值
			$words = $('#searchInput').val().trim(); // 获取搜索框的值 清除两端空格

		window.location.href= 'book-list.php?key=' + $key + '&words=' + $words;
	}
}
