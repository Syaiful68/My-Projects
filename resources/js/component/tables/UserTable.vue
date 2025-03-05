<script setup>
import Swal from 'sweetalert2';
import { router } from '@inertiajs/vue3';
defineProps({
    user: Object
})

const deleteUser = (user) => {
    Swal.fire({
        title: "Are you sure?",
        text: "You won't be delete this",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: "#3085d6",
        cancelButtonColor: "#d33",
        confirmButtonText: "Yes"
    }).then((result) => {
        if (result.isConfirmed) {
            router.delete('/settings/user/delete/' + user)
        }
    });
}
</script>

<template>
    <div class="card">
        <div class="card-body border-bottom py-3">
            <div class="d-flex">
                <div class="text-secondary">
                    Show
                    <div class="mx-2 d-inline-block">
                        <input type="text" class="form-control form-control-sm" value="8" size="3"
                            aria-label="Invoices count">
                    </div>
                    entries
                </div>
                <div class="ms-auto text-secondary">
                    Search:
                    <div class="ms-2 d-inline-block">
                        <input type="text" class="form-control form-control-sm" aria-label="Search invoice">
                    </div>
                </div>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table card-table table-vcenter text-nowrap datatable">
                <thead>
                    <tr>
                        <th class="w-1">No. <!-- Download SVG icon from http://tabler-icons.io/i/chevron-up -->
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-sm icon-thick">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M6 15l6 -6l6 6" />
                            </svg>
                        </th>
                        <th>User</th>
                        <th>Name</th>
                        <th>Rules</th>
                        <th>Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item, index in user.data" :key="index">
                        <td>{{ index + 1 }}</td>
                        <td><span class="text-secondary">{{ item.user }}</span></td>
                        <td><a href="invoice.html" class="text-reset" tabindex="-1">{{ item.full_name }}</a></td>
                        <td>
                            {{ item.rules }}
                        </td>
                        <td>
                            <span v-if="item.is_active === 'Active'"
                                class="badge bg-success text-white me-1">Active</span>
                            <span v-if="item.is_active === 'Deactive'"
                                class="badge bg-danger text-white me-1">DeActive</span>
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-info btn-icon me-2"><svg
                                    xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-info-circle">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0" />
                                    <path d="M12 9h.01" />
                                    <path d="M11 12h1v4h1" />
                                </svg></button>
                            <button type="button" class="btn btn-danger btn-icon" @click="deleteUser(item.user)">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                    fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="icon icon-tabler icons-tabler-outline icon-tabler-trash">
                                    <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                    <path d="M4 7l16 0" />
                                    <path d="M10 11l0 6" />
                                    <path d="M14 11l0 6" />
                                    <path d="M5 7l1 12a2 2 0 0 0 2 2h8a2 2 0 0 0 2 -2l1 -12" />
                                    <path d="M9 7v-3a1 1 0 0 1 1 -1h4a1 1 0 0 1 1 1v3" />
                                </svg>
                            </button>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex align-items-center">
            <p class="m-0 text-secondary">Showing <span>{{ user.from }}</span> to <span>{{ user.to }}</span> of
                <span>{{ user.total }}</span>
                Data
            </p>
            <ul class="pagination m-0 ms-auto">
                <li v-for="item, index in user.links" :key="index" class="page-item">
                    <a class="page-link" href="#"> <span v-html="item.label"></span></a>
                </li>
            </ul>
        </div>
    </div>
</template>