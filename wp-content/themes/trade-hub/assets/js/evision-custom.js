// On Document Load
/* pre loader */
jQuery(window).on('load', function () {
  jQuery('#status').fadeOut();
  jQuery('#preloader').delay(350).fadeOut('slow');
  jQuery('body').delay(350).css({
    'overflow': 'initial'
  });
})

// On Document Ready
jQuery(document).ready(function ($) {
  goToTop();
  // headerFix();
  subMenuScript();
  navBar();
  addOddclass();
  checkImage();
  Slider();
  // jQuery("header#masthead").sticky({topSpacing:0});
});

/* fixed header function */
function headerFix() {
  jQuery(window).scroll(function () {
    if (jQuery(window).scrollTop() > 0) {
      jQuery('#masthead').addClass('navbar-fixed-top');
    }

    if (jQuery(window).scrollTop() < 1) {
      jQuery('#masthead').removeClass('navbar-fixed-top');
    }
  });

  jQuery(".nav-buttons.col-md-1").click(function () {
    jQuery("i.fa.fa-search").toggleClass("fa-close");
  });
}


/* go to top function */
function goToTop() {

  jQuery('#gotop').click(function () {
    jQuery('html, body').animate({
      scrollTop: '0px'
    }, 1000);
    return false;
  });

  jQuery(window).scroll(function () {
    var scrollTopPosition = jQuery('html, body').scrollTop();
    if (scrollTopPosition > 240) {
      jQuery('#gotop').css({
        'bottom': 25
      });
    } else {
      jQuery('#gotop').css({
        'bottom': -100
      });
    }
  });
}

/* sub menu function */
function subMenuScript() {
  jQuery("li.menu-item-has-children > a").each(function () {
    jQuery(this).append("<i class='fa fa-angle-down'></i>");
  });
  jQuery('li.menu-item-has-children .fa').click(function (e) {
    e.preventDefault();
    jQuery(this).siblings().toggle();
    e.stopPropagation();
  })

}

function navBar() {
  //hide and show nav 
  jQuery("button#sec-menu-toggle").click(function () {
    jQuery("div#sec-site-header-menu").slideToggle("1500");
  });
  //hide and show top nav 
  jQuery("i.fa.fa-bars.top-nav-mobile").click(function () {
    jQuery(".trade-hub-top-menu ul").slideToggle("1500");
  });

  jQuery("#sec-menu-toggle").click(function () {
    jQuery('button > i').toggleClass('fa-bars');
    jQuery("button > i").toggleClass("fa-close");
  });
  //hide and show search 
  jQuery(".nav-buttons").click(function () {
    jQuery("#top-search").slideToggle("fast");
  });
}

/* add odd class */
function addOddclass() {
  jQuery('article:odd').addClass('odd');
}

/* check image class*/

function checkImage() {
  if (jQuery("div#main-menu").hasClass(".post-image")) {
    jQuery(".entry-content-stat").addClass("no-image");
  }
}

/* slick slider function */
function Slider() {
  //slick slider 
  jQuery('.banner-wrapper').slick({
    slidesToShow: 1,
    dots: true,
    arrows: true,
    autoplay: true,
    autoplaySpeed: 6000,
    responsive: [{
        breakpoint: 769,
        settings: {
          arrows: false,
          slidesToShow: 1
        }
      },
      {
        breakpoint: 480,
        settings: {
          arrows: false,
          slidesToShow: 1
        }
      }
    ]
  });

   //slick slider 
  jQuery('.testimonials').slick({
    slidesToShow: 3,
    dots: true,
    arrows: false,
    autoplay: true,
    autoplaySpeed: 6000,
    responsive: [{
        breakpoint: 768,
        settings: {
          arrows: false,
          slidesToShow: 1
        }
      },
      {
        breakpoint: 480,
        settings: {
          arrows: false,
          slidesToShow: 1
        }
      }
    ]
  });

  jQuery('.trade-hub-news').slick({
    slidesToShow: 3,
    dots: true,
    arrows: false,
    autoplay: true,
    autoplaySpeed: 6000,
    responsive: [{
        breakpoint: 768,
        settings: {
          arrows: false,
          slidesToShow: 1
        }
      },
      {
        breakpoint: 480,
        settings: {
          arrows: false,
          slidesToShow: 1
        }
      }
    ]
  });

}