jQuery(document).ready(function ($) {


  if (window.one_page_express_backstretch) {

    window.one_page_express_backstretch.duration = parseInt(window.one_page_express_backstretch.duration);
    window.one_page_express_backstretch.transitionDuration = parseInt(window.one_page_express_backstretch.transitionDuration);

    jQuery('.header-homepage, .header').backstretch(one_page_express_backstretch.images, one_page_express_backstretch);
  }


  var masonry = $(".post-list-c");
  if (masonry.length) {
    masonry.masonry({
      itemSelector: '.post-list-item',
      percentPosition: true,
    });


  }
  
});


(function ($) {
  var masonry = $(".post-list-c");

  var images = masonry.find('img');
  var loadedImages = 0;

  function imageLoaded() {
    loadedImages++;
    if (images.length === loadedImages) {
      masonry.data().masonry.layout();
    }
  }

  images.each(function () {
    $(this).on('load',imageLoaded);
  });

  var morphed = $("[data-text-effect]");
  if (morphed.length && JSON.parse(one_page_express_settings.header_text_morph)) {
    morphed.each(function () {
      var text = $(this).html();
      text = text.replace(/\{(.*?)\}/, '<span class="text-morph">$1</span>');
      $(this).html(text);

      $(this).find(".text-morph").Morphext({
        animation: one_page_express_settings.header_text_morph_animation,
        speed: one_page_express_settings.header_text_morph_speed,
        separator: "|"
      });

      $(this).css('opacity', 1);
    });
  }
})(jQuery);