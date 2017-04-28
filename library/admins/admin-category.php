<!DOCTYPE html>
<html>
<head>
	<title>人员书籍-书籍类别</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/master.css">
	<link rel="stylesheet" type="text/css" href="../css/form.css">
	<link rel="stylesheet" type="text/css" href="../css/admin-contents.css">
</head>
<body>
	<?php 
		include 'admin-master.php';

		$id = 0; // 代操作的id
		$type = 'add'; // 默认为添加
		$value = ''; // 默认显示在输入框内的值
		$text = '添加'; // 用于显示按钮和标题的值

		if (isset($_GET['id'])) {
			$id = $_GET['id'];
		}

		if (isset($_GET['type'])) {
			$type = $_GET['type'];
		}

		// 删除操作
		if ($type == "delete") {
			if ($db->singleOp('delete from category where cateId = '.$id)) {
				echo '<script>alert("删除成功!")</script>';
			} else {
				echo '<script>alert("删除失败!")</script>';
			}
		}

		// 根据id获取到类别名
		if ($id != 0 && $type == 'edit') {
			$value = $db->getSingleData('select cateName from category where cateId = '.$id);
			$text = '修改';
		}

		// 点击了按钮 
		if (isset($_POST['subOk'])) {
			if ($type == 'edit') {
				// 修改的sql
				$sql = 'update category set cateName = "'.$_POST['txtName'].'" where cateId = '.$id;
			} else {
				// 添加的sql
				$sql = 'insert into category (cateName) values ("'.$_POST['txtName'].'")';
			}

			if ($db->singleOp($sql)) {
				echo '<script>alert("'.$text.'成功")</script>';
			} else {
				echo '<script>alert("'.$text.'失败")</script>';
			}
		}
	?>

	<div class="content">
		<!-- 正文内容头部 -->
		<div class="content-header">
			<h3 class="content-title">书籍类别</h3>
			<small class="content-subtitle">类别删除时会将该类别下所有书籍删除</small>
			<div class="content-breadcrumb">
				<span class="content-breadcrumb-span">
				<i class="content-breadcrumb-icon header-menu-icon-people"></i>人员书籍
				</span>>
				<span class="content-breadcrumb-span">书籍类别</span>
			</div>
		</div>

		<div class="wrap wrap-cate">
			<h3 class="wrap-title">
				<i class="wrap-title-icon header-menu-icon-cate"></i>CATEGORY
			</h3>
			<ul class="cate-group">
			<?php
				$infos = $db->getData('select * from category');

				for ($i = 0; $i < sizeof($infos); $i++) {
 			?>
				<li class="cate-item">
					<?php echo $infos[$i]['cateName'];?>
					<a class="cate-item-dele" href="admin-category.php?id=<?php echo $infos[$i]['cateId'];?>&type=delete" title="删除">-</a>
					<a class="cate-item-edit" href="admin-category.php?id=<?php echo $infos[$i]['cateId'];?>&type=edit" title="修改"></a>
				</li>
			<?php
				}
			?>
			</ul>
			<h3 class="cate-edit-title">
				<?php echo $text;?>
				<a class="cate-edit-title-a" href="admin-category.php?type=add" title="切换到添加">添加</a>
			</h3>
			<form class="cate-edit" action="" method="post">
				<label>类别名：</label>
				<input type="text" name="txtName" id="txtName" value="<?php echo $value;?>" required>
				<input type="submit" name="subOk" value="<?php echo $text;?>">
			</form>
		</div>
	</div>

	<script type="text/javascript" src="../scripts/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="../scripts/master.js"></script>
	<script type="text/javascript" src="../scripts/student-contents.js"></script>
	<script type="text/javascript">
		$('.cate-item-dele').on('click', function(e) {
			if (!confirm("确定要删除吗")) { // 弹出删除询问框，确定后执行跳转 否则不跳转
				e.preventDefault();
			}
		});
	</script>
</body>
</html>
