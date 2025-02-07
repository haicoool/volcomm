@extends('layouts.admin-app')

@section('title', 'Manage Organizations')

@section('content')
    <div class="px-8 py-8">
        <h1 class="text-3xl font-bold mb-6 text-gray-100">Organization List</h1>

        <div class="overflow-x-auto shadow-lg rounded-lg">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                <thead class="bg-gray-100">
                <tr>
                    <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">
                        Name
                    </th>
                    <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">
                        Actions
                    </th>
                </tr>
                </thead>
                <tbody class="text-gray-700">
                @foreach($organizations as $organization)
                    <tr class="hover:bg-gray-50 transition-colors duration-200">
                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200 text-base">
                            {{ $organization->organizationName }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                            <div class="flex space-x-2">
                                <!-- View Details Button -->
                                <a href="{{ route('admin.organizations.show', ['id' => $organization->organizationId]) }}"
                                   class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-1 px-3 rounded-md text-sm flex items-center space-x-1 transition duration-200">
                                    <i class="fas fa-eye"></i>
                                    <span>View</span>
                                </a>

                                <!-- Terminate Button -->
                                <form action="{{ route('admin.organizations.terminate', $organization->organizationId) }}"
                                      method="POST" class="terminate-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button"
                                            class="terminate-button bg-red-500 hover:bg-red-600 text-white font-semibold py-1 px-3 rounded-md text-sm flex items-center space-x-1 transition duration-200">
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

    <!-- Include Font Awesome and SweetAlert2 -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script>
        document.querySelectorAll('.terminate-button').forEach(button => {
            button.addEventListener('click', function (e) {
                e.preventDefault();
                const form = this.closest('form');

                Swal.fire({
                    title: 'Confirm Termination',
                    text: "Are you sure you want to terminate this organization? This action cannot be undone.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#3085d6',
                    confirmButtonText: 'Yes, terminate it',
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

@endsection
