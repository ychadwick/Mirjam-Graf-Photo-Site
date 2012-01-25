<?php use_helper( 'I18N', 'Date' ) ?>
<?php include_partial( 'category/assets' ) ?>

<div id="sf_admin_container">
    <?php if ( $form->getObject()->getPhotos()->count() > 0 ): ?>
    <div id="sf_admin_bar">
        <h1><?php echo __( 'Sort photos', array(), 'messages' ) ?></h1>

        <div id="message"></div>


        <ul class="sortable" id="sortable-<?php echo $form->getObject()->getId() ?>">
            <?php foreach ( $form->getObject()->getPhotos() as $photo ): ?>
            <li class="ui-state-default sortPhoto" id="photo_<?php echo $photo->getId() ?>">
                <img src="/uploads/photos/200x200/<?php echo $photo->getImage()?>"
                     alt="<?php echo $photo->getTitle() ?>" height="50px"/>
                <?php echo $photo->getTitle() ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>
    <div id="sf_admin_content">
        <h1><?php echo __( 'Edit Category', array(), 'messages' ) ?></h1>

        <?php include_partial( 'category/flashes' ) ?>

        <div id="sf_admin_header">
            <?php include_partial( 'category/form_header', array( 'category' => $category, 'form' => $form, 'configuration' => $configuration ) ) ?>
        </div>

        <div id="sf_admin_content">
            <?php include_partial( 'category/form', array( 'category' => $category, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper ) ) ?>
        </div>

        <div id="sf_admin_footer">
            <?php include_partial( 'category/form_footer', array( 'category' => $category, 'form' => $form, 'configuration' => $configuration ) ) ?>
        </div>
    </div>
</div>
<script type="text/javascript">
    $(function ()
    {
        $('ul[id^=sortable-]').each(function ()
        {
            $(this).sortable({
                placeholder:"ui-state-highlight",
                update:function (event, ui)
                {
                    var photoOrder = $(this).sortable('toArray').toString();
                    $('#message').html('');
                    $('#message').load('<?php echo url_for( 'photo/orderItems' )?>', {photoOrder:photoOrder});
                }
            });
        })
    });
</script>
