<!-- Modal -->
<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">TAMBAH KASIR</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <div class="form-group">
                    <label for="name" class="control-label">Nama</label>
                    <input type="text" class="form-control" id="nama">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-nama"></div>
                </div>
                

                <div class="form-group">
                    <label class="control-label">Alamat</label>
                    <textarea class="form-control" id="alamat" rows="4"></textarea>
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-alamat"></div>
                </div>

                <div class="form-group">
                    <label for="name" class="control-label">No telpon</label>
                    <input type="number" class="form-control" id="telp">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-telp"></div>
                </div>

                <div class="form-group">
                    <label for="name" class="control-label">Email</label>
                    <input type="text" class="form-control" id="email">
                    <div class="alert alert-danger mt-2 d-none" role="alert" id="alert-email"></div>
                </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">TUTUP</button>
                <button type="button" class="btn btn-primary" id="store">SIMPAN</button>
            </div>
        </div>
    </div>
</div>

<script>
    //button create kasir event
    $('body').on('click', '#btn-create-kasir', function () {

        //open modal
        $('#modal-create').modal('show');
    });

    //action create kasir
    $('#store').click(function(e) {
        e.preventDefault();

        //define variable
        let nama   = $('#nama').val();
        let alamat = $('#alamat').val();
        let telp = $('#telp').val();
        let email = $('#email').val();
        let token   = $("meta[name='csrf-token']").attr("content");
        
        //ajax
        $.ajax({

            url: `/kasir`,
            type: "POST",
            cache: false,
            data: {
                "nama": nama,
                "alamat": alamat,
                "telp": telp,
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

                //data kasir
                let kasir = `
                    <tr id="index_${response.data.id}">
                        <td>${response.data.nama}</td>
                        <td>${response.data.alamat}</td>
                        <td>${response.data.telp}</td>
                        <td>${response.data.email}</td>
                        <td class="text-center">
                            <a href="javascript:void(0)" id="btn-edit-kasir" data-id="${response.data.id}" class="btn btn-primary btn-sm">EDIT</a>
                            <a href="javascript:void(0)" id="btn-delete-kasir" data-id="${response.data.id}" class="btn btn-danger btn-sm">DELETE</a>
                        </td>
                    </tr>
                `;
                
                //append to table
                $('#table-kasirs').prepend(kasir);
                
                //clear form
                $('#nama').val('');
                $('#alamat').val('');
                $('#telp').val('');
                $('#email').val('');

                //close modal
                $('#modal-create').modal('hide');
                

            },
            // error:function(error){
                
            //     if(error.responseJSON.nama[0]) {

            //         //show alert
            //         $('#alert-nama').removeClass('d-none');
            //         $('#alert-nama').addClass('d-block');

            //         //add message to alert
            //         $('#alert-nama').html(error.responseJSON.nama[0]);
            //     } 

            //     if(error.responseJSON.alamat[0]) {

            //         //show alert
            //         $('#alert-alamat').removeClass('d-none');
            //         $('#alert-alamat').addClass('d-block');

            //         //add message to alert
            //         $('#alert-alamat').html(error.responseJSON.alamat[0]);
            //     } 

            //     if(error.responseJSON.telp[0]) {

            //         //show alert
            //         $('#alert-telp').removeClass('d-none');
            //         $('#alert-telp').addClass('d-block');

            //         //add message to alert
            //         $('#alert-telp').html(error.responseJSON.telp[0]);
            //     } 

            //     if(error.responseJSON.email[0]) {

            //         //show alert
            //         $('#alert-email').removeClass('d-none');
            //         $('#alert-email').addClass('d-block');

            //         //add message to alert
            //         $('#alert-email').html(error.responseJSON.email[0]);
            //     } 

            // }

        });

    });

</script>