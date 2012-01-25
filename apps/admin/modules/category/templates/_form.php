<?php use_javascript('tiny_mce/tiny_mce_gzip.js') ?> 
<?php slot('javascript') ?>
<script type="text/javascript">
// This is where the compressor will load all components, include all components used on the page here
tinyMCE_GZ.init({
	themes : 'advanced',
	languages : 'en,de',
	disk_cache : false,
	debug : false
});
</script>
<script type="text/javascript">
// Normal initialization of TinyMCE
tinyMCE.init({
	// General options
	mode : "textareas",
	theme : "advanced",
	language : '<?php echo $sf_user->getCulture()?>',
        // Theme options
	theme_advanced_toolbar_location : "top",
	theme_advanced_statusbar_location : "bottom",
	theme_advanced_resizing : true,
        width: "460px",
        content_css: "/css/main.css"

});
</script>
<?php end_slot() ?>
<?php use_stylesheets_for_form($form) ?>
<?php use_javascripts_for_form($form) ?>

<div class='sf_admin_form'>
  <?php echo form_tag_for($form, '@category') ?>
    <?php echo $form->renderHiddenFields(false) ?>

    <?php if ($form->hasGlobalErrors()): ?>
      <?php echo $form->renderGlobalErrors() ?>
    <?php endif; ?>

    <?php foreach ($configuration->getFormFields($form, $form->isNew() ? 'new' : 'edit') as $fieldset => $fields): ?>
      <?php include_partial('category/form_fieldset', array('category' => $category, 'form' => $form, 'fields' => $fields, 'fieldset' => $fieldset)) ?>
    <?php endforeach; ?>

    <?php include_partial('category/form_actions', array('category' => $category, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper)) ?>
  </form>
</div>
