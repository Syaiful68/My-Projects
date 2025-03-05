<template>
    <header class="navbar navbar-expand-sm navbar-light d-print-none">
        <div class="container-xl">
            <div class="navbar-nav ms-auto flex-row order-md-last">
                <div class="nav-item">
                    <a href="#" class="nav-link d-flex lh-1 text-reset p-0">
                        <span class="avatar avatar-sm" style="background-image: url(...)"></span>
                        <div class="d-none d-xl-block ps-2">
                            <div>{{ user.full_name }}</div>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </header>
</template>

<script setup>
import { computed } from 'vue'
import { usePage } from '@inertiajs/vue3'

const page = usePage()

const user = computed(() => page.props.auth.user)
</script>
