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
                                Armada
                            </div>
                            <h2 class="page-title">
                                Armada
                            </h2>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end -->

            <!-- body -->
            <div class="page-body">
                <div class="container-xl">
                    <div class="mb-3">
                        <Link class="btn btn-primary" href="/armada/create">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                            <path d="M12 5l0 14" />
                            <path d="M5 12l14 0" />
                        </svg>
                        <span>Add New</span>
                        </Link>
                    </div>
                    <TableArmada :armada="props.armada" @search="searching"></TableArmada>
                </div>
            </div>
        </div>
    </Layout>
</template>


<script setup>
import Layout from '../App.vue'
import TableArmada from '../../component/tables/ArmadaTable.vue'
import Swal from 'sweetalert2';
import { Link, router } from '@inertiajs/vue3';
import { watchEffect } from 'vue'
import { usePage } from '@inertiajs/vue3'

const page = usePage()

const props = defineProps({
    armada: Object,
})
const searching = (key) => {
    router.get('/armada', { q: key }, { preserveState: true })
}

watchEffect(() => {
    let getMessage = page.props.flash

    if (getMessage.success) {
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 2500,
            timerProgressBar: true,
        });
        Toast.fire({
            icon: "success",
            title: getMessage.success
        });
    }

    if (getMessage.destroy) {
        Swal.fire({
            title: "Delete",
            text: getMessage.destroy,
            icon: "error"
        });

    }
    if (getMessage.error) {
        const Toast = Swal.mixin({
            toast: true,
            position: "top-end",
            showConfirmButton: false,
            timer: 2500,
            timerProgressBar: true,
        });
        Toast.fire({
            icon: "warning",
            title: getMessage.error
        });

    }
})
</script>