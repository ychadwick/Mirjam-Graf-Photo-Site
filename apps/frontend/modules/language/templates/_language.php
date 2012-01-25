<?php if($sf_user->getCulture() == 'de'): ?>
DE
<?php else: ?>
<?php echo link_to('DE', 'change_language', array('language' => 'de'),array('class' => 'noLink')) ?> 
<?php endif; ?> |
<?php if($sf_user->getCulture() == 'en'): ?>
EN
<?php else: ?>
<?php echo link_to('EN', 'change_language', array('language' => 'en'),array('class' => 'noLink')) ?>
<?php endif; ?>
