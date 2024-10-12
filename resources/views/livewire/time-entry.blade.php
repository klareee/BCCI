<div>
    <div class="p-4 bg-white rounded-lg shadow-xs">
        <div class="text-center">
            <div id="timeDisplay" class="text-3xl font-bold"></div>
            <div id="dateDisplay" class="text-1xl mt-2"></div>
        </div>

        <div class="flex justify-center gap-2 my-4">
            @if($isLogged)
                <x-primary-button class="bg-green-600 hover:bg-green-500" wire:click="save">
                    Time In
                </x-primary-button>
            @else
                <x-primary-button class="bg-red-800 hover:bg-red-700" wire:click="save">
                    Time Out
                </x-primary-button>
            @endif
        </div>
    </div>

    <script>
        function updateDateTime() {
            const now = new Date();

            // Format time as HH:MM:SS
            const time = now.toLocaleTimeString('en-US', { hour12: false });

            // Format date
            const dateOptions = {
                weekday: 'long',
                year: 'numeric',
                month: 'long',
                day: 'numeric'
            };
            const date = now.toLocaleDateString('en-US', dateOptions);

            // Update the HTML content
            document.getElementById('timeDisplay').textContent = time;
            document.getElementById('dateDisplay').textContent = date;
        }

        // Update the date and time every second
        setInterval(updateDateTime, 1000);

        // Initialize the date and time display
        updateDateTime();
    </script>
</div>
