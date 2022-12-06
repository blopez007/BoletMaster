<template>
    
    <v-tabs vertical class="ma-3">
        <v-tab class="tabla">
            <v-icon left color="#1A374D"> mdi-account-box </v-icon>
            <h4 class="tab">Mi Cuenta</h4>
        </v-tab>
        
        <v-tab-item style="background: #f6f6f6">
            <h2 class="subtitulo tab">Gestion de la cuenta.</h2>
            <br>
            <h4 class="texto tab">Informacion de la cuenta.</h4>
            <br>
            <v-container class="tamano">
            <v-simple-table>
               
                <template v-slot:default>
                    
                    <thead class="thead">
                        <tr class="tr">
                            <th class="text-md-center white--text">Nombres</th>
                            <th class="text-md-center white--text">Apellidos</th>
                            <th class="text-md-center white--text">Correo</th>
                            <th class="text-md-center white--text">Usuario</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="tr">
                            <td>{{ user.name }}</td>
                            <td>{{ user.apellido }}</td>
                            <td>{{ user.email }}</td>
                            <td>{{ user.user }}</td>
                        </tr>
                    </tbody>
                    <v-col>
                        <br>
                    <br>
                      <div class="centrado"> 
                    <editar_contraVue></editar_contraVue>
                </div> 
                <br>
               <div class="centrado">
                    <editar_usuarioVue></editar_usuarioVue>
                </div>
                </v-col>


                </template>
            </v-simple-table>
        </v-container>
        </v-tab-item>
        <v-tab>
            <v-icon left color="#1A374D"> mdi-ticket </v-icon>
            <h4 class="tab">Mis Boletos</h4>
        </v-tab>
        <v-tab-item style="background: #f6f6f6">
            <v-col cols="12" md="11">
                <h2 class="subtitulo">Mis Boletos</h2>
<br>
                <v-simple-table class="tabla">
                    <template v-slot:default>
                        <thead class="thead">
                            <tr class="tr">
                                <th class="text-md-center white--text">Evento</th>
                                <th class="text-md-center white--text">Fecha</th>
                                <th class="text-md-center white--text">Generar Ticket</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr class="tr" v-for="(voucher, index) in vouchers" :key="index">
                                <td>{{ voucher.evento.titulo }}</td>
                                <td>{{ voucher.evento.fecha }}</td>
                                <td><v-btn color="#406882" @click="generarTicket(voucher.id)"><span class="white--text">Imprimir</span></v-btn>
                                </td>
                            </tr>
                        </tbody>
                    </template>
                </v-simple-table>
            </v-col>
        </v-tab-item>


    </v-tabs>

</template>
<script>
import HTTP from "../utils/HTTP";
import { mapState, mapMutations } from "vuex";
import editar_usuarioVue from '../components/editar_usuario.vue';
import editar_contraVue from '../components/editar_contra.vue';
export default {
    name: "cuenta",
    data: () => ({
        vouchers: [],
    }),
    computed: {
        ...mapState(["user"]),
    },
    methods: {
        logout() {
            this.logout(state)
            localStorage.clear();
        },
        async generarTicket(voucherid) {
            let response = await HTTP.get(`user/${this.user.id}/generarticket/${voucherid}`, {

                responseType: "blob",
            });
            let blob = new Blob([response.data], {
                type: "application/pdf",
            });
            let link = document.createElement("a");
            link.href = window.URL.createObjectURL(blob);
            link.download = "ticket.pdf";
            link.click();

        },

        ...mapMutations(['logout'])

    },
    async beforeMount() {
        let userID = localStorage.getItem("userID");
        var bolet = await HTTP.get(`user/${userID}/boletos`)
        this.vouchers = bolet.data.data;
    },

    components: {
        editar_usuarioVue,
        editar_contraVue
    }
}
</script>


<style scoped>
.tabla {
  background-color: white;
  text-align: center;
  border-collapse: collapse;
  width: 100%;
}

.th {
  padding: 20px;
  text-align: center;
  color: white;
}

.td {
  padding: 20px;
  text-align: center;
}

.thead {
  background-color: #406882;
  border-bottom: solid 100px #000;
  color: white;
}

.tr:nth-child(even) {
  background-color: #ddd;
}

.tr:hover td {
  background-color: #6998ab;
  color: white;
}


.subtitulo{
        font-size: 25px;
        font-family: 'Expletus Sans', cursive;
        text-align: center;
        line-height: 30px; 
}

.texto {
        font-size: 19px;
        font-family: 'Mukta Vaani', sans-serif;
        text-align: center;
        line-height: 30px;
}

.centrado{
    margin-left: -80px;
}


</style>