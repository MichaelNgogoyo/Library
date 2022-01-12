<div>
  <div
    x-data="{
      open: @entangle('showDropdown'),
      search: @entangle('search'),
      selected: @entangle('selected'),
      highlightedIndex: 0,
      highlightPrevious() {
        if (this.highlightedIndex > 0) {
          this.highlightedIndex = this.highlightedIndex - 1;
          this.scrollIntoView();
        }
      },
      highlightNext() {
        if (this.highlightedIndex < this.$refs.results.children.length - 1) {
          this.highlightedIndex = this.highlightedIndex + 1;
          this.scrollIntoView();
        }
      },
      scrollIntoView() {
        this.$refs.results.children[this.highlightedIndex].scrollIntoView({
          block: 'nearest',
          behavior: 'smooth'
        });
      },
      updateSelected(id, title) {
        this.selected = id;
        this.search = title;
        this.open = false;
        this.highlightedIndex = 0;
      },
  }">
  <div
    x-on:value-selected="updateSelected($event.detail.id, $event.detail.title)">
    <span>
      <div>
        <input
            id="book" name="book" type="text" autocomplete="book"
           class="shadow-sm focus:ring-indigo-500 focus:border-indigo-500 block w-full sm:text-sm border-gray-300 rounded-md"
          wire:model.debounce.300ms="search"
          x-on:keydown.arrow-down.stop.prevent="highlightNext()"
          x-on:keydown.arrow-up.stop.prevent="highlightPrevious()"
          x-on:keydown.enter.stop.prevent="$dispatch('value-selected', {
            id: $refs.results.children[highlightedIndex].getAttribute('data-result-id'),
            title: $refs.results.children[highlightedIndex].getAttribute('data-result-title')
          })">
      </div>
    </span>

    <div
      x-show="open"
      x-on:click.away="open = false" class="drop-shadow-lg z-10 absolute w-[210px] bg-white">
        <ul x-ref="results">
          @forelse($results as $index => $result)
            <li
              wire:key="{{ $index }}"
              x-on:click.stop="$dispatch('value-selected', {
                id: {{ $result->id }},
                title: '{{ $result->title }}'
              })"
              :class="{
                'bg-gray-200': {{ $index }} === highlightedIndex,
                'text-gray-600': {{ $index }} === highlightedIndex
              }"
              class="py-0.5 px-1"
              data-result-id="{{ $result->id }}"
              data-result-title="{{ $result->title }}">
                <span>
                  {{ $result->title }}
                </span>
            </li>
          @empty
            <li>No results found</li>
          @endforelse
        </ul>
      </div>
    </div>
  </div>
</div>
