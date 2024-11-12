@extends('layouts.admin-app')

@section('title', 'Volunteer Details')

@section('content')
    <div class="px-8">
        <h1 class="text-3xl font-bold mb-6 text-gray-800">Volunteer Details</h1>
        
        <div class="overflow-x-auto shadow-lg rounded-lg">
            <table class="min-w-full bg-white border border-gray-200 rounded-lg">
                <thead class="bg-gray-100">
                    <tr>
                        <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">#</th>
                        <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">Name</th>
                        <th class="px-6 py-3 border-b-2 border-gray-200 text-left text-sm font-semibold text-gray-700 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="text-gray-700">
                    @foreach($volunteers as $index => $volunteer)
                        <tr class="hover:bg-gray-50">
                            <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200 text-base">{{ $index + 1 }}</td>
                            <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200 text-base">{{ $volunteer->vName }}</td>
                            <td class="px-6 py-4 whitespace-nowrap border-b border-gray-200">
                                <a href="{{ route('admin.volunteers.show', $volunteer->vId) }}" class="view-details-button bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded-lg inline-flex items-center">
                                    <span class="material-icons mr-2">visibility</span> View Details
                                </a>
                                <form action="{{ route('admin.volunteers.terminate', $volunteer->vId) }}" method="POST" style="display:inline;" class="terminate-form">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="terminate-button bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded-lg inline-flex items-center">
                                        <span class="material-icons mr-2">delete</span> Terminate
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

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

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@endsection
