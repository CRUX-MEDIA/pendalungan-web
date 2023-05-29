@component('layouts.app')
    @slot('title')
        Penyewaan - Pendalungan Megah Solusi
    @endslot

    @section('title')
        Penyewaan
    @endsection

    @section('breadcrumb')
        @parent
        <li class="breadcrumb-item">Penyewaan</li>
    @endsection

    @section('content')
        <div class="row">
            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row g-3">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="exampleFormControlReadonly">No Invoice</label>
                                    <input class="form-control" type="text" placeholder="Readonly input here..." id="noinv" readonly>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="form-group" id="simple-date1">
                                    <label for="simpleDataInput">Tanggal Penyewaan</label>
                                        <div class="input-group date">
                                        <div class="input-group-prepend">
                                            <span class="input-group-text"><i class="fas fa-calendar"></i></span>
                                        </div>
                                        <input type="text" class="form-control" id="simpleDataInput">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="form-group">
                                    <label for="clockPicker2">Waktu Penyewaan</label>
                                    <div class="input-group clockpicker" id="clockPicker2">
                                        <input type="text" class="form-control" value="12:30">                     
                                    <div class="input-group-append">
                                        <span class="input-group-text"><i class="fas fa-clock"></i></span>
                                    </div>                      
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row g-4">
                            <div class="col-sm">
                                <div class="form-group">
                                    <label for="nama_barang">Nama Barang</label>
                                    <select class="form-control" id="nama_barang" autofocus required>
                                        <option value="">Pilih Barang</option>
                                        @foreach ($barang as $data)
                                        <option value="{{ $data->id_barang }}">{{ $data->nama_barang }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="form-group">
                                    <label for="touchSpin1">QTY</label>
                                    <input id="touchSpin1" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="form-group">
                                    <label for="touchSpin2">Durasi</label>
                                    <input id="touchSpin2" type="text" class="form-control">
                                </div>
                            </div>
                            <div class="col-sm">
                                <div class="form-group">
                                    <label for="subtotal">Sub Total</label>
                                    <input type="number" class="form-control" id="subtotal" placeholder="Rp. 150.000" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-12">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="table-responsive p-3">
                            <table class="table align-items-center table-flush" id="table">
                                <thead class="thead-light">
                                <tr>
                                    <th>No</th>
                                    <th>Nama Barang</th>
                                    <th>Harga Barang</th>
                                    <th>QTY</th>
                                    <th>Durasi</th>
                                    <th>Sub Total</th>
                                    <th>Aksi</th>
                                </tr>
                                </thead>
                                <tbody></tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-8">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="row g-2">
                            <div class="col-sm">
                                <div class="form-group">
                                    <label for="penyewa">Nama Penyewa</label>
                                    <select class="form-control" id="penyewa" required>
                                        <option value="">Pilih Penyewa</option>
                                        @foreach ($penyewa as $data)
                                            <option value="{{ $data->id }}">{{ $data->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="jaminan">Jaminan</label>
                                    <select class="form-control" id="jaminan" required>
                                        <option value="">Pilih Jaminan</option>
                                        @foreach ($jaminan as $data)
                                        <option value="{{ $data->id_jaminan }}">{{ $data->nama_jaminan }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="nohp">No Hp</label>
                                    <input type="number" class="form-control" id="nohp" placeholder="089505016100" readonly>
                                </div>
                            </div>
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <label for="alamat">Alamat</label>
                                    <input type="text" class="form-control" id="alamat" placeholder="Jl. Mastrip No.1" readonly>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card mb-4">
                    <div class="card-body">
                        <div class="col-sm">
                            <div class="form-group">
                                <label for="pajak">Pajak</label>
                                <input type="number" class="form-control" id="pajak" placeholder="Rp. 150.000" readonly>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="form-group">
                                <label for="total">Total</label>
                                <input type="number" class="form-control" id="total" placeholder="Rp. 150.000" readonly>
                            </div>
                        </div>
                        <div class="col-sm">
                            <div class="form-group">
                                <label for="dibayar">Dibayar</label>
                                <input type="number" class="form-control" id="dibayar" placeholder="Rp. 150.000" required>
                            </div>
                        </div>
                        <div class="col-lg-12 mb-3 text-right">
                            <a href="javascript:void(0)" class="btn btn-primary" onclick="addForm()"><i class="fa fa-plus-circle"></i> Simpan</a>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    {{-- @include('barang.form') --}}
    @endsection

    @section('script')
        <script>
            $(document).ready(function () {
                $('#simple-date1 .input-group.date').datepicker({
                    format: 'dd/mm/yyyy',
                    todayBtn: 'linked',
                    todayHighlight: true,
                    autoclose: true,        
                });
                $('#clockPicker2').clockpicker({
                    autoclose: true
                });
                $('#touchSpin1').TouchSpin({
                    min: 0,
                    max: 100,                
                    boostat: 5,
                    maxboostedstep: 10,        
                    initval: 0
                });
                $('#touchSpin2').TouchSpin({
                    min: 0,
                    max: 100,                
                    boostat: 5,
                    maxboostedstep: 10,        
                    initval: 0
                });
                //when penyewa onchange, fill input nohp and alamat automation
                
            });
        </script>
    @endsection
@endcomponent