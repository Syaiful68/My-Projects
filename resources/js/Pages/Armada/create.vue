<template>
    <Layout>
        <!-- slot -->
        <div class="page-wrapper">
            <!-- Page header -->
            <div class="page-header d-print-none">
                <div class="container-xl">
                    <div class="row g-2 align-items-center">
                        <div class="col">
                            <!-- Page pre-title -->
                            <div class="page-pretitle">
                                armada/create
                            </div>
                            <h2 class="page-title">
                                Create New Armada
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end -->

            <!-- body -->
            <div class="page-body">
                <div class="container-xl">
                    <form @submit.prevent="SaveForm">
                        <div class="row">
                            <div class="col-lg-6 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label">Nik</label>
                                            <input type="text" class="form-control mt-1"
                                                :class="{ 'is-invalid': errors.nik }" v-model="form.nik">
                                            <div class="invalid-feedback">{{ errors.nik }}</div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Owner</label>
                                            <input type="text" class="form-control mt-1"
                                                :class="{ 'is-invalid': errors.owner }" v-model="form.owner">
                                            <div class="invalid-feedback">{{ errors.owner }}</div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Address</label>
                                            <input type="text" class="form-control mt-1"
                                                :class="{ 'is-invalid': errors.address }" v-model="form.address">
                                            <div class="invalid-feedback">{{ errors.address }}</div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="mb-3">
                                            <label class="form-label">Plat Number</label>
                                            <input type="text" class="form-control mt-1"
                                                :class="{ 'is-invalid': errors.plat }" v-model="form.plat">
                                            <div class="invalid-feedback">{{ errors.plat }}</div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Vehicle</label>
                                            <input type="text" class="form-control mt-1"
                                                :class="{ 'is-invalid': errors.vehicle }" v-model="form.vehicle">
                                            <div class="invalid-feedback">{{ errors.vehicle }}</div>
                                        </div>
                                        <div class="mb-3">
                                            <label clas="form-label">Fuel</label>
                                            <input type="text" class="form-control mt-1"
                                                :class="{ 'is-invalid': errors.fuel }" v-model="form.fuel">
                                            <div class="invalid-feedback">{{ errors.fuel }}</div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">Contract Date</label>
                                            <input type="date" class="form-control mt-1"
                                                :class="{ 'is-invalid': errors.contract }" v-model="form.contract">
                                            <div class="invalid-feedback">{{ errors.contract }}</div>
                                        </div>
                                        <div class="mb-3">
                                            <label class="form-label">File</label>
                                            <input type="file" class="form-control"
                                                :class="{ 'is-invalid': errors.contract_file }"
                                                @input="form.contract_file = $event.target.files[0]">
                                            <div class="invalid-feedback">{{ errors.contract_file }}</div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <div class="d-flex justify-content-end">
                                            <button type="submit" class="btn btn-primary">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </Layout>
</template>

<script setup>
import { router, useForm } from '@inertiajs/vue3';
import Layout from '../App.vue'

defineProps({
    errors: Object
})

const form = useForm({
    nik: null,
    owner: null,
    address: null,
    plat: null,
    vehicle: null,
    fuel: null,
    contract: null,
    contract_file: null,
})

const SaveForm = async () => {
    router.post('/armada', form)
}

</script>