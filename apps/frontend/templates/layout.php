<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
    <head>
        <?php include_http_metas() ?>
        <?php include_metas() ?>
        <?php include_title() ?>
        <link rel="shortcut icon" href="/favicon.ico" />
        <?php include_stylesheets() ?>
        <?php include_javascripts() ?>
    </head>
    <body>
        <div id="content">
            <div id="header">

                <div id="headerLeft" >
                    <?php echo link_to(__('Contact'), 'contact', array(),array('class' => 'noLink')) ?>
                </div>
                <a href="<?php echo url_for('@localized_homepage') ?>" alt="home">
                    <img src="/images/logo.png" alt="logo" id="logo"/>
                </a>
                <br />
                <?php include_component('language', 'language') ?>
                <div class="cleaner">&nbsp;</div>
            </div>
            <?php echo $sf_content ?>
        </div>
    </body>
</html>
