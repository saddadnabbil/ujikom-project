<div class="modal fade" id="addCustomerModal" data-bs-backdrop="static" data-bs-keyboard="false" aria-hidden="true">
	<div class="modal-dialog modal-lg">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title">Tambah Data Customer</h5>
				<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
			</div>
			<div class="modal-body">
				<form action="{{ route('customer.store') }}" method="POST">
					@csrf
					<div class="row">
						<div class="col-sm-12 col-md-6">
							<div class="mb-3">
								<label for="nama_customer" class="form-label">Nama Customer</label>
								<input type="text" class="form-control @error('nama_customer') is-invalid @enderror"
									name="nama_customer" id="nama_customer" value="{{ old('nama_customer') }}"
									placeholder="Masukkan nama customer..." required>
								@error('nama_customer')
								<div class="d-block invalid-feedback">
									{{ $message }}
								</div>
								@enderror
							</div>
						</div>

						<div class="col-sm-12 col-md-6">
							<div class="mb-3">
								<label for="email" class="form-label">Email</label>
								<input type="email" class="form-control @error('email') is-invalid @enderror" name="email"
									id="email" value="{{ old('email') }}" placeholder="Masukkan email customer..." required>
								@error('email')
								<div class="d-block invalid-feedback">
									{{ $message }}
								</div>
								@enderror
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-12 col-md-6">
							<div class="mb-3">
								<label for="no_telp" class="form-label">Nomor Telepon</label>
								<input type="text" class="form-control @error('no_telp') is-invalid @enderror" name="no_telp"
									id="no_telp" value="{{ old('no_telp') }}" placeholder="Masukkan nomor telepon..." required>
								@error('no_telp')
								<div class="d-block invalid-feedback">
									{{ $message }}
								</div>
								@enderror
							</div>
						</div>

						<div class="col-sm-12 col-md-6">
							<div class="mb-3">
								<label for="alamat" class="form-label">Alamat</label>
								<textarea class="form-control @error('alamat') is-invalid @enderror" name="alamat" id="alamat"
									rows="3" placeholder="Masukkan alamat customer..." required>{{ old('alamat') }}</textarea>
								@error('alamat')
								<div class="d-block invalid-feedback">
									{{ $message }}
								</div>
								@enderror
							</div>
						</div>
					</div>

					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
						<button type="submit" class="btn btn-primary">Simpan</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
