<template>
  <div class="centro">
    <v-row>
      <v-btn
        class="mx-4"
        rounded
        dark
        small
        color="#1A374D"
        @click="quitarEntrada()"
      >
        <v-icon dark> mdi-minus </v-icon>
      </v-btn>
      <p>{{ cantidad }}</p>
      <v-btn
        class="mx-4"
        rounded
        dark
        small
        color="#1A374D"
        @click="agregarEntrada()"
      >
        <v-icon dark> mdi-plus </v-icon>
      </v-btn>
    </v-row>
  </div>
</template>
<script>
export default {
  name: "cantentrada",
  data() {},
  methods: {
    agregarEntrada() {
      this.$emit("agregarEntrada");
    },
    quitarEntrada() {
      this.$emit("quitarEntrada");
    },
  },
  props: {
    cantidad: {
      type: Number,
      required: true,
    },
  },
};
</script>
<style scoped>
.centro {
  margin-left: 175px;
}
</style>
