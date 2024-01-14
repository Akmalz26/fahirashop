<!-- Modal -->
<div class="modal fade" id="modal-edit" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">EDIT pelanggan</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <input type="hidden" id="pelanggan_id">

                <div class="form-group">
                    <label for="name" class="control-label">nama</label>
                    <input type="text" class="form-control" id="nama-edit">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-nama-edit"></div>
                </div>

                <div class="form-group">
                    <label class="control-label">alamat</label>
                    <textarea class="form-control" id="alamat-edit" rows="4"></textarea>
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-alamat-edit"></div>
                </div>

                <div class="form-group">
                    <label for="name" class="control-label">tlp</label>
                    <input type="number" class="form-control" id="tlp-edit">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-tlp-edit"></div>
                </div>

                <div class="form-group">
                    <label for="name" class="control-label">email</label>
                    <input type="text" class="form-control" id="email-edit">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-email-edit"></div>
                </div>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
                <button type="button" class="btn btn-primary" id="update">UPDATE</button>
            </div>
        </div>
    </div>
</div>

<script>
    //button create pelanggan event
    $('body').on('click', '#btn-edit-pelanggan', function () {

        let pelanggan_id = $(this).data('id');

        //fetch detail pelanggan with ajax
        $.ajax({
            url: `/pelanggan/${pelanggan_id}`,
            type: "GET",
            cache: false,
            success:function(response){

                //fill data to form
                $('#pelanggan_id').val(response.data.id);
                $('#nama-edit').val(response.data.nama);
                $('#alamat-edit').val(response.data.alamat);
                $('#tlp-edit').val(response.data.tlp);
                $('#email-edit').val(response.data.email);

                //open modal
                $('#modal-edit').modal('show');
            }
        });
    });

    //action update pelanggan
    $('#update').click(function(e) {
        e.preventDefault();

        //define variable
        let pelanggan_id = $('#pelanggan_id').val();
        let nama   = $('#nama-edit').val();
        let alamat   = $('#alamat-edit').val();
        let tlp   = $('#tlp-edit').val();
        let email   = $('#email-edit').val();
        let token   = $("meta[name='csrf-token']").attr("content");
        
        //ajax
        $.ajax({

            url: `/pelanggan/${pelanggan_id}`,
            type: "PUT",
            cache: false,
            data: {
                "nama": nama,
                "alamat": alamat,
                "tlp": tlp,
                "email": email,
                "_token": token
            },
            success:function(response){

                //show success message
                Swal.fire({
                    type: 'success',
                    icon: 'success',
                    title: `${response.message}`,
                    showConfirmButton: false,
                    timer: 3000
                });

                //data pelanggan
                let pelanggan = `
                    <tr id="index_${response.data.id}">
                        <td>${response.data.nama}</td>
                        <td>${response.data.alamat}</td>
                        <td>${response.data.tlp}</td>
                        <td>${response.data.email}</td>
                        <td class="text-center">
                            <a href="javascript:void(0)" id="btn-edit-pelanggan" data-id="${response.data.id}" class="btn btn-primary btn-sm">EDIT</a>
                            <a href="javascript:void(0)" id="btn-delete-pelanggan" data-id="${response.data.id}" class="btn btn-danger btn-sm">DELETE</a>
                        </td>
                    </tr>
                `;
                
                //append to pelanggan data
                $(`#index_${response.data.id}`).replaceWith(pelanggan);

                //close modal
                $('#modal-edit').modal('hide');
                

            },
            // error:function(error){
                
            //     if(error.responseJSON.title[0]) {

            //         //show alert
            //         $('#alert-title-edit').removeClass('d-none');
            //         $('#alert-title-edit').addClass('d-block');

            //         //add message to alert
            //         $('#alert-title-edit').html(error.responseJSON.title[0]);
            //     } 

            //     if(error.responseJSON.content[0]) {

            //         //show alert
            //         $('#alert-content-edit').removeClass('d-none');
            //         $('#alert-content-edit').addClass('d-block');

            //         //add message to alert
            //         $('#alert-content-edit').html(error.responseJSON.content[0]);
            //     } 

            // }

        });

    });

</script>