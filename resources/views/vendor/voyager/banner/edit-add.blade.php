@extends('voyager::master')

@section('content')
<div class="page-content container-fluid">
    <div class="row">
        <div class="col-md-12">
            <form action="@if(isset($dataTypeContent->id)){{ route('voyager.banner.update', $dataTypeContent->id) }}@else{{ route('voyager.banner.store') }}@endif" method="POST" enctype="multipart/form-data">
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
                            <input type="hidden" name="photo" id="cloudinary-url" value="{{ $dataTypeContent->photo ?? '' }}">

                            <div id="cloud-preview" style="margin-top: 10px;">
                                @if (!empty($dataTypeContent->photo))
                                    @php $ext = pathinfo($dataTypeContent->photo, PATHINFO_EXTENSION); @endphp
                                    @if(in_array($ext, ['mp4', 'mov', 'webm']))
                                        <video src="{{ $dataTypeContent->photo }}" controls style="max-width: 300px;"></video>
                                    @else
                                        <img src="{{ $dataTypeContent->photo }}" style="max-width: 200px;">
                                    @endif
                                @endif
                            </div>
                        </div>

                        {{-- Description --}}
                        <div class="form-group">
                            <label for="description">📄 Description</label>
                            <textarea name="description" class="form-control">{{ $dataTypeContent->description ?? '' }}</textarea>
                        </div>

                        {{-- Link --}}
                        <div class="form-group">
                            <label for="link">🔗 Link</label>
                            <input type="text" name="link" class="form-control" value="{{ $dataTypeContent->link ?? '' }}">
                        </div>

                        {{-- Start Date --}}
                        <div class="form-group">
                            <label for="startDate">🕒 Start Date</label>
                            <input type="date" name="startDate" class="form-control" value="{{ isset($dataTypeContent->startDate) ? \Carbon\Carbon::parse($dataTypeContent->startDate)->format('Y-m-d') : '' }}">
                        </div>

                        {{-- End Date --}}
                        <div class="form-group">
                            <label for="endDate">🕒 End Date</label>
                            <input type="date" name="endDate" class="form-control" value="{{ isset($dataTypeContent->endDate) ? \Carbon\Carbon::parse($dataTypeContent->endDate)->format('Y-m-d') : '' }}">
                        </div>

                        {{-- Branch --}}
                        <div class="form-group">
                            <label for="branch_id">📍 Branch</label>
                            <select name="branch_id" class="form-control">
                                <option value="">-- Select Branch --</option>
                                @foreach(App\Models\Branches::all() as $branch)
                                    <option value="{{ $branch->id }}" {{ (isset($dataTypeContent->branch_id) && $dataTypeContent->branch_id == $branch->id) ? 'selected' : '' }}>
                                        {{ $branch->name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="storyfilter_id">📍 Story or Banner</label>
                            <select name="storyfilter_id" class="form-control" required>
                                <option value="">-- Select Option --</option>
                                @foreach(App\Models\Storyfilter::all() as $story)
                                    <option value="{{ $story->id }}" {{ (isset($dataTypeContent->storyfilter_id) && $dataTypeContent->storyfilter_id == $story->id) ? 'selected' : '' }}>
                                        {{ $story->name }}
                                    </option>
                                @endforeach
                            </select>
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
