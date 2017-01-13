<?php
	class DataBase {
		var $conn;

		/**
		* @func
		* @desc 打开数据库
		*/
		function open() {
			$conn = mysql_connect("localhost","root","") or die(mysql_error());
            mysql_query("SET NAMES UTF8");
            mysql_select_db("library");
		}

		/**
		* @func
		* @desc 关闭数据库
		*/
		function close() {
			mysql_close();
		}

		/**
		* @func
		* @desc 单条增删改数据操作
		* @param {string} $sql - sql语句
		* return true - 执行成功 false - 执行失败
		*/
		function singleOp($sql) {
			$this->open();

			if (mysql_query($sql)) {
				$this->close();
				return true;
			} else {
				$this->close();
				return false;
			}
		}

		/**
		* @func
		* @desc 单条搜索数据操作
		* @param {string} $sql - sql语句
		* return {array} resl 二维数组
		*/
		function getData($sql) {
			$this->open();
			$resl = Array();

			$select = mysql_query($sql);
	        while ($row = mysql_fetch_array($select)) {
	        	array_push($resl, $row);
	        }

	        $this->close();
	        return $resl;
		}

		/**
		* @func
		* @desc 获取指定查询sql的返回值数量
		* @param {string} $sql sql语句
		* return {number} $num 数量
		*/
		function getNum($sql) {
			$this->open();

			$num = mysql_num_rows(mysql_query($sql));
			$this->close();

			return $num;
		}

		/**
		* @func
		* @desc 验证是否存在数据
		* @param {string} $sql - sql语句
		* return {bool} true 存在  false 不存在
		*/
		function dataSet($sql) {
			$this->open();
			
			if (mysql_fetch_array(mysql_query($sql))) {
				$this->close();

				return true;
			}

			$this->close();

	        return false;
		}
	}