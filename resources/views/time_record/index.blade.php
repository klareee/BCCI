<x-guest-layout>

    <script src="{{ asset('js/shim.js') }}"></script>
    <script src="{{ asset('js/websdk.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/ifvisible/1.0.6/ifvisible.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/async/3.2.4/async.min.js"></script>

    @vite(['resources/js/customFingerprint.js'])

    <div class="flex overflow-y-auto flex-col md:flex-row">
        <div class="h-32 md:h-auto md:w-1/2">
            <img aria-hidden="true" class="object-cover w-full h-full"
                src="{{ asset('images/forgot-password-office.jpeg') }}" alt="Office" />
        </div>

        <div class="flex justify-center items-center p-6 sm:p-12 md:w-1/2">
            <div class="w-full">

                <div id="scanner-status" class="mb-4 text-center">
                    <p class="text-gray-600">Click to start fingerprint capture</p>
                </div>

                <div class="bg-white shadow-md rounded-lg px-6 max-w-md mx-auto border border-black py-4 text-sm">
                    <h6 class="font-bold ">Time Logs</h6>
                    <p class="text-gray-600" id="time-in-text"></p>
                    <p class="text-gray-600" id="time-out-text"></p>
                </div>

                <x-primary-button type="button" class="block mt-4 w-full" id="capture-btn">
                    Clock In / Clock Out
                </x-primary-button>

            </div>
        </div>
    </div>
</x-guest-layout>
