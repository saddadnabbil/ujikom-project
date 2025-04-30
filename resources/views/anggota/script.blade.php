<script>
    $(function() {
        // DataTable setup
        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('anggota.index') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'id_anggota',
                    name: 'id_anggota'
                },
                {
                    data: 'nama',
                    name: 'nama'
                },
                {
                    data: 'alamat',
                    name: 'alamat'
                },
                {
                    data: 'jenis_kelamin',
                    name: 'jenis_kelamin'
                },
                {
                    data: 'no_telp',
                    name: 'no_telp'
                },
                {
                    data: 'tgl_lahir',
                    name: 'tgl_lahir'
                },
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                },
            ]
        });

        // Detail modal
        $('#datatable').on('click', '.anggota-detail', function() {
            let id = $(this).data('id');
            let url = "{{ route('api.anggota.show', ':id') }}".replace(':id', id);

            // Menampilkan status loading
            $('#showAnggotaModal input, #showAnggotaModal textarea').val('Memuat...');

            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    let data = response.data;

                    // Menampilkan data anggota ke dalam modal
                    $('#showAnggotaModal #show_id_anggota').val(data.id_anggota);
                    $('#showAnggotaModal #show_nama').val(data.nama);
                    $('#showAnggotaModal #show_alamat').val(data.alamat);
                    $('#showAnggotaModal #show_jenis_kelamin').val(data.jenis_kelamin ===
                        'L' ? 'Laki-laki' : 'Perempuan');
                    $('#showAnggotaModal #show_no_telp').val(data.no_telp);
                    $('#showAnggotaModal #show_tgl_lahir').val(data.tgl_lahir);

                    // Menampilkan modal
                    $('#showAnggotaModal').modal('show');
                },
                error: function() {
                    alert('Gagal mengambil data detail anggota.');
                }
            });
        });


        // Edit modal
        $('#datatable').on('click', '.anggota-edit', function() {
            let id = $(this).data('id');
            let url = "{{ route('api.anggota.edit', ':id') }}".replace(':id', id);
            let formActionURL = "{{ route('anggota.update', ':id') }}".replace(':id',
            id); // Pastikan route update sudah benar

            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    let data = response.data;

                    // Set form action URL dan data anggota ke form modal
                    $('#editAnggotaModal #edit-anggota-form').attr('action', formActionURL);
                    $('#editAnggotaModal #edit_id_anggota').val(data.id_anggota);
                    $('#editAnggotaModal #edit_nama').val(data.nama);
                    $('#editAnggotaModal #edit_alamat').val(data.alamat);
                    $('#editAnggotaModal #edit_jenis_kelamin').val(data.jenis_kelamin);
                    $('#editAnggotaModal #edit_no_telp').val(data.no_telp);
                    $('#editAnggotaModal #edit_tgl_lahir').val(data.tgl_lahir);

                    // Menampilkan modal edit
                    $('#editAnggotaModal').modal('show');
                },
                error: function() {
                    alert('Gagal mengambil data anggota untuk edit.');
                }
            });
        });

    });
</script>
