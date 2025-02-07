@extends('layouts.admin-app')

@section('title', 'Volunteer Details')

@section('content')
    <div class="px-8 mt-10">
        <h1 class="text-3xl font-bold mb-8 text-gray-100">Volunteer List</h1>

        <!-- Table Container -->
        <div class="overflow-x-auto shadow-md rounded-lg">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                <!-- Table Header -->
                <thead class="bg-blue-100 text-blue-800">
                <tr>
                    <th class="px-6 py-4 border-b text-left text-sm font-semibold uppercase tracking-wider">#</th>
                    <th class="px-6 py-4 border-b text-left text-sm font-semibold uppercase tracking-wider">Name</th>
                    <th class="px-6 py-4 border-b text-left text-sm font-semibold uppercase tracking-wider">Actions</th>
                </tr>
                </thead>

                <!-- Table Body -->
                <tbody class="text-gray-700">
                @foreach($volunteers as $index => $volunteer)
                    <tr class="hover:bg-gray-100 transition duration-200">
                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200 text-base">{{ $index + 1 }}</td>
                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200 text-base">{{ $volunteer->vName }}</td>
                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                            <div class="flex space-x-2">
                                <!-- View Details Button -->
                                <a href="{{ route('admin.volunteers.show', $volunteer->vId) }}"
                                   class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-1 px-3 rounded-md text-sm flex items-center space-x-1">
                                    <i class="fas fa-eye"></i>
                                    <span>View</span>
                                </a>

                                <!-- Terminate Button -->
                                <form action="{{ route('admin.volunteers.terminate', $volunteer->vId) }}" method="POST" class="terminate-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button"
                                            class="terminate-button bg-red-500 hover:bg-red-600 text-white font-semibold py-1 px-3 rounded-md text-sm flex items-center space-x-1">
                                        <i class="fas fa-trash-alt"></i>
                                        <span>Terminate</span>
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <!-- Termination Confirmation Script -->
    <script>
        document.querySelectorAll('.terminate-button').forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                const form = this.closest('form');

                Swal.fire({
                    title: 'Confirm Termination',
                    text: "Are you sure you want to terminate this volunteer? This action cannot be undone.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, terminate',
                    cancelButtonText: 'Cancel'
                }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire({
                            title: 'Processing...',
                            text: 'Please wait while we process your request.',
                            icon: 'info',
                            showConfirmButton: false,
                            allowOutsideClick: false,
                            didOpen: () => {
                                Swal.showLoading();
                                form.submit();
                            }
                        });
                    }
                });
            });
        });
    </script>

    <!-- Include Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <!-- SweetAlert2 -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
