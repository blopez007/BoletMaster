<template>
    <v-card elevation="12">
    <v-card-title>Grafica de lineas de cantidad vendida de dinero mensual</v-card-title>
        <div><canvas id="grafica5"></canvas></div>
    </v-card>
</template>

<script>
import Chart from 'chart.js/auto';

export default {
  mounted(){
    console.log('Component mounted.')
    const ctx5 = document.getElementById('grafica5');

    const grafica5 = new Chart(ctx5, {
    type: 'bar',
    data: {
        labels: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio'],
        datasets: [{
            label: 'Cantidad vendida:$',
            data: [2500, 3900, 5000, 12000, 20000, 1233],
            fill: false,
            backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
            ],
            borderColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ],
            borderWidth: 3
        }]
    },

    options: {
      
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});


grafica5;

  }

}
</script>