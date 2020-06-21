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
<div class="form-group row">
    <label for="is_active" class="col-sm-2 col-form-label">Is_Active</label>
    <div class="col-sm-10">
        <input type="text" class="form-control @error('is_active') is-invalid @enderror" id="is_active" name="is_active"
            placeholder="Masukan Is_active" value="{{ $question->is_active ?? old('is_active') }}">
        <span class="messages"></span>
        @error('is_active')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="author_id" class="col-sm-2 col-form-label">Penulis</label>
    <div class="col-sm-10">
        <select name="author_id" id="author_id" class="form-control select2">
            <option value="">----- PILIH Pembuat ------</option>
            @foreach ($authors as $id => $author)
            <option value="{{$id}}" {{ ( $data->author_id ?? old('author_id')) == $id ? 'selected' : ''}}>{{ $author }}
            </option>
            @endforeach
        </select>
        @error('is_active')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
