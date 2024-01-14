<!-- Modal -->
<div class="modal fade" id="modal-create" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">TAMBAH PENJUALAN</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

                <<div class="form-group">
                        <label for="tgl">Tanggal</label>
                        <input type="date" class="form-control" id="tgl" name="tgl">
                    </div>
            
                    <div class="form-group">
                        <label for="jumlah">Jumlah</label>
                        <input type="number" class="form-control" id="jumlah" name="jumlah">
                    </div>

                    <div class="form-group">
                        <label for="id_pelanggan">pelanggan</label>
                        <select class="form-control" id="id_pelanggan" name="id_pelanggan">
                            <option value="">Pilih pelanggan</option>
                            @foreach($pelanggans as $pelanggan)
                                <option value="{{ $pelanggan->id }}">{{ $pelanggan->tanggal }}</option>
                            @endforeach
                        </select>
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
    //button create penjualan event
    $('body').on('click', '#btn-create-penjualan', function () {

        //open modal
        $('#modal-create').modal('show');
    });

    //action create penjualan
    $('#store').click(function(e) {
        e.preventDefault();

        //define variable
        let tanggal   = $('#tanggal').val();
        let jumlah = $('#jumlah').val();
        let id_pelanggan = $('#id_pelanggan').val();
        let token   = $("meta[name='csrf-token']").attr("content");
        
        //ajax
        $.ajax({

            url: `/penjualan`,
            type: "POST",
            cache: false,
            data: {
                "tanggal": tanggal,
                "jumlah": jumlah,
                "id_pelanggan": id_pelanggan,
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

                

                //data penjualan
                let penjualan = `
                    <tr id="index_${response.data.id}">
                        <td>${response.data.tanggal}</td>
                        <td>${response.data.jumlah}</td>
                        <td>${response.data.id_pelanggan}</td>
                        <td class="text-center">
                            <a href="javascript:void(0)" id="btn-edit-penjualan" data-id="${response.data.id}" class="btn btn-primary btn-sm">EDIT</a>
                            <a href="javascript:void(0)" id="btn-delete-penjualan" data-id="${response.data.id}" class="btn btn-danger btn-sm">DELETE</a>
                        </td>
                    </tr>
                `;
                
                //append to table
                $('#table-penjualans').prepend(penjualan);
                
                //clear form
                $('#tanggal').val('');
                $('#jumlah').val('');
                $('#id_pelanggan').val('');

                //close modal
                $('#modal-create').modal('hide');
                

            },

            // error: function (error) {
            //     // Tampilkan pesan kesalahan validasi atau email sudah ada
            //     var errors = error.responseJSON.errors;
            //     if ('email' in errors) {
            //         Swal.fire({
            //             icon: 'error',
            //             title: 'Oops...',
            //             text: 'Email sudah ada dalam basis data.',
            //         });
            //     } else {
            //         $.each(errors, function (key, value) {
            //             Swal.fire({
            //                 icon: 'error',
            //                 title: 'Oops...',
            //                 text: value[0],
            //             });
            //         });
            //     }

                
            // }
            // error:function(error){
                
            //     if(error.responseJSON.tanggal[0]) {

            //         //show alert
            //         $('#alert-tanggal').removeClass('d-none');
            //         $('#alert-tanggal').addClass('d-block');

            //         //add message to alert
            //         $('#alert-tanggal').html(error.responseJSON.tanggal[0]);
            //     } 

            //     if(error.responseJSON.jumlah[0]) {

            //         //show alert
            //         $('#alert-jumlah').removeClass('d-none');
            //         $('#alert-jumlah').addClass('d-block');

            //         //add message to alert
            //         $('#alert-jumlah').html(error.responseJSON.jumlah[0]);
            //     } 

            //     if(error.responseJSON.id_pelanggan[0]) {

            //         //show alert
            //         $('#alert-id_pelanggan').removeClass('d-none');
            //         $('#alert-id_pelanggan').addClass('d-block');

            //         //add message to alert
            //         $('#alert-id_pelanggan').html(error.responseJSON.id_pelanggan[0]);
            //     } 
        });

    });

</script>