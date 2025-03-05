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
                                Fuel/detail
                            </div>
                            <h2 class="page-title">
                                Fuel Details
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
                                <div class="card-body">
                                    <div class="mb-3">
                                        <label class="form-label">Code Fuel</label>
                                        <input type="text" class="form-control mt-1" :value="props.fuel[0].code"
                                            disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Driver</label>
                                        <input type="text" class="form-control mt-1" :value="props.fuel[0].driver"
                                            disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Keterangan</label>
                                        <textarea class="form-control"
                                            disabled>{{ props.fuel[0].description }}</textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Cost</label>
                                        <input type="text" class="form-control mt-1" :value="props.fuel[0].cost"
                                            disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">First Mile</label>
                                        <input type="text" class="form-control mt-1" :value="props.fuel[0].first_mile"
                                            disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Last Mile</label>
                                        <input type="text" class="form-control mt-1" :value="props.fuel[0].last_mile"
                                            disabled>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Plat Number</label>
                                        <input type="text" class="form-control mt-1"
                                            :value="props.fuel[0].armada.plat_number" disabled>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="mb-3">
                                        <img :src="'http://127.0.0.1:8000' + props.fuel[0].path_picture"
                                            :alt="props.fuel[0].picture" sizes="100">
                                    </div>
                                </div>
                                <div class="card-footer">
                                    <div class="d-flex justify-content-end">
                                        <button type="button" @click="back" class="btn btn-primary">Back</button>
                                    </div>
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
import { router } from '@inertiajs/vue3';
import Layout from '../App.vue'

const props = defineProps({
    fuel: Array
})

const back = () => {
    router.get('/fuel')
}

</script>
