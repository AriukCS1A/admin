@extends('voyager::master')

@section('content')
<div class="page-content browse container-fluid">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-bordered">
                <div class="panel-heading">
                    <h3 class="panel-title">Reward List</h3>
                    <div class="panel-actions">
                        <a href="{{ route('voyager.reward.create') }}" class="btn btn-success">➕ Add New</a>
                    </div>
                </div>

                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Media</th>
                                <th>Name</th>
                                <th>Info</th>
                                <th>Required Month</th>
                                <th>Required Age</th>
                                <th>Benefit</th>
                                <th>Valid From</th>
                                <th>Valid To</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dataTypeContent as $data)
                            <tr>
                                <td>{{ $data->rewardId }}</td>
                                <td>
                                    @php $ext = pathinfo($data->productPhoto, PATHINFO_EXTENSION); @endphp
                                    @if (in_array($ext, ['mp4', 'mov', 'webm']))
                                        <video src="{{ $data->productPhoto }}" controls style="max-width: 100px;"></video>
                                    @elseif($data->productPhoto)
                                        <img src="{{ $data->productPhoto }}" style="max-width: 100px;">
                                    @else
                                        No Media
                                    @endif
                                </td>
                                <td>{{ $data->name }}</td>
                                <td>{{ $data->info }}</td>
                                <td>{{ $data->requiredMonth }}</td>
                                <td>{{ $data->requiredAge }}</td>
                                <td>{{ $data->benefit }}</td>
                                <td>{{ $data->validFrom }}</td>
                                <td>{{ $data->validTo }}</td>
                                <td>
                                    <a href="{{ route('voyager.reward.edit', $data->rewardId) }}" class="btn btn-sm btn-primary">✏️</a>
                                    <form action="{{ route('voyager.reward.destroy', $data->rewardId) }}" method="POST" style="display:inline;">
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
