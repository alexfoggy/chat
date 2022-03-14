<form action="" style="display: flex; flex-direction: column; max-width: 400px">
    <label for="">Language</label>
    <select name="language" id="">
        @foreach(\App\Models\Language::all() as $language)
            <option value="{{ $language->id }}">{{ $language->name }}</option>
        @endforeach
    </select>
    <label for="">Language</label>
    <select name="language" id="">
        <option value="1">Usa</option>
        <option value="2">United Kingdom</option>
        <option value="3">Britain</option>
    </select>
    <label for="">Level</label>
    @foreach(config('general.language.levels') as $key => $level)
        <div style="display: flex">
            <input type="radio" name="level" value="{{ $level }}">
            <span>{{ $level }}</span>
        </div>
    @endforeach
</form>
