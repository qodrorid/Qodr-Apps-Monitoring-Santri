<div class="form-group row">
    <label for="title" class="col-sm-2 col-form-label">Title</label>
    <div class="col-sm-10">
        <input type="text" class="form-control @error('title') is-invalid @enderror" name="title" id="title"
            placeholder="Masukan Judul" value="{{ $surveys->title ?? old('title') }}">
        @error('title')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="author_id" class="col-sm-2 col-form-label">Pembuat</label>
    <div class="col-sm-10">
        <select name="author_id" id="author_id" class="form-control select2">
            <option value="">----- PILIH Pembuat ------</option>
            @foreach ($authors as $id => $author)
            <option value="{{$id}}" {{ ( $data->author_id ?? old('author_id')) == $id ? 'selected' : ''}}>{{ $author }}
            </option>
            @endforeach
        </select>
        @error('author_id')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="date_start" class="col-sm-2 col-form-label">Tanggal Awal</label>
    <div class="col-sm-10">
        <input type="text" class="form-control datepicker" name="date_start" id="date_start"
            placeholder="Masukan Tanggal Awal" value="{{ $surveys->date_start ?? old('date_start') }}" autocomplete="off">
    </div>
</div>
<div class="form-group row">
    <label for="date_end" class="col-sm-2 col-form-label">Tanggal Akhir</label>
    <div class="col-sm-10">
        <input type="text" class="form-control datepicker" name="date_end" id="date_end"
            placeholder="Masukan Tanggal Akhir" value="{{ $surveys->date_end ?? old('date_end') }}" autocomplete="off">
    </div>
</div>
<div class="form-group row">
    <label for="time_limit" class="col-sm-2 col-form-label">Batas Waktu</label>
    <div class="col-sm-10">
        <input type="number" class="form-control @error('time_limit') is-invalid @enderror" name="time_limit" id="time_limit"
            placeholder="Masukan Batas Waktu" value="{{ $surveys->time_limit ?? old('time_limit') }}">
        @error('time_limit')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
<div class="form-group row">
    <label for="note" class="col-sm-2 col-form-label">Catatan</label>
    <div class="col-sm-10">
        <input type="text" class="form-control @error('note') is-invalid @enderror" name="note" id="note"
            placeholder="Masukan Catatan" value="{{ $surveys->note ?? old('note') }}">
        @error('note')
        <div class="invalid-feedback">{{ $message }}</div>
        @enderror
    </div>
</div>
