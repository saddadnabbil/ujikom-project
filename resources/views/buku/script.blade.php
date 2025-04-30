<script>
    $(function() {
        // DataTable setup
        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('buku.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'judul', name: 'judul' },
                { data: 'pengarang', name: 'pengarang' },
                { data: 'penerbit', name: 'penerbit' },
                { data: 'tahun', name: 'tahun' },
                { data: 'isbn', name: 'isbn' },
                { data: 'action', name: 'action' }
            ]
        });

        // Detail modal
        $('#datatable').on('click', '.buku-detail', function() {
            let id = $(this).data('id');
            let url = "{{ route('api.buku.show', ':id') }}".replace(':id', id);

            $('#showProductModal input').val('Memuat...');

            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    let data = response.data;
                    $('#showProductModal #show_buku_judul').val(data.judul);
                    $('#showProductModal #show_buku_pengarang').val(data.pengarang);
                    $('#showProductModal #show_buku_penerbit').val(data.penerbit);
                    $('#showProductModal #show_buku_tahun').val(data.tahun);
                    $('#showProductModal #show_buku_isbn').val(data.isbn);
                    $('#showProductModal #show_buku_tgl_input').val(data.tgl_input);
                    $('#showProductModal #show_buku_jml_halaman').val(data.jml_halaman);
                    $('#showProductModal #show_buku_kategori').val(data.kategori);
                    $('#showProductModal').modal('show');
                },
                error: function() {
                    alert('Gagal mengambil data detail buku.');
                }
            });
        });

        // Edit modal
        $('#datatable').on('click', '.buku-edit', function() {
            let id = $(this).data('id');
            let url = "{{ route('api.buku.edit', ':id') }}".replace(':id', id);
            let formActionURL = "{{ route('buku.update', ':id') }}".replace(':id', id);

            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    let data = response.data;

                    $('#editProductModal #edit-buku-form').attr('action', formActionURL);
                    $('#editProductModal #edit_buku_judul').val(data.judul);
                    $('#editProductModal #edit_buku_pengarang').val(data.pengarang);
                    $('#editProductModal #edit_buku_penerbit').val(data.penerbit);
                    $('#editProductModal #edit_buku_tahun').val(data.tahun);
                    $('#editProductModal #edit_buku_isbn').val(data.isbn);
                    $('#editProductModal #edit_buku_tgl_input').val(data.tgl_input);
                    $('#editProductModal #edit_buku_jml_halaman').val(data.jml_halaman);
                    $('#editProductModal #edit_buku_id_kategori').val(data.id_kategori);
                    $('#editProductModal input').prop('disabled', false);
                    $('#editProductModal').modal('show');
                },
                error: function() {
                    alert('Gagal mengambil data buku untuk edit.');
                }
            });
        });
    });
</script>
