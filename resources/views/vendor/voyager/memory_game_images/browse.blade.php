@extends('voyager::master')

@section('content')
<div class="page-content browse container-fluid">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-bordered">
                <div class="panel-heading">
                    <h3 class="panel-title">Memory Game Image List</h3>
                    <div class="panel-actions">
                        <a href="{{ route('voyager.memory_game_images.create') }}" class="btn btn-success">➕ Add New</a>
                    </div>
                </div>

                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Media</th>
                                <th>Product name</th>
                                <th>Created At</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dataTypeContent as $data)
                            <tr>
                                <td>{{ $data->id }}</td>
                                <td>
                                    @php $ext = pathinfo($data->image_url, PATHINFO_EXTENSION); @endphp
                                    @if (in_array($ext, ['mp4', 'mov', 'webm']))
                                        <video src="{{ $data->image_url }}" controls style="max-width: 100px;"></video>
                                    @elseif($data->image_url)
                                        <img src="{{ $data->image_url }}" style="max-width: 100px;">
                                    @else
                                        No Media
                                    @endif
                                </td>
                                <td>{{ $data->product_name }}</td>
                                <td>{{ $data->created_at }}</td>
                                <td>
                                    <a href="{{ route('voyager.memory_game_images.edit', $data->id) }}" class="btn btn-sm btn-primary">✏️</a>
                                    <form action="{{ route('voyager.memory_game_images.destroy', $data->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">🗑</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @if (method_exists($dataTypeContent, 'links'))
                        <div class="d-flex justify-content-center">
                            <nav>
                                <ul class="pagination">
                                    {{-- Previous --}}
                                    @if ($dataTypeContent->onFirstPage())
                                        <li class="page-item disabled"><span class="page-link">« Previous</span></li>
                                    @else
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $dataTypeContent->previousPageUrl() }}" rel="prev">« Previous</a>
                                        </li>
                                    @endif

                                    {{-- Page Numbers --}}
                                    @foreach ($dataTypeContent->getUrlRange(1, $dataTypeContent->lastPage()) as $page => $url)
                                        <li class="page-item {{ $page == $dataTypeContent->currentPage() ? 'active' : '' }}">
                                            <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                        </li>
                                    @endforeach

                                    {{-- Next --}}
                                    @if ($dataTypeContent->hasMorePages())
                                        <li class="page-item">
                                            <a class="page-link" href="{{ $dataTypeContent->nextPageUrl() }}" rel="next">Next »</a>
                                        </li>
                                    @else
                                        <li class="page-item disabled"><span class="page-link">Next »</span></li>
                                    @endif
                                </ul>
                            </nav>
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
