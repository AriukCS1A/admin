@extends('voyager::master')

@section('content')
<div class="page-content browse container-fluid">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-bordered">
                <div class="panel-heading">
                    <h3 class="panel-title">🎮 Memory Game Reward</h3>
                    <div class="panel-actions">
                        <a href="{{ route('voyager.memory_game_rewards.create') }}" class="btn btn-success">➕ Add New</a>
                    </div>
                </div>

                <div class="panel-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>📸 Media</th>
                                <th>🎯 Level</th>
                                <th>🖼 Reward Type</th>
                                <th>🖼 Point</th>
                                <th>🖼 Max Winner Per Month</th>
                                <th>🖼 Created_at</th>
                                <th>⚙️ Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($dataTypeContent as $data)
                            <tr>
                                <td>{{ $data->id }}</td>

                                {{-- 📸 Image Preview --}}
                                <td>
                                    @php
                                        $imageModel = App\Models\Products::find($data->reward_product_id);
                                        $mediaUrl = $imageModel->pic ?? '';
                                        $ext = pathinfo($mediaUrl, PATHINFO_EXTENSION);
                                    @endphp

                                    @if ($imageModel && $mediaUrl)
                                        @if (in_array($ext, ['mp4', 'mov', 'webm']))
                                            <video src="{{ $mediaUrl }}" controls style="max-width: 100px;"></video>
                                        @else
                                            <img src="{{ $mediaUrl }}" style="max-width: 100px;">
                                        @endif
                                    @else
                                        <span class="text-muted">No Media</span>
                                    @endif
                                </td>

                                {{-- 🎯 Level name --}}
                                <td>
                                    @php
                                        $level = App\Models\Level::find($data->level_id);
                                    @endphp
                                    {{ $level->name ?? 'Unknown' }}
                                </td>

                                
                                <td>{{ $data->reward_type }}</td>
                                <td>{{ $data->reward_points }}</td>

                                <td>{{ $data->max_winners_per_month }}</td>
                                <td>{{ $data->created_at }}</td>


                                {{-- ⚙️ Actions --}}
                                <td>
                                    <a href="{{ route('voyager.memory_game_rewards.edit', $data->id) }}" class="btn btn-sm btn-primary">✏️</a>
                                    <form action="{{ route('voyager.memory_game_rewards.destroy', $data->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button class="btn btn-sm btn-danger" onclick="return confirm('Устгах уу?')">🗑</button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>

                    {{-- Pagination --}}
                    @if (method_exists($dataTypeContent, 'links'))
                        <div class="d-flex justify-content-center">
                            {{ $dataTypeContent->links() }}
                        </div>
                    @endif
                </div>
            </div>

        </div>
    </div>
</div>
@endsection
