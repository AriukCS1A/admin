@extends('voyager::master')

@section('content')
<div class="page-content browse container-fluid">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-bordered">
                <div class="panel-heading">
                    <h3 class="panel-title">Babydev List</h3>
                    <div class="panel-actions">
                        <a href="{{ route('voyager.babydev.create') }}" class="btn btn-success">➕ Add New</a>
                    </div>
                </div>

                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Media</th>
                                <th>Name</th>
                                <th>Month</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dataTypeContent as $data)
                            <tr>
                                <td>{{ $data->id }}</td>
                                <td>
                                    @php $ext = pathinfo($data->pic, PATHINFO_EXTENSION); @endphp
                                    @if (in_array($ext, ['mp4', 'mov', 'webm']))
                                        <video src="{{ $data->pic }}" controls style="max-width: 100px;"></video>
                                    @elseif($data->pic)
                                        <img src="{{ $data->pic }}" style="max-width: 100px;">
                                    @else
                                        No Media
                                    @endif
                                </td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->month }}</td>
                                <td>
                                    <a href="{{ route('voyager.babydev.edit', $data->id) }}" class="btn btn-sm btn-primary">✏️</a>
                                    <form action="{{ route('voyager.babydev.destroy', $data->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">🗑</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    <div class="text-center">
                        {{ method_exists($dataTypeContent, 'links') ? $dataTypeContent->links() : '' }}
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
