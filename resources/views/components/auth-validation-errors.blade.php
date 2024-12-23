@props(['errors'])

@if ($errors->any())
    <div
        {{ $attributes->merge(['class' => 'alert alert-error bg-error/10 text-error-content shadow-sm animate-fadeIn border-2 border-error/20']) }}>
        <div class="flex flex-col w-full">
            <!-- <div class="flex items-center gap-2">
                <i data-lucide="alert-circle" class="w-5 h-5 stroke-error"></i>
                <h3 class="font-semibold text-error">{{ __('Whoops! Something went wrong.') }}</h3>
            </div> -->

            <ul class="space-y-1.5 text-sm list-none">
                @foreach ($errors->all() as $error)
                    <li class="flex items-center gap-2">
                        <i data-lucide="x-circle" class="w-4 h-4 stroke-error"></i>
                        <span class="text-error font-bold">{{ $error }}</span>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endif

<style>
    @keyframes fadeIn {
        from {
            opacity: 0;
            transform: translateY(-10px);
        }

        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .animate-fadeIn {
        animation: fadeIn 0.3s ease-out;
    }
</style>
