<?php use_helper('I18N', 'Date') ?>
<?php include_partial('category/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Sort categories', array(), 'messages') ?></h1>
  <div id="message" ></div>

  <div id="sections">
      <ul>
      <?php foreach ($sections as $section): ?>
        <li><a href="#section-<?php echo $section->getId() ?>"><span><?php echo $section->getTitle() ?></span></a></li>
      <?php endforeach; ?>
      </ul>
      <?php foreach ($sections as $section): ?>
      <div id="section-<?php echo $section->getId() ?>">
          <ul class="sortable" id="sortable-<?php echo $section->getId() ?>">
            <?php foreach($section->getCategories() as $category): ?>
                <li class="ui-state-default" id="cat_<?php echo $category->getId() ?>"><?php echo $category->getTitle() ?></li>
            <?php endforeach; ?>
         </ul>
      </div>
      <?php endforeach; ?>
  </div>

  <ul class="sf_admin_actions">
      <li><a href="<?php echo url_for('category') ?>"><?php echo __('Back to list', null, 'sf_admin') ?></a></li>
  </ul>
</div>
<script type="text/javascript">
$(function() {
        $('ul[id^=sortable-]').each(function(){
            $(this ).sortable({
                placeholder: "ui-state-highlight",
                update: function(event, ui) {
                        var catOrder = $(this).sortable('toArray').toString();
                        $('#message').html('');
                        $('#message').load('<?php echo url_for('category/orderItems')?>', {catOrder:catOrder});
                }
        });
        $(this).disableSelection();
        })
        $('#sections').tabs();
});
</script>