<div class="form-group row">
    <label for="title" class="col-sm-2 col-form-label">Title</label>
    <div class="col-sm-10">
        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title"
            placeholder="Masukan Judul" value="{{ $question->title ?? old('title') }}">
        @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="category_id" class="col-sm-2 col-form-label">Kategori</label>
    <div class="col-sm-10">
        <select name="category_id" id="category_id" class="form-control select2">
            <option value="">----- PILIH KATEGORI ------</option>
            @foreach ($categories as $id => $category)
            <option value="{{$id}}" {{ ( $data->category_id ?? old('category_id')) == $id ? 'selected' : ''}}>
                {{ $category }}</option>
            @endforeach
        </select>
        @error('category_id')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="note" class="col-sm-2 col-form-label">Catatan</label>
    <div class="col-sm-10">
        <input type="text" class="form-control @error('note') is-invalid @enderror" id="note" name="note"
            placeholder="Masukan Catatan" value="{{ $question->note ?? old('note') }}">
        <span class="messages"></span>
        @error('note')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
