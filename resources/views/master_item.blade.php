@extends('layouts.app')

@section('head')
<script src="{{ asset('js/app.js') }}" defer></script>
@endsection

@section('content')

<div class="container">
    <div class="card">
        <div class="card-body">
            <div class="row">
            <div class="col-12 text-right">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addItemModal">Add Item</button>
            </div>
            </div>
            <div class="row" style="clear: both;margin-top: 18px;">
                <div class="col-12" id="items">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>ID Paket</th>
                            <th>Paket</th>
                            <th>Unit</th>
                            <th>Hasil</th>
                            <th>Normal Value</th>
                            <th>Keterangan</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($items as $item)
                        <tr id="item_{{$item->id}}">
                            <td>{{ $item->id  }}</td>
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->paket  }}</td>
                            <td>{{ $pakets_ids[$item->paket] }}</td>
                            <td>{{ $item->unit }}</td>
                            <td>{{ $item->hasil }}</td>
                            <td>{{ $item->nilai_normal }}</td>
                            <td>{{ $item->keterangan }}</td>
                            <td>
                                <a data-id="{{ $item->id }}" onclick="editItem(event.target)" class="btn btn-info">Edit</a>
                                <a class="btn btn-danger" onclick="deleteItem({{ $item->id }})">Delete</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            </div>
        </div>
    </div>

</div>
<div class="modal fade" id="addItemModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Add Item</h4>
        </div>
        <div class="modal-body">

                <div class="form-group">
                    <label for="name" class="col-sm-12">Nama Item</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="name" name="item" placeholder="Enter name">
                        <span id="nameError" class="alert-message"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="name" class="col-sm-12">Paket</label>
                    <div class="col-sm-12">
                        <select class="form-control" name="paket" id="paket">
                        @foreach($pakets as $paket)
                            <option value="{{$paket->id}}">{{$paket->name}} </option>
                        @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="name" class="col-sm-12">Unit</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="unit" name="unit" placeholder="Enter unit">
                        <span id="nameError" class="alert-message"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="name" class="col-sm-12">Hasil</label>
                    <div class="col-sm-12">
                        <select class="form-control" name="hasil" id="hasil">
                            <option value='NEGATIF'>NEGATIF</option>
                            <option value='POSITIF'>POSITIF</option>
                        </select>

                    </div>
                </div>

                <div class="form-group">
                    <label for="name" class="col-sm-12">Nilai Normal</label>
                    <div class="col-sm-12">
                        <select class="form-control" name="nilai_normal" id="nilai_normal">
                            <option value='NEGATIF'>NEGATIF</option>
                            <option value='POSITIF'>POSITIF</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="name" class="col-sm-12">Keterangan</label>
                    <div class="col-sm-12">
                        <textarea type="text" class="form-control" id="keterangan" name="keterangan" placeholder="Enter keterangan"></textarea>
                        <span id="nameError" class="alert-message"></span>
                    </div>
                </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="addItem()">Save</button>
        </div>
    </div>
  </div>

