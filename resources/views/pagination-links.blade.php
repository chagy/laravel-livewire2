@if ($paginator->hasPages())
    <ul class="flex justify-between">
        @if ($paginator->onFirstPage())
        <li class="w-16 px-2 py-1 text-center rounded border shadow bg-gray-100 cursor-pointer">Prev</li>
        @else 
        <li class="w-16 px-2 py-1 text-center rounded border shadow bg-white cursor-pointer" wire:click="previousPage">Prev</li>
        @endif
       
        @foreach ($elements as $element)
        @if (is_array($element))
        @foreach ($element as $page => $url)
            @if ($page == $paginator->currentPage())
            <li class="mx-2 w-10 px-2 py-1 text-center rounded border shadow bg-blue-30 cursor-pointer" wire:click="gotoPage({{ $page }})">
                {{ $page }}
            </li>
            @else
            <li class="mx-2 w-10 px-2 py-1 text-center rounded border shadow bg-white cursor-pointer" wire:click="gotoPage({{ $page }})">
                {{ $page }}
            </li>
            @endif
        @endforeach
        @endif
        @endforeach

        @if ($paginator->hasMorePages())
        <li class="w-16 px-2 py-1 text-center rounded border shadow bg-white cursor-pointer" wire:click="nextPage">Next</li>
        @else
        <li class="w-16 px-2 py-1 text-center rounded border shadow bg-gray-100 cursor-pointer">Next</li>
        @endif
        
    </ul>
@endif