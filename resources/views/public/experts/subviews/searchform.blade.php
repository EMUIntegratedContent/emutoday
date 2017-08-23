<form action="{{ route('expertsearch') }}" method="get">
    <label>Name or Keyword
        <input
                type="text"
                name="q"
                class="form-control"
                placeholder="Search..."
                value="{{ request('q') }}"
        />
    </label>
    <label>Browse Topics
        <select type="text" name="category" class="form-control">
            <option value="">
                -- SELECT A CATEGORY (optional) --
            </option>
            @foreach($expertCategories as $category)
                <option
                  value="{{ $category->category }}"
                  @if(isset($currentCategory))
                      @if ($currentCategory == $category->category)
                          selected
                      @endif
                  @endif
                >
                {{ $category->category }}
                </option>
            @endforeach
        </select>
    </label>
    <input type="submit" value="Apply" class="button" />
    <a href="/experts/find" class="button">Reset</a>
</form>
