@extends('layouts.kepsek')
@section('content')
<section class="section">
          <div class="row">
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="card card-statistic-2">
                <div class="card-stats">
                  <div class="card-stats-items">
                  </div>
                </div>
                <div class="card-icon shadow-primary bg-primary">
                  <i class="fas fa-user"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Guru Dan Kaprok</h4>
                  </div>
                  <div class="card-body">
                    <?php  
                        $total_guru = \App\User::where('role',3)->count();
                     ?>
                    {{$total_guru}}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="card card-statistic-2">
                <div class="card-stats">
                  <div class="card-stats-items">
                  </div>
                </div>
                <div class="card-icon shadow-primary bg-primary">
                  <i class="fas fa-user-circle"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Karyawan</h4>
                  </div>
                  <div class="card-body">
                    <?php  
                        $total_karyawan = \App\User::where('role',4)->count();
                     ?>
                    {{$total_karyawan}}
                  </div>
                </div>
              </div>
            </div>
            <div class="col-lg-4 col-md-4 col-sm-12">
              <div class="card card-statistic-2">
                <div class="card-stats">
                  <div class="card-stats-items">
                  </div>
                </div>
                <div class="card-icon shadow-primary bg-primary">
                  <i class="fas fa-user-circle"></i>
                </div>
                <div class="card-wrap">
                  <div class="card-header">
                    <h4>Total Bobot Jadwal Sekarang</h4>
                  </div>
                  <div class="card-body">
                    @php  
                      $bobot = \App\PenilaianGuru::where('target', $jadwal_guru->user_id)->sum('bobot');
                    @endphp
                    {{$bobot}}
                  </div>
                </div>
              </div>
            </div>
            <div class="table-responsive">
              <table id="example" class="display nowrap" style="width:100%">
                <thead>
                  <tr>
                    <th>No</th>
                    <th>Target</th>
                    <th>Tanggal</th>
                  </tr>
                </thead>
                <tbody>
                  @foreach($penilaians_guru as $penilaian)
                  @php
                    $jadwal = \App\Jadwal::find($penilaian->jadwal_id);
                    $target = \App\User::find($jadwal->user_id);
                    $penilai_1 = \App\User::find($jadwal->penilai_1);
                    $penilai_2 = \App\User::find($jadwal->penilai_2);
                    $penilai_3 = \App\User::find($jadwal->penilai_3);
                    $penilai_4 = \App\User::find($jadwal->penilai_4);
                    $penilai_5 = \App\User::find($jadwal->penilai_5);
                    $bobot1 = \App\PenilaianGuru::where('target', $penilaian->target)->sum('bobot');
                  @endphp
                  <tr>
                    @if($penilai_1->role == 3)
                    <td>{{$loop->iteration}}</td>
                    <td>
                      @if(!empty($target->name))
                        <a href="" data-toggle="modal" data-target="#exampleModal">{{$target->name}}</a>
                      @endif
                    </td>
                    <td>{{$penilaian->tanggal}}</td>
                    @else
                    @endif
                  </tr>
                  @endforeach
                </tbody>
              </table>
              
            </div>
          </div>
        </section>
        @if(!empty($target->name))
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog" role="document">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detail Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                Target &ensp;&ensp;&ensp;&ensp;: {{$target->name}}<br>
                Total Bobot: {{$bobot1}}<br>
                Penilai &ensp;&ensp;&ensp;&ensp;: - {{$penilai_1->name}} <br>
                &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp; - {{$penilai_2->name}} <br>
                &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp; - {{$penilai_3->name}} <br>
                &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp; - {{$penilai_4->name}} <br>
                &ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp;&ensp; - {{$penilai_5->name}} <br>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
              </div>
            </div>
          </div>
        </div>
        @endif
@endsection
@section('css')
<!-- CSS Libraries -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/buttons/1.7.0/css/buttons.dataTables.min.css">
@endsection
@section('js')
<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/dataTables.buttons.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.html5.min.js"></script>
<script src="https://cdn.datatables.net/buttons/1.7.0/js/buttons.print.min.js"></script>
<script type="text/javascript">
$(document).ready(function() {
  $('#example').DataTable( {
  dom: 'Bfrtip',
  buttons: [
  'copy', 'csv', 'excel', 'pdf', 'print'
  ]
  } );
} );
</script>
@endsection