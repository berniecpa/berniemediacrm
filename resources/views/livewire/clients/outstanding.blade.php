<div class="flex flex-col">
    @if ($invoices->count())
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
                            <a wire:click.prevent="sortBy('payable')" role="button" href="#">
                                @langapp('payable')
                                @include('partial._sort-icon', ['field' => 'payable'])
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
                    @foreach ($invoices as $invoice)
                    <tr class="bg-white">
                        <td class="px-6 py-4 text-sm font-medium leading-5 border-b border-gray-200">
                            <div class="flex items-center">
                                <div class="ml-4">
                                    <div class="text-sm font-semibold leading-5 truncate">
                                        <a href="{{ route('invoices.view', $invoice->id) }}" class="{{themeLinks()}}">
                                            {{ $invoice->reference_no }}
                                        </a>
                                    </div>
                                    <div class="text-xs leading-5 text-gray-700">
                                        {{$invoice->status}}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-700 border-b border-gray-200">
                            <div class="flex items-center">
                                <div class="ml-4">
                                    <div class="text-sm font-semibold leading-5 text-gray-600">
                                        {{formatCurrency($invoice->currency, $invoice->payable)}}
                                    </div>
                                    <div class="text-xs leading-5 text-gray-700">
                                        @langapp('paid') {{formatCurrency($invoice->currency, $invoice->paid_amount)}}
                                    </div>
                                </div>
                            </div>
                        </td>
                        <td class="px-6 py-4 text-sm leading-5 text-gray-500 border-b border-gray-200">
                            <div class="ml-4">
                                <div class="text-sm font-semibold leading-5 text-gray-600">
                                    {{$invoice->due_date->toFormattedDateString()}}
                                </div>
                                <div class="text-xs leading-5 text-gray-700">
                                    @langapp('balance') {{formatCurrency($invoice->currency, $invoice->balance)}}
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
                {{ $invoices->links() }}
            </div>
        </div>
    </div>

    @else

    <div class="px-4 py-3">
        <p class="text-base text-gray-600">
            You have no pending invoices
        </p>
    </div>
    @endif

</div>