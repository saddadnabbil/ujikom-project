<script>
    $(function() {
        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('produk.index.history') }}", // Pastikan ini adalah route yang benar
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex',
                    orderable: false,
                    searchable: false
                }, // Indeks baris
                {
                    data: 'nama_produk',
                    name: 'nama_produk'
                }, // Nama Produk
                {
                    data: 'price',
                    name: 'price'
                }, // Harga Produk (price)
                {
                    data: 'jenis',
                    name: 'jenis'
                }, // Jenis Produk (jenis)
                {
                    data: 'stock',
                    name: 'stock'
                }, // Stok Produk (stock)
                {
                    data: 'action',
                    name: 'action',
                    orderable: false,
                    searchable: false
                } // Tombol Aksi (seperti Pulihkan atau Hapus)
            ]
        });
    });
</script>
