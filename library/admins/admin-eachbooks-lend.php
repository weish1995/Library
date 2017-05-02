<!DOCTYPE html>
<html>
<head>
	<title>人员书籍-借出书籍</title>
	<meta charset="utf-8">
	<link rel="stylesheet" type="text/css" href="../css/master.css">
	<link rel="stylesheet" type="text/css" href="../css/form.css">
	<link rel="stylesheet" type="text/css" href="../css/admin-contents.css">
</head>
<body>
	<?php 
		include 'admin-master.php';

		// 用于初始化
		$eachId = '';
		$status = ''; // 状态
		$booksId = '';
		$bookName = '';
		$date = Date('Y-m-d', time()); // 默认显示当前时间

		// 预约中 或者 已借出 显示
		$studentId = '';

		// 输入框 按钮 能否被操作
		$textDis = '';

		// 获取详细书籍id
		if (isset($_GET['eachId'])) {
			$eachId = $_GET['eachId'];

			// 获取基本数据
			$sqlData = 'select * from eachbooks join books on books.booksId = eachbooks.booksId where eachId = "'.$eachId.'"';

			$infoData = $db->getData($sqlData)[0];
			$status = $infoData['status'];
			$booksId = $infoData['booksId'];
			$bookName = $infoData['bookName'];

			// 被别人预约之后 只能借给预约人 只能点击借出按钮进行借阅
			if ($status == '预约中') {
				$orderInfo = $db->getData('select * from orders where orderType = "生效中" and eachId = "'.$eachId.'"')[0];
				$studentId = $orderInfo['studentId'];
				$date = $orderInfo['orderDate'];
				$textDis = 'disabled';
			}

			// 借出之后只能查看信息 不能再进行借书操作
			if ($status == '已借出') {
				$lendInfo = $db->getData('select * from records where eachId = "'.$eachId.'"')[0];
				$studentId = $lendInfo['studentId'];
				$date = $lendInfo['startDate'];
				$textDis = 'disabled';
			}
		} else {
			// 未传递eachId 连接到 books页面
			header('location: admin-books.php');
		}

		// 借书操作
		if (isset($_POST['subOk'])) {
			if ($status == '在馆') {
				$studentId = $_POST['selStudent'];
			}

			$sqlLend = 'insert into records (studentId, eachId, startDate, destine, renew) values ("'.$studentId.'", "'.$eachId.'", "'.date('Y-m-d', time()).'", "'.date('Y-m-d', strtotime("+1 months", time())).'", 0)';

			// 更改书籍状态
			$sqlCh = 'update eachbooks set status = "已借出" where eachId = "'.$eachId.'"';

			if ($db->singleOp($sqlLend) && $db->singleOp($sqlCh)) {
				// 借书后 要将预约中的书籍取消掉
				if ($status == '预约中') {
					$db->singleOp('update orders set orderType = "已借" where studentId = "'.$studentId.'" and eachId = "'.$eachId.'"');
				}

				echo '<script>alert("借书成功");top.location="admin-eachbooks.php?booksId='.$booksId.'"</script>';
			} else {
				echo '<script>alert("借书失败")</script>';
			}
		}

		// 还书操作
		if (isset($_POST['subReturn'])) {
			// 获取记录Id
			$recordId = $db->getSingleData('select recordId from records where studentId = "'.$studentId.'" and eachId = "'.$eachId.'" and endDate is null');

			// 修改借阅记录
			$rec = $db->singleOp('update records set endDate = "'.date('Y-m-d', time()).'" where recordId = "'.$recordId.'"');
			// 修改书籍状态
			$eachSta = $db->singleOp('update eachbooks set status = "在馆" where eachId = "'.$eachId.'"');

			if ($rec && $eachSta) {
				echo '<script>alert("还书成功");top.location="admin-eachbooks.php?booksId='.$booksId.'"</script>';
			} else {
				echo '<script>alert("借书失败")</script>';
			}
		}
	?>

	<div class="content">
		<!-- 正文内容头部 -->
		<div class="content-header">
			<h3 class="content-title">图书管理</h3>
			<small class="content-subtitle">书籍借出</small>
			<div class="content-breadcrumb">
				<span class="content-breadcrumb-span">
				<i class="content-breadcrumb-icon header-menu-icon-person"></i>人员书籍
				</span>>
				<span class="content-breadcrumb-span">借出书籍</span>
			</div>
		</div>

		<form class="wrap wrap-user-edit" method="post" action="">
			<h3 class="wrap-title">
				<i class="wrap-title-icon header-menu-icon-edit"></i>LEND BOOKS
			</h3>
			<div class="wrap-group">
				<label class="wrap-new-label" for="txtId"><span class="require">*</span>索书号：</label>
				<input class="wrap-new-text disabled" name="txtId" id="txtId" value="<?php echo $eachId;?>" type="text"  placeholder="自动生成索书号：" disabled>
			</div>
			<div class="wrap-group">
				<label class="wrap-new-label" for="txtName"><span class="require">*</span>书籍名：</label>
				<input class="wrap-new-text disabled" name="txtName" id="txtName" disabled value="<?php echo $bookName;?>" type="text" required placeholder="请输入书籍名：">
			</div>
			<div class="wrap-group">
				<label class="wrap-new-label" for="selStudent"><span class="require">*</span>借阅人(姓名+id)：</label>
				<select class="wrap-new-text wrap-each-select <?php echo $textDis;?>" name="selStudent" <?php echo $textDis;?>>
					<?php
						// 从读者表中读出
						$stuInfo = $db->getData('select * from students');
						$selected = '';

						for ($i = 0; $i < sizeof($stuInfo); $i++) {
							if ($stuInfo[$i]['studentId'] == $studentId) {
								$selected = 'selected'; // 设置默认选中
							} else {
								$selected = '';
							}

							echo '<option value="'.$stuInfo[$i]['studentId'].'" '.$selected.'>'.$stuInfo[$i]['studentName'].'　'.$stuInfo[$i]['studentId'].'</option>';
						}
					?>
				</select>
			</div>
			<div class="wrap-group">
				<label class="wrap-new-label" for="txtDate"><span class="require">*</span>日期：</label>
				<input class="wrap-new-text disabled" type="text" name="txtDate" id="txtDate" disabled value="<?php echo $date;?>">
			</div>
			<div class="wrap-group">
				<label class="wrap-new-label" for="txtStatus"><span class="require">*</span>书籍状态：</label>
				<input class="wrap-new-text disabled" type="text" name="txtStatus" id="txtStatus" disabled value="<?php echo $status;?>">
			</div>
			<div class="wrap-group wrap-group-btn book-edit-wrap">
				<?php
					if ($status == "已借出") {
						echo '<input class="wrap-new-button" type="submit" name="subReturn" value="还书">';
					} else {
						echo '<input class="wrap-new-button" type="submit" name="subOk" value="借出">'
							.'<input class="wrap-new-button" type="reset" name="reset" value="重置">';
					}
				?>
				<a  class="wrap-new-button" href="admin-eachbooks.php?booksId=<?php echo $booksId;?>">返回</a>
			</div>
		</form>
	</div>

	<script type="text/javascript" src="../scripts/jquery-2.1.4.min.js"></script>
	<script type="text/javascript" src="../scripts/master.js"></script>
	<script type="text/javascript" src="../scripts/student-contents.js"></script>
</body>
</html>
