import Vue from "vue";
import Router from "vue-router";
import Login from "./views/Login.vue";
import Home from "./views/Home.vue";
import HomeIndex from "./views/home/Index.vue";

import HomeAbout from "./views/home/About.vue";
import HomeUsers from "./views/home/Users.vue";
import HomeServicios from "./views/home/Servicios.vue";
import HomeAyuda from "./views/home/Ayuda.vue";

import Admin from "./views/Admin.vue";
import AdminIndex from "./views/admin/Index.vue";
import AdminUsers from "./views/admin/Users.vue";
import AdminCategorias from "./views/admin/Categorias.vue";
import AdminMetodosPagos from "./views/admin/MetodosPagos.vue";
import AdminServicios from "./views/cliente/Servicios.vue";
import AdminVerServicios from "./views/cliente/VerServicios";
import AdminContratar from "./components/publico/Contratar.vue";
import AdminPerfil from "./views/admin/Perfil.vue";
import AdminServiciosContratados from "./views/cliente/ServiciosContratados.vue";
import AdminFiltrar from "./components/publico/Filtrar.vue";
import AdminFiltrarServicios from "./components/publico/FiltrarServicios.vue";

import Secretaria from "./views/secretaria.vue";
import SecretariaIndex from "./views/secretaria/Index.vue";
import SecretariaUsers from "./views/secretaria/Users.vue";
import SecretariaValidar from "./views/secretaria/Validar.vue";
import SecretariaServicios from "./views/secretaria/Servicios.vue";
import SecretariaContratar from "./components/publico/Contratar.vue";
import SecretariaPerfil from "./views/admin/Perfil.vue";
import SecretariaServiciosContratados from "./views/cliente/ServiciosContratados.vue";
import SecretariaServiciosDenunciados from "./views/secretaria/Denunciados.vue";
import SecretariaFiltrar from "./components/publico/Filtrar.vue";
import SecretariaFiltrarServicios from "./components/publico/FiltrarServicios.vue";

import Cliente from "./views/cliente.vue";
import ClienteIndex from "./views/cliente/Index.vue";
import ClienteServicios from "./views/cliente/Servicios.vue";
import ClienteVerServicios from "./views/cliente/VerServicios.vue";
import ClienteContratar from "./components/publico/Contratar.vue";
import ClienteEncuesta from "./components/publico/Encuenta.vue";
import ClienteServiciosContratados from "./views/cliente/ServiciosContratados.vue";
import ClientePerfil from "./views/admin/Perfil.vue";
import ClienteFiltrar from "./components/publico/Filtrar.vue";
import ClienteFiltrarServicios from "./components/publico/FiltrarServicios.vue";

import ServicioId from "./components/publico/Servicios.vue";

Vue.use(Router);

export default new Router({
    mode: "history",
    base: process.env.BASE_URL,
    routes: [
        {
            path: "/login",
            name: "login",
            component: Login
        },
        {
            path: "/home",
            component: Home,
            children: [
                {
                    path: "",
                    name: "home",
                    component: HomeIndex
                },
                {
                    path: "about",
                    name: "homeAbout",
                    component: HomeAbout
                },
                {
                    path: "users",
                    name: "homeUsers",
                    component: HomeUsers
                },
                {
                    path: "ayuda",
                    name: "homeAyuda",
                    component: HomeAyuda
                },
                {
                    path: "servicios",
                    name: "homeServicios",
                    component: HomeServicios
                }
            ]
        },
        {
            path: "/admin",
            name: "admin",
            component: Admin,
            children: [
                {
                    path: "",
                    name: "adminIndex",
                    component: AdminIndex
                },
                {
                    path: "users",
                    name: "adminUsers",
                    component: AdminUsers
                },
                {
                    path: "categorias",
                    name: "adminCategorias",
                    component: AdminCategorias
                },
                {
                    path: "metodosPagos",
                    name: "adminMetodosPagos",
                    component: AdminMetodosPagos
                },
                {
                    path: "servicios",
                    name: "adminServicios",
                    component: AdminServicios
                },
                {
                    path: "verServicios",
                    name: "adminVerServicios",
                    component: AdminVerServicios
                },
                ,
                {
                    path: "contratar/:servicio",
                    name: "adminContratar",
                    component: AdminContratar,
                    props: true
                },
                {
                    path: "perfil",
                    name: "adminPerfil",
                    component: AdminPerfil
                },
                {
                    path: "serviciosContratados",
                    name: "adminServiciosContratados",
                    component: AdminServiciosContratados
                },
                {
                    path: "filtrar",
                    name: "adminFiltrar",
                    component: AdminFiltrar
                },
                {
                    path: "filtrarServicios",
                    name: "adminFiltrarServicios",
                    component: AdminFiltrarServicios
                }
            ]
        },
        {
            path: "/secretaria",
            name: "secretaria",
            component: Secretaria,
            children: [
                {
                    path: "",
                    name: "secretariaIndex",
                    component: SecretariaIndex
                },
                {
                    path: "users",
                    name: "secretariaUsers",
                    component: SecretariaUsers
                },
                {
                    path: "servicios",
                    name: "secretariaServicios",
                    component: SecretariaServicios
                },
                {
                    path: "validar",
                    name: "secretariaValidar",
                    component: SecretariaValidar
                },
                {
                    path: "contratar/:servicio",
                    name: "secretariaContratar",
                    component: SecretariaContratar,
                    props: true
                },
                {
                    path: "perfil",
                    name: "secretariaPerfil",
                    component: SecretariaPerfil
                },
                {
                    path: "serviciosContratados",
                    name: "secretariaServiciosContratados",
                    component: SecretariaServiciosContratados
                },
                {
                    path: "serviciosDenunciados",
                    name: "secretariaServiciosDenunciados",
                    component: SecretariaServiciosDenunciados
                },
                {
                    path: "filtrar",
                    name: "secretariaFiltrar",
                    component: SecretariaFiltrar
                },
                {
                    path: "filtrarServicios",
                    name: "secretariaFiltrarServicios",
                    component: SecretariaFiltrarServicios
                }
            ]
        },
        {
            path: "/cliente",
            component: Cliente,
            children: [
                {
                    path: "",
                    name: "cliente",
                    component: ClienteIndex
                },
                {
                    path: "servicios",
                    name: "clienteServicios",
                    component: ClienteServicios
                },
                {
                    path: "verServicios",
                    name: "clienteVerServicios",
                    component: ClienteVerServicios
                },
                {
                    path: "contratar/:servicio",
                    name: "clienteContratar",
                    component: ClienteContratar,
                    props: true
                },
                {
                    path: "serviciosContratados",
                    name: "clienteServiciosContratados",
                    component: ClienteServiciosContratados
                },
                {
                    path: "encuesta",
                    name: "clienteEncuesta",
                    component: ClienteEncuesta
                },
                {
                    path: "perfil",
                    name: "clientePerfil",
                    component: ClientePerfil
                },
                {
                    path: "filtrar",
                    name: "clienteFiltrar",
                    component: ClienteFiltrar
                },
                {
                    path: "filtrarServicios",
                    name: "clienteFiltrarServicios",
                    component: ClienteFiltrarServicios
                }
            ]
        }
    ]
});
