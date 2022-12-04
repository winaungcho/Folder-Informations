<?php
include("FolderInfo.php");
/**
 * example for FolderInfo Class
 *
 * This class is free for the educational use as long as maintain this header together with this class.
 * Author: Win Aung Cho
 * Contact winaungcho@gmail.com
 * version 1.0
 * Date: 4-12-2022
 */
?>
	<!DOCTYPE html>
	<html lang="en">

	<head>
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1.60">
		<style>
		li {
			list-style: none;
			padding-left: 12px;
		}
		
		li::before {
			content: attr(data-style-type) " ";
			background-color: #bef;
		}
		span {
			background-color: #bef;
		}
		table { border: none }
		td, th{
			font-size: 1rem;
			min-width:90px;
			border-bottom: 1px solid #ddd;
		}
		</style>
	</head>

	<body>
<?php
$folderinfo = new FolderInfo();
$folderinfo->printAll();
?>
			<script>
			window.onload = function() {
				var li_ul = document.querySelectorAll(".collapse li ul");
				for(var i = 0; i < li_ul.length; i++) {
					li_ul[i].style.display = "none";
				};
				var exp_li = document.querySelectorAll(".collapse li > span");
				for(var i = 0; i < exp_li.length; i++) {
					exp_li[i].style.cursor = "pointer";
					exp_li[i].onclick = showul;
					exp_li[i].parentNode.dataset.styleType = '+';
					exp_li[i].parentNode.style.padding = '0px';
				};

				function showul() {
					nextul = this.nextElementSibling;
					while(nextul) {
						if(nextul.matches('ul') || nextul.matches('ol')) break;
						nextul = nextul.nextElementSibling;
					}
					if(nextul.style.display == "block") {
						nextul.style.display = "none";
						this.parentNode.dataset.styleType = '+';
					} else {
						nextul.style.display = "block";
						this.parentNode.dataset.styleType = '-';
					}
				}
			}
			</script>
	</body>

	</html
