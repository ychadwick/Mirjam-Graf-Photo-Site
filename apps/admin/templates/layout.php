<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
	<head>
		<?php include_http_metas() ?>
		<?php include_metas() ?>
		<?php include_title() ?>
		<link rel="shortcut icon" href="/favicon.ico" />
		<?php use_stylesheet('superfish.css') ?>
		<?php use_stylesheet('superfish-vertical.css') ?>
		<?php //use_stylesheet('Base.css') ?>
		<?php use_stylesheet('BreadCrumb.css') ?>
		<?php use_stylesheet('/sfDoctrinePlugin/css/global.css', 'first') ?>
		<?php use_stylesheet('/sfDoctrinePlugin/css/default.css', 'first') ?>
                <?php use_stylesheet('/css/smoothness/jquery-ui-1.8.6.custom.css') ?>
		<?php include_stylesheets() ?>

		<?php use_javascript('http://ajax.googleapis.com/ajax/libs/jquery/1.7.1/jquery.min.js', 'first')?>
		<?php //use_javascript('hoverIntent.js') ?>
		<?php use_javascript('superfish.js') ?>
		<?php use_javascript('jquery-ui-1.8.6.custom.min.js') ?>
		<?php use_javascript('jquery.easing.1.3.js') ?>
		<?php use_javascript('jquery.jBreadCrumb.1.1.js') ?>
		<?php include_javascripts() ?>
        <?php include_slot('javascript') ?>

	</head>
	<body>
		<?php if ($sf_user->isAuthenticated()): ?>
		<div id="topnav">
			<div class="content" style="float: right">
				<!-- footer content -->
				<?php //include_component('language', 'language') ?>
			</div>
				<?php include_component(
						'navigation',
						'breadcrumb',
						array(
						'nodes' => array('root', 'category', 'section','users'),
						'open' => true
						)
						) ?>
		</div>
		<div id="leftnav">
				<?php include_component(
						'navigation',
						'navigation',
						array(
						'nodes' => array('root', 'category', 'section','users','logout'),
						'htmlAttrs' => array('class' => 'sf-menu sf-vertical'),
						'open' => true
						)
						) ?>
		</div>
		<?php endif; ?>
		<div id="maincontent">
			<?php echo $sf_content ?>
		</div>
		<script type="text/javascript">

			$(document).ready(function(){
				$("ul.sf-menu").superfish({
					animation: {height:'show'},   // slide-down effect without fade-in
					delay:     1200               // 1.2 second delay on mouseout
				});
				jQuery("#breadCrumb").jBreadCrumb();
			});

		</script>
	</body>
</html>
