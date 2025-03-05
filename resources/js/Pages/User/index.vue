<script setup>
import Layout from '../App.vue'
import UserTable from '../../component/tables/UserTable.vue'
import UserModal from '../../component/modals/UserModel.vue'

defineProps({
    user: Object,
    errors: Object
})
</script>

<script>
export default {
    data() {
        return {
            isModalVisible: false,
        };
    },
    methods: {
        showModal() {
            this.isModalVisible = true;
        },
        closeModal() {
            this.isModalVisible = false;
        }
    }
}
</script>


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
                                User
                            </div>
                            <h2 class="page-title">
                                User List
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
                        <button type="button" class="btn btn-primary" @click="showModal">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                                fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                                stroke-linejoin="round" class="icon icon-tabler icons-tabler-outline icon-tabler-plus">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                                <path d="M12 5l0 14" />
                                <path d="M5 12l14 0" />
                            </svg>
                            <span>Add New</span>
                        </button>
                    </div>
                    <UserTable :user="user"></UserTable>
                </div>
            </div>
        </div>
        <UserModal v-show="isModalVisible" @close="closeModal" :errors="errors"></UserModal>
    </Layout>
</template>