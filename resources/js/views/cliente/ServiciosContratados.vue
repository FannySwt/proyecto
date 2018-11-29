<template>
  <v-data-table :headers="headers" :items="ServiciosContratados" hide-actions class="elevation-1">
    <template slot="items" item-key slot-scope="props">
      <td>{{ props.item.pivot.fecha_contratacion }}</td>
      <td class="text-xs-center">{{ props.item.pivot.fecha_fin_contratacion }}</td>
      <td class="text-xs-center">{{ props.item.pivot.descuento_tipo_cliente }}</td>
      <td class="text-xs-center">{{ props.item.tipo_pago }}</td>
      <td class="text-xs-center">{{ props.item.pivot.numero_tarjeta }}</td>
      <td class="text-xs-center">{{ props.item.pivot.numero_cuota }}</td>
      <td class="text-xs-center">{{ props.item.pivot.valor_cuota }}</td>
      <td>
        <div class="text-xs-center">
          <v-btn v-if="props.item.pivot.evaluar == 1" color="info" dark>Evaluado</v-btn>
          <v-dialog v-model="dialog" width="500">
            <v-btn
              v-if="props.item.pivot.evaluar == 0"
              slot="activator"
              color="success"
              dark
            >Evaluar</v-btn>
            <v-btn v-if="props.item.pivot.evaluar == 1" color="info" dark>Evaluar</v-btn>
            <v-card>
              <v-card-title
                class="headline grey lighten-2"
                primary-title
              >¿Te ha gustado el servicio?</v-card-title>
              <v-card-text></v-card-text>
              <v-divider></v-divider>
              <v-layout justify-space-around>
                <v-flex v-if="props.item.pivot.me_gusta=='no'" xs12 sm3 class="h4 ml-5">Me gusta
                  <v-btn @click="guardarUsuarioServicio(props.item)" flat icon color="black">
                    <v-icon>thumb_up</v-icon>
                  </v-btn>
                </v-flex>
                <v-flex v-if="props.item.pivot.me_gusta=='no'" xs12 sm3 row class="h4">No me gusta
                  <v-btn color="blue" flat icon>
                    <v-icon>thumb_down</v-icon>
                  </v-btn>
                </v-flex>
                <v-flex v-if="props.item.pivot.me_gusta=='si'" xs12 sm3 class="h4 ml-5">Me gusta
                  <v-btn flat icon color="blue">
                    <v-icon>thumb_up</v-icon>
                  </v-btn>
                </v-flex>
                <v-flex v-if="props.item.pivot.me_gusta=='si'" xs12 sm3 row class="h4">No me gusta
                  <v-btn @click="guardarUsuarioServicio(props.item)" color="black" flat icon>
                    <v-icon>thumb_down</v-icon>
                  </v-btn>
                </v-flex>
              </v-layout>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="danger" flat @click="close()">Cancelar</v-btn>
                <v-btn color="primary" flat @click="save(props.item)">Aceptar</v-btn>
              </v-card-actions>
            </v-card>
          </v-dialog>
        </div>
      </td>
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
      { text: "Acción", class: "center", value: "name", sortable: false }
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
      valor_cuota: "",
      me_gusta: "",
      evaluar: ""
    },
    defaultItem: {
      id: 0,
      fecha_contratacion: "",
      fecha_fin_contratacion: "",
      descuento_tipo_cliente: "normal",
      tipo_pago: "",
      numero_tarjeta: "",
      numero_cuota: "",
      valor_cuota: "",
      me_gusta: "",
      evaluar: ""
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
    },
    close() {
      this.dialog = false;
    },
    save(servicio) {
      var url = "/serviciosUsuario/" + servicio.id + "/" + servicio.user_id;
      axios
        .put(url, {
          fecha_contratacion: servicio.pivot.fecha_contratacion,
          fecha_fin_contratacion: servicio.pivot.fecha_fin_contratacion,
          descuento_tipo_cliente: servicio.pivot.descuento_tipo_cliente,
          numero_tarjeta: servicio.pivot.numero_tarjeta,
          tipo_pago: servicio.pivot.tipo_pago,
          numero_cuota: servicio.pivot.numero_cuota,
          valor_cuota: servicio.pivot.valor_cuota,
          me_gusta: servicio.pivot.me_gusta,
          evaluar: 1
        })
        .then(response => {
          console.log(response);
          this.cargarServiciosContratados();
          this.close();
          this.actualizarServicio(servicio);
        })
        .catch(error => {
          console.log(error);
        });
    },
    actualizarServicio(servicio) {
      var like = 0;
      var dislike = 0;
      if (servicio.pivot.me_gusta == "si") {
        like = servicio.me_gusta + 1;
        dislike = servicio.no_me_gusta;
      } else {
        like = servicio.me_gusta;
        dislike = servicio.no_me_gusta + 1;
      }
      var url = "/servicios/" + servicio.id;
      axios
        .put(url, {
          nombre_servicio: servicio.nombre_servicio,
          descripcion_servicio: servicio.descripcion_servicio,
          estado: servicio.estado,
          fecha_publicacion_se: servicio.fecha_publicacion_se,
          fecha_finalizacion_se: servicio.fecha_finalizacion_se,
          tags_servicio: servicio.tags_servicio,
          visitas: servicio.visitas,
          creador: servicio.creador,
          tipo_pago: servicio.tipo_pago,
          precio_servicio: servicio.precio_servicio,
          me_gusta: like,
          no_me_gusta: dislike,
          ubicacion: servicio.ubicacion
        })
        .then(response => {
          console.log(response);
        })
        .catch(error => {
          console.log(error);
        });
    },
    guardarUsuarioServicio(servicio) {
      var like;
      if (servicio.pivot.me_gusta == "si") {
        like = "no";
      } else {
        like = "si";
      }

      var url = "/serviciosUsuario/" + servicio.id + "/" + servicio.user_id;
      axios
        .put(url, {
          fecha_contratacion: servicio.pivot.fecha_contratacion,
          fecha_fin_contratacion: servicio.pivot.fecha_fin_contratacion,
          descuento_tipo_cliente: servicio.pivot.descuento_tipo_cliente,
          numero_tarjeta: servicio.pivot.numero_tarjeta,
          tipo_pago: servicio.pivot.tipo_pago,
          numero_cuota: servicio.pivot.numero_cuota,
          valor_cuota: servicio.pivot.valor_cuota,
          me_gusta: like
        })
        .then(response => {
          console.log(response);
          this.cargarServiciosContratados();
        })
        .catch(error => {
          console.log(error);
        });
    }
  }
};
</script>
