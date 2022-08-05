<div class="flex flex-col">
    @if ($estimates->count())
    @include('partial._table-search-bar')

    <div class="py-2 overflow-x-auto sm:-mx-6 sm:px-6 lg:-mx-8 lg:px-8">
        <div class="inline-block min-w-full overflow-hidden align-middle border-b border-gray-200 shadow sm:rounded-lg">
            <table class="min-w-full">
                <thead>
                    <tr>
                        <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                            <a wire:click.prevent="sortBy('reference_no')" role="button" href="#">
                                @langapp('reference_no')
                                @include('partial._sort-icon', ['field' => 'reference_no'])
                            </a>
                        </th>

                        <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                            <a wire:click.prevent="sortBy('sub_total')" role="button" href="#">
                                @langapp('sub_total')
                                @include('partial._sort-icon', ['field' => 'sub_total'])
                            </a>
                        </th>
                        <th class="px-6 py-3 text-xs font-medium leading-4 tracking-wider text-left text-gray-500 uppercase border-b border-gray-200 bg-gray-50">
                            <a wire:click.prevent="sortBy('due_date')" role="button" href="#">
                                @langapp('due_date')
                                @include('partial._sort-icon', ['field' => 'due_date'])
                            </a>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($estimates as $estimate)
                    <tr class="bg-white">
                        <td class="px-6 py-4 text-sm font-medium leading-5 border-b border-gray-200">
                            <div class="flex items-center">
                                <div class="ml-4">
                                    <div class="text-sm font-semibold leading-5 truncate">
                                        <a href="{{ route('estimates.view', $estimate->id) }}" class="{{themeLinks()}}">
                                            {{ $estimate->reference_no }}
                                        </a>
                                    </div>
                                    <div class="text-xs leading-5 text-gray-700">
                                        @langapp('amount') {{ formatCurrency($estimate->currency, $estimate->amount) }}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-700 border-b border-gray-200">
                            <div class="flex items-center">
                                <div class="ml-4">
                                    <div class="text-sm font-semibold leading-5 text-gray-600">
                                        {{ formatCurrency($estimate->currency, $estimate->sub_total) }}
                                    </div>
                                    <div class="text-xs leading-5 text-gray-700">
                                        {{$estimate->currency}}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-500 border-b border-gray-200">
                            <div class="ml-4">
                                <div class="text-sm font-semibold leading-5 text-gray-600">
                                    {{ $estimate->due_date->toFormattedDateString()}}
                                </div>
                                <div class="text-xs leading-5 text-gray-700">
                                    {{$estimate->status}}
                                </div>
                            </div>
                        </td>
                    </tr>

                    @endforeach
                </tbody>
            </table>
        </div>
        <div class="row">
            <div class="px-4 py-2 text-gray-600">
                {{ $estimates->links() }}
            </div>
        </div>
    </div>

    @else

    <div class="px-4 py-3">
        <p class="text-base text-gray-600">
            You have no pending estimates
        </p>
    </div>
    @endif

</div>