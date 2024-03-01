<?php
/* Smarty version 5.0.0-rc1, created on 2024-02-23 17:15:50
  from 'file:header.tpl' */

/* @var \Smarty\Template $_smarty_tpl */
if ($_smarty_tpl->getCompiled()->isFresh($_smarty_tpl, array (
  'version' => '5.0.0-rc1',
  'unifunc' => 'content_65d8d2c604a4b3_82300091',
  'has_nocache_code' => false,
  'file_dependency' => 
  array (
    '38493838c43836c0c10940781e32b05fbac0a0fb' => 
    array (
      0 => 'header.tpl',
      1 => 1708708548,
      2 => 'file',
    ),
  ),
  'includes' => 
  array (
  ),
))) {
function content_65d8d2c604a4b3_82300091 (\Smarty\Template $_smarty_tpl) {
$_smarty_current_dir = 'C:\\xampp8.12\\htdocs\\coalition\\wp-content\\themes\\ct-custom';
?>
<!doctype html>
<html <?php echo '<?php'; ?>
 language_attributes(); <?php echo '?>'; ?>
>

<head>
	<meta charset="<?php echo '<?php'; ?>
 bloginfo('charset'); <?php echo '?>'; ?>
">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="https://gmpg.org/xfn/11">

	<?php echo '<?php'; ?>
 wp_head(); <?php echo '?>'; ?>



</head>

<body <?php echo '<?php'; ?>
 body_class(); <?php echo '?>'; ?>
>
	444

9999
	33
	<div id="page" class="site">
		<a class="skip-link screen-reader-text" href="#content"><?php echo '<?php'; ?>
 esc_html_e('Skip to content', 'ct-custom'); <?php echo '?>'; ?>
</a>

		<header id="masthead" class="site-header">
			<div class="site-branding">
				<?php echo '<?php'; ?>

				the_custom_logo();
				if (is_front_page() && is_home()) :
				<?php echo '?>'; ?>

					<h1 class="site-title"><a href="<?php echo '<?php'; ?>
 echo esc_url(home_url('/')); <?php echo '?>'; ?>
" rel="home"><?php echo '<?php'; ?>
 bloginfo('name'); <?php echo '?>'; ?>
</a></h1>
				<?php echo '<?php'; ?>

				else :
				<?php echo '?>'; ?>

					<p class="site-title"><a href="<?php echo '<?php'; ?>
 echo esc_url(home_url('/')); <?php echo '?>'; ?>
" rel="home"><?php echo '<?php'; ?>
 bloginfo('name'); <?php echo '?>'; ?>
</a></p>
				<?php echo '<?php'; ?>

				endif;
				$ct_custom_description = get_bloginfo('description', 'display');
				if ($ct_custom_description || is_customize_preview()) :
				<?php echo '?>'; ?>

					<p class="site-description">
						<?php echo '<?php'; ?>
 echo $ct_custom_description; /* WPCS: xss ok. */ <?php echo '?>'; ?>

					</p>
				<?php echo '<?php'; ?>
 endif; <?php echo '?>'; ?>

			</div><!-- .site-branding -->

			<nav id="site-navigation" class="main-navigation">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php echo '<?php'; ?>
 esc_html_e('Primary Menu', 'ct-custom'); <?php echo '?>'; ?>
</button>
				<?php echo '<?php'; ?>

				wp_nav_menu(array(
					'theme_location' => 'menu-1',
					'menu_id'        => 'primary-menu',
				));
				<?php echo '?>'; ?>

			</nav><!-- #site-navigation -->
		</header><!-- #masthead -->

		<div id="content" class="site-content"><?php }
}
