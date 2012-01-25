<form name="languageForm" action="<?php echo url_for('@change_language') ?>">

	<?php foreach ($form->getFormFieldSchema() as $name => $field): ?>
		<?php if($form[$name]->isHidden()): ?>
			<?php echo $field ?>
		<?php else: ?>
			<?php echo $field->renderLabel() ?> <?php echo $field->render(array('onchange' => 'javascript:document.languageForm.submit();')) ?>
		<?php endif; ?>
	<?php endforeach; ?>
</form>
