<?php
	function hide_buttons_adminpanel(){
		echo '	<style type="text/css">
					body.post-type-adminpanel #posts-filter select option[value=trash],
					body.post-type-adminpanel #posts-filter table tr td:first-child,
					body.post-type-adminpanel #posts-filter table tr th:first-child,

					body.post-type-adminpanel .page-title-action,

					body.post-type-adminpanel #misc-publishing-actions,
					body.post-type-adminpanel #minor-publishing-actions,

					body.post-type-adminpanel tr span.trash,
					body.post-type-adminpanel a.page-title-action,
					body.post-type-adminpanel #delete-action,
					body.post-type-adminpanel tr span.view,
					body.post-type-adminpanel tr span.inline.hide-if-no-js,

					body.post-type-adminpanel #titlediv > .inside {
						display: none !important;
					}
					body.post-type-adminpanel .fixed .column-position{
						width:10%;
					}
				</style>';
	}
	add_action('admin_head','hide_buttons_adminpanel');
?>