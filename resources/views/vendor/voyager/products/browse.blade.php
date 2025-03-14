@extends('voyager::master')

@section('content')
<div class="page-content browse container-fluid">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-bordered">
                <div class="panel-heading d-flex justify-content-between align-items-center">
                    <h3 class="panel-title">Product List</h3>
                    <a href="{{ route('voyager.products.create') }}" class="btn btn-success">➕ Add New</a>
                </div>

                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Media</th>
                                <th>Name</th>
                                <th>Barcode</th>
                                <th>Description</th>
                                <th>Price</th>
                                <th>Brand</th>
                                <th>Created_at</th>
                                <th>Updated_at</th>
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
                                <td>{{ $data->barCode }}</td>
                                <td>{{ $data->description }}</td>
                                <td>{{ $data->price }}</td>
                                <td>{{ $data->brand_id }}</td>
                                <td>{{ $data->created_at }}</td>
                                <td>{{ $data->updated_at }}</td>
                                <td>
                                    <a href="{{ route('voyager.products.edit', $data->id) }}" class="btn btn-sm btn-primary">✏️</a>
                                    <form action="{{ route('voyager.products.destroy', $data->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger">🗑</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- Custom Pagination --}}
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
