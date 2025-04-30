<script>
    $(function() {
        $(document).ready(function() {
            $('#datatable').DataTable({
                processing: true,
                serverSide: true,
                ajax: "{{ route('peminjaman.index') }}",
                columns: [{
                        data: 'DT_RowIndex',
                        name: 'DT_RowIndex'
                    },
                    {
                        data: 'id_pinjam',
                        name: 'id_pinjam'
                    },
                    {
                        data: 'lama_pinjam',
                        name: 'lama_pinjam'
                    },
                    {
                        data: 'nominal_denda',
                        name: 'nominal_denda'
                    },

                    {
                        data: 'action',
                        name: 'action'
                    }
                ]
            });
        });


        // Detail modal
        $('#datatable').on('click', '.peminjaman-detail', function() {
            let id = $(this).data('id');
            let url = "{{ route('api.peminjaman.show', ':id') }}".replace(':id', id);

            $('#showPeminjamanModal input').val('Memuat...'); // Temporary loading text

            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    let data = response.data;

                    // Update the fields with data
                    $('#showPeminjamanModal #show_id_pinjam').val(data.id_pinjam);
                    $('#showPeminjamanModal #show_lama_pinjam').val(data.lama_pinjam);
                    $('#showPeminjamanModal #show_nominal_denda').val(data.nominal_denda);
                    $('#showPeminjamanModal #show_nama_anggota').val(data
                    .anggota_nama); // Assuming 'anggota_nama' is the correct field
                    $('#showPeminjamanModal #show_denda').val(data
                    .denda_jenis); // Assuming 'denda_jenis' is the correct field
                    $('#showPeminjamanModal #show_user').val(data
                    .user_nama); // Assuming 'user_nama' is the correct field

                    // Show modal
                    $('#showPeminjamanModal').modal('show');
                },
                error: function() {
                    alert('Gagal mengambil data detail peminjaman.');
                }
            });
        });

        // Edit modal
        $('#datatable').on('click', '.peminjaman-edit', function() {
            let id = $(this).data('id');
            let url = "{{ route('api.peminjaman.edit', ':id') }}".replace(':id', id);
            let formActionURL = "{{ route('peminjaman.update', ':id') }}".replace(':id', id);

            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    let data = response.data;

                    $('#editPeminjamanModal #edit-peminjaman-form').attr('action',
                        formActionURL);

                    $('#editPeminjamanModal #edit_id_pinjam').val(data.id_pinjam);
                    $('#editPeminjamanModal #edit_lama_pinjam').val(data.lama_pinjam);
                    $('#editPeminjamanModal #edit_nominal_denda').val(data.nominal_denda);
                    $('#editPeminjamanModal #edit_id_anggota').val(data.id_anggota);
                    $('#editPeminjamanModal #edit_id_denda').val(data.id_denda);

                    // Enable form fields and show the modal
                    $('#editPeminjamanModal input, #editPeminjamanModal select').prop(
                        'disabled', false);
                    $('#editPeminjamanModal').modal('show');
                },
                error: function() {
                    alert('Gagal mengambil data peminjaman untuk edit.');
                }
            });
        });
    });
</script>
