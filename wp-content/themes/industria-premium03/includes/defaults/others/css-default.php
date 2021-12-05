<?php
	function style_css_all_dashboard(){
		echo '	<style type="text/css">
					.wsg_info, .wsg_success, .wsg_warning, .wsg_error {
						margin: 10px 0px;
						padding:12px;
					}
					.wsg_info {
						color: #00529B;
						background-color: #BDE5F8;
					}
					.wsg_success {
						color: #4F8A10;
						background-color: #DFF2BF;
					}
					.wsg_warning {
						color: #9F6000;
						background-color: #FEEFB3;
					}
					.wsg_error {
						color: #D8000C;
						background-color: #FFD2D2;
					}
					.wsg_info i, .wsg_success i, .wsg_warning i, .wsg_error i {
						margin:10px 22px;
						font-size:2em;
						vertical-align:middle;
					}
				</style>';
	}
	add_action('admin_head','style_css_all_dashboard');
?>