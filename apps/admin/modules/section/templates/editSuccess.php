<?php use_helper( 'I18N', 'Date' ) ?>
<?php include_partial( 'section/assets' ) ?>

<div id="sf_admin_container">
    <?php if ( $form->getObject()->getCategories()->count() > 0 ): ?>
    <div id="sf_admin_bar">
        <h1><?php echo __( 'Sort categories', array(), 'messages' ) ?></h1>

        <div id="message"></div>


        <ul class="sortable" id="sortable-<?php echo $form->getObject()->getId() ?>">
            <?php foreach ( $form->getObject()->getCategories() as $category ): ?>
            <li class="ui-state-default"
                id="cat_<?php echo $category->getId() ?>"><?php echo $category->getTitle() ?></li>
            <?php endforeach; ?>
        </ul>
    </div>
    <?php endif; ?>
    <div id="sf_admin_content">
        <h1><?php echo __( 'Edit Section', array(), 'messages' ) ?></h1>

        <?php include_partial( 'section/flashes' ) ?>

        <div id="sf_admin_header">
            <?php include_partial( 'section/form_header', array( 'section' => $section, 'form' => $form, 'configuration' => $configuration ) ) ?>
        </div>

        <div id="sf_admin_content">
            <?php include_partial( 'section/form', array( 'section' => $section, 'form' => $form, 'configuration' => $configuration, 'helper' => $helper ) ) ?>
        </div>

        <div id="sf_admin_footer">
            <?php include_partial( 'section/form_footer', array( 'section' => $section, 'form' => $form, 'configuration' => $configuration ) ) ?>
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
                    var catOrder = $(this).sortable('toArray').toString();
                    $('#message').html('');
                    $('#message').load('<?php echo url_for( 'category/orderItems' )?>', {catOrder:catOrder});
                }
            });
        })
    });
</script>