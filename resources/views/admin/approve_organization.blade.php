<!-- resources/views/admin/approve_organization.blade.php -->

@extends('layouts.admin-app')

@section('content')
    <div class="container mx-auto p-6">
        <h1 class="text-3xl font-bold text-gray-100 mb-6">Approved Organizations</h1>

        @if($organizations->isEmpty())
            <p class="text-gray-500">It seems there are currently no organization registrations</p>
        @else
            <div class="overflow-x-auto bg-white shadow-lg rounded-lg">
                <table class="min-w-full bg-white border border-gray-200">
                    <thead>
                        <tr class="bg-gray-100 text-gray-600 uppercase text-sm leading-normal">
                            <th class="py-3 px-6 text-left">Organization Name</th>
                            <th class="py-3 px-6 text-left">Email</th>
                            <th class="py-3 px-6 text-center">Status</th>
                            <th class="py-3 px-6 text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="text-gray-700 text-sm font-light">
                        @foreach($organizations as $organization)
                            <tr class="border-b border-gray-200 hover:bg-gray-100">
                                <td class="py-3 px-6 text-left whitespace-nowrap">
                                    {{ $organization->organizationName }}
                                </td>
                                <td class="py-3 px-6 text-left">
                                    {{ $organization->organizationEmail }}
                                </td>
                                <td class="py-3 px-6 text-center text-yellow-500 font-semibold">
                                    Pending Approval
                                </td>
                                <td class="py-3 px-6 text-center">
                                    <button onclick="confirmAction('accept', '{{ route('admin.organizations.accept', $organization->organizationId) }}')" class="bg-green-500 text-white px-3 py-1 rounded hover:bg-green-600 focus:outline-none">Accept</button>
                                    <button onclick="confirmAction('reject', '{{ route('admin.organizations.reject', $organization->organizationId) }}')" class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600 focus:outline-none">Reject</button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function confirmAction(action, url) {
            let actionText = action === 'accept' ? 'Accept' : 'Reject';
            let actionColor = action === 'accept' ? '#28a745' : '#dc3545';

            Swal.fire({
                title: `Are you sure?`,
                text: `You are about to ${actionText.toLowerCase()} this organization.`,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: actionColor,
                cancelButtonColor: '#6c757d',
                confirmButtonText: `Yes, ${actionText}`,
                cancelButtonText: 'Cancel'
            }).then((result) => {
                if (result.isConfirmed) {
                    // Submit the form using a hidden form to maintain CSRF token integrity
                    let form = document.createElement('form');
                    form.action = url;
                    form.method = 'POST';
                    form.style.display = 'none';
                    let csrfField = document.createElement('input');
                    csrfField.type = 'hidden';
                    csrfField.name = '_token';
                    csrfField.value = '{{ csrf_token() }}';
                    form.appendChild(csrfField);
                    document.body.appendChild(form);
                    form.submit();
                }
            });
        }
    </script>
@endsection
