<template>
  <v-app id="login">
    <v-parallax src="/public/images/material.jpg"></v-parallax>
      <v-container fluid fill-height>
        <v-layout align-center justify-center>
          <v-flex xs12>
              <v-form ref="form" v-model="input.valid" lazy-validation v-on:submit.prevent="submit">
            <v-card class="elevation-12">
              <v-toolbar dark color="primary">
                <v-toolbar-title>Iniciar sesion</v-toolbar-title>
                <v-spacer></v-spacer>
              </v-toolbar>
              <v-card-text>
                  <v-text-field prepend-icon="person" name="login" label="Login" type="text" v-model="input.login" :rules="input.loginRules" required></v-text-field>
                  <v-text-field id="password" prepend-icon="lock" name="password" label="Password" type="password" v-model="input.password" :rules="input.passwordRules" required></v-text-field>
              </v-card-text>
              <v-card-actions>
                <v-spacer></v-spacer>
                <v-btn color="primary" :disabled="!input.valid" type="submit">Login</v-btn>
              </v-card-actions>
            </v-card>
            </v-form>
          </v-flex>
        </v-layout>
      </v-container>

  </v-app>
</template>

<script>
export default {
  data: () => ({
    drawer: null,
    input: {
      valid: true,
      password: "",
      passwordRules: [
        v => !!v || "El password es requerido",
        v =>
          (v && v.length >= 4) ||
          "El password nececita por lo menos 4 caracteres"
      ],
      login: "",
      loginRules: [v => !!v || "El usuario es requerido"]
    }
  }),
  props: {},
  methods: {
    submit() {
      if (this.$refs.form.validate()) {
        var url = "/login";
        axios
          .post(url, {
            email: this.input.login,
            password: this.input.password
          })
          .then(response => {
            console.log(response);
            this.$emit("authenticated");
          })
          .catch(error => {
            this.$emit("logout");
            console.log(error);
          });
      }
    }
  }
};
</script>
