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
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#addPaketModal">Add Paket</button>
            </div>
            </div>
            <div class="row" style="clear: both;margin-top: 18px;">
                <div class="col-12">
                <table class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($pakets as $paket)
                        <tr id="paket_{{$paket->id}}">
                            <td>{{ $paket->id  }}</td>
                            <td>{{ $paket->name }}</td>
                            <td>
                                <a data-id="{{ $paket->id }}" onclick="editPaket(event.target)" class="btn btn-info">Edit</a>
                                <a class="btn btn-danger" onclick="deletePaket({{ $paket->id }})">Delete</a>
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
<div class="modal fade" id="addPaketModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Add Paket</h4>
        </div>
        <div class="modal-body">

                <div class="form-group">
                    <label for="name" class="col-sm-2">Task</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="name" name="paket" placeholder="Enter name">
                        <span id="nameError" class="alert-message"></span>
                    </div>
                </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="addPaket()">Save</button>
        </div>
    </div>
  </div>
  
</div>
<div class="modal fade" id="editPaketModal" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
        <div class="modal-header">
            <h4 class="modal-title">Edit Paket</h4>
        </div>
        <div class="modal-body">

               <input type="hidden" name="paket_id" id="paket_id">
                <div class="form-group">
                    <label for="name" class="col-sm-2">Task</label>
                    <div class="col-sm-12">
                        <input type="text" class="form-control" id="editname" name="paket" placeholder="Enter name">
                        <span id="nameError" class="alert-message"></span>
                    </div>
                </div>

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" onclick="updatePaket()">Save</button>
        </div>
    </div>
  </div>
<script>

    function addPaket() {
        var name = $('#name').val();
        let _url     = `/pakets/create`;
        let _token   = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: _url,
            type: "POST",
            data: {
                name: name,
                _token: _token
            },
            success: function(data) {
                    paket = data
                    $('table tbody').append(`
                        <tr id="paket_${paket.id}">
                            <td>${paket.id}</td>
                            <td>${ paket.name }</td>
                            <td>
                                <a data-id="${ paket.id }" onclick="editPaket(${paket.id})" class="btn btn-info">Edit</a>
                                <a data-id="${paket.id}" class="btn btn-danger" onclick="deletePaket(${paket.id})">Delete</a>
                            </td>
                        </tr>
                    `);

                    $('#name').val('');

                    $('#addPaketModal').modal('hide');
            },
            error: function(response) {
                $('#nameError').text(response.responseJSON.errors.paket);
            }
        });
    }

    function deletePaket(id) {
        let url = `/pakets/${id}`;
        let token   = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: url,
            type: 'DELETE',
            data: {
            _token: token
            },
            success: function(response) {
                $("#paket_"+id).remove();
            }
        });
    }

    function editPaket(e) {
        var id  = $(e).data("id");
        var paket  = $("#paket_"+id+" td:nth-child(2)").html();
        $("#paket_id").val(id);
        $("#editname").val(paket);
        $('#editPaketModal').modal('show');x
    }

    function updatePaket() {
        var name = $('#editname').val();
        var id = $('#paket_id').val();
        let _url     = `/pakets/${id}`;
        let _token   = $('meta[name="csrf-token"]').attr('content');

        $.ajax({
            url: _url,
            type: "PUT",
            data: {
                name: name,
                _token: _token
            },
            success: function(data) {
                    paket = data
                    $("#paket_"+id+" td:nth-child(2)").html(paket.name);
                    $('#paket_id').val('');
                    $('#editname').val('');
                    $('#editPaketModal').modal('hide');
            },
            error: function(response) {
                $('#nameError').text(response.responseJSON.errors.paket);
            }
        });
    }

</script>
@endsection
