<template>
    <v-card
    elevation="12">
    <v-card-title>Grafica de lineas de cantidad vendida de dinero mensual</v-card-title>
        <div><canvas id="grafica1"></canvas></div>
</v-card>
</template>

<script>
import Chart from 'chart.js/auto';
import HTTP from '../../utils/HTTP';

export default {
  async mounted(){
    console.log('Component mounted.')
    const ctx1 = document.getElementById('grafica1');
    const response = await HTTP.get('/dashboard/ventasporeventos')

    const grafica1 = new Chart(ctx1, {
    type: 'bar',
    data: {
        labels: response.data.data.labels,
        datasets: response.data.data.datasets,
          
    },

    options: {
      
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});


grafica1;

  }

}
</script>