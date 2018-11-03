<template>
    <v-flex xs12 sm6 md4>
      <v-menu
        ref="menu"
        :close-on-content-click="false"
        v-model="menu"
        :nudge-right="40"
        :return-value.sync="date"
        lazy
        transition="scale-transition"
        offset-y
        full-width
        min-width="290px"
      >
        <v-text-field
          slot="activator"
          v-model="data"
          v-on:input="$emit('input',data)"
          :label="label"
          prepend-icon="event"
          readonly
        ></v-text-field>
        <v-date-picker v-model="data" no-title scrollable
          v-on:input="$emit('input',data)"
        >
          <v-spacer></v-spacer>
          <v-btn flat color="primary" @click="menu = false">Cancel</v-btn>
          <v-btn flat color="primary" @click="$refs.menu.save(date)">OK</v-btn>
        </v-date-picker>
      </v-menu>
    </v-flex>
</template>

<script>
export default {
  data: () => ({
    date: new Date().toISOString().substr(0, 10),
    menu: false,
    modal: false,
    menu2: false
  }),
  computed: {
    data: {
      get() {
        return this.value;
      },
      set(val) {
        this.date = val;
      }
    }
  },
  props: {
    value: "",
    label: ""
  }
};
</script>