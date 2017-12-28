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