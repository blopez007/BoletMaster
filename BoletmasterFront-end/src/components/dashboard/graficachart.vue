<template>
    <v-card
    elevation="12"
    outlined
    shaped
    me="-14">
    <v-card-title>Grafica de lineas de cantidad vendida de dinero mensual</v-card-title>
        <div><canvas id="grafica"></canvas></div>
    </v-card>
</template>

<script>
import Chart from 'chart.js/auto';
import HTTP from '../../utils/HTTP';

export default {
  async mounted(){
    console.log('Component mounted.')
    const ctx = document.getElementById('grafica');
    const response = await HTTP.get("/dashboard/ventasdiarias")

    const grafica = new Chart(ctx, {
    type: 'line',
    data: {
        labels: response.data.data.labels,
        datasets: response.data.data.datasets
        // [{
        //     label: 'Cantidad vendida:$',
        //     data: [2500, 3900, 5000, 12000, 20000, 1233],
            //fill: false,
            
       // }]
    },

    options: {
      
        scales: {
            y: {
                beginAtZero: true
            }
        }
    }
});


grafica;

  }

}
</script>

<style scoped>
#grafica {
    max-height: 200px;
}
</style>