@extends('layouts.app')

@section('title', 'Kontrol Role User')

@section('content')
<div class="min-h-screen bg-gray-50">
    <div class="max-w-7xl mx-auto py-6 sm:px-6 lg:px-8">
        <div class="px-4 py-6 sm:px-0">
            <!-- Header Section -->
            <div class="mb-8">
                <div class="flex items-center space-x-3 mb-2">
                    <div class="flex-shrink-0 bg-gray-100 rounded-lg p-2.5">
                        <svg class="h-6 w-6 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"></path>
                        </svg>
                    </div>
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Kontrol Role & Status User</h1>
                        <p class="text-sm text-gray-600 mt-0.5">Kelola role dan status pengguna sistem</p>
                    </div>
                </div>
            </div>

            <!-- Bulk Actions -->
            <div class="bg-white shadow-sm rounded-lg border border-gray-200 p-6 mb-6">
                <div class="flex items-center space-x-2 mb-4">
                    <svg class="h-5 w-5 text-gray-700" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6V4m0 2a2 2 0 100 4m0-4a2 2 0 110 4m-6 8a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4m6 6v10m6-2a2 2 0 100-4m0 4a2 2 0 110-4m0 4v2m0-6V4"></path>
                    </svg>
                    <h3 class="text-base font-semibold text-gray-900">Aksi Massal</h3>
                </div>
                <form id="bulk-form" action="{{ route('admin.roles.bulk-update') }}" method="POST" data-confirm-submit="Apakah Anda yakin ingin menerapkan perubahan ke user yang dipilih?">
                    @csrf
                    <div class="flex items-center space-x-4">
                        <select name="action" id="bulk-action" class="px-4 py-2.5 border border-gray-300 rounded-lg focus:ring-2 focus:ring-gray-900 focus:border-gray-900 text-sm">
                            <option value="">Pilih Aksi</option>
                            <option value="activate">Aktifkan User</option>
                            <option value="deactivate">Nonaktifkan User</option>
                            <option value="make_admin">Jadikan Admin</option>
                            <option value="make_student">Jadikan Student</option>
                        </select>
                        <button type="submit" id="bulk-submit" disabled class="px-6 py-2.5 bg-gray-900 text-white rounded-lg hover:bg-gray-800 transition-colors font-medium disabled:opacity-50 disabled:cursor-not-allowed text-sm">
                            Terapkan ke yang Dipilih
                        </button>
                        <span id="selected-count" class="text-sm text-gray-600">0 user dipilih</span>
                    </div>
                </form>
            </div>

            <div class="bg-white shadow-sm rounded-lg border border-gray-200 overflow-hidden">
                <table class="min-w-full divide-y divide-gray-200">
                    <thead class="bg-gray-50">
                        <tr>
                            <th class="px-6 py-3.5 text-left">
                                <input type="checkbox" id="select-all" class="h-4 w-4 text-gray-900 focus:ring-gray-900 border-gray-300 rounded">
                            </th>
                            <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Nama</th>
                            <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Email</th>
                            <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Role</th>
                            <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Status</th>
                            <th class="px-6 py-3.5 text-left text-xs font-semibold text-gray-700 uppercase tracking-wider">Progress</th>
                            <th class="px-6 py-3.5 text-right text-xs font-semibold text-gray-700 uppercase tracking-wider">Aksi</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200">
                        @forelse($users as $user)
                            <tr class="hover:bg-gray-50 transition-colors {{ $user->status === 'inactive' ? 'opacity-60' : '' }}">
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <input type="checkbox" name="user_ids[]" value="{{ $user->id }}" class="user-checkbox h-4 w-4 text-gray-900 focus:ring-gray-900 border-gray-300 rounded">
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <div class="text-sm font-medium text-gray-900">{{ $user->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $user->username }}</div>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">{{ $user->email }}</td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <form action="{{ route('admin.roles.update', $user) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <select name="role" onchange="confirmRoleChange(this)" 
                                            class="text-xs font-semibold px-2.5 py-1 rounded border border-gray-300 focus:ring-2 focus:ring-gray-900 focus:border-gray-900 bg-white text-gray-700">
                                            <option value="admin" {{ $user->role === 'admin' ? 'selected' : '' }}>Admin</option>
                                            <option value="student" {{ $user->role === 'student' ? 'selected' : '' }}>Student</option>
                                        </select>
                                        <input type="hidden" name="status" value="{{ $user->status }}">
                                    </form>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap">
                                    <form action="{{ route('admin.roles.update', $user) }}" method="POST" class="inline">
                                        @csrf
                                        @method('PUT')
                                        <select name="status" onchange="confirmStatusChange(this)" 
                                            class="text-xs font-semibold px-2.5 py-1 rounded border border-gray-300 focus:ring-2 focus:ring-gray-900 focus:border-gray-900 bg-white text-gray-700">
                                            <option value="active" {{ $user->status === 'active' ? 'selected' : '' }}>Active</option>
                                            <option value="inactive" {{ $user->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                        <input type="hidden" name="role" value="{{ $user->role }}">
                                    </form>
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-600">
                                    {{ $user->student_modules_count ?? 0 }} modul
                                </td>
                                <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                                    <a href="{{ route('admin.users.edit', $user) }}" class="text-gray-700 hover:text-gray-900 font-medium">Edit</a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" class="px-6 py-16 text-center">
                                    <svg class="mx-auto h-12 w-12 text-gray-400 mb-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z"></path>
                                    </svg>
                                    <h3 class="text-sm font-medium text-gray-900 mb-1">Belum ada user</h3>
                                    <p class="text-sm text-gray-500">Tidak ada data user untuk ditampilkan</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
                @if($users->hasPages())
                    <div class="px-6 py-4 bg-gray-50 border-t border-gray-200">
                        {{ $users->links() }}
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectAll = document.getElementById('select-all');
    const checkboxes = document.querySelectorAll('.user-checkbox');
    const bulkSubmit = document.getElementById('bulk-submit');
    const selectedCount = document.getElementById('selected-count');
    const bulkForm = document.getElementById('bulk-form');

    function updateCount() {
        const checked = document.querySelectorAll('.user-checkbox:checked');
        const count = checked.length;
        selectedCount.textContent = count + ' user dipilih';
        bulkSubmit.disabled = count === 0 || !document.getElementById('bulk-action').value;
    }

    selectAll.addEventListener('change', function() {
        checkboxes.forEach(cb => cb.checked = this.checked);
        updateCount();
    });

    checkboxes.forEach(cb => {
        cb.addEventListener('change', updateCount);
    });

    document.getElementById('bulk-action').addEventListener('change', function() {
        bulkSubmit.disabled = document.querySelectorAll('.user-checkbox:checked').length === 0 || !this.value;
    });

    bulkForm.addEventListener('submit', function(e) {
        e.preventDefault();
        const checked = document.querySelectorAll('.user-checkbox:checked');
        if (checked.length === 0) {
            if (typeof Swal !== 'undefined') {
                Swal.fire({
                    icon: 'warning',
                    title: 'Peringatan',
                    text: 'Pilih minimal satu user',
                    confirmButtonText: 'OK',
                    customClass: {
                        popup: 'minimal-swal-popup',
                        confirmButton: 'minimal-swal-confirm'
                    }
                });
            } else {
                alert('Pilih minimal satu user');
            }
            return;
        }

        const action = document.getElementById('bulk-action').value;
        const actionText = {
            'activate': 'mengaktifkan',
            'deactivate': 'menonaktifkan',
            'make_admin': 'menjadikan admin',
            'make_student': 'menjadikan student'
        }[action] || 'mengubah';

        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: 'Konfirmasi',
                text: `Apakah Anda yakin ingin ${actionText} ${checked.length} user yang dipilih?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Terapkan',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                customClass: {
                    popup: 'minimal-swal-popup',
                    confirmButton: 'minimal-swal-confirm',
                    cancelButton: 'minimal-swal-cancel'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    checked.forEach(cb => {
                        const input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = 'user_ids[]';
                        input.value = cb.value;
                        bulkForm.appendChild(input);
                    });
                    bulkForm.submit();
                }
            });
        } else {
            if (confirm(`Apakah Anda yakin ingin ${actionText} ${checked.length} user yang dipilih?`)) {
                checked.forEach(cb => {
                    const input = document.createElement('input');
                    input.type = 'hidden';
                    input.name = 'user_ids[]';
                    input.value = cb.value;
                    bulkForm.appendChild(input);
                });
                bulkForm.submit();
            }
        }
    });

    function confirmRoleChange(select) {
        const form = select.closest('form');
        const newRole = select.value;
        const userName = form.closest('tr').querySelector('.text-sm.font-medium').textContent;
        const oldValue = select.options[select.selectedIndex === 0 ? 1 : 0].value;
        
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: 'Konfirmasi',
                text: `Apakah Anda yakin ingin mengubah role ${userName} menjadi ${newRole}?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Ubah',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                customClass: {
                    popup: 'minimal-swal-popup',
                    confirmButton: 'minimal-swal-confirm',
                    cancelButton: 'minimal-swal-cancel'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                } else {
                    select.value = oldValue;
                }
            });
        } else {
            if (confirm(`Apakah Anda yakin ingin mengubah role menjadi ${newRole}?`)) {
                form.submit();
            } else {
                select.value = oldValue;
            }
        }
    }

    function confirmStatusChange(select) {
        const form = select.closest('form');
        const newStatus = select.value;
        const userName = form.closest('tr').querySelector('.text-sm.font-medium').textContent;
        const oldValue = select.options[select.selectedIndex === 0 ? 1 : 0].value;
        
        if (typeof Swal !== 'undefined') {
            Swal.fire({
                title: 'Konfirmasi',
                text: `Apakah Anda yakin ingin mengubah status ${userName} menjadi ${newStatus}?`,
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: 'Ya, Ubah',
                cancelButtonText: 'Batal',
                reverseButtons: true,
                customClass: {
                    popup: 'minimal-swal-popup',
                    confirmButton: 'minimal-swal-confirm',
                    cancelButton: 'minimal-swal-cancel'
                }
            }).then((result) => {
                if (result.isConfirmed) {
                    form.submit();
                } else {
                    select.value = oldValue;
                }
            });
        } else {
            if (confirm(`Apakah Anda yakin ingin mengubah status menjadi ${newStatus}?`)) {
                form.submit();
            } else {
                select.value = oldValue;
            }
        }
    }
});
</script>
@endsection

