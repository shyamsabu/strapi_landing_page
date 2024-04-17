
jQuery(function() {
    $.ajax({
        url: 'http://localhost:1337/api/banner-text?populate=%2A',
        method: 'GET',
        success: function(response1) {
            var banner_main = response1.data.attributes.TextMain;
            var contact_head = response1.data.attributes.contact_head;
            var banner_small = response1.data.attributes.TextSmall;
            var banner_sub = response1.data.attributes.TextSub;
            var banner_img = response1.data.attributes.banner_img.data[0].attributes.url;
            var contact_bg = response1.data.attributes.contact_bg.data.attributes.url;
            var sec_1_heading = response1.data.attributes.section_1_heading;
            var get_quote = response1.data.attributes.get_quote;
            var get_quote_bg = response1.data.attributes.get_quote_bg.data.attributes.url;
            var price_sec_heading = response1.data.attributes.price_sec_heading;
  
            console.log(get_quote);
            $(".text-main").append(banner_main);
            $(".text-small").append(banner_small);
            $(".text-sub").append(banner_sub);
            $(".benefit_sec h2").append(sec_1_heading);
            $(".price_sec  h2").append(price_sec_heading);
            $(".contact-main h2").append(contact_head);
            $(".get-quote h2").append(get_quote);
            $(".get-quote").css("background-image", "url('http://localhost:1337" + get_quote_bg + "')");
            $(".project_banner").css("background-image", "url('http://localhost:1337" + banner_img + "')");
            $(".contact-main").css("background-image", "url('http://localhost:1337" + contact_bg + "')");
  
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
            console.log(bnfit);
              var bnfit_img = bnfit.attributes.product_img.data.attributes.url;
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
              var sec_img = response3.data.attributes.second_img.data[0].attributes.url;
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

      const owls1 = document.querySelectorAll('.f1_slider .slider_item');
      const owls2 = document.querySelectorAll('.f2_slider .slider_item');
      $.ajax({
        url: 'http://localhost:1337/api/automated-sliders?populate=%2A',
        method: 'GET',
        success: function(response6) {
            console.log( response6);
            response6.data.forEach((bnfit,index) => {
                console.log( bnfit,"index",index);
                var owlitem1 = owls1[index];
                var owlitem2 = owls2[index];
                var slider_head = bnfit.attributes.slider_head;
                var slider_img = bnfit.attributes.slider_img.data.attributes.url;
                console.log(slider_head);
                var slider_dec = bnfit.attributes.para_text[0].children[0].text;                ;
                $(owlitem1).append('<div class="item"><div class="tab-title">' + slider_head + '</div></div>');
                $(owlitem2).append('<div class="item"><div class="tab-outer-wrap"><div class="left-wrap"><figure class="img-tab-fig"><img src=" http://localhost:1337' + slider_img + '"></figure></div><div class="right-wrap">' + slider_dec + '</div></div>');
     
            });
        },
        error: function(xhr, status, error) {
            console.error(status, error);
        }
    });


    const data_contact = document.querySelectorAll('.contact-main-wrap .icon');
    const data_contact_head = document.querySelectorAll('.contact-main-wrap h4');
    $.ajax({
        url: 'http://localhost:1337/api/contact-secs?populate=%2A',
        method: 'GET',
        success: function(response7) {
            response7.data.forEach((bnfit,index) => {
                var contact_data = data_contact[index];
                var contact_data_head = data_contact_head[index];
                var contact_svg = bnfit.attributes.contact_svg;
                var contact_head = bnfit.attributes.heading;

              $(contact_data).append(contact_svg);
              $(contact_data_head).append(contact_head);
    
            });
        },
        error: function(xhr, status, error) {
            console.error(status, error);
        }
    });

    $.ajax({
        url: 'http://localhost:1337/api/franco-sec?populate=%2A',
        method: 'GET',
        success: function(response8) {
            console.log(response8,"ggufguyf");
           var frnc_img = response8.data.attributes.franc_img.data.attributes.url;
           var frnc_head = response8.data.attributes.frnc_head;
           var frnc_text = response8.data.attributes.para_text[0].children[0].text;
           console.log(frnc_text);
           $(".postalia-text h2").append(frnc_head);
           $(".postalia-text").append('<img src="http://localhost:1337' + frnc_img +' ">');
           $(".postalia-text").append(frnc_text);


        },
        error: function(xhr, status, error) {
            console.error(status, error);
        }
    });
});