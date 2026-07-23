@php
    $posStr = strtolower($member->position);
    
    // Determine Color based on position string
    if ($posStr === 'kepala panti') {
        $colorClass = 'bg-warning text-white';
        $borderClass = 'border-warning border-dashed';
    } elseif (str_contains($posStr, 'staf') && $posStr !== 'staf pengurus') {
        $colorClass = 'bg-accent text-white';
        $borderClass = 'border-accent border-dashed';
    } else {
        $colorClass = 'bg-[#0056b3] text-white';
        $borderClass = 'border-[#0056b3] border-dashed';
    }
@endphp

<li>
    <div class="org-node flex flex-col items-center">
        {{-- Card Container --}}
        <div class="w-64 max-w-[280px]">
            {{-- Position Header Capsule --}}
            <div class="{{ $colorClass }} py-2 px-4 rounded-full font-heading font-semibold text-sm mb-[-12px] relative z-10 shadow-md mx-4 whitespace-normal break-words text-center min-h-[36px] flex items-center justify-center">
                {{ $member->position }}
            </div>
            
            {{-- Name Box --}}
            <div class="bg-white border-2 {{ $borderClass }} rounded-xl pt-6 pb-4 px-4 shadow-subtle flex flex-col items-center">
                @if($member->image)
                    <img src="{{ $member->image_url }}" alt="{{ $member->name }}" class="w-16 h-16 rounded-full object-cover mb-3 border-2 border-background">
                @endif
                <h4 class="font-heading font-bold text-heading text-center text-sm md:text-base leading-tight">
                    {{ $member->name }}
                </h4>
            </div>
        </div>
    </div>
    
    @if($member->children->count() > 0)
        <ul>
            @foreach($member->children as $child)
                @include('partials.org-node', ['member' => $child])
            @endforeach
        </ul>
    @endif
</li>
