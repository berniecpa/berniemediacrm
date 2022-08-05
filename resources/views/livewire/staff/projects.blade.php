<div class="flex flex-col">

    @include('partial._table-search-bar')

    <div class="py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
        <div class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
            @if ($entries->count())

            <table class="min-w-full">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                            @langapp('name')
                        </th>
                        <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                            @langapp('progress')
                        </th>
                        @can('projects_view_expenses')
                        <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                            @langapp('expenses')
                        </th>
                        @endcan
                        <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                            @langapp('start_date')
                        </th>
                        <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                            @langapp('due_date')
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($entries as $entry)
                    <tr class="bg-white">
                        <td class="px-6 py-4 text-sm font-medium leading-5 border-b border-gray-200">
                            <div class="flex items-center">
                                <div class="ml-4">
                                    <div class="text-sm font-semibold leading-5 truncate">
                                        <a href="{{ route('projects.view', $entry->assignable->id) }}" class="{{themeLinks()}}">
                                            {{ str_limit($entry->assignable->name,25) }}
                                        </a>
                                    </div>
                                    @can('projects_view_cost')
                                    <div class="text-xs leading-5 text-gray-700">
                                        {{ formatCurrency($entry->assignable->currency, $entry->assignable->sub_total) }}
                                    </div>
                                    @endcan
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-700 border-b border-gray-200">
                            {{ $entry->assignable->progress }}%
                        </td>
                        @can('projects_view_expenses')
                        <td class="px-6 py-4 text-sm leading-5 text-gray-700 border-b border-gray-200">
                            {{ formatCurrency($entry->assignable->currency, $entry->assignable->total_expenses) }}
                        </td>
                        @endcan
                        <td class="px-6 py-4 text-sm leading-5 text-gray-700 border-b border-gray-200">
                            <div class="flex items-center">
                                <div class="ml-4">
                                    <div class="text-sm font-semibold leading-5 text-gray-600">
                                        {{ dateString($entry->assignable->start_date) }}
                                    </div>

                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-500 border-b border-gray-200">
                            <div class="ml-4">
                                <div class="text-sm font-semibold leading-5 text-gray-600">
                                    {{ dateString($entry->assignable->due_date)}}
                                </div>
                            </div>
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
            @else

            <div class="px-4 py-3 text-center">
                <p class="text-base text-gray-600">
                    No active projects found!
                </p>
            </div>
            @endif
        </div>
        <div class="row">
            <div class="px-4 py-2 text-gray-600">
                {{ $entries->links() }}
            </div>
        </div>
    </div>

</div>