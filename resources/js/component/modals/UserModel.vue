<script>
export default {
    methods: {
        close() {
            this.$emit('close');
        },
    },
};
</script>
<script setup>
import { router, useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2';

defineProps({
    errors: Object
})

const form = useForm({
    nik: null,
    name: null,
    user: null,
    password: null
})


const SubmitUser = () => {
    router.post('/settings/user', form, {
        onSuccess: () => {
            const Toast = Swal.mixin({
                toast: true,
                position: "top-end",
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            });
            Toast.fire({
                icon: "success",
                title: page.props.flash.success
            });
            router.get('/settings/user')
        }
    })
}
</script>

<style scoped>
.modal {
    display: block;
}
</style>

<template>
    <div class="modal modal-blur fade show" id="modal-report" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">New User</h5>
                    <button type="button" class="btn-close" @click="close" aria-label="Close"></button>
                </div>
                <form @submit.prevent="SubmitUser">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Nik</label>
                            <input type="text" class="form-control" v-model="form.nik">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-control" v-model="form.name">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">User</label>
                            <input type="text" class="form-control" v-model="form.user">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Password</label>
                            <input type="password" class="form-control" v-model="form.password">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" @click="close">
                            Cancel
                        </button>
                        <button type="submit" class="btn btn-primary ms-auto">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</template>