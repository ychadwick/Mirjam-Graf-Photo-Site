<?php foreach($sections as $section ): ?>
    <?php $i = 0; ?>
    <?php foreach($section->getCategories() as $category): ?>
        <?php if($category->getPhotos()->count() > 0): ?>
            <?php $photo = $category->getFirstPhoto(); ?>
                <?php if($i == 0): ?>
            <div class="photoBoxHeader">
                <h1 class="section"><?php echo $section->getTitle(); ?> -></h1>
                <?php else:?>
            <div class="photoBox">
                <?php endif; ?>
                  <div class="photoBoxInner">
                    <a href="<?php echo url_for('category_show_user', $category) ?>">
                        <img align="bottom" src="/uploads/photos/200x200/<?php echo $photo->getImage() ?>" alt="<?php echo $photo->getTitle() ?>" />
                    </a>
                  </div>
            </div>
        <?php $i++; ?>
        <?php endif; ?>
    <?php endforeach; ?>
<?php endforeach; ?>