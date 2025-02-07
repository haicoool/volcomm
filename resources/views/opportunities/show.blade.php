<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $opportunity->oppTitle }} - Opportunity Details</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <script src="https://cdn.tailwindcss.com"></script>
    <script src="https://unpkg.com/flowbite@1.6.5/dist/flowbite.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body class="bg-gray-50 p-8">

<div class="max-w-3xl mx-auto bg-white p-10 rounded-lg shadow-lg">
    <!-- SweetAlert for Messages -->
    @if(session('error'))
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: '{{ session('error') }}',
            });
        </script>
    @endif

    @if(session('message'))
        @php
            $message = session('message');
            $alertType = $message['type'] === 'success' ? 'success' : 'warning';
        @endphp
        <script>
            Swal.fire({
                icon: '{{ $alertType }}',
                title: '{{ ucfirst($message['type']) }}!',
                text: '{{ $message['text'] }}',
            });
        </script>
    @endif

    <!-- Opportunity Title -->
    <h1 class="text-3xl font-semibold text-gray-900 mb-4">{{ $opportunity->oppTitle }}</h1>

    <!-- Opportunity Image -->
    <div class="mb-6">
        <img src="{{ asset('storage/' . $opportunity->oppImage) }}" alt="{{ $opportunity->oppTitle }}" class="w-full h-64 object-cover rounded-lg shadow-sm">
    </div>

    <!-- Opportunity Description -->
    <p class="text-base text-gray-700 leading-relaxed mb-8">{{ $opportunity->oppDesc }}</p>

    <!-- Opportunity Details -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-8 text-sm">
        <div class="text-gray-600">
            <strong class="text-gray-800">Location:</strong>
            <span class="block">{{ $opportunity->oppLocation }}</span>
        </div>
        <div class="text-gray-600">
            <strong class="text-gray-800">Date:</strong>
            <span class="block">{{ $opportunity->oppDate }}</span>
        </div>
        <div class="text-gray-600">
            <strong class="text-gray-800">Time:</strong>
            <span class="block">{{ $opportunity->oppTime }}</span>
        </div>
        <div class="text-gray-600">
            <strong class="text-gray-800">Required Skill:</strong>
            <span class="block">{{ $opportunity->reqSkill }}</span>
        </div>

        <!-- Registration Progress Bar -->
        <div class="col-span-2 text-gray-600 mt-4">
            <strong class="text-gray-800">Current Registration:</strong>
            <div class="w-full bg-gray-200 rounded-full h-3 mt-1">
                @php
                    $percentage = ($opportunity->currentReg / $opportunity->maxCapacity) * 100;
                    $progressColor = $percentage > 75 ? 'bg-red-500' : ($percentage > 50 ? 'bg-yellow-400' : 'bg-green-500');
                @endphp
                <div class="h-3 rounded-full {{ $progressColor }}" style="width: {{ $percentage }}%"></div>
            </div>
            <span class="block mt-2 text-sm">{{ $opportunity->currentReg }} out of {{ $opportunity->maxCapacity }} registered</span>
        </div>
    </div>

    <!-- Registration Section -->
    <div class="flex justify-between items-center mt-6">
        <form action="{{ route('volunteer.registerOpportunity', $opportunity->oppId) }}" method="POST" class="w-full max-w-xs">
            @csrf
            <input type="hidden" name="vId" value="{{ Auth::check() ? Auth::user()->vId : '' }}">

            <!-- Qualification Requirement -->
            @if($opportunity->reqQualification == 1)
                <div class="mb-4">
                    <label for="qualification" class="block text-gray-700 font-medium mb-2">Choose a Qualification:</label>
                    @if(!empty($qualifications) && count($qualifications) > 0)
                        <select name="vQualification" id="qualification" required class="w-full border-gray-300 focus:ring-indigo-500 focus:border-indigo-500 rounded-md shadow-sm">
                            @foreach($qualifications as $qualification)
                                <option value="{{ $qualification }}">{{ $qualification }}</option>
                            @endforeach
                        </select>
                    @else
                        <p class="text-red-600">You have not uploaded any qualifications. Please upload one in your profile before registering.</p>
                    @endif
                </div>
            @endif

            <!-- Register Button -->
            <button type="submit"
                    class="w-full text-white bg-indigo-600 hover:bg-indigo-700 font-medium rounded-lg text-sm px-4 py-2 focus:ring-4 focus:ring-indigo-300 transition-colors duration-200"
                    @if($opportunity->reqQualification == 1 && (empty($qualifications) || count($qualifications) === 0))
                        disabled
                    class="bg-gray-400 cursor-not-allowed"
                @endif>
                Register
            </button>
        </form>

        <!-- Back Button -->
        <a href="{{ route('volunteer.dashboard') }}" class="text-sm font-medium text-gray-800 bg-gray-200 hover:bg-gray-300 px-5 py-2 rounded-lg focus:ring-4 focus:ring-gray-300 transition-colors duration-200 ml-6">
            Back to Opportunities
        </a>
    </div>
</div>

</body>
</html>
