@extends('layouts.app')
@section('content')
    <div class="row">
        <div class="container-fluid">
            <div class="py-3 col-9 ">
                <h5 class="font-weight-bold">Amr Task</h5>
                <div class="alert alert-primary alert-dismissible fade show" role="alert">
                    <strong>Buka todo list!</strong> Tulis yang ingin di kerjakan , bukan yang akan dikerjakan
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form action=" {{ route('task.store') }} " method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="">Kegiatan</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="kegiatan" required>
                            <span class="input-group-prepend">
                                <button class="btn btn-primary">
                                    Tambahkan
                                </button>
                            </span>
                        </div>
                    </div>
                </form>

                <table class="table table-hover table-bordered text-center">
                    <tr>
                        <th>No</th>
                        <th>Kegiatan</th>
                        <th> <i class="fa fa-flag text-primary"></i> </th>
                        <th><i class="fa fa-check text-success"></i></th>
                        {{-- <th><i class="fa fa-clock-o text-success"></i></th> --}}
                        <th> <i class="fa fa-edit"></i> </th>
                        <th> <i class="fa fa-trash text-danger"></i> </th>
                    </tr>
                    @foreach ($in_kegiatan as $kegiatan)
                        <tr>
                            <td width="1"> {{ $loop->iteration }} </td>
                            <td> {{ $kegiatan->kegiatan }} </td>
                            <td width="150"> {{ $kegiatan->created_at->format('d-M-y') }} </td>
                            <td width=150>
                                @if ($kegiatan->selesai != null)
                                    {{ date('d-M-y', $kegiatan->selesai) }}
                                @else

                                    <form action=" {{ route('task.update', $kegiatan->kd_task_todo) }} " method="POST">
                                        @csrf
                                        {{ method_field('PUT') }}
                                        <button class="btn btn-success btn-sm btn-block"
                                            onclick="return confirm('Sudahi ?')">
                                            <i class="fa fa-check"></i>
                                        </button>
                                    </form>

                                @endif
                            </td>
                            {{-- <td> --}}
                                {{-- @if ($kegiatan->selesai != null)
                                    @php
                                        $datetime1 = new DateTime($kegiatan->created_at->format('d-M-y h:i'));
                                        $datetime2 = new DateTime(date('Y-m-d h:i:s', $kegiatan->selesai));
                                        $interval = $datetime1->diff($datetime2);
                                        // %a hari
                                        $elapsed = $interval->format(' %h j %i m');
                                        echo $elapsed;
                                    @endphp
                                @else
                                    <span class="spinner-spin text-primary"></span>

                                @endif --}}
                            {{-- </td> --}}
                            <td width="1">
                                <button class="btn btn-secondary btn-sm" data-toggle="modal"
                                    data-target="#modal{{ $kegiatan->kd_task_todo }}">
                                    <i class="fa fa-edit"></i>
                                </button>
                            </td>
                            <td width="1">
                                <form action=" {{ route('task.destroy', $kegiatan->kd_task_todo) }} " method="POST">
                                    @csrf
                                    {{ method_field('DELETE') }}
                                    <button class="btn btn-danger btn-sm btn-block" onclick="return confirm('Hapus ?')">
                                        <i class="fa fa-trash"></i>
                                    </button>
                                </form>
                            </td>

                        </tr>

                        <div class="modal fade" tabindex="-1" id="modal{{ $kegiatan->kd_task_todo }}">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <form action=" {{ route('task.update', $kegiatan->kd_task_todo) }} " method="POST">
                                            @csrf
                                            {{ method_field('PUT') }}
                                            <div class="form-group">
                                                <label for="">Kegiatan</label>
                                                <input type="text" class="form-control" name="ubah_kegiatan"
                                                    value="{{ $kegiatan->kegiatan }}">
                                            </div>
                                            <button class="btn btn-primary  btn-block" type="submit">
                                                Simpan
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </table>
            </div>
        </div>
        <div class="  offset-sm-9  fixed-top center text-center bg-primary text-white ">
            <div class="">
                <h1 class="font-weight-bold">
                    <i class="fa fa-calendar"></i>
                    {{ date('D m Y') }}
                </h1>
                <h4>
                    <i class="fa fa-clock-o"></i>
                    <span id="txt"></span>
                </h4>
            </div>
        </div>
    </div>

    <script>
        function startTime() {
            var today = new Date();
            var h = today.getHours();
            var m = today.getMinutes();
            var s = today.getSeconds();
            m = checkTime(m);
            s = checkTime(s);
            document.getElementById('txt').innerHTML =
                // h + ":" + m + ":" + s;
                h + ":" + m;
            var t = setTimeout(startTime, 500);
        }

        function checkTime(i) {
            if (i < 10) {
                i = "0" + i
            }; // add zero in front of numbers < 10
            return i;
        }

    </script>
@endsection
