<form action="{{ route('mediahighlights_index') }}" method="get">
    <label>Keyword or Source
        <input
                type="text"
                name="q"
                class="form-control"
                placeholder="Search..."
                value="{{ request('q') }}"
        />
    </label>
    <label>Browse Tags
        <select type="text" name="tag" class="form-control">
            <option value="">
                -- SELECT A TAG (optional) --
            </option>
            @foreach($tags as $tag)
                <option
                  value="{{ $tag->name }}"
                  @if(isset($currentTag))
                      @if ($currentTag == $tag->name)
                          selected
                      @endif
                  @endif
                >
                {{ $tag->name }}
                </option>
            @endforeach
        </select>
    </label>
    <input type="submit" value="Apply" class="button" />
    <a href="/mediahighlights" class="button hollow">Reset</a>
</form>
