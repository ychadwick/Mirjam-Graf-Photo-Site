<?php use_helper('I18N', 'Date') ?>
<?php include_partial('category/assets') ?>

<div id="sf_admin_container">
  <h1><?php echo __('Sort photos', array(), 'messages') ?></h1>
  <div id="message" ></div>

  <div id="sections">
      <ul>
      <?php foreach ($categories as $category): ?>
        <li><a href="#section-<?php echo $category->getId() ?>"><span><?php echo $category->getTitle() ?></span></a></li>
      <?php endforeach; ?>
      </ul>
      <?php foreach ($categories as $category): ?>
      <div id="section-<?php echo $category->getId() ?>">
          <ul class="sortable" id="sortable-<?php echo $category->getId() ?>">
            <?php foreach($category->getPhotos() as $photo): ?>
                <li class="ui-state-default sortPhoto" id="photo_<?php echo $photo->getId() ?>">
                    <img src="/uploads/photos/200x200/<?php echo $photo->getImage()?>" alt="<?php echo $photo->getTitle() ?>" height="50px"/>
                    <?php echo $photo->getTitle() ?></li>
            <?php endforeach; ?>
         </ul>
      </div>
      <?php endforeach; ?>
  </div>

  <ul class="sf_admin_actions">
      <li><a href="<?php echo url_for('photo') ?>"><?php echo __('Back to list', null, 'sf_admin') ?></a></li>
  </ul>
</div>
<script type="text/javascript">
$(function() {
        $('ul[id^=sortable-]').each(function(){
            $(this ).sortable({
                placeholder: "ui-state-highlight",
                update: function(event, ui) {
                        var photoOrder = $(this).sortable('toArray').toString();
                        $('#message').html('');
                        $('#message').load('<?php echo url_for('photo/orderItems')?>', {photoOrder:photoOrder});
                }
        });
        $(this).disableSelection();
        })
        $('#sections').tabs();
});
</script>