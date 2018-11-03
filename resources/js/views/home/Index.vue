<template>
  <v-container fluid fill-height>
    <v-layout column>
      <header>
      <div class="layout align-center justify-start">
        <div style="min-width: 600px;"></div>
        <div class="flex display-3 font-weight-bold">Venta de Servicios</div>
        </div>
      </header>
      <v-carousel hide-controls class="mt-5">
        <v-carousel-item
          v-for="(item,i) in items"
          :key="i"
          :src="item.src"
        ></v-carousel-item>
      </v-carousel>
    </v-layout>
  </v-container>
</template>

<script>
export default {
  data() {
    return {
      items: [
        {
          src: require("./../../assets/productos.png")
        },
        {
          src: require("./../../assets/seguro.jpg")
        },
        {
          src: require("./../../assets/tarjeta.jpeg")
        },
        {
          src: require("./../../assets/pago.jpg")
        }
      ]
    };
  }
};
</script>

