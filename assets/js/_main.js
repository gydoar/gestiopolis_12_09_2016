/* ========================================================================
 * DOM-based Routing
 * Based on http://goo.gl/EUTi53 by Paul Irish
 *
 * Only fires on body classes that match. If a body class contains a dash,
 * replace the dash with an underscore when adding it to the object below.
 *
 * .noConflict()
 * The routing is enclosed within an anonymous function so that you can 
 * always reference jQuery with $, even when in .noConflict() mode.
 *
 * Google CDN, Latest jQuery
 * To use the default WordPress version of jQuery, go to lib/config.php and
 * remove or comment out: add_theme_support('jquery-cdn');
 * ======================================================================== */

(function($) {

// Use this variable to set up the common and page specific functions. If you 
// rename this variable, you will also need to rename the namespace below.
var Gestiopolis = {
  // All pages
  common: {
    init: function() {
      // JavaScript to be fired on all pages
      $("img.lazy").show().lazyload({
        effect : "fadeIn"
      });
      //1. Formulario de búsqueda top-nav
      $('.busca-link').on('click', function(e){
        e.preventDefault();
        $(this).hide();
        $('#nav_busca .navbar-search').removeClass('hide');
        $('#nav_busca .navbar-search').show('slow');
      });
      $('#nav_busca .x-search').on('click', function(e){
        e.preventDefault();
        $('#nav_busca .navbar-search').hide();
        $('#nav_busca .navbar-search').addClass('hide');
        $('.busca-link').show();
      });
      // 2. Hacer que aparezcan botones sociales conforme pasa el cursor encima de un artículo 
      
      //3. Iniciar tooltips
      $("a[data-toggle=tooltip]").tooltip();

      //5. Función de buscador mobile friendly http://tympanus.net/codrops/2013/06/26/expanding-search-bar-deconstructed/
        new UISearch( document.getElementById( 'sb-search' ) );
        new UISearch( document.getElementById( 'sb-search1' ) );
        //6. hide bar on scroll down
        // Hide Header on on scroll down
        var didScroll;
        var lastScrollTop = 0;
        var delta = 5;
        var navbarHeight = $('header.banner').outerHeight();

        $(window).scroll(function(event){
            didScroll = true;
        });

        setInterval(function() {
            if (didScroll) {
                hasScrolled();
                didScroll = false;
            }
        }, 250);

        function hasScrolled() {
            var st = $(this).scrollTop();
            
            // Make sure they scroll more than delta
            if(Math.abs(lastScrollTop - st) <= delta){return;}
            
            // If they scrolled down and are past the navbar, add class .nav-up.
            // This is necessary so you never see what is "behind" the navbar.
            if (st > lastScrollTop && st > navbarHeight){
                // Scroll Down
                $('header.banner').removeClass('nav-down').addClass('nav-up');
                $('.single #toolbar').css( "margin-top", "10px" );
                $('.sb-search-input').css( "top", "0" );
            } else {
                // Scroll Up
                if(st + $(window).height() < $(document).height()) {
                    $('header.banner').removeClass('nav-up').addClass('nav-down');
                    $('.single #toolbar').css( "margin-top", "58px" );
                    $('.sb-search-input').css( "top", "48px" );
                }
            }
            
            lastScrollTop = st;
        }
        //Button toTop
        $(window).scroll(function(){
          if ($(this).scrollTop() > 1200) {
            $('.toTop').fadeIn();
          } else {
            $('.toTop').fadeOut();
          }
        });
        
        //Click event to scroll to top
        $('.toTop').click(function(e){
          e.preventDefault();
          $('html, body').animate({scrollTop : 0},0);
          return false;
        });
    }
  },
  // Home page
  home: {
    init: function() {
      $("img.lazy").show().lazyload({
        effect : "fadeIn"
      });
      // JavaScript to be fired on the home page
      //1. Grid Ejes temáticos Home
      //Grid.init();
      //2. Slider home autores
      //slider(".autores-home", ".autores-home .carrusel", ".carrusel>.span3", 8);
      $('.carousel-inner').slick({
        dots: false,
        infinite: true,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 1,
        prevArrow: '.left.carousel-control',
        nextArrow: '.right.carousel-control',
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 1,
              infinite: true,
              dots: false
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 1
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
          // You can unslick at a given breakpoint now by adding:
          // settings: "unslick"
          // instead of a settings object
        ]
      });
        
      //3. Slider home temas
      //slider(".temas-home", ".temas-home .carrusel", ".carrusel>.span3", 8);
      
      var $container = $('#recientes');
      // Fire Isotope only when images are loaded
      $container.imagesLoaded(function(){
        $container.isotope({
          itemSelector : '.postw'
        });
      });
      // Infinite Scroll
      $('#recientes').infinitescroll({
        loading: {
          finishedMsg: "<em>Felicitaciones, has llegado al fin de Internet.</em>",
          img: serverval.template_directory+'/assets/img/ajax-loader.gif',
          msgText: '<em>Cargando el siguiente grupo de publicaciones...</em>',
          speed: 'fast'
        },
        navSelector  : 'div.pagination',
        nextSelector : '.nextpostslink',
        itemSelector : '.postw',
        bufferPx     : 200
      },
      // Infinite Scroll Callback
      function( newElements ) {
        var $newElems = jQuery( newElements ).hide();
        $newElems.imagesLoaded(function(){
          $newElems.fadeIn();
          $container.isotope( 'appended', $newElems );
          $("img.lazy").show().lazyload({
            effect : "fadeIn"
          });
        });
      });
    }
  },
  author: { //Página del autor
    init: function() {
      $("img.lazy").show().lazyload({
        effect : "fadeIn"
      });
      var $conta3 = $('#publicaciones');
      // Fire Isotope only when images are loaded
      $conta3.imagesLoaded(function(){
        $conta3.isotope({
          itemSelector : '.postw'
        });
      });
      // Infinite Scroll
      $('#publicaciones').infinitescroll({
        loading: {
          finishedMsg: "<em>Felicitaciones, has llegado al fin de Internet.</em>",
          img: serverval.template_directory+'/assets/img/ajax-loader.gif',
          msgText: '<em>Cargando el siguiente grupo de publicaciones...</em>',
          speed: 'fast'
        },
        navSelector  : 'div.pagination',
        nextSelector : '.nextpostslink',
        itemSelector : '.postw',
        bufferPx     : 200
      },
      // Infinite Scroll Callback
      function( newElements ) {
        var $newElems = jQuery( newElements ).hide();
        $newElems.imagesLoaded(function(){
          $newElems.fadeIn();
          $conta3.isotope( 'appended', $newElems );
          $("img.lazy").show().lazyload({
            effect : "fadeIn"
          });
        });
      });
      $('.see-more').on('click',function(event){
        event.preventDefault();
        $('.autdesc').css('height', 'auto');
        var height = ($('.post-image .vert-centered').outerHeight()+16);
        $('.author .post-image').css('height', height+'px');
        $('.author .post-image .bg-image').css('height', height+'px');
        $(this).hide();
        $('.see-less').show();
      });
      $('.see-less').on('click',function(event){
        event.preventDefault();
        $('.autdesc').css('height', '22px');
        $('.author .post-image').css('height', '25rem');
        $('.author .post-image .bg-image').css('height', '25rem');
        $(this).hide();
        $('.see-more').show();
      });
    }
  },
  category: { //Página del autor
    init: function() {
      $("img.lazy").show().lazyload({
        effect : "fadeIn"
      });
      //1. Slider home autores
      $('.carousel-inner').slick({
        dots: false,
        infinite: true,
        speed: 300,
        slidesToShow: 4,
        slidesToScroll: 1,
        prevArrow: '.left.carousel-control',
        nextArrow: '.right.carousel-control',
        responsive: [
          {
            breakpoint: 1024,
            settings: {
              slidesToShow: 3,
              slidesToScroll: 1,
              infinite: true,
              dots: false
            }
          },
          {
            breakpoint: 600,
            settings: {
              slidesToShow: 2,
              slidesToScroll: 1
            }
          },
          {
            breakpoint: 480,
            settings: {
              slidesToShow: 1,
              slidesToScroll: 1
            }
          }
          // You can unslick at a given breakpoint now by adding:
          // settings: "unslick"
          // instead of a settings object
        ]
      });

      var $conta1 = $('#recientes');
      // Fire Isotope only when images are loaded
      $conta1.imagesLoaded(function(){
        $conta1.isotope({
          itemSelector : '.postw'
        });
      });
      // Infinite Scroll
      $('#recientes').infinitescroll({
        loading: {
          finishedMsg: "<em>Felicitaciones, has llegado al fin de Internet.</em>",
          img: serverval.template_directory+'/assets/img/ajax-loader.gif',
          msgText: '<em>Cargando el siguiente grupo de publicaciones...</em>',
          speed: 'fast'
        },
        navSelector  : 'div.pagination',
        nextSelector : '.nextpostslink',
        itemSelector : '.postw',
        bufferPx     : 200
      },
      // Infinite Scroll Callback
      function( newElements ) {
        var $newElems = jQuery( newElements ).hide();
        $newElems.imagesLoaded(function(){
          $newElems.fadeIn();
          $conta1.isotope( 'appended', $newElems );
          $("img.lazy").show().lazyload({
            effect : "fadeIn"
          });
        });
      });
    }
  },
  tag: { //Página del autor
    init: function() {
      $("img.lazy").show().lazyload({
        effect : "fadeIn"
      });
      var $conta2 = $('#publicaciones');
      // Fire Isotope only when images are loaded
      $conta2.imagesLoaded(function(){
        $conta2.isotope({
          itemSelector : '.postw'
        });
      });
      // Infinite Scroll
      $('#publicaciones').infinitescroll({
        loading: {
          finishedMsg: "<em>Felicitaciones, has llegado al fin de Internet.</em>",
          img: serverval.template_directory+'/assets/img/ajax-loader.gif',
          msgText: '<em>Cargando el siguiente grupo de publicaciones...</em>',
          speed: 'fast'
        },
        navSelector  : 'div.pagination',
        nextSelector : '.nextpostslink',
        itemSelector : '.postw',
        bufferPx     : 200
      },
      // Infinite Scroll Callback
      function( newElements ) {
        var $newElems = jQuery( newElements ).hide();
        $newElems.imagesLoaded(function(){
          $newElems.fadeIn();
          $conta2.isotope( 'appended', $newElems );
          $("img.lazy").show().lazyload({
            effect : "fadeIn"
          });
        });
      });
    }
  },
  search: { //ABC temático
    init: function() {
      $("img.lazy").show().lazyload({
        effect : "fadeIn",
        failure_limit : 20
      });
      var $conta2 = $('#publicaciones');
      // Fire Isotope only when images are loaded
      $conta2.imagesLoaded(function(){
        $conta2.isotope({
          itemSelector : '.postw'
        });
      });
      // Infinite Scroll
      $('#publicaciones').infinitescroll({
        loading: {
          finishedMsg: "<em>Felicitaciones, has llegado al fin de Internet.</em>",
          img: serverval.template_directory+'/assets/img/ajax-loader.gif',
          msgText: '<em>Cargando el siguiente grupo de publicaciones...</em>',
          speed: 'fast'
        },
        navSelector  : 'div.pagination',
        nextSelector : '.nextpostslink',
        itemSelector : '.postw',
        bufferPx     : 200
      },
      // Infinite Scroll Callback
      function( newElements ) {
        var $newElems = jQuery( newElements ).hide();
        $newElems.imagesLoaded(function(){
          $newElems.fadeIn();
          $conta2.isotope( 'appended', $newElems );
          $("img.lazy").show().lazyload({
            effect : "fadeIn",
            failure_limit : 15
          });
        });
      });
    }
  },
  date: { //Página del autor
    init: function() {
      $("img.lazy").show().lazyload({
        effect : "fadeIn"
      });
      var $conta2 = $('#publicaciones');
      // Fire Isotope only when images are loaded
      $conta2.imagesLoaded(function(){
        $conta2.isotope({
          itemSelector : '.postw'
        });
      });
      // Infinite Scroll
      $('#publicaciones').infinitescroll({
        loading: {
          finishedMsg: "<em>Felicitaciones, has llegado al fin de Internet.</em>",
          img: serverval.template_directory+'/assets/img/ajax-loader.gif',
          msgText: '<em>Cargando el siguiente grupo de publicaciones...</em>',
          speed: 'fast'
        },
        navSelector  : 'div.pagination',
        nextSelector : '.nextpostslink',
        itemSelector : '.postw',
        bufferPx     : 200
      },
      // Infinite Scroll Callback
      function( newElements ) {
        var $newElems = jQuery( newElements ).hide();
        $newElems.imagesLoaded(function(){
          $newElems.fadeIn();
          $conta2.isotope( 'appended', $newElems );
          $("img.lazy").show().lazyload({
            effect : "fadeIn"
          });
        });
      });
    }
  },
  /*page_id_325584: { //Página de publicar
    init: function() {
      //Funciones javascript de página de publicar
      $("form#upldoc").submit(function(e){
        e.preventDefault();
        $('#publicar1').hide();
        $('#publicar2').show();
        $('#publicar2 .docprog').text('Cargando...');
        //grab all form data  
        var formData2 = new FormData($(this)[0]);
        $.ajax({
          url: serverval.template_directory+'/lib/functions/upload-doc.php',
          type: 'POST',
          data: formData2,
          async: true,
          cache: false,
          contentType: false,
          processData: false,
          success: function (pID1) {
            console.info('Paso 1 con éxito');
            console.info(pID1);
            $('#publicar2 .docprog').text('Preparando...');
            $('#publicar2 input#postid').val(pID1);
            $.ajax({
              url: serverval.template_directory+'/lib/functions/upload-doc.php',
              type: 'POST',
              data: { postid: pID1, step: 'dos' },
              async: true,
              cache: false,
              processData: true,
              success: function (pID2) {
                console.info('Paso 2 con éxito');
                console.info(pID2);
                $('#publicar2 .docprog').text('Optimizando...');
                $.ajax({
                  url: serverval.template_directory+'/lib/functions/upload-doc.php',
                  type: 'POST',
                  data: { postid: pID2, step: 'tres' },
                  async: true,
                  cache: false,
                  processData: true,
                  success: function (pID3) {
                    console.info('Paso 3 con éxito');
                    console.info(pID3);
                    $('#publicar2 .docprog').text('Generando HTML...');
                    $.ajax({
                      url: serverval.template_directory+'/lib/functions/upload-doc.php',
                      type: 'POST',
                      data: { postid: pID3, step: 'cuatro' },
                      async: true,
                      cache: false,
                      processData: true,
                      success: function (pID4) {
                        console.info('Paso 4 con éxito');
                        console.info(pID4);
                        $('#publicar2 .docprog').text('Finalizando...');
                        $.ajax({
                          url: serverval.template_directory+'/lib/functions/upload-doc.php',
                          type: 'POST',
                          data: { postid: pID4, step: 'cinco' },
                          async: true,
                          cache: false,
                          processData: true,
                          success: function (pID5) {
                            if (pID5 != 'error'){
                              console.info('Paso 5 con éxito');
                              console.info(pID5);
                              $('#publicar2 .docprog').text('¡Listo!');
                              $( "#uplpost button" ).removeAttr( "disabled" );
                              //$('#publicar2 input#postid').val(pID5);
                              
                            }else if (pID5 == 'error') {
                              $('#myModal img').hide();
                              console.info('Error en la conversión');
                              $('#publicar2 .docprog').text('Error en la conversión');
                              setTimeout(function(){
                                location.reload();
                                
                              }, 6000);
                            }
                          }
                        });
                      }
                    });
                  }
                });
              }
            });
          }
        });
       
        return false;
      });
      $("form#uplpost").submit(function(e){
        e.preventDefault();
        $('#publicar1').hide();
        
        //grab all form data  
        var formData3 = new FormData($(this)[0]);
        $.ajax({
          url: serverval.template_directory+'/lib/functions/upload-doc.php',
          type: 'POST',
          data: formData3,
          async: true,
          cache: false,
          contentType: false,
          processData: false,
          success: function (datareturn) {
            $('#publicar2').hide();
            var sharedata = datareturn.split('|');
            $('#publicar3 #post_link').html(sharedata[0]);
            $('#publicar3 #doc_iframe').html(sharedata[1]);
            $('#publicar3').show();
          }
        });
        return false;
      });
    }
  },*/ //Fin page_id_264

  single: {
    init: function() {
      $(".entry-content").find("a").addClass("gafrom from-post-content-link");
      $(window).scroll(function(){
        var scrolled = $(window).scrollTop();
        var arth = 100;
        if (serverval.all2html_htmlcontent != "") {
          arth = $('#page-container').outerHeight();
        } else {
          arth = $('.single .post-content .entry-content').outerHeight();
        }
        var adsh = 600;
        var relh = $('.single .right-post').outerHeight();
        var sideh = (adsh + relh) * 3.2;
        var sideh1 = adsh + relh;
        if(scrolled > 0){
          if(sideh < arth){
            $('.fixedside').css('top',-(scrolled*0.35)+'px');
          } else {
            if (arth <= 3700){
              $('.fixedside').css('position','relative');
              $(".right-post, .maincol").stick_in_parent().on("sticky_kit:stick", function(e) {
                console.log("has stuck!", e.target);
              });
            }else {
              $('.fixedside').css('top',-(scrolled*1.3)+'px');
            }
          }
        } else {
          if (arth <= 3700){
            $('.fixedside').css('top','0');
          }else {
            $('.fixedside').css('top','64px');
          }
          
        }
      });
      $("#social-sidebar").stick_in_parent({
        parent: ".right-post",
        offset_top: 48
      });
      $('table').addClass('table table-bordered');
      $('table td').removeAttr( "width" ).removeAttr( "style" );
      $('table tr').removeAttr( "width" ).removeAttr( "style" );
      $('table').removeAttr( "style" );
      setTimeout(function(){
        $(".comments-wrapper").hide();
        $('.comentarios > a.btn-block, .fixed-action-btn .btn-floating.gray').on('click', function(){
          $(".comments-wrapper").toggle('fast', 'linear');
          $(".comentarios > a.btn-block span").toggle();
        });
      }, 10000);
      
      //Button toTop
        $(window).scroll(function(){
          if ($(this).scrollTop() > 500) {
            $('.fixed-action-btn').fadeIn();
            $('.ad-sidebar').animate({
              bottom: "10px"
            }, 100 );
          } else {
            $('.fixed-action-btn').fadeOut();
            $('.ad-sidebar').animate({
              bottom: "-400px"
            }, 100 );
          }
        });
        /*$(window).scroll(function(){
          if ($(this).scrollTop() > 510) {
            $('.ad-sidebar').animate({
              bottom: "10px"
            }, 200 );
          } else {
            $('.ad-sidebar').animate({
              bottom: "-400px"
            }, 200 );
          }
        });*/
        /*$('.ad-sidebar .arrow.down').on('click', function(event) {
          event.preventDefault();
          $('.ad-sidebar').animate({
              bottom: "-310px"
            }, 100 );
          $(this).hide();
          $('.ad-sidebar .arrow.up').show();
        });
        $('.ad-sidebar .arrow.up').on('click', function(event) {
          event.preventDefault();
          $('.ad-sidebar').animate({
              bottom: "10px"
            }, 100 );
          $(this).hide();
          $('.ad-sidebar .arrow.down').show();
        });*/
        $('.fixed-action-btn.top-left .btn-floating.red').on('click', function(){
          $('.fixed-action-btn.top-left ul li.additional').toggle();
        });
        $('.internal-campaign').bind('click',function () {
          gaic.r( $(this).data('ic') );
        });

      $('.related-out li span a').on('click', function(e) {
        e.preventDefault();
        var idpost = $(this).data('el-pid');
        var linkid = $(this).attr('class');
        var titlelink = $(this).data('el-title');
        var urllink = $(this).data('el-url');
        console.info(idpost);
        console.info(linkid);
        console.info(titlelink);
        console.info(urllink);
        $.post(serverval.template_directory+'/lib/functions/report-link.php', {id:linkid, postid:idpost, title:titlelink, url:urllink}).done(function() {
            window.alert("Se ha reportado el enlace roto con éxito\n");
          });
      });

      $('.quotes a[data-toggle="tab"]').on('click', function () {
        var id = $(this).attr('href').slice(1);
        $('#copytext').attr('data-clipboard-target', id);
      });

      // main.js
      var client = new ZeroClipboard( document.getElementById("copytext") );

      client.on( "ready", function( readyEvent ) {
        // alert( "ZeroClipboard SWF is ready!" );
          client.on( "aftercopy", function( event ) {
          // `this` === `client`
          // `event.target` === the element that was clicked
          //event.target.style.display = "none";
          $('.quotes .alert').removeClass('hidden').addClass('show');
          setTimeout(function(){
            $('.quotes .alert').removeClass('show').addClass('hidden');
          }, 2000);
        });
      });

      // JavaScript to be fired on a single post
      if (serverval.manage_options == "1" && serverval.userlogin == "1"){
        $("input#editslug").on('click', function(e){
          e.preventDefault();
          var slug = $("input#slugedit").val();
          var idpost = parseInt(serverval.postid, 10);
          $.post(serverval.template_directory+'/lib/functions/frontendedit.php', {type: "slugedit", postid:idpost, newslug:slug}).done(function() {
                  location.reload();
                });
        });
        $("input#editimage").on('click', function(e){
          e.preventDefault();
          var imageurl = $("input#imageedit").val();
          var idpost = parseInt(serverval.postid, 10);
          $.post(serverval.template_directory+'/lib/functions/frontendedit.php', {type: "imageedit", postid:idpost, flickrurl:imageurl}).done(function() {
                  location.reload();
                });
        });
        $("#deletePost").on('click', function(e){
          e.preventDefault();
          var idpost = parseInt(serverval.postid, 10);
          if (confirm('¿Estás seguro que deseas eliminar este Artículo?')) {
              $.post(serverval.template_directory+'/lib/functions/frontendedit.php', {type: "deletepost", postid:idpost});
          }
        });
        $("input#editmargin").on('click', function(e){
          e.preventDefault();
          var margin = $("input#imagemargin").val();
          var idpost = parseInt(serverval.postid, 10);
          $.post(serverval.template_directory+'/lib/functions/frontendedit.php', {type: "imagemargin", postid:idpost, immargin:margin}).done(function() {
                  location.reload();
                });
        });
        $("#deleteImage").on('click', function(e){
          e.preventDefault();
          var idpost = parseInt(serverval.postid, 10);
          if (confirm('¿Estás seguro que deseas eliminar esta Imágen?')) {
              $.post(serverval.template_directory+'/lib/functions/frontendedit.php', {type: "deleteimage", postid:idpost}).done(function() {
                  location.reload();
                });
          }
        });
        $("#deletePdf").on('click', function(e){
          e.preventDefault();
          var idpost = parseInt(serverval.postid, 10);
          if (confirm('¿Estás seguro que deseas eliminar este Documento?')) {
              $.post(serverval.template_directory+'/lib/functions/frontendedit.php', {type: "deletepdf", postid:idpost}).done(function() {
                  location.reload();
                });
          }
        });

        $("a.gesti-open").click(function(){

          $($(this).attr('href')).fadeIn('normal');
              return false;
          
        });

        
        $('a.gesti-close').click(function() {
        
              $($(this).attr('href')).fadeOut();
              return false;
              
          });
        var ques=0;
        $("#agrexl").click(function() {
          $("#exlinks-"+ques).show();
          ques++;
        });
        $(".borrarjq").click(function() {
          var jqpost = $(this).attr("rel");
          $("#"+jqpost).remove();
        });
        $("form#optimg").submit(function(e){
          e.preventDefault();
          var formData = new FormData($(this)[0]);
          $.ajax({
            url: serverval.template_directory+'/lib/functions/frontendedit.php',
            type: 'POST',
            data: formData,
            async: true,
            cache: false,
            contentType: false,
            processData: false,
            success: function (returndata) { location.reload(); }
          });
        });
        $("form#all2html").submit(function(e){
          e.preventDefault();
          $('#myModal').modal('show');
          $('#myModal .modal-text').text('Cargando el Documento a WordPress...');
          //grab all form data  
          var formData = new FormData($(this)[0]);
          $.ajax({
            url: serverval.template_directory+'/lib/functions/processpdf.php',
            type: 'POST',
            data: formData,
            async: true,
            cache: false,
            contentType: false,
            processData: false,
            success: function (returndata) {
              //alert('Documento cargado con éxito. Recarga la página.');
              //location.reload();
              console.info('Paso 1 con éxito');
              $('#myModal .modal-text').text('Preparando el documento para la conversión...');
              $.ajax({
                url: serverval.template_directory+'/lib/functions/processpdf.php',
                type: 'POST',
                data: { postid: parseInt(serverval.postid, 10), step: 'dos' },
                async: true,
                cache: false,
                processData: true,
                success: function (returndata) {
                  console.info('Paso 2 con éxito');
                  $('#myModal .modal-text').text('Optimizando el documento...');
                  $.ajax({
                    url: serverval.template_directory+'/lib/functions/processpdf.php',
                    type: 'POST',
                    data: { postid: parseInt(serverval.postid, 10), step: 'tres' },
                    async: true,
                    cache: false,
                    processData: true,
                    success: function (returndata) {
                      console.info('Paso 3 con éxito');
                      $('#myModal .modal-text').text('Generando el HTML del documento');
                      $.ajax({
                        url: serverval.template_directory+'/lib/functions/processpdf.php',
                        type: 'POST',
                        data: { postid: parseInt(serverval.postid, 10), step: 'cuatro' },
                        async: true,
                        cache: false,
                        processData: true,
                        success: function (returndata) {
                          console.info('Paso 4 con éxito');
                          $('#myModal .modal-text').text('Finiquitando un par de detalles. Ya casi...');
                          $.ajax({
                            url: serverval.template_directory+'/lib/functions/processpdf.php',
                            type: 'POST',
                            data: { postid: parseInt(serverval.postid, 10), step: 'cinco' },
                            async: true,
                            cache: false,
                            processData: true,
                            success: function (returndata) {
                              if (returndata != 'error'){
                                console.info('Paso 5 con éxito');
                                $('#myModal .modal-text').text('Redirigiendo a la versión full del archivo convertido');
                                setTimeout(function(){
                                  window.location.replace(returndata);
                                }, 4000);
                              }else if (returndata == 'error') {
                                $('#myModal img').hide();
                                console.info('Error en la conversión');
                                $('#myModal .modal-text').text('El archivo que estás tratando de cargar tiene errores. Por favor revísalo e inténtalo cargar de nuevo.');
                                setTimeout(function(){
                                  location.reload();
                                  /*$.post(serverval.template_directory+'/lib/functions/frontendedit.php', {type: "deletepdf", postid:parseInt(serverval.postid, 10)}).done(function() {
                                      location.reload();
                                    });*/
                                }, 6000);
                              }
                            }
                          });
                        }
                      });
                    }
                  });
                }
              });
            }
          });
          return false;
        });
      } //If user admin and login
      if (serverval.all2html_htmlcontent != "") {
        $(document).on('ready', function() {
          var curpage = 0;
          $(window).scroll(function(){
            curpage = this_cur_page_idx;
            $('input.pagen').val(curpage+1);
          });
          $('#toolbar').width($('#page-container').width());
          var page = document.getElementsByClassName('pf');

          var total_pages = page.length;
          $('#pages').text(total_pages);

          $( "input.pagen" ).keyup(function() {
            var value = $(this).val()-1;
            if(value < 0) {return;}
            var offsettop = $('#'+page[value].id).offset().top;
            setTimeout(function() {
              $('html, body').stop().animate({
                  scrollTop: offsettop
              }, 1000);
            },300);
          }).keyup();
          $( "#toolbar .prevpage" ).on('click', function(e) {
            e.preventDefault();
            var offsettop = $('#'+page[curpage-1].id).offset().top;
            $('html, body').stop().animate({
                scrollTop: offsettop
            }, 1000);
          });
          $( "#toolbar .nextpage" ).on('click', function(e) {
            e.preventDefault();
            var offsettop = $('#'+page[curpage+1].id).offset().top;
            $('html, body').stop().animate({
                scrollTop: offsettop
            }, 1000);
          });
          setTimeout(function() {
            a2h.fit_width(); //Escala las páginas para que se ajusten al ancho del contenedor
          },1500);
          $(window).resize(function() {
            if(this.resizeTO) {clearTimeout(this.resizeTO);}
            this.resizeTO = setTimeout(function() {
                $(this).trigger('resizeEnd');
            }, 500);
          });

          $(window).bind('resizeEnd', function() {
              a2h.fit_width_resize(); //Escala las páginas para que se ajusten al ancho del contenedor si la ventana cambia de tamaño
              $('#toolbar').width($('#page-container').width());
          });
        });
      } //if htmlcontent
    } //init
  }
};

// The routing fires all common scripts, followed by the page specific scripts.
// Add additional events for more control over timing e.g. a finalize event
var UTIL = {
  fire: function(func, funcname, args) {
    var namespace = Gestiopolis;
    funcname = (funcname === undefined) ? 'init' : funcname;
    if (func !== '' && namespace[func] && typeof namespace[func][funcname] === 'function') {
      namespace[func][funcname](args);
    }
  },
  loadEvents: function() {
    UTIL.fire('common');

    $.each(document.body.className.replace(/-/g, '_').split(/\s+/),function(i,classnm) {
      UTIL.fire(classnm);
    });
  }
};

$(document).ready(UTIL.loadEvents);

})(jQuery); // Fully reference jQuery after this point.