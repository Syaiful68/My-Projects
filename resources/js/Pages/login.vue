<script setup>
import { router, useForm } from '@inertiajs/vue3';


const form = useForm({
    user: null,
    password: null
})

const SubmitLogin = () => {
    router.post('/login', form)
}
</script>

<template>
    <div class="page page-center">
        <div class="container container-tight py-4">
            <div class="card card-md">
                <div class="card-body">
                    <h2 class="h2 text-center mb-4">Login to your account</h2>
                    <form @submit.prevent="SubmitLogin">
                        <div class="mb-3">
                            <label class="form-label">User</label>
                            <input type="text" class="form-control" placeholder="Your User" autocomplete="off"
                                v-model="form.user">
                        </div>
                        <div class="mb-2">
                            <label class="form-label">
                                Password
                            </label>
                            <div class="input-group input-group-flat">
                                <input type="password" class="form-control" placeholder="Your password"
                                    autocomplete="off" v-model="form.password">
                            </div>
                        </div>
                        <div class="form-footer">
                            <button type="submit" class="btn btn-primary w-100">Sign in</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>