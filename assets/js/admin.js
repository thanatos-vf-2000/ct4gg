/**
* Template Name: ct4gg - Admin
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
  on('click', 'ul.nav-tabs > li', function(e) {
    e.preventDefault(),
	document.querySelector("ul.nav-tabs li.active").classList.remove("active"),
		document.querySelector(".tab-pane.active").classList.remove("active");
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

})()