<li class="list-group-item" draggable="true" id="cat-{{ $category->id }}">
    <span class="pull-right">
        <a href="{{ route('kb.category.edit', ['id' => $category->id]) }}" data-toggle="ajaxModal" data-dismiss="modal">
            @icon('solid/pencil-alt', 'fa-fw m-r-xs text-gray-600')
        </a>
        <a href="#" class="deleteCategory" data-cat-id="{{ $category->id }}">
            @icon('solid/times', 'text-gray-600 fa-fw')
        </a>
    </span>

    {{-- <span class="pull-left media-xs">@icon('solid/arrows-alt', 'm-r-sm')</span> --}}

    <div class="clear">{{ $category->name }} </div>
</li>