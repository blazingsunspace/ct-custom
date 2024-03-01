<?php /* Template Name: Homepage */ ?>

<?php
get_header();
?>
11111111111111111


<div id="primary" class="content-area">
    <main id="main" class="site-main">
        <?php get_option('ct_custom_phone'); ?> 3333sadsaddas
        pupcina
        <?php echo get_option('aaa'); ?>

        pupulele
        <?php echo apply_shortcodes('[contact-form-7 id="a3463c8" title="Contact form 1"]'); ?>
        <?php
    echo get_theme_mod('basic-author-callout-image');
       

        if (get_theme_mod('base-author-callout-display') === 'Yes') {
            echo '<div class="w-full author">
                <div class="autor-image">
                    <img src="' .  wp_get_attachment_url(get_theme_mod('basic-author-callout-image')) . '" alt="placeholder image">
                </div>
                <div class="autor-content">
                    ' . (get_theme_mod('basic-author-callout-text') == '' ? 'prrr' :  get_theme_mod('basic-author-callout-text')) . '
                </div>
            </div>';
        }
        ?>


    </main><!-- #main -->
</div><!-- #primary -->

<?php
get_sidebar();
get_footer();
