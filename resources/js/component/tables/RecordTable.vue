<script setup>
import { Link, router } from '@inertiajs/vue3';
import { throttle } from 'lodash';
import { ref, watch } from 'vue';
defineProps({
    record: Object,
})

const info = (fuel) => {
    router.get('/fuel/details/' + fuel)
}

const emit = defineEmits(['search'])

const search = ref('')

watch(search, throttle(function (value) {
    emit('search', value)
}, 1500))
</script>
<template>
    <div class="card">
        <div class="card-body border-bottom py-3">
            <div class="d-flex">

                <div class="ms-auto text-secondary">
                    Search:
                    <div class="ms-2 d-inline-block">
                        <input type="text" v-model="search" class="form-control form-control-sm"
                            aria-label="Search invoice">
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
                        <th>Tag Code</th>
                        <th>Plat Number</th>
                        <th>Cost</th>
                        <th>Last Mile</th>
                        <th>Driver</th>
                        <th>Status</th>
                        <th class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr v-for="item, index in record.data" :key="index">
                        <td><span class="text-secondary">{{ index + record.from }}</span></td>
                        <td>{{ item.code }}</td>
                        <td>
                            {{ item.armada.plat_number }}
                        </td>
                        <td>
                            {{ item.cost }}
                        </td>
                        <td>
                            {{ item.last_mile }} Km
                        </td>
                        <td>
                            {{ item.driver }}
                        </td>
                        <td>
                            <span v-if="item.is_status === 'Paid'" class="badge bg-success text-white me-1">{{
                                item.is_status
                            }}</span>
                            <span v-if="item.is_status === 'UnPaid'" class="badge bg-warning text-white me-1">{{
                                item.is_status
                            }}</span>
                            <span v-if="item.is_status === 'Cancel'" class="badge bg-danger text-white me-1">{{
                                item.is_status
                            }}</span>
                        </td>
                        <td class="text-center">
                            <button type="button" class="btn btn-info me-2" @click="info(item.code)">info</button>
                            <Link type="button" class="btn btn-danger" :href="'/fuel/details/' + item.code">delete
                            </Link>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex align-items-center">
            <p class="m-0 text-secondary">Showing <span>{{ record.from }}</span> to <span>{{ record.to }}</span> of
                <span>{{
                    record.total }}</span>
                Data
            </p>
            <ul class="pagination m-0 ms-auto">
                <li v-for="item, index in record.links" :key="index" class="page-item">
                    <a class="page-link" :href="item.url"><span v-html="item.label"></span></a>
                </li>
            </ul>
        </div>
    </div>
</template>