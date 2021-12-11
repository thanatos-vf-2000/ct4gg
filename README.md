<img src="https://github.com/thanatos-vf-2000/ct4gg/blob/master/assets/img/banner772x250.png" width="400">

# ct4gg

[![GitHub version](https://badge.fury.io/gh/thanatos-vf-2000%2Fct4gg.svg)](https://badge.fury.io/gh/thanatos-vf-2000%2Fct4gg)
[![License](http://poser.pugx.org/thanatos-vf-2000/ct4gg/license)](https://packagist.org/packages/thanatos-vf-2000/ct4gg)
[![PHP Version Require](http://poser.pugx.org/thanatos-vf-2000/ct4gg/require/php)](https://packagist.org/packages/thanatos-vf-2000/ct4gg)

Contributors: vanhoucke
Tags: tools, customiser, homepage, redirect, Jetpack, performance, login, speed, comments, min comments, meta generator, htaccess, cache
Requires at least: 5.7
Tested up to: 5.8
Requires PHP: 7.4
Stable tag: 1.3.1
License: GPLv2

Wordpress customiser tools for beginer and confirmed users.

## Description
> Wordpress customiser tools for beginer and confirmed users.

For complete details visit [ct4gg @ ginkgos.net](https://ginkgos.net/plugin/ct4gg/).

### Overview
CT4GG is the Wordpress complementary tool which adds additional options. It allows you to:

* Customiser Screen Login
* Used "Classic" Widget settings screens
* Managed the interval before displaying the administration email verification screen
* Disable Jetpack for Automattic
* Delete Wordpress logo in dashboard administration,
* Redirect to home page after logout,
* Hide login errors,
* No admin user to go back home,
* If the result of search return one post, display them,
* Force the minimum comment lenght,
* Hide meta generator (Wordpress Version),
* Display message on old post,
* Manage option in .htaccess file (caches and security).
* Build robots.txt and humans.txt

### Please Note
Adding an additional customization option to help us personalize our sites is a help for everyone. We all seek to hide or personalize options or displays; that's why your feedback is important to me. Thank you for helping me make WordPress the best blogging platform in the world.

### Disclaimer
This plugin doesn't require technical knowledge or to be a web developer. The activation or the modification of an option is not definitive, the deactivation of the option or the deletion of the plugin allows a return to the standard.

= Active Contributors =
<li>[Franck VANHOUCKE](https://profiles.wordpress.org/vanhoucke/) (Development)</li>

## Screenshots

1. Logo,
2. Exemple of login screen,
3. Exemple of screenshot .htaccess file,
4. Exemple of screenshot robots.txt file
5. Exemple of screenshot humans.txt file
6. Example of restoration menu for htaccess files.


<img src="https://github.com/thanatos-vf-2000/ct4gg/blob/master/assets/img/screenshot-1.png" width="30%"></img> <img src="https://github.com/thanatos-vf-2000/ct4gg/blob/master/assets/img/screenshot-2.png" width="30%"></img> <img src="https://github.com/thanatos-vf-2000/ct4gg/blob/master/assets/img/screenshot-3.png" width="30%"></img><img src="https://github.com/thanatos-vf-2000/ct4gg/blob/master/assets/img/screenshot-4.png" width="30%"></img><img src="https://github.com/thanatos-vf-2000/ct4gg/blob/master/assets/img/screenshot-5.png" width="30%"></img><img src="https://github.com/thanatos-vf-2000/ct4gg/blob/master/assets/img/screenshot-6.png" width="30%"></img> 


## Frequently Asked Questions

### Installation Instructions
1. Upload `ct4gg` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Click on the Ct4gg link from the main menu

The ct4gg requires php 7.4 or higher.

### Is this plugin compatible with WordPress multisite (MU)?
ct4gg is multisite compatible, in case of problem contact me.

### wich options
* Customiser Screen Login,
* Used "Classic" Widget settings screens,
* Managed the interval before displaying the administration email verification screen,
* Disable Jetpack for Automattic,
* Delete Wordpress logo in dashboard administration,
* Redirect to home page after logout,
* Hide login errors,
* No admin user to go back home,
* If the result of search return one post, display them,
* Force the minimum comment lenght,
* Hide meta generator (Wordpress Version),
* Display message on old post,
* Management of the .htaccess file:
 Disable display of directory contents
 Hide server information
 Protect .htaccess and .htpasswds files
 Enable Force download
 Enable cache expires
 Compressing static files
* Generate robots.txt
* Generate humans.txt

### Apply changes in the file .htaccess
1. Activate the settings and save them
2. go to the htaccess menu
3. click on "Update Htaccess" button

### Apply changes in the file robots.txt
1. Activate the settings in Dashboard menu and save them
2. go to the robots menu
3. click on "Update Robots.txt" button

### Apply changes in the file humans.txt
1. Activate the settings in Dashboard menu and save them
2. go to the humans menu
3. click on "Update Humans.txt" button

## new features
If you want a new feature, you can contact me by email at contact@ginkgos.net 

## Changelog

### 1.3.1 (2021-12-11)

* fixed SVN commit

### 1.3.0 (2121-12-11)
* fixed for front page (home) not display a message at the top of articles older than X days,
* fixed options not display,
* fixed for post type as page not display a message at the top of articles older than X days,
* Add Auto update .htaccess, humans.txt and robots.txt after saving options,
* Add Rewrite URL for wp-login.php options (login, logout, ...),
* Change management wp-login.php (New Version),
* Add new options for customize login page (New Version only),
* Add support information and link.

### 1.2.1 (2021-11-15)
* Add generator for robots.txt
* Add generator for humans.txt

### 1.1.0 (2021-10-08)

* fixed file inc/Ui/Post.php line 22 & 28 add test is_array
* Added management of the .htaccess file
* .htaccess: Disable display of directory contents
* .htaccess: Hide server information
* .htaccess: Protect .htaccess and .htpasswds files
* .htaccess: Enable Force download
* .htaccess: Enable cache expires
* .htaccess: Compressing static files

### 1.0.0 (2020-10-01)

* fixed style login message
* fixed style ct4gg
* Add option to delete Wordpress logo in dashboard administration
* Add option to redirect to home page after logout
* Add option to hide login errors
* Add option for no admin user to go back home
* Add option, if the result of search return one post, display them
* Add option to force the minimum comment lenght
* Add option hide meta generator (Wordpress Version)
* Add option to display message on old post 

### 0.0.1 (2021-09-14)

* Initial version

See [changelog.txt](https://plugins.svn.wordpress.org/ct4gg/trunk/changelog.txt) for older changelog

## Upgrade Notice

Please contact me by email or through the contact form on the site [ginkgos.net] (https://ginkgos.net/). Please do not post on the forums.