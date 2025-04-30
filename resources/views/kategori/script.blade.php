<script>
    $(function() {
        // DataTable setup
        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('kategori.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'kategori_buku', name: 'kategori_buku' },
                { data: 'action', name: 'action' }
            ]
        });

        // Detail modal
        $('#datatable').on('click', '.kategori-detail', function() {
            let id = $(this).data('id');
            let url = "{{ route('api.kategori.show', ':id') }}".replace(':id', id);

            $('#showKategoriModal input').val('Memuat...');

            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    let data = response.data;
                    $('#showKategoriModal #show_kategori').val(data.kategori_buku);
                    $('#showKategoriModal').modal('show');
                },
                error: function() {
                    alert('Gagal mengambil data detail kategori.');
                }
            });
        });

        // Edit modal
        $('#datatable').on('click', '.kategori-edit', function() {
            let id = $(this).data('id');
            let url = "{{ route('api.kategori.edit', ':id') }}".replace(':id', id);
            let formActionURL = "{{ route('kategori.update', ':id') }}".replace(':id', id);

            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    let data = response.data;

                    $('#editKategoriModal #edit-kategori-form').attr('action', formActionURL);
                    $('#editKategoriModal #edit_kategori').val(data.kategori_buku);
                    $('#editKategoriModal input').prop('disabled', false);
                    $('#editKategoriModal').modal('show');
                },
                error: function() {
                    alert('Gagal mengambil data kategori untuk edit.');
                }
            });
        });
    });
</script>
