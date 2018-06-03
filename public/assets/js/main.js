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
        $('.choice_e').fadeOut();
        $("#answer option[value='choice_c']").remove();
        $("#answer option[value='choice_d']").remove();
      }
      else if( $(this).val() == 4 ){
        $('.choice_c').fadeIn();
        $('.choice_d').fadeIn();
        $('.choice_e').fadeOut();
        if($("#answer option[value='choice_c']").length == 0){
          $("#answer").append('<option value="choice_c">Choice C</option>');
        } 
        if($("#answer option[value='choice_d']").length == 0){
          $("#answer").append('<option value="choice_d">Choice D</option>');
        }
      }
      else if( $(this).val() == 5 ){
        $('.choice_c').fadeIn();
        $('.choice_d').fadeIn();
        $('.choice_e').fadeIn();
        if($("#answer option[value='choice_c']").length == 0){
          $("#answer").append('<option value="choice_c">Choice C</option>');
        } 
        if($("#answer option[value='choice_d']").length == 0){
          $("#answer").append('<option value="choice_d">Choice D</option>');
        }
        if($("#answer option[value='choice_e']").length == 0){
          $("#answer").append('<option value="choice_e">Choice E</option>');
        }
      }
  });

  $('#question_type').change(function(e) {
    e.preventDefault();
      if ($(this).val() == 'regular' ) {
        $('.question_image').fadeOut();
      } else if ( $(this).val() == 'photo' ) {
        $('.question_image').fadeIn();
      }
  });

  $('#number_of_answer').change(function(e) {
    var choice = $('#number_of_answer').find(":selected").text();
    if(choice == 2){
      $("#answer option[value='choice_c']").remove();
      $("#answer option[value='choice_d']").remove();
      $("#answer option[value='choice_e']").remove();
    }
    else if(choice == 3){
      $("#answer option[value='choice_d']").remove();
      $("#answer option[value='choice_e']").remove();
    }
    else if(choice == 4){
      $("#answer option[value='choice_e']").remove();
    }
  });
});