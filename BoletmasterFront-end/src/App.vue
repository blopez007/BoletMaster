<template>
  <v-app>
    <barra></barra>
    <v-main>
      <router-view></router-view>
    </v-main>
    <pie></pie>
  </v-app>
</template>

<script>
import barra from "./components/barra.vue";
import pie from "./components/pie_de_pagina.vue";
import HTTP from "./utils/HTTP";
import {mapMutations} from "vuex";

export default {
  components: { barra, pie },
  name: "App",

  data: () => ({
    //
  }),
  methods: {
    ...mapMutations(["loguear"]),
  },
  async beforeMount() {
    if (localStorage.getItem("token")) {
      var response = await HTTP.get("/profile");
      this.loguear(response.data.user);
    }
  },
};
</script>
