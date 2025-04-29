<div class="modal fade" id="editCustomerModal" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Ubah Data Customer</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form action="#" method="POST" id="edit-customer-form">
					@csrf
					@method('PUT')
					<div class="row">
						<div class="col-sm-12 col-md-6">
							<div class="mb-3">
								<label for="edit_nama_customer" class="form-label">Nama Customer</label>
								<input type="text" class="form-control" name="nama_customer" id="edit_nama_customer"
									placeholder="Masukkan nama customer..." required>
							</div>
						</div>

						<div class="col-sm-12 col-md-6">
							<div class="mb-3">
								<label for="edit_email" class="form-label">Email</label>
								<input type="email" class="form-control" name="email" id="edit_email"
									placeholder="Masukkan email customer..." required>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-12 col-md-6">
							<div class="mb-3">
								<label for="edit_no_telp" class="form-label">Nomor Telepon</label>
								<input type="text" class="form-control" name="no_telp" id="edit_no_telp"
									placeholder="Masukkan nomor telepon..." required>
							</div>
						</div>

						<div class="col-sm-12 col-md-6">
							<div class="mb-3">
								<label for="edit_alamat" class="form-label">Alamat</label>
								<textarea class="form-control" name="alamat" id="edit_alamat" rows="3"
									placeholder="Masukkan alamat customer..." required></textarea>
							</div>
						</div>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
						<button type="submit" class="btn btn-success">Simpan Perubahan</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
