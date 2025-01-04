=== ct4gg ===
Contributors: vanhoucke
Tags: tools, customiser, homepage, meta generator, htaccess, cache, robots.txt, robots, humans.txt
Requires at least: 5.2
Tested up to: 6.5.4
Requires PHP: 8.0
Stable tag: 1.5.2
License: GPLv2

Wordpress customiser tools for beginer and confirmed users.

== Description ==
> Wordpress customiser tools for beginer and confirmed users.

For complete details visit [ct4gg @ ginkgos.net](https://ginkgos.net/plugin/ct4gg/).

= Overview =
CT4GG is the Wordpress complementary tool which adds additional customiser options. It allows you to:

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
* Manage option in .htaccess file (caches and security).
* Build robots.txt, humans.txt and security.txt

= Please Note =
Adding an additional customization option to help us personalize our sites is a help for everyone. We all seek to hide or personalize options or displays; that's why your feedback is important to me. Thank you for helping me make WordPress the best blogging platform in the world.

= Disclaimer =
This plugin doesn't require technical knowledge or to be a web developer. The activation or the modification of an option is not definitive, the deactivation of the option or the deletion of the plugin allows a return to the standard.

= Active Contributors =
<li>[Franck VANHOUCKE](https://profiles.wordpress.org/vanhoucke/) (Development)</li>

== Screenshots ==

1. Logo,
2. Exemple of login screen,
3. Exemple of screenshot .htaccess file,
4. Exemple of screenshot robots.txt file,
5. Exemple of screenshot humans.txt file,
6. Exemple of screenshot security.txt file,
7. Example of restoration menu for htaccess files.

== Frequently Asked Questions ==

= Installation Instructions =
1. Upload `ct4gg` folder to the `/wp-content/plugins/` directory
2. Activate the plugin through the 'Plugins' menu in WordPress
3. Click on the Ct4gg link from the main menu

The ct4gg requires php 7.4 or higher.

= Is this plugin compatible with WordPress multisite (MU)? =
ct4gg is multisite compatible, in case of problem contact me.

= wich options =
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
* Management robots.txt,
* Management humans.txt,
* Management security.txt,
* Social media sharing buttons.

= Can I use a shortcode to place the share buttons? =

Yes, it's [ct4gg_social]. You can place it into any editor. If the sharing buttons still don't show, there might be an issue with your theme.

Alternatively, you can place the followin into your codes: <?php echo do_shortcode('[ct4gg_social]'); ?>

= Apply changes in the file .htaccess =
1. Activate the settings in Dashboard menu and save them
2. go to the htaccess menu
3. you can modify the file if needed
4. click on "Update htaccess" button

= Apply changes in the file robots.txt =
1. Activate the settings in Dashboard menu and save them
2. go to the robots menu
3. you can modify the file if needed
4. click on "Update robots.txt" button

= Apply changes in the file humans.txt =
1. Activate the settings in Dashboard menu and save them
2. go to the humans menu
3. you can modify the file if needed
4. click on "Update humans.txt" button

= Apply changes in the file security.txt =
1. Activate the settings in Dashboard menu and save them
2. go to the security menu
3. you can modify the file if needed
4. click on "Update security.txt" button

= new features =
If you want a new feature, you can contact me by email at contact@ginkgos.net 

== Changelog ==

= 1.5.2 (2402-SFP2) =
*Release Date - 25 Febrary 2024*

* Test up Woodpress 6.5.4,
* Compatible PHP8.3 and change Requires PHP to 8.0,
* Correction function old post notice
* Add Header check Security,
* Add Header check information,
* Add Header check Cache,
* Add function to desable ChatGPT and ChatGPT pluging in Robot.txt,
* Correction phpcs 3.7.2 error,
* Add security Deletion file.


See [changelog.txt](https://plugins.svn.wordpress.org/ct4gg/trunk/changelog.txt) for older changelog

== Upgrade Notice ==

Please contact me by email or through the contact form on the site [ginkgos.net] (https://ginkgos.net/). Please do not post on the forums.