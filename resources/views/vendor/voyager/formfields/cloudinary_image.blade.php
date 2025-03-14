<div class="form-group">
    <label for="cloudinary-upload">Upload Image to Cloudinary</label>
    <input type="file" id="cloudinary-upload" class="form-control" accept="image/*">

    {{-- Cloudinary линкийг хадгалах input --}}
    <input type="hidden" name="{{ isset($row) ? $row->field : 'pic' }}" id="cloudinary-url"
           value="{{ $dataTypeContent->{$row->field ?? 'pic'} ?? '' }}">

    {{-- Preview --}}
    @if (!empty($dataTypeContent->{$row->field ?? 'pic'}))
        <img src="{{ $dataTypeContent->{$row->field ?? 'pic'} }}" style="max-width:200px; margin-top:10px;">
    @endif
</div>

<script>
    document.getElementById('cloudinary-upload').addEventListener('change', async function (e) {
        const file = e.target.files[0];
        if (!file) return;

        const formData = new FormData();
        formData.append('file', file);
        formData.append('upload_preset', 'voyager'); // Cloudinary upload preset
        formData.append('folder', 'voyager_uploads'); // Cloudinary folder

        const res = await fetch('https://api.cloudinary.com/v1_1/dzwchq5e5/image/upload', {
            method: 'POST',
            body: formData
        });

        const data = await res.json();

        if (data.secure_url) {
            document.getElementById('cloudinary-url').value = data.secure_url;
            alert('✅ Зураг амжилттай Cloudinary-д хадгалагдлаа!');
            console.log('✅ Cloudinary URL:', data.secure_url);
        } else {
            alert('❌ Upload амжилтгүй боллоо!');
            console.log(data);
        }
    });
</script>
