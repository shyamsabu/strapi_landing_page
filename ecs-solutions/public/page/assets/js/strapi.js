$(document).ready(function(){
  $.ajax({
      url: 'http://localhost:1337/api/banner-text?populate=%2A',
      method: 'GET',
      success: function(response1) {
          var banner_main = response1.data.attributes.TextMain;
          var banner_small = response1.data.attributes.TextSmall;
          var banner_sub = response1.data.attributes.TextSub;
          var banner_img = response1.data.attributes.banner_img.data[0].attributes.url;
          var sec_1_heading = response1.data.attributes.section_1_heading;
          var price_sec_heading = response1.data.attributes.price_sec_heading;

          $(".text-main").append(banner_main);
          $(".text-small").append(banner_small);
          $(".text-sub").append(banner_sub);
          $(".benefit_sec h2").append(sec_1_heading);
          $(".price_sec  h2").append(price_sec_heading);
          $(".project_banner").css("background-image", "url('http://localhost:1337" + banner_img + "')");

      },
      error: function(xhr, status, error) {
          console.error(status, error);
      }
  });



  $.ajax({
    url: 'http://localhost:1337/api/benefits-secs?populate=%2A',
    method: 'GET',
    success: function(response2) {
        response2.data.forEach(bnfit => {
            var bnfit_img = bnfit.attributes.product_img.data[0].attributes.url;
            var bnfit_heading = bnfit.attributes.heading;
            var bnfit_dec = bnfit.attributes.discription;
            $(".benefit-wrap .row").append('<div class="col-lg-4 col-md-6"><div><div class="benefit-wrap-in"><div class="bf-pic"><img src="http://localhost:1337'+ bnfit_img +'" alt=""></div><div class="benefit-main"><h3 class="fw-34">' + bnfit_heading +'</h3><p>' + bnfit_dec + '</p></div></div></div></div>');

        });
    },
    error: function(xhr, status, error) {
        console.error(status, error);
    }
});


    // about_section //

    $.ajax({
        url: 'http://localhost:1337/api/about-sec?populate=%2A',
        method: 'GET',
        success: function(response3) {
            console.log(response3);
            var sec_head_1 = response3.data.attributes.sec_title_1;
            var sec_head_2 = response3.data.attributes.sec_title_2;
            var sec_subtext = response3.data.attributes.sec_subText;
            var sec_para = response3.data.attributes.abt_pre[0].children[0].text;      
            var first_img = response3.data.attributes.on_e.data.attributes.url;
            var sec_img = response3.data.attributes.second_img.data.attributes.url;
            var bg_img = response3.data.attributes.background.data.attributes.url;
            $(".about-wrap .sec_title .fs-70").append(sec_head_1);
            $(".about-wrap .sec_head_2").append(sec_head_2);
            $(".about-wrap h4").append(sec_subtext);
            $(".abt-pre").html(sec_para);
            $(".about").css("background-image", "url('http://localhost:1337" + bg_img + "')");
            $('.about-right').append('<img src="http://localhost:1337'+ first_img +'" class="on-e">')
            $('.about-right').append('<img src="http://localhost:1337'+ sec_img +'" class="tw-o">')
  
        },
        error: function(xhr, status, error) {
            console.error(status, error);
        }
    });


    // slider //
    const owls = document.querySelectorAll('.owl-item');

    $.ajax({
        url: 'http://localhost:1337/api/slider-contents?populate=%2A',
        method: 'GET',
        success: function(response4) {
            console.log( response4);
            response4.data.forEach((bnfit,index) => {
                var owlitem = owls[index];
                var svg = bnfit.attributes.svg;
                var slider_head = bnfit.attributes.slider_head;
                var slider_dec = bnfit.attributes.slider_dec;
                $(owlitem).append('<div class="price_s"><div class="price_s_in"><div class="price_icon">' + svg + '</div><h3 class="fw-34">' + slider_head + '</h3><p>' + slider_dec + '</p></div></div>');
     
            });
        },
        error: function(xhr, status, error) {
            console.error(status, error);
        }
    });


    $.ajax({
        url: 'http://localhost:1337/api/automated-sec?populate=%2A',
        method: 'GET',
        success: function(response5) {
            
        var sec_heading = response5.data.attributes.heading;
        var sec_text = response5.data.attributes.text;
        $(".tab-section  h2").append(sec_heading);
        $(".tab-section  p.text-white").append(sec_text);


        },
        error: function(xhr, status, error) {
            console.error(status, error);
        }
    });
});