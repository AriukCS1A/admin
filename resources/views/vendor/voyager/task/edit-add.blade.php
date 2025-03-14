@extends('voyager::master')

@section('content')
<div class="page-content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <form action="@if(isset($dataTypeContent->id)){{ route('voyager.task.update', $dataTypeContent->id) }}@else{{ route('voyager.task.store') }}@endif" method="POST" enctype="multipart/form-data">
                @csrf
                @if(isset($dataTypeContent->id))
                    @method('PUT')
                @endif

                <div class="panel">
                    <div class="panel-body">

                        {{-- Cloudinary Upload --}}
                        <div class="form-group">
                            <label for="cloudinary-upload">📷 Upload Banner Image or Video</label>
                            <input type="file" id="cloudinary-upload" class="form-control" accept="image/*,video/*">
                            <input type="hidden" name="pic" id="cloudinary-url" value="{{ $dataTypeContent->photo ?? '' }}">

                            <div id="cloud-preview" style="margin-top: 10px;">
                                @if (!empty($dataTypeContent->pic))
                                    @php $ext = pathinfo($dataTypeContent->pic, PATHINFO_EXTENSION); @endphp
                                    @if(in_array($ext, ['mp4', 'mov', 'webm']))
                                        <video src="{{ $dataTypeContent->pic }}" controls style="max-width: 300px;"></video>
                                    @else
                                        <img src="{{ $dataTypeContent->pic }}" style="max-width: 200px;">
                                    @endif
                                @endif
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="name">📄 Name</label>
                            <input type="text" name="name" class="form-control" value="{{ $dataTypeContent->name ?? '' }}">
                        </div>

                        <div class="form-group">
                            <label for="info">🔗 Info</label>
                            <textarea name="info" class="form-control">{{ $dataTypeContent->info ?? '' }}</textarea>
                        </div>

                        {{-- Start Date --}}
                        <div class="form-group">
                            <label for="taskStart">🕒 Start Date</label>
                            <input type="date" name="taskStart" class="form-control" value="{{ isset($dataTypeContent->taskStart) ? \Carbon\Carbon::parse($dataTypeContent->taskStart)->format('Y-m-d') : '' }}">
                        </div>

                        {{-- End Date --}}
                        <div class="form-group">
                            <label for="taskEnd">🕒 End Date</label>
                            <input type="date" name="taskEnd" class="form-control" value="{{ isset($dataTypeContent->taskEnd) ? \Carbon\Carbon::parse($dataTypeContent->taskEnd)->format('Y-m-d') : '' }}">
                        </div>

                        <div class="form-group">
                            <label for="progress">📄 Progress</label>
                            <input type="text" name="progress" class="form-control" value="{{ $dataTypeContent->progress ?? '' }}">
                        </div>

                        {{-- filter --}}
                        <div class="form-group">
                            <label for="filter_id">📍 Filter</label>
                            <select name="filter_id" class="form-control" required>
                                <option value="">-- Select filter --</option>
                                @foreach(App\Models\Filter::all() as $filter)
                                    <option value="{{ $filter->id }}" {{ (isset($dataTypeContent->filter_id) && $dataTypeContent->filter_id == $filter->id) ? 'selected' : '' }}>
                                        {{ $filter->filter }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        {{-- filter --}}
                        <div class="form-group">
                            <label for="product_id">📍 Products</label>
                            <select name="product_id" class="form-control" required>
                                <option value="">-- Select product --</option>
                                @foreach(App\Models\Products::all() as $products)
                                    <option value="{{ $products->id }}" {{ (isset($dataTypeContent->product_id) && $dataTypeContent->product_id == $products->id) ? 'selected' : '' }}>
                                        {{ $products->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="barCode">📄 Barcode</label>
                            <input type="text" name="barCode" class="form-control" value="{{ $dataTypeContent->barCode ?? '' }}">
                        </div>

                    </div>
                    <div class="panel-footer">
                        <button type="submit" class="btn btn-primary">💾 Save</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- Cloudinary Upload --}}
<script>
    document.getElementById('cloudinary-upload').addEventListener('change', async function(e) {
        const file = e.target.files[0];
        if (!file) return;

        const formData = new FormData();
        formData.append('file', file);
        formData.append('upload_preset', 'voyager');
        formData.append('folder', 'voyager_uploads');

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
                preview.innerHTML = isVideo
                    ? `<video src="${data.secure_url}" controls style="max-width: 300px;"></video>`
                    : `<img src="${data.secure_url}" style="max-width: 200px;">`;

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
