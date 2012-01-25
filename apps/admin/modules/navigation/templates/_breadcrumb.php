<div class="breadCrumbHolder module">
	<div id="breadCrumb" class="breadCrumb module">
		<ul>
			<li class="first"><?php echo link_to('home', '@homepage') ?></li>
			<?php foreach($breadcrumb as $link): ?>
			<li><?php echo link_to(__($link['text']), $link['link']) ?></li>
			<?php endforeach; ?>
		</ul>
	</div>
</div>
