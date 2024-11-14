
<form action="{{ route('upload.banner.image') }}" method="POST" enctype="multipart/form-data">
    @csrf
    <input type="file" name="image" required>
    
    <label for="startDate">Эхлэх Огноо:</label>
    <input type="date" name="startDate" required>

    <label for="endDate">Дуусах Огноо:</label>
    <input type="date" name="endDate" required>

    <button type="submit" class="btn btn-primary">Зураг Оруулах</button>
</form>
