@extends('layouts.admin-app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-gray-100 mb-6">Manage Admins</h1>

        <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
            <table class="min-w-full bg-white border border-gray-200">
                <thead>
                <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                    <th class="py-3 px-6 text-left">Admin Name</th>
                    <th class="py-3 px-6 text-left">Admin Email</th>
                    <th class="py-3 px-6 text-center">Actions</th>
                </tr>
                </thead>
                <tbody class="text-gray-700 text-sm font-light">
                @foreach($admins as $admin)
                    <tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-left whitespace-nowrap">{{ $admin->adminName }}</td>
                        <td class="py-3 px-6 text-left">{{ $admin->adminEmail }}</td>
                        <td class="py-3 px-6 text-center">
                            <a href="{{ route('admin.edit', $admin->adminId) }}" class="text-blue-500 hover:text-blue-600">Edit</a>
                            <button onclick="confirmDelete('{{ route('admin.delete', $admin->adminId) }}')" class="text-red-500 hover:text-red-600 ml-4">Delete</button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmDelete(url) {
            Swal.fire({
                title: 'Are you sure?',
                text: "This action will permanently delete the admin.",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Yes, delete it!',
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit form using a hidden form to maintain CSRF token integrity
                    let form = document.createElement('form');
                    form.action = url;
                    form.method = 'POST';
                    form.style.display = 'none';

                    // CSRF token
                    let csrfField = document.createElement('input');
                    csrfField.type = 'hidden';
                    csrfField.name = '_token';
                    csrfField.value = '{{ csrf_token() }}';
                    form.appendChild(csrfField);

                    // Method override for DELETE
                    let methodField = document.createElement('input');
                    methodField.type = 'hidden';
                    methodField.name = '_method';
                    methodField.value = 'DELETE';
                    form.appendChild(methodField);

                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }
    </script>
@endsection
