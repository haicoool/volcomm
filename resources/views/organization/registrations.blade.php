@extends('layouts.app')

@section('content')
    <h1 class="text-3xl font-bold mb-6">Volunteer List</h1>

    <form id="attendanceForm" action="{{ route('attendance.store') }}" method="POST" class="space-y-4">
        @csrf
        <input type="hidden" name="oppId" value="{{ $oppId }}">

        <div class="overflow-x-auto">
            <table class="min-w-full bg-white shadow-md rounded-lg">
                <thead>
                <tr class="bg-gray-200">
                    <th class="py-3 px-4 text-left text-gray-600 font-semibold">#</th>
                    <th class="py-3 px-4 text-left text-gray-600 font-semibold">Volunteer Name</th>
                    <th class="py-3 px-4 text-left text-gray-600 font-semibold">Skill</th>
                    <th class="py-3 px-4 text-center text-gray-600 font-semibold">Confirm Attendance</th>
                </tr>
                </thead>
                <tbody>
                @forelse($registrations as $index => $registration)
                    <tr class="border-b hover:bg-gray-100">
                        <td class="py-4 px-4 text-left">{{ $index + 1 }}</td>
                        <td class="py-4 px-4 text-left">{{ $registration->vName }}</td>
                        <td class="py-4 px-4 text-left">{{ $registration->vSkill }}</td>
                        <td class="py-4 px-4 text-center">
                            <input type="checkbox" name="registrations[]" value="{{ $registration->regId }}" id="registration-{{ $registration->regId }}">
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="py-4 px-4 text-center text-gray-500">No volunteers available for attendance confirmation.</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>

        <div class="flex justify-between mt-4">
            <a href="{{ route('attendance.confirm') }}" class="inline-block px-4 py-2 text-white bg-gray-400 rounded hover:bg-gray-500 transition duration-300">Back to Event List</a>
            <button type="submit" class="inline-block px-4 py-2 text-white bg-green-600 rounded hover:bg-green-700 transition duration-300" @if($registrations->isEmpty()) disabled @endif>Confirm Attendance</button>
        </div>
    </form>

    @section('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script>
            document.getElementById('attendanceForm').addEventListener('submit', function(e) {
                e.preventDefault(); // Prevent default form submission

                Swal.fire({
                    title: 'Confirm Attendance',
                    text: "Are you sure you want to confirm attendance for the selected volunteers?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, confirm it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        this.submit(); // Submit the form if confirmed
                        Swal.fire(
                            'Confirmed!',
                            'Attendance has been confirmed.',
                            'success'
                        );
                    }
                });
            });
        </script>
    @endsection
@endsection
