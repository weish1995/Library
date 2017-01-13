$('.frm-passwd').on('submit', function() {
	if ($('.frm-passwd-newpwd').val() != $('.frm-passwd-newagain').val()) {
		alert('两次密码输入不一致!');
		return false;
	}

	return true;
});