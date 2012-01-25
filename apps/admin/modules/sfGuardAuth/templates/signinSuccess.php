<?php use_helper('I18N') ?>
<div id="sf_admin_container">
	<div id="sf_admin_content">
		<h1><?php echo __('sign in') ?></h1>
		<div class="sf_admin_form">
			<form action="<?php echo url_for('@sf_guard_signin') ?>" id="login" method="post">

				<?php if ($form->hasGlobalErrors()): ?>
					<?php echo $form->renderGlobalErrors() ?>
				<?php endif; ?>
				<fieldset id="sf_fieldset_none">
					<?php foreach ($form->getFormFieldSchema() as $name => $field): ?>
					<?php if($form[$name]->isHidden()): ?>
					<?php echo $field ?>
					<?php else: ?>
					<div class="sf_admin_form_row <?php $form[$name]->hasError() and print ' errors' ?>">
						<?php echo $form[$name]->renderError() ?>
						<div>
								<?php echo $field->renderLabel() ?>
							<div class="content">
									<?php echo $field->render() ?>
							</div>

						</div>
					</div>
					<?php endif; ?>
					<?php endforeach; ?>
				</fieldset>

				<input type="submit" value="<?php echo __('sign in') ?>" />
<!--				<a href="--><?php //echo url_for('@sf_guard_password') ?><!--">--><?php //echo __('Forgot your password?') ?><!--</a>-->
			</form>
		</div>
	</div>
</div>
