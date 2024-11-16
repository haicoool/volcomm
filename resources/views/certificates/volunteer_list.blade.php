@extends('layouts.app')

@section('title', 'Generate Certificate')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">Volunteers for {{ $opportunity->oppTitle }}</h1>

    <!-- Bulk Certificate Form -->
    <form action="{{ route('certificates.bulk_form') }}" method="GET" class="bg-white shadow-md rounded-lg p-6">
        @csrf
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead>
                    <tr>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-left text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            Volunteer Name
                        </th>
                        <th class="px-6 py-3 border-b border-gray-200 bg-gray-50 text-right text-xs font-semibold text-gray-600 uppercase tracking-wider">
                            <button type="button" id="selectAll" class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                                Select All
                            </button>
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($registrations as $registration)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 border-b border-gray-200 text-gray-700">
                                {{ $registration->volunteer->vName }}
                            </td>
                            <td class="px-6 py-4 border-b border-gray-200 text-right">
                                <!-- Checkbox for selecting the volunteer -->
                                <input type="checkbox" name="registrations[]" value="{{ $registration->regId }}" class="form-checkbox h-5 w-5 text-blue-600">
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="2" class="px-6 py-4 border-b border-gray-200 text-center text-gray-500">
                                No volunteers available for certificate generation.
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Submit button for generating certificates in bulk -->
        <div class="mt-4 text-right">
            <button type="submit" class="px-4 py-2 bg-blue-600 text-white font-semibold rounded-lg shadow-md hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2">
                Generate Certificate
            </button>
        </div>
    </form>
</div>

<!-- JavaScript for Select All functionality -->
<script>
    document.getElementById('selectAll').addEventListener('click', function() {
        const checkboxes = document.querySelectorAll('input[name="registrations[]"]');
        const isChecked = Array.from(checkboxes).some(checkbox => !checkbox.checked);
        checkboxes.forEach(checkbox => {
            checkbox.checked = isChecked;
        });
    });
</script>
@endsection
