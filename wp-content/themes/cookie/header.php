<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package cookie
 */

?><!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
<div id="page" class="hfeed site">
	<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'cookie' ); ?></a>

    <div class="container-fluid background-header">
        
        <div class="container">
	<header id="masthead" class="site-header" role="banner">
		<div class="site-branding">
			<?php if ( is_front_page() && is_home() ) : ?>
				<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
			<?php else : ?>
				<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
			<?php endif; ?>
			<p class="site-description"><?php bloginfo( 'description' ); ?></p>
                        
                        <h2>Freephone (UK) 08000 324 987</h2>
		</div><!-- .site-branding -->

           <nav class="navbar navbar-inverse" role="navigation"> 
                <!-- Brand and toggle get grouped for better mobile display --> 
                  <div class="navbar-header"> 
                    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse"> 
                      <span class="sr-only">Toggle navigation</span> 
                      <span class="icon-bar"></span> 
                      <span class="icon-bar"></span> 
                      <span class="icon-bar"></span> 
                    </button> 
                  
                  </div> 
                  <!-- Collect the nav links, forms, and other content for toggling --> 
                  <div class="collapse navbar-collapse navbar-ex1-collapse"> 
                      <?php wp_nav_menu(array(
                        'container_class' => 'menu-header',
                        'theme_location' => 'primary',
                        'items_wrap' => '<ul id="%1$s" class="%2$s nav navbar-nav">%3$s</ul>',
                        'walker' => new wp_bootstrap_navwalker(),
                        'menu' => 'Your Menu'
                )); ?>
                  </div>
            </nav>

                
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.
                </p>      
                
                <div class="row header-links-bottom">
                    <div class="col-lg-12">
                        <ul class="list-inline"> 
                            <li><a href="#">Action</a></li> 
                            <li><a href="#">Another action</a></li> 
                            <li><a href="#">Something else here</a></li> 
                            <li><a href="#">Separated link</a></li> 
                            <li><a href="#">One more separated link</a></li> 
                   
                        </ul>
                    </div>
                </div>
                
	</header><!-- #masthead -->
      </div>
   </div>
	<div id="content" class="site-content">