</div>
<div class="modal fade" id="editItemModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Edit Item</h4>
        </div>
        <div class="modal-body">

               <input type="hidden" name="item_id" id="item_id">
                <div class="form-group">
                    <label for="name" class="col-sm-12">Nama item</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="editname" name="item" placeholder="Nama Paket">
                        <span id="nameError" class="alert-message"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="name" class="col-sm-12">Paket</label>
                    <div class="col-sm-12">
                        <select class="form-control" name="paket" id="editpaket">
                        @foreach($pakets as $paket)
                            <option value="{{$paket->id}}">{{$paket->name}} </option>
                        @endforeach
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="name" class="col-sm-12">Unit</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="editunit" name="unit" placeholder="Enter unit">
                        <span id="nameError" class="alert-message"></span>
                    </div>
                </div>

                <div class="form-group">
                    <label for="name" class="col-sm-12">Hasil</label>
                    <div class="col-sm-12">
                        <select class="form-control" name="hasil" id="edithasil">
                            <option value='NEGATIF'>NEGATIF</option>
                            <option value='POSITIF'>POSITIF</option>
                        </select>

                    </div>
                </div>

                <div class="form-group">
                    <label for="name" class="col-sm-12">Nilai Normal</label>
                    <div class="col-sm-12">
                        <select class="form-control" name="nilai_normal" id="editnilai_normal">
                            <option value='NEGATIF'>NEGATIF</option>
                            <option value='POSITIF'>POSITIF</option>
                        </select>
                    </div>
                </div>

                <div class="form-group">
                    <label for="name" class="col-sm-12">Keterangan</label>
                    <div class="col-sm-12">
                        <textarea type="text" class="form-control" id="editketerangan" name="keterangan" placeholder="Enter keterangan"></textarea>
                        <span id="nameError" class="alert-message"></span>
                    </div>
                </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="updateItem()">Save</button>
        </div>
    </div>
  </div>
<script>


    function addItem() {
        var name = $('#name').val();
        var paket = $('#paket').val();
        var unit = $('#unit').val();
        var hasil = $('#hasil').val();
        var nilai_normal = $('#nilai_normal').val();
        var keterangan = $('#keterangan').val();
        let _url     = `/items/create`;
        let _token   = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: _url,
            type: "POST",
            data: {
                name: name,
                unit : unit,
                paket : paket,
                hasil : hasil,
                nilai_normal : nilai_normal,
                keterangan:keterangan,
                _token: _token
            },
            success: function(data) {
                    item = data
                    $("#items").html('')
                    $("#items").html(item.list)

                    $('#name').val('');

                    $('#addItemModal').modal('hide');
            },
            error: function(response) {
                $('#nameError').text(response.responseJSON.errors.item);
            }
        });
    }

    function deleteItem(id) {
        let url = `/items/${id}`;
        let token   = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: url,
            type: 'DELETE',
            data: {
            _token: token
            },
            success: function(response) {
                $("#item_"+id).remove();
            }
        });
    }

    function editItem(e) {
        var id  = $(e).data("id");
        var item  = $("#item_"+id+" td:nth-child(2)").html();
        var paket  = $("#item_"+id+" td:nth-child(3)").html();
        var unit  = $("#item_"+id+" td:nth-child(5)").html();
        var hasil  = $("#item_"+id+" td:nth-child(6)").html();
        var nv  = $("#item_"+id+" td:nth-child(7)").html();
        var ket  = $("#item_"+id+" td:nth-child(8)").html();
        $("#item_id").val(id);
        $("#editname").val(item);
        $("#editpaket").val(paket);
        $("#editunit").val(unit);
        $("#edithasil").val(hasil);
        $("#editnilai_normal").val(nv);
        $("#editketerangan").val(ket);
        $('#editItemModal').modal('show');
    }

    function updateItem() {
        var name = $('#editname').val();
        var paket = $('#editpaket').val();
        var unit = $('#editunit').val();
        var hasil = $('#edithasil').val();
        var nilai_normal = $('#editnilai_normal').val();
        var keterangan = $('#editketerangan').val();
        var id = $('#item_id').val();
        let _url     = `/items/${id}`;
        let _token   = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: _url,
            type: "PUT",
            data: {
                name: name,
                unit : unit,
                paket : paket,
                hasil : hasil,
                nilai_normal : nilai_normal,
                keterangan:keterangan,
                _token: _token
            },
            success: function(data) {

                    item = data
                    $("#item_"+id+" td:nth-child(2)").html(item.name);
                    $('#item_id').val('');
                    $('#editname').val('');
                    $('#editItemModal').modal('hide');
                    $("#items").html('')
                    $("#items").html(item.list)
            },
            error: function(response) {
                $('#nameError').text(response.responseJSON.errors.item);
            }
        });




    }



</script>
@endsection
