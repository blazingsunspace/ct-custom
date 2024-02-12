<?php /* Template Name: Homepage */ ?>

<?php
get_header();
?>

<div id="primary" class="content-area">
    <main id="main" class="site-main">
    <?php get_option('ct_custom_phone'); ?> 3333sadsaddas
        pupcina
        <?php echo get_option('aaa'); ?>

        pupulele
        <?php echo apply_shortcodes( '[contact-form-7 id="a3463c8" title="Contact form 1"]' ); ?>

    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
