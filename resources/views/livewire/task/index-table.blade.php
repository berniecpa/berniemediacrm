<div class="flex flex-col">
    @include('partial._table-search-bar')

    <div class="py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
        <div class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                            <a wire:click.prevent="sortBy('name')" role="button" href="#">
                                @langapp('name')
                                @include('partial._sort-icon', ['field' => 'name'])
                            </a>
                        </th>
                        <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                            <a wire:click.prevent="sortBy('project_id')" role="button" href="#">
                                @langapp('project')
                                @include('partial._sort-icon', ['field' => 'project_id'])
                            </a>
                        </th>
                        <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                            <a wire:click.prevent="sortBy('start_date')" role="button" href="#">
                                @langapp('start_date')
                                @include('partial._sort-icon', ['field' => 'start_date'])
                            </a>
                        </th>
                        <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                            <a wire:click.prevent="sortBy('due_date')" role="button" href="#">
                                @langapp('due_date')
                                @include('partial._sort-icon', ['field' => 'due_date'])
                            </a>
                        </th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($tasks as $task)
                    <tr class="bg-white">
                        <td class="px-6 py-4 text-sm font-medium leading-5 border-b border-gray-200">
                            <div class="flex items-center">
                                <div class="ml-4">
                                    <div class="text-sm font-semibold leading-5 truncate">
                                        <a href="{{ route('projects.view', ['project' => $task->project_id,'tab' => 'tasks','item'=>$task->id]) }}" class="{{themeLinks()}}">
                                            {{ $task->name }}
                                        </a>
                                    </div>
                                    <div class="text-xs leading-5 text-gray-700">
                                        {{$task->user->name}}
                                    </div>
                                </div>
                            </div>
                            <div class="m-1 progress progress-xxs">
                                <div class="progress-bar progress-bar-success" data-toggle="tooltip" title="{{ $task->progress }}%" style="width: {{ $task->progress }}%"></div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-500 border-b border-gray-200">
                            <a href="{{ route('projects.view',['project' => $task->project_id]) }}"
                                class="text-indigo-600">{{ str_limit(optional($task->project)->name, 25) }}</a>
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-700 border-b border-gray-200">
                            <div class="flex items-center">
                                <div class="ml-4">
                                    <div class="text-sm font-semibold leading-5 text-gray-600">
                                        {{$task->start_date->toFormattedDateString()}}
                                    </div>
                                    <div class="text-xs leading-5 text-gray-700">
                                        {{$task->hourly_rate}}/hr
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-500 border-b border-gray-200">
                            <div class="ml-4">
                                <div class="text-sm font-semibold leading-5 text-gray-600">
                                    {{$task->due_date->toFormattedDateString()}}
                                </div>
                                <div class="text-xs leading-5 text-gray-700">
                                    {{secToHours($task->total_time)}}
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm font-medium leading-5 text-right border-b border-gray-200">
                            <a href="{{route('tasks.edit',$task->id)}}" data-toggle="ajaxModal" class="btn {{themeButton()}}">Edit</a>
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="px-4 py-2 text-gray-600">
                {{ $tasks->links() }}
            </div>
        </div>
    </div>
</div>