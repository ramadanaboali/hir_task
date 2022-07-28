'use strict';
var loadFile = function(event) {
    var image = document.getElementById('output');
    image.src = URL.createObjectURL(event.target.files[0]);
};
function edit_alert(id){
    $("#update_model_"+id).modal('show');
}
function show_points(id){
    $("#show_model_"+id).modal('show');
}
function delete_alert(id,url){

    swal({
        title: "Are you sure ?",
        text: "Once deleted, you will not be able to recover this field!",
        icon: "warning",
        buttons: true,
        dangerMode: true,
    })
        .then((willDelete) => {
            if (willDelete) {
                $.ajax({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    url  : app_url+"/admin/"+url+"/"+id,
                    type : 'Delete',
                    async: false,
                    success:function(data) {
                        if(data==1){
                            $("#row_"+id).fadeOut(1500)
                            swal("Poof! field has been deleted!", {
                                icon: "success",
                            });
                        }else{
                            swal(data);
                        }
                    },
                    error: function (request, status, error) {
                        swal(error);
                    }
                });
            } else {
                swal("Your field is safe!");
            }
        });

}

