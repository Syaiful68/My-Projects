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
                                report
                            </div>
                            <h2 class="page-title">
                                Reporting
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end -->

            <!-- body -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="card">
                        <div class="card-body">
                            <form @submit.prevent="GetData">
                                <div class="row">
                                    <div class="col-2">
                                        <label for="" class="form-label">From</label>
                                        <input type="date" class="form-control" v-model="from">
                                    </div>
                                    <div class="col-2">
                                        <label for="" class="form-label">To</label>
                                        <input type="date" class="form-control" v-model="to">
                                    </div>
                                    <div class="col-1">
                                        <div style="margin-top: 27px;">
                                            <button type="submit" class="btn btn-primary">Submit</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <TabelReport :data="data"></TabelReport>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </Layout>
</template>

<script setup>
import Layout from '../Pages/App.vue'
import TabelReport from '../component/tables/ReportTable.vue'
import { ref } from 'vue'
import { router } from '@inertiajs/vue3'

defineProps({
    data: Array
})

function GetData() {
    router.get('/settings/report', { start: from.value, end: to.value }, {
        onSuccess: ({ props }) => {
            reportData.value = props.data;
        }
    })
}

const from = ref('')
const to = ref('')
const reportData = ''

</script>
