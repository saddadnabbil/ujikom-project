<script>
    $(function() {
        // DataTable setup
        $('#datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('denda.index') }}",
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex' },
                { data: 'nominal', name: 'nominal' },
                { data: 'action', name: 'action' }
            ]
        });

        // Detail modal
        $('#datatable').on('click', '.denda-detail', function() {
            let id = $(this).data('id');
            let url = "{{ route('api.denda.show', ':id') }}".replace(':id', id);

            $('#showDendaModal input').val('Memuat...');

            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    let data = response.data;
                    $('#showDendaModal #show_nominal').val(data.nominal);
                    $('#showDendaModal').modal('show');
                },
                error: function() {
                    alert('Gagal mengambil data detail denda.');
                }
            });
        });

        // Edit modal
        $('#datatable').on('click', '.denda-edit', function() {
            let id = $(this).data('id');
            let url = "{{ route('api.denda.edit', ':id') }}".replace(':id', id);
            let formActionURL = "{{ route('denda.update', ':id') }}".replace(':id', id);

            $.ajax({
                url: url,
                type: 'GET',
                success: function(response) {
                    let data = response.data;

                    $('#editDendaModal #edit-denda-form').attr('action', formActionURL);
                    $('#editDendaModal #edit_nominal').val(data.nominal);
                    $('#editDendaModal input').prop('disabled', false);
                    $('#editDendaModal').modal('show');
                },
                error: function() {
                    alert('Gagal mengambil data denda untuk edit.');
                }
            });
        });
    });
</script>
