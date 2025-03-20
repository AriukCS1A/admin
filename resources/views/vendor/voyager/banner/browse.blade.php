@extends('voyager::master')

@section('content')
<div class="page-content browse container-fluid">
    <div class="row">
        <div class="col-md-12">

            <div class="panel panel-bordered">
                <div class="panel-heading d-flex justify-content-between align-items-center">
                    <h3 class="panel-title">Banner List</h3>
                    <a href="{{ route('voyager.banner.create') }}" class="btn btn-success">➕ Add New</a>
                </div>

                <div class="panel-body">

                    {{-- ✅ Scrollable Table --}}
                    <div style="overflow-x: auto;">
                        <table class="table table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Media</th>
                                    <th>Description</th>
                                    <th>Link</th>
                                    <th>Start Date</th>
                                    <th>End Date</th>
                                    <th>Branch</th>
                                    <th>Story or Banner</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($dataTypeContent as $data)
                                <tr>
                                    <td>{{ $data->id }}</td>
                                    <td>
                                        @php $ext = pathinfo($data->photo, PATHINFO_EXTENSION); @endphp
                                        @if (in_array($ext, ['mp4', 'mov', 'webm']))
                                            <video src="{{ $data->photo }}" controls style="max-width: 100px;"></video>
                                        @elseif($data->photo)
                                            <img src="{{ $data->photo }}" style="max-width: 100px;">
                                        @else
                                            No Media
                                        @endif
                                    </td>
                                    <td>{{ $data->description }}</td>
                                    <td>{{ $data->link }}</td>
                                    <td>{{ $data->startDate }}</td>
                                    <td>{{ $data->endDate }}</td>
                                    <td>{{ $data->branch_id }}</td>
                                    <td>{{ $data->storyfilter_id }}</td>
                                    <td>
                                        <a href="{{ route('voyager.banner.edit', $data->id) }}" class="btn btn-sm btn-primary">✏️</a>
                                        <form action="{{ route('voyager.banner.destroy', $data->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-sm btn-danger">🗑</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{-- ✅ Custom Pagination --}}
                    @if (method_exists($dataTypeContent, 'links'))
                        <div class="d-flex justify-content-center mt-3">
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

{{-- Cloudinary Upload Script --}}
<script>
    const UPLOAD_PRESET = "{{ env('CLOUDINARY_UPLOAD_PRESET', 'voyager') }}";

    document.getElementById('cloudinary-upload')?.addEventListener('change', async function (e) {
        const file = e.target.files[0];
        if (!file) return;

        const formData = new FormData();
        formData.append('file', file);
        formData.append('upload_preset', UPLOAD_PRESET);
        formData.append('folder', 'voyager_uploadss');

        const isVideo = file.type.startsWith('video/');
        const resourceType = isVideo ? 'video' : 'image';

        try {
            const res = await fetch(`https://api.cloudinary.com/v1_1/dzwchq5e5/${resourceType}/upload`, {
                method: 'POST',
                body: formData
            });

            const data = await res.json();

            if (data.secure_url) {
                document.getElementById('cloudinary-url').value = data.secure_url;

                const preview = document.getElementById('cloud-preview');
                if (isVideo) {
                    preview.outerHTML = `<video src="${data.secure_url}" controls style="max-width:300px; margin-top:10px;"></video>`;
                } else {
                    preview.src = data.secure_url;
                    preview.style.display = 'block';
                }

                alert('✅ Файл амжилттай Cloudinary-д хадгалагдлаа!');
            } else {
                alert('❌ Upload амжилтгүй боллоо!');
                console.log(data);
            }
        } catch (err) {
            alert('⚠️ Cloudinary upload алдаа гарлаа');
            console.error(err);
        }
    });
</script>
@endsection
