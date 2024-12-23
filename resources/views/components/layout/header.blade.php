<header class="z-50 bg-[#680000] header-bg bg-no-repeat border-b-[5px] border-[#f65503] transition-transform duration-200">
    <div>
        <div class="flex items-start py-4">
            <div class="flex-shrink-0">
                <img src="{{ asset('images/logo-new2.png') }}"
                     alt="Enverga University Student Information System"
                     class="h-16 w-auto" />
            </div>
            <div class="hidden md:block ml-auto">
                <nav class="flex space-x-4">
                    {{-- Add navigation items here if needed --}}
                </nav>
            </div>
        </div>
    </div>
</header>

<style>
    .header-bg {
        background-image: url('{{ asset("images/headerbg.png") }}');
    }
</style>
