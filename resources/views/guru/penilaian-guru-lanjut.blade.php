@extends('layouts.guru')
@section('content')
<section class="section">
	<div class="card">
		<div class="row">
			<div class="col-2 col-md-4 col-lg-12">
				<div class="card-header">
					<h4>Penilaian Guru</h4>
				</div>
				<form id="nilai" action="/guru/penilaian-guru-lanjut" method="POST" enctype="multipart/form-data">
					@csrf
					<div class="card-body">
						@php
			              $guru = \App\Jadwal::find(Auth::user()->jadwal_id);
			            @endphp

						<input type="hidden" name="target" value="{{$guru->user_id}}">
						<table class="table table-bordered">
						  <thead>
						    <tr>
						      <th scope="col">#</th>
						      <th scope="col">Pertanyaan - Bobot (1 sangat buruk - 10 sangat baik)</th>
						    </tr>
						  </thead>
						  <tbody>
						@foreach($pertanyaan as $key => $pertanyaans)

						<!-- <div class="form-group"> -->
							@php
								$nama = \App\User::find($guru->user_id);

								if($guru->user_id != Auth::user()->id){
									$replace = str_replace(" A ", " ".$nama->name." ", $pertanyaans->pertanyaan);
								}else{
									$replace = str_replace(" A ", " ".Auth::user()->name." ", $pertanyaans->pertanyaan);
								}
							@endphp
							<!-- <label>{{$replace}}</label> -->
							<input type="hidden" name="pertanyaanid[]" value="1">
						<!-- </div> -->

						    <tr>
						      <th scope="row">{{ $loop->iteration }}</th>
						      <td colspan="2">{{$replace}}</td>
						    </tr>
						    <tr>
						      <th scope="row">Bobot</th>
						      <td colspan="2">
						      	<select class="form-control" name="pertanyaan[{{$pertanyaans->id}}]">
						      		<option value="5">1</option>
						      		<option value="2">2</option>
						      		<option value="3">3</option>
						      		<option value="4">4</option>
						      		<option value="5">5</option>
						      		<option value="6">6</option>
						      		<option value="7">7</option>
						      		<option value="8">8</option>
						      		<option value="9">9</option>
						      		<option value="10">10</option>
						      	</select>
						      	<!-- <div class="selectgroup w-100">
								<label class="selectgroup-item">
									<input type="radio" name="pertanyaan[{{$pertanyaans->id}}]" value="5" class="selectgroup-input" checked>
									<span class="selectgroup-button">1</span>
								</label>
								<label class="selectgroup-item">
									<input type="radio" name="pertanyaan[{{$pertanyaans->id}}]" value="2" class="selectgroup-input">
									<span class="selectgroup-button">2</span>
								</label>
								<label class="selectgroup-item">
									<input type="radio" name="pertanyaan[{{$pertanyaans->id}}]" value="3" class="selectgroup-input">
									<span class="selectgroup-button">3</span>
								</label>
								<label class="selectgroup-item">
									<input type="radio" name="pertanyaan[{{$pertanyaans->id}}]" value="4" class="selectgroup-input">
									<span class="selectgroup-button">4</span>
								</label>
								<label class="selectgroup-item">
									<input type="radio" name="pertanyaan[{{$pertanyaans->id}}]" value="5" class="selectgroup-input">
									<span class="selectgroup-button">5</span>
								</label>
								<label class="selectgroup-item">
									<input type="radio" name="pertanyaan[{{$pertanyaans->id}}]" value="6" class="selectgroup-input">
									<span class="selectgroup-button">6</span>
								</label>
								<label class="selectgroup-item">
									<input type="radio" name="pertanyaan[{{$pertanyaans->id}}]" value="7" class="selectgroup-input">
									<span class="selectgroup-button">7</span>
								</label>
								<label class="selectgroup-item">
									<input type="radio" name="pertanyaan[{{$pertanyaans->id}}]" value="8" class="selectgroup-input">
									<span class="selectgroup-button">8</span>
								</label>
								<label class="selectgroup-item">
									<input type="radio" name="pertanyaan[{{$pertanyaans->id}}]" value="9" class="selectgroup-input">
									<span class="selectgroup-button">9</span>
								</label>
								<label class="selectgroup-item">
									<input type="radio" name="pertanyaan[{{$pertanyaans->id}}]" value="10" class="selectgroup-input">
									<span class="selectgroup-button">10</span>
								</label>
							</div> -->
						      </td>
						    </tr>
						  @endforeach
						  </tbody>
						</table>

						<!-- <div class="form-group">
							<label class="form-label">Bobot (1 sangat buruk - 10 sangat baik)</label>
						
						</div> -->
						<button type="submit" class="btn btn-primary" onclick="nilai()"><i class="fa fa-add">Submit</i></button>
					</div>
				</form>

				<!-- <div class="form-row"> -->
					<!-- <div class="form-group"> -->
						
					<!-- </div> -->
				<!-- </div> -->
			</div>
		</div>
	</div>
</section>
@endsection
@section('js')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
	function nilai()
	{
		swal({
			title: "Apakah sudah yakin untuk menilai?",
			text: "Data yang terkirim akan masuk ke dalam penilaian!",
			icon: "warning",
			buttons: true,
			dangerMode: true,
		})
		.then((willDelete) => {
		if (willDelete) {
			$('#nilai').submit();
		}else{
			swal("Data anda berhasil di cancel", "Silakan klik tombol ok!", "error");
		}
		});
	}
</script>
@endsection
