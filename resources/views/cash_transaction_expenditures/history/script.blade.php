<script>
	$(function () {
		$('#datatable').DataTable({
			processing: true,
			serverSide: true,
			ajax: "{{ route('cash-transaction-expenditures.index.history') }}",
			columns: [
				{ data: 'DT_RowIndex', name: 'DT_RowIndex' },
				{ data: 'note', name: 'note' },
				{ data: 'expenditure', name: 'expenditure' },
				{ data: 'date', name: 'date' },
				{ data: 'action', name: 'action' },
			]
		});
	});
</script>
