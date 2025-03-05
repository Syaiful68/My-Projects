<template>
    <div class="card">
        <div class="card-body">
            <canvas ref="chartCanvas"></canvas>
        </div>
    </div>
</template>

<script setup>
import { ref, onMounted } from 'vue';
import { Chart } from 'chart.js/auto';

const chartCanvas = ref(null);

const props = defineProps({
    total: Array
})

onMounted(() => {
    const label = props.total.map(item => item.is_status);
    const data = props.total.map(item => item.total_cost);

    const ctx = chartCanvas.value.getContext('2d');
    new Chart(ctx, {
        type: 'pie', // or 'line', 'pie', etc.
        data: {
            labels: label,
            datasets: [{
                label: 'Sample Data',
                data: data,
                borderWidth: 1
            }]
        },
    });
});
</script>