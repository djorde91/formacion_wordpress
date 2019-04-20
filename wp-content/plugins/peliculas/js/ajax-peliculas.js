jQuery(document).ready( function($){

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
             action: 'api_movie_info' 
            
         },
         success: function(response) {
                //console.log(typeof response);
                //parse two times.

                var json_movie_info = JSON.parse(response);
                var json_movie_info = JSON.parse(json_movie_info);

                $('#acf-field_5cabb07cc9899').val(json_movie_info.Title);
                $('#acf-field_5cb9dc30113ca').val(json_movie_info.Year);
                $('#acf-field_5cb9fdd7c255e').val(json_movie_info.Runtime);
                $('#acf-field_5cba01123bcfc').val(json_movie_info.Director);
                $('#acf-field_5cba01a6671b2').val(json_movie_info.Plot);
          
         }
      })

   });
});