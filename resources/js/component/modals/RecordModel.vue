<script>
export default {
    methods: {
        close() {
            this.$emit('close');
        },
    }
};
</script>

<script setup>
import { router, useForm } from '@inertiajs/vue3';
import Swal from 'sweetalert2';
import { usePage } from '@inertiajs/vue3';

const page = usePage()

const props = defineProps({
    armada: Object,
    errors: Object,
})

const formData = useForm({
    plat: null,
    cost: null,
    driver: null,
    km: null,
    description: null,
    picture: null
})


const Submit = () => {
    router.post('/fuel', formData, {
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
            router.get('/fuel')
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
                    <h5 class="modal-title">New report</h5>
                    <button type="button" class="btn-close" @click="close" aria-label="Close"></button>
                </div>
                <form @submit.prevent="Submit">
                    <div class="modal-body">
                        <div class="mb-3">
                            <label class="form-label">Plat</label>
                            <select class="form-control" :class="{ 'is-invalid': errors.plat }" v-model="formData.plat">
                                <option value="">Choise</option>
                                <option v-for="item, index in armada" :key="index" :value="item.id">{{
                                    item.plat_number
                                }}</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Driver</label>
                            <input type="text" class="form-control" :class="{ 'is-invalid': errors.driver }"
                                v-model="formData.driver">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Km</label>
                            <input type="number" class="form-control" :class="{ 'is-invalid': errors.km }"
                                v-model="formData.km">
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Cost</label>
                            <input type="number" class="form-control" :class="{ 'is-invalid': errors.cost }"
                                v-model="formData.cost">
                        </div>
                        <div class="mb-3">
                            <div>
                                <label class="form-label">Description</label>
                                <textarea class="form-control" rows="3" :class="{ 'is-invalid': errors.description }"
                                    v-model="formData.description"></textarea>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Picture</label>
                            <input type="file" class="form-control" :class="{ 'is-invalid': errors.picture }"
                                @input="formData.picture = $event.target.files[0]">
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