<template>
  <div>
    <v-card>
      <v-card-title class="grey lighten-4 py-4 title">
        <span class="headline">Contratar Servicio</span>
      </v-card-title>
      <v-container grid-list-sm class="pa-4">
        <v-layout row wrap>
          <v-flex xs12 align-center justify-space-between>
            <v-layout align-center>
              <v-menu
                :close-on-content-click="false"
                v-model="menu"
                :nudge-right="40"
                lazy
                transition="scale-transition"
                offset-y
                full-width
                min-width="290px"
              >
                <v-text-field
                  slot="activator"
                  v-model="editedItem.fecha_contratacion"
                  label="Fecha de inicio del contrato"
                  prepend-icon="event"
                  readonly
                ></v-text-field>
                <v-date-picker v-model="editedItem.fecha_contratacion" @input="menu = false"></v-date-picker>
              </v-menu>
            </v-layout>
          </v-flex>
          <v-flex xs12 align-center justify-space-between>
            <v-layout align-center>
              <v-menu
                :close-on-content-click="false"
                v-model="menu2"
                :nudge-right="40"
                lazy
                transition="scale-transition"
                offset-y
                full-width
                min-width="290px"
              >
                <v-text-field
                  slot="activator"
                  v-model="editedItem.fecha_fin_contratacion"
                  label="Fecha final del contrato"
                  prepend-icon="event"
                  readonly
                ></v-text-field>
                <v-date-picker v-model="editedItem.fecha_fin_contratacion" @input="menu2 = false"></v-date-picker>
              </v-menu>
            </v-layout>
          </v-flex>"
          <v-flex xs6>
            <v-input v-model="editedItem.descuento_tipo_cliente" prepend-icon="dialpad">
              Descuento Tipo de Cliente"
              {{descuento_tipo_cliente}}
            </v-input>
            <v-divider class="ml-4"></v-divider>
          </v-flex>
          <v-flex xs12>
            <v-select
              :items="tipo_pago"
              item-text="tipo_pago"
              item-value="tipo_pago"
              label="Tipo de Pago"
              v-model="tipo_pago_elegido"
              prepend-icon="mail"
              return-object
              readonly
            ></v-select>
          </v-flex>
          <v-flex xs12>
            <v-text-field
              v-model="editedItem.numero_tarjeta"
              label="Numero de Tarjeta"
              prepend-icon="dialpad"
            ></v-text-field>
          </v-flex>
          <v-flex xs12>
            <v-select
              :items="numero_cuota"
              item-text="numero_cuota"
              item-value="numero_cuota"
              v-model="cuotas_elegidas"
              label="Número de Cuotas"
              prepend-icon="phone"
              return-object
            ></v-select>
          </v-flex>
          <v-flex xs12>
            <h3>
              Total: {{servicio.precio_servicio}}
              <div>{{cuotas_elegidas}} Cuotas de {{valorCuota}}</div>
            </h3>
          </v-flex>
        </v-layout>
        <v-card-actions>
          <v-spacer></v-spacer>
          <v-btn color="info" @click="$router.push({name:'home'})">Cancelar</v-btn>
          <v-btn color="error" @click.native="save">Contratar Servicio</v-btn>
        </v-card-actions>

        <servicios></servicios>
      </v-container>
    </v-card>
  </div>
</template>

<script>
import Servicios from "./../../components/publico/Servicios";
export default {
  data: () => ({
    date: new Date().toISOString().substr(0, 10),
    menu: false,
    modal: false,
    menu2: false,
    cuotas_elegidas: "",
    tipo_pago: [],
    numero_cuota: [],
    tipo_pago_elegido: "",
    dialog: false,
    usuario: {},
    headers: [
      {
        text: "Fecha inicial del contrato",
        align: "left",
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
    usuarios: [],
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
      me_gusta: ""
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
      me_gusta: ""
    }
  }),

  watch: {
    dialog(val) {
      val || this.close();
    },
    tipo_pago() {
      this.cargar();
    },
    concreta(ventas_concretadas) {
      if (this.ventas_concretadas >= 100) {
        return (this.tipo_cliente = "Gold");
      }
    }
  },

  created() {
    this.initialize();
  },

  methods: {
    initialize() {
      this.cargarUsuarioServicio();
      this.cargarMetodosPagos();
      this.auth();
    },
    redirect(link) {
      this.$router.push(link);
    },

    close() {
      this.dialog = false;
      setTimeout(() => {
        this.editedItem = Object.assign({}, this.defaultItem);
        this.editedIndex = -1;
      }, 300);
    },
    cargar() {
      this.tipo_pago_elegido = this.servicio.tipo_pago;
      const pago = this.tipo_pago.find(
        item => item.tipo_pago == this.tipo_pago_elegido
      );
      this.numero_cuota = pago.cuotas;
      console.log("wut", pago);
    },
    save() {
      this.guardarUsuarioServicio();
      this.close();
      this.$router.push({ name: "clienteServiciosContratados" });
    },
    cargarUsuarioServicio() {
      var url = "/serviciosUsuario";
      axios
        .get(url)
        .then(response => {
          this.usuarios = response.data;
          console.log(response);
        })
        .catch(error => {
          console.log(error);
        });
    },
    guardarUsuarioServicio() {
      var url = "/serviciosUsuario/" + this.servicio.id + "/" + this.usuario.id;
      axios
        .post(url, {
          fecha_contratacion: this.editedItem.fecha_contratacion,
          fecha_fin_contratacion: this.editedItem.fecha_fin_contratacion,
          descuento_tipo_cliente: this.editedItem.descuento_tipo_cliente,
          tipo_pago: this.tipo_pago_elegido,
          numero_tarjeta: this.editedItem.numero_tarjeta,
          numero_cuota: this.cuotas_elegidas,
          valor_cuota: this.valorCuota,
          me_gusta: this.editedItem.me_gusta
        })
        .then(response => {
          console.log(response);
        })
        .catch(error => {
          console.log(error);
        });
    },
    cargarMetodosPagos() {
      var url = "/metodosPagos";
      axios
        .get(url)
        .then(response => {
          this.tipo_pago = response.data;
          console.log(response);
        })
        .catch(error => {
          console.log(error);
        });
    },
    cambioTipoPago() {
      console.log(this.tipo_pago_elegido);
      this.numero_cuota = this.tipo_pago_elegido.cuotas;
    },
    auth() {
      var url = "/auth";
      axios
        .post(url)
        .then(response => {
          this.usuario = response.data;
          console.log(response);
        })
        .catch(error => {
          console.log(error);
        });
    }
  },
  computed: {
    valorCuota() {
      return this.servicio.precio_servicio / this.cuotas_elegidas;
    }
  },
  components: {
    Servicios
  },
  props: {
    servicio: {}
  }
};
</script>
