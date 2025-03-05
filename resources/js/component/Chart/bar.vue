<template>
    <div class="card">
        <div class="card-body">
            <div class="d-flex">
                <h3 class="card-title">Social {{ currentYear }}</h3>
                <div class="ms-auto">
                    <div class="dropdown">
                        <form @submit.prevent="filter">
                            <select class="form-control" v-model="form.tahun">
                                <option value="2024">2024 Year</option>
                                <option value="2023">2023 Year</option>
                                <option value="2022">2022 Year</option>
                            </select>
                        </form>
                    </div>
                </div>
            </div>
            <canvas ref="chartBar"></canvas>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted, computed, watch, reactive } from 'vue';
import { Chart } from 'chart.js/auto';
import { useForm } from '@inertiajs/vue3';

const currentYear = new Date().getFullYear();

const form = useForm({
    tahun: currentYear
})

const filter = () => {
    console.log(form.tahun)
}

const chartBar = ref(null);
const props = defineProps({
    summary: Array,
    year: String
})

onMounted(() => {
    // const label = props.summary.map(item => item.month);
    const labels = computed(() => {
        return props.summary.map(item => monthNames[item.month - 1]);
    });
    const data = props.summary.map(item => item.data);

    const monthNames = ['January', 'February', 'March', 'April', 'May', 'June', 'July', 'Agust', 'September', 'October', 'November', 'December'];


    const ctx = chartBar.value.getContext('2d');
    new Chart(ctx, {
        type: 'bar', // or 'line', 'pie', etc.
        data: {
            labels: labels.value,
            datasets: [{
                label: 'Sample Data',
                data: data,
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                borderColor: 'rgba(75, 192, 192, 1)',
                borderWidth: 1
            }]
        },
        options: {
            maintainAspectRatio: true, // Menonaktifkan rasio aspek default
            aspectRatio: 4, // Nilai 2 berarti rasio 2:1, Anda bisa menyesuaikannya
            scales: {
                y: {
                    beginAtZero: true
                }
            }
        }
    });
    watch(props, () => {
        if (chartInstance) {
            chartInstance.destroy();
            createChart();
        }
    }, { deep: true });
});
</script>