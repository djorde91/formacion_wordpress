jQuery(document).ready( function($){

  $( "<div class='acf-notice -error acf-error-message notice_selector_error'><p>No hemos encontrado nada, prueba con otro nombre o año.</p></div>" ).appendTo( $( ".acf-field-5cbb380954532 > div.acf-label label" ) );
  $( "<div class='acf-notice -success acf-success-message notice_selector_success'><p>¡Revisa los cambios!</p></div>" ).appendTo( $( ".acf-field-5cbb380954532 > div.acf-label label" ) );

	$('input[name="acf[field_5cbb380954532]"').on('click', function(){ 

      $.ajax({
         beforeSend: function (qXHR, settings) {
         },
         complete: function () {
        //$('#loading').fadeOut();
         },
         type : "post",
         url: '/wp-admin/admin-ajax.php',
         data : {
             action: 'api_movie_info',
             movie_name: $('#acf-field_5cabb07cc9899').val(),
             movie_year: $('#acf-field_5cb9dc30113ca').val()

            
         },
         success: function(response) {
                //console.log(typeof response);
                //parse two times.

                var json_movie_info = JSON.parse(response);
                var json_movie_info = JSON.parse(json_movie_info);
                console.log(json_movie_info);
                if (json_movie_info.Response == 'False') {
                  $('.notice_selector_error').addClass('notice_error_display');
                  $('.notice_selector_success').removeClass('notice_success_display');
                }else{
                  $('.notice_selector_error').removeClass('notice_error_display');
                  $('.notice_selector_success').addClass('notice_success_display');
                  

                  $('#acf-field_5cabb07cc9899').val(json_movie_info.Title);
                  $('#acf-field_5cb9dc30113ca').val(json_movie_info.Year);
                  $('#acf-field_5cb9fdd7c255e').val(json_movie_info.Runtime);
                  $('#acf-field_5cba01123bcfc').val(json_movie_info.Director);
                  $('#acf-field_5cba01a6671b2').val(json_movie_info.Plot);
                }


          
         }
      })

   });

  $( "<div class='acf-notice -info acf-info-message sugerencias_peliculas sugerencias_none'><p id='sugerencias_text'></p></div>" ).appendTo( $( ".acf-field-5cb9dc30113ca  div.acf-input" ) );

    $('#acf-field_5cb9dc30113ca, #acf-field_5cabb07cc9899').on('click touch keyup', function(){ 

      $.ajax({
         beforeSend: function (qXHR, settings) {
         },
         complete: function () {
        //$('#loading').fadeOut();
         },
         type : "post",
         url: '/wp-admin/admin-ajax.php',
         data : {
             action: 'api_movie_info',
             movie_name: $('#acf-field_5cabb07cc9899').val(),
             movie_year: $('#acf-field_5cb9dc30113ca').val()
          
         },
         success: function(response) {

                //console.log(typeof response);
                //parse two times.

                var json_movie_info = JSON.parse(response);
                var json_movie_info = JSON.parse(json_movie_info);
                if (json_movie_info.Response == 'False') {

                    $('#sugerencias_text').text('No hemos encontrado ninguna sugerencia');
                    $('.sugerencias_peliculas').addClass('sugerencias_display');
                    
                }else{

                  var text = '<h3><strong>Sugerencias de Contenido:</strong> </h3>';
                      text += '<p> Prueba con distintos años y nombres para obtener distintos resultados. </p> ';
                      text += '<p> <b>Titulo: </b>' + json_movie_info.Title;
                      text += '<p> <b>Año: </b>' + json_movie_info.Year;
                      text += '<p> <b>Duración: </b>' + json_movie_info.Runtime;
                      text += '<p> <b>Director: </b>' + json_movie_info.Director;
                      text += '<p> <b>Argumento: </b>' + json_movie_info.Plot;

                 
                      $('#sugerencias_text').html(text);
                      $('.sugerencias_peliculas').addClass('sugerencias_display');

                }    
         }
      })

   });

    // $('.acf-field_5cb9dc30113ca, .acf-field_5cabb07cc9899').on('mouseleave', function(){ 
    //    $('.sugerencias_peliculas').removeClass('sugerencias_display');


    //  });

});