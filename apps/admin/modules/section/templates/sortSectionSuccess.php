<?php use_helper('I18N', 'Date') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Sort sections', array(), 'messages') ?></h1>
  <div id="message" ></div>
<ul class="sortable">
    <?php foreach($sections as $section): ?>
    <li class="ui-state-default" id="sec_<?php echo $section->getId() ?>"><?php echo $section->getTitle() ?></li>
    <?php endforeach; ?>
</ul>


  <ul class="sf_admin_actions">
      <li><a href="<?php echo url_for('section') ?>"><?php echo __('Back to list', null, 'sf_admin') ?></a></li>
  </ul>
</div>
<script type="text/javascript">
$(function() {
        $( ".sortable" ).sortable({
                placeholder: "ui-state-highlight",
                update: function(event, ui) {
                        var secOrder = $(this).sortable('toArray').toString();
                        $('#message').html('');
                        $('#message').load('<?php echo url_for('section/orderItems')?>', {secOrder:secOrder});
                }
        });
        $( "#sortable" ).disableSelection();
});
</script>