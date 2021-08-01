
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
