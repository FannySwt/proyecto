<template>
  
    <v-data-table
      :headers="headers"
      :items="ServiciosContratados"
      hide-actions
      class="elevation-1"
    >
      <template slot="items" slot-scope="props">
        <td>{{ props.item.pivot.fecha_contratacion }}</td>
        <td class="text-xs-center">{{ props.item.pivot.fecha_fin_contratacion }}</td>
        <td class="text-xs-center">{{ props.item.pivot.descuento_tipo_cliente }}</td>
        <td class="text-xs-center">{{ props.item.tipo_pago }}</td>
        <td class="text-xs-center">{{ props.item.pivot.numero_tarjeta }}</td>
        <td class="text-xs-center">{{ props.item.pivot.numero_cuota }}</td>
        <td class="text-xs-center">{{ props.item.pivot.valor_cuota }}</td>
        <td class="justify-center align-center layout px-0"></td>
      </template>
      <template slot="no-data">
        <v-btn color="primary" @click="initialize">Reiniciar</v-btn>
      </template>
    </v-data-table>
</template>

<script>
export default {
  data: () => ({
    dialog: false,
    headers: [
      {
        text: "Fecha inicial del contrato",
        align: "center",
        value: "fecha_contratacion"
      },
      { text: "Fecha final del contrato", value: "fecha_fin_contratacion" },
      { text: "Descuento de cliente", value: "descuento_tipo_cliente" },
      { text: "Tipo de Pago", value: "tipo_pago" },
      { text: "Número de Tarjeta", value: "numero_tarjeta" },
      { text: "Número de Cuotas", value: "numero_cuota" },
      { text: "Valor de las Cuotas", value: "valor_cuota" },
      { text: "Actions", value: "name", sortable: false }
    ],
    ServiciosContratados: [],
    editedIndex: -1,
    editedItem: {
      id: 0,
      fecha_contratacion: "",
      fecha_fin_contratacion: "",
      descuento_tipo_cliente: "normal",
      tipo_pago: "",
      numero_tarjeta: "",
      numero_cuota: "",
      valor_cuota: ""
    },
    defaultItem: {
      id: 0,
      fecha_contratacion: "",
      fecha_fin_contratacion: "",
      descuento_tipo_cliente: "normal",
      tipo_pago: "",
      numero_tarjeta: "",
      numero_cuota: "",
      valor_cuota: ""
    }
  }),
  created() {
    this.initialize();
  },

  methods: {
    initialize() {
      this.cargarServiciosContratados();
    },
    cargarServiciosContratados() {
      var url = "/serviciosContratados";
      axios
        .get(url)
        .then(response => {
          this.ServiciosContratados = response.data;
          console.log(ServiciosContratados);
        })
        .catch(error => {
          console.log(error);
        });
    },
    redirect(link) {
      this.$router.push(link);
    }
  }
};
</script>
