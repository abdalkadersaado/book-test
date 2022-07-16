<div class="card-body">
    <form action="" method="get">
    <div class="row">
        <div class="col-2">
            <div class="form-group">
                <input type="text" name="keyword" value="{{ old('keyword',request('keyword')) }}" class="form-control" placeholder="{{ __('BackEnd/contact_us.search_here') }}">
            </div>
        </div>
        <div class="col-2">
            <div class="form-group">
            <select name="genre_id" class="form-control">
                <option value=""> Genres </option>
                @foreach ($genres as $genre )
                <option value="{{ $genre->id }}"{{ old('genre_id',request('genre_id')) == $genre->id ? 'selected': '' }} >{{ $genre->title }}</option>
                @endforeach
            </select>
            </div>
        </div>

        <div class="col-1">
            <div class="form-group">
                <button type="submit" class="btn btn-link">Search</button>
            </div>
        </div>
    </div>
    </form>
</div>
