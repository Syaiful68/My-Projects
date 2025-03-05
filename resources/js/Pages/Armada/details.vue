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
                                Overview
                            </div>
                            <h2 class="page-title">
                                Detail Armada
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end -->

            <!-- body -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="row">
                        <div class="col-lg-6 col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">profile</h4>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label">Nik Owner</label>
                                        <input type="text" class="form-control mt-1" :value="props.armada[0].nik"
                                            disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Owner</label>
                                        <input type="text" class="form-control mt-1" :value="props.armada[0].owner"
                                            disabled>
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="d-flex justify-content-end">
                                        <button type="button" @click="back" class="btn btn-primary">Back</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">Vehicle</h4>
                                </div>
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label">Vehicle</label>
                                        <input type="text" class="form-control mt-1" :value="props.armada[0].vehicle"
                                            disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Fuel</label>
                                        <input type="text" class="form-control mt-1" :value="props.armada[0].fuel"
                                            disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label clas="form-label">Contract Date</label>
                                        <input type="text" class="form-control mt-1"
                                            :value="props.armada[0].contract_date" disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Contract</label>
                                        <a :href="'http://127.0.0.1:8000' + props.armada[0].contract_path"
                                            class="btn btn-outline">{{ props.armada[0].contract }}</a>
                                    </div>
                                </div>
                                <div class="card-footer">

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>

<script setup>
import Layout from '../App.vue'
import { router } from '@inertiajs/vue3';

const props = defineProps({
    armada: Object
})

const back = () => {
    router.get('/armada')
}
</script>