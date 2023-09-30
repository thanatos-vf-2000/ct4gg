/**
* Template Name: ct4gg - Admin
* @Version 1.3.0
*/
(function() {
    "use strict";

  /**
   * Easy selector helper function
   */
  const select = (el, all = false) => {
    el = el.trim()
    if (all) {
      return [...document.querySelectorAll(el)]
    } else {
      return document.querySelector(el)
    }
  }

  /**
   * Easy event listener function
   */
  const on = (type, el, listener, all = false) => {
    let selectEl = select(el, all)
    if (selectEl) {
      if (all) {
        selectEl.forEach(e => e.addEventListener(type, listener))
      } else {
        selectEl.addEventListener(type, listener)
      }
    }
  }

  /**
   * Admin Tab
   */
  on('click', 'ul.ct4gg-nav-tabs > li', function(e) {
    e.preventDefault(),
	document.querySelector("ul.ct4gg-nav-tabs li.active").classList.remove("active"),
		document.querySelector(".ct4gg-tab-pane.active").classList.remove("active");
	var t=e.currentTarget,
		n=e.target.getAttribute("href");
	t.classList.add("active"),
		document.querySelector(n).classList.add("active");
  }, true)

  /**
   * Admin Tab Graph
   */
  on('click', 'ul.ct4gg-nav-tabs-graph > li', function(e) {
    e.preventDefault(),
	document.querySelector("ul.ct4gg-nav-tabs-graph li.active").classList.remove("active"),
		document.querySelector(".ct4gg-tab-pane.active").classList.remove("active");
	var t=e.currentTarget,
		n=e.target.getAttribute("href");
	t.classList.add("active"),
		document.querySelector(n).classList.add("active");
  }, true)

  /**
   * Images
   */
   var custom_uploader;
   var attachment;
   var selin;
  on('click', '#upload_image_button',function(e) {
       e.preventDefault();
       selin = this.getAttribute("for")
       //If the uploader object has already been created, reopen the dialog
       if (custom_uploader) {
           custom_uploader.open();
           return;
       }
       //Extend the wp.media object
       custom_uploader = wp.media.frames.file_frame = wp.media({
           title: 'Choose Image',
           button: {
               text: 'Choose Image'
           },
           multiple: false
       });
        //When a file is selected, grab the URL and set it as the text field's value
        custom_uploader.on('select', function() {
        attachment = custom_uploader.state().get('selection').first().toJSON();
        jQuery("input[name='"+selin+"']").each(function() {
          this.value = attachment.url
        });
        jQuery("img[name='"+selin+"']").each(function() {
          this.setAttribute("src", attachment.url)
        });
       });
       //Open the uploader dialog
       custom_uploader.open();
   }, true)



  
  //color picker
  on('click', '.color-picker',function(e) {
    jQuery(this).wpColorPicker()
  }, true)

  //Checkbox ct4gg-htaccess
  on('click', '#ct4gg-htaccess',function(e) {
    var checkboxes = document.getElementsByName('ct4gg-htaccess');
    var box = (this);
        checkboxes.forEach((item) => {
            if (item !== box) 
            item.checked = false;
        })
  }, true)

  //Text Field URL
  var seltxt;
  on('input', '#login_slugs_login, #login_slugs_logout, #login_slugs_register, #login_slugs_lostpassword, #login_slugs_resetpass, #login_slugs_postpass',function(e) {
    selin = this.getAttribute("id")+'_txt';
    seltxt = this.value;
    var element = document.getElementById(selin);
    element.innerHTML= '<b id="' + selin + '">' + seltxt + '</b>';
  }, true)

  //Login Screen v2
  const ids = ['login_screen_logo_enable',
      'upload_image',
      'upload_image_button',
      'login_screen_background_enable',
      'ct4gg_plugin[login_screen_background_color]',
      'ct4gg_plugin[login_screen_link_color]',
      'ct4gg_plugin[login_screen_text_color]',
      'ct4gg_plugin[login_screen_btn_color]',
      'ct4gg_plugin[login_screen_form_bg_color]',
      'login_redirect_after_logout',
      'login_hide_login_errors',
      'login_no_admin_to_home'];
  function login_v2(checked) {
    if (checked) {
      for (var i = 0; i < ids.length; i++) {
       document.getElementById(ids[i]).disabled=true;
      }
       Array.from(document.getElementsByClassName("login-slugs")).forEach(
         function(element, index, array) {
             // do stuff
             element.disabled = false;
         }
       );
     } else {
       for (var i = 0; i < ids.length; i++) {
         document.getElementById(ids[i]).disabled=false;
        }
       Array.from(document.getElementsByClassName("login-slugs")).forEach(
         function(element, index, array) {
             // do stuff
             element.disabled = true;
         }
       );
     }
  }
    on('change', '#login_screen_v2',function(e) {
    login_v2(this.checked);
  }, true)


  
  function onLoad(loading, loaded) {
    if(document.readyState === 'complete'){
        return loaded();
    }
    loading();
    if (window.addEventListener) {
        window.addEventListener('load', loaded, false);
    }
    else if (window.attachEvent) {
        window.attachEvent('onload', loaded);
    }
};

onLoad(function(){
   console.log('I am waiting for the page to be loaded');
},
function(){
    console.log('The page is loaded');
    if(document.getElementById('login_screen_v2') !== null) {
      login_v2(document.getElementById('login_screen_v2').checked);
    }
    
});

})()