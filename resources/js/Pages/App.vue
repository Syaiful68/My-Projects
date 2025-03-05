<template>
    <div class="page">
        <!-- sidebar -->
        <sidebar></sidebar>
        <!-- end -->

        <!-- header -->

        <header class="navbar navbar-expand-sm navbar-light d-print-none">
            <div class="container-xl">
                <div class="navbar-nav ms-auto flex-row order-md-last">
                    <div class="nav-item">
                        <a href="#" class="nav-link d-flex lh-1 text-reset p-0">
                            <div class="d-none d-xl-block ps-2">
                                <div>{{ user.full_name }}</div>
                                <div class="mt-1 small text-secondary">{{ user.rules }}</div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </header>
        <!-- end -->
        <!-- content -->
        <slot :errors="errors"></slot>
        <!-- end -->
    </div>
</template>


<script setup>
import sidebar from '../component/partials/sidebar.vue';


import { computed } from 'vue'
import { usePage } from '@inertiajs/vue3'

const page = usePage()

const user = computed(() => page.props.auth.user)

const errors = defineProps({
    errors: Object
})
</script>