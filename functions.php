<?php
/**
 * Quota's functions have been moved to a remote file called
 *
 * quota-functions.php
 *
 * This is done to make developing with a child theme much easier. 
 * Below, the quota-functions.php file is required once and when no
 * child theme is installed, everything will behave just as if all of
 * Quota's functions were in this file.
 *
 * In the event a child theme is installed, WordPress will look for its
 * functions.php file before Quota's. Because of this order of operations,
 * functions placed in a child theme's functions.php will run before
 * Quota's functions which may lead to undesirable results and extra code.
 *
 * To make things easier, child themes that wish to run functions.php files
 * should "require_once" the quota-functions.php first (remember, child theme
 * functions.php files run first). With that in place, the child theme will
 * have direct and immediate access to all of Quota's functions.
 *
 * Because the child theme must use "require_once" as well, once WordPress
 * finishes running its functions.php file and moves on to run Quota's 
 * functions.php file (this file), it will read the line below and NOT run
 * the quota-functions.php file because it has already been required once.
 *
 * Therefore, child themes with a functions.php file should run the
 * following line above ALL other custom functions:
 *
 * require_once( get_template_directory() . '/inc/quota-functions.php' );
 *
 * Placing all custom functions below that line will keep Quota's core 
 * functions running before the child theme's functions. Awesome. :)
 */
 
require_once('inc/quota-functions.php'); // Quota's main functions