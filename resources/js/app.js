require("./bootstrap");

import Vue from "vue";
import VueRouter from "vue-router";
import swal from "sweetalert2";


Vue.use(VueRouter);

window.Swal = swal;
window.Vue = require("vue").default;


// User
import UserDashboard from "./components/User/Dashboard.vue";
import NewAdmin from "./components/User/NewAdmin.vue";
import Bookings from "./components/User/Bookings.vue";
import Drivers from "./components/User/Drivers.vue";
import DriverRatings from "./components/User/DriverRatings.vue";
import Trips from "./components/User/Trips.vue";
import VehicleTypes from "./components/User/VehicleTypes.vue";


const routes = [


    /** User */
    {
        path: "/user/home",
        component: UserDashboard
    },
    {
        path: "/user/new-admin",
        component: NewAdmin
    },
    {
        path: "/user/Bookings",
        component: Bookings
    },
    {
        path: "/user/drivers",
        component: Drivers
    },
    {
        path: "/user/driver-ratings",
        component: DriverRatings
    },
    {
        path: "/user/trips",
        component: Trips
    },
    {
        path: "/user/vehicle-type",
        component: VehicleTypes
    },

];

const router = new VueRouter({
    mode: "history",
    routes // short for `routes: routes`
});

const app = new Vue({
    el: "#app_vue_js",
    router,
    components: {
      
        UserDashboard,
        NewAdmin,
        Bookings,
        Drivers,
        DriverRatings,
        Trips,
        VehicleTypes,
    }
});
  