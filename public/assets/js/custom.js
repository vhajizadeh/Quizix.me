quizix = {
    showNotification: function(from, align, type, message){
        $.notify({
        	icon: "<i class='fa fa-bell-o'></i>",
        	message: message

        },{
            type: type,
            timer: 4000,
            placement: {
                from: from,
                align: align
            }
        });
    }
}

jQuery(document).ready(function(){
  $('#number_of_answer').change(function(e) {
    e.preventDefault();
      if ($(this).val() == 3 ) {
        $('.choice_c').fadeIn();
        $('.choice_d').fadeOut();
        $("#answer option[value='choice_d']").remove();
        if($("#answer option[value='choice_c']").length == 0){
          $("#answer").append('<option value="choice_c">Choice C</option>');
        }        
      } else if ( $(this).val() == 2 ) {
        $('.choice_c').fadeOut();
        $('.choice_d').fadeOut();
        $("#answer option[value='choice_c']").remove();
        $("#answer option[value='choice_d']").remove();
      }
      else if( $(this).val() == 4 ){
        $('.choice_c').fadeIn();
        $('.choice_d').fadeIn();
        if($("#answer option[value='choice_c']").length == 0){
          $("#answer").append('<option value="choice_c">Choice C</option>');
        } 
        if($("#answer option[value='choice_d']").length == 0){
          $("#answer").append('<option value="choice_d">Choice D</option>');
        }
      }
  });

  $('#question_type').change(function(e) {
    e.preventDefault();
      if ($(this).val() == 'regular' ) {
        $('#question_image').fadeOut();
      } else if ( $(this).val() == 'photo' ) {
        $('#question_image').fadeIn();
      }
  });
});