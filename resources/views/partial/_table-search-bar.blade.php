<div class="flex items-center justify-between px-4 py-3 bg-white border-t border-gray-200 sm:px-6">
    <div class="text-gray-600">
        Per Page: &nbsp;
        <select wire:model="perPage" class="py-2 border-none rounded-md">
            <option>10</option>
            <option>15</option>
            <option>25</option>
        </select>
    </div>
    <div class="flex justify-between flex-1 sm:justify-end">
        <div class="relative md:w-1/3">
            <input wire:model="search"
                class="w-full py-2 pl-10 pr-2 font-medium border-gray-300 rounded-md shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                type="text" placeholder="Search...">
            <div class="absolute top-0 left-0 inline-flex items-center p-2">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6 text-gray-400" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                    stroke-linejoin="round">
                    <rect x="0" y="0" width="24" height="24" stroke="none"></rect>
                    <circle cx="10" cy="10" r="7" />
                    <line x1="21" y1="21" x2="15" y2="15" />
                </svg>
            </div>
        </div>
    </div>
</div>