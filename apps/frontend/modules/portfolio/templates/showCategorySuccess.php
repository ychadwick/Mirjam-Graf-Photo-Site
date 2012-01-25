<div id="left">&nbsp;</div>
<div id="right">&nbsp;</div>
<div id="categoryContent">
    <div class="innerHeader">
        <div class="counter">1 - <?php echo $category->getPhotos()->count() ?></div>
        <h1 class="sectionCategory"><a href="<?php echo url_for('@homepage')?>"><?php echo $category->getSection()->getTitle(); ?></a></h1> -> <h2 class="category"><?php echo $category->getTitle() ?></h2>
        <?php if ($category->getContent()): ?>
    <div id="intro">
        <?php echo $category->getContent(ESC_RAW) ?>
    </div>
    <?php endif; ?>
    </div>

    
    <br />
    <?php foreach($category->getPhotos() as $photo): ?>
    <img src="/uploads/photos/400x400/<?php echo $photo->getImage() ?>" alt="<?php echo $photo->getTitle() ?>" />
    <br/>
    <?php endforeach; ?>
</div>