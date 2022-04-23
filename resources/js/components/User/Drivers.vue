<template>
<div class="row">

    <div v-for="(driver, index) in drivers" :key="index" class="col-md-4 col-lg-4 user-profile layout-spacing">
        <div class="col-md-12 col-sm-12 layout-top-spacing">
            <div class="widget-content widget-content-area">
                <div class="d-flex justify-content-between">
                    <h3 class="">Profile</h3>
                </div>
                <div class="text-center user-info">
                    <img :src="`/storage/drivers/${driver.image}`" class="rounded-circle" width="90px" height="90px" alt srcset />
                    <p>{{driver.first_name}} {{driver.last_name}}</p>
                </div>

                <div class="user-info-list">
                    <div class="">
                        <ul class="contacts-block list-unstyled">
                            <li class="contacts-block__item">
                                <p><a>Email : </a><a>{{driver.email}}</a></p>
                            </li>
                            <li class="contacts-block__item">
                              <p><a>Address : </a><a>{{driver.address}}</a></p> 
                            </li>
                            <li class="contacts-block__item">
                               <p><a>Birthday : </a><a>{{driver.birthday}}</a></p>
                            </li>
                            <li class="contacts-block__item">
                               <p><a>Telephone : </a><a>{{driver.telephone}}</a></p>
                            </li>
                            <li class="contacts-block__item">
                              <p><a>Vehicle Name : </a><a>{{driver.vehicle_name}}</a></p>
                            </li>
                            <li class="contacts-block__item">
                              <p><a>Vehicle Make : </a><a>{{driver.vehicle_make}}</a></p> 
                            </li>
                            <li class="contacts-block__item">
                             <p><a>Vehicle Model : </a><a> {{driver.vehicle_model}}</a> </p>  
                            </li>
                            <li class="contacts-block__item">
                              <p><a>Plate Number : </a><a>{{driver.vehicle_plate_number}}</a></p>  
                            </li>
                            <li class="contacts-block__item">
                             <p><a>Vehicle Type : </a><a>{{driver.vehicle_type_name}}</a></p>
                            </li>
                            
                            <br>
                            <div class="row g-2">

                                <div class="col-6" v-if="driver.online_status  == 1">
                                    <center><span class="shadow-none badge badge-primary text-center">Online</span></center>
                                </div>
                                <div class="col-6" v-else>
                                    <center><span class="shadow-none badge badge-warning text-center">Offline</span></center>
                                </div>

                                <div class="col-6" v-if="driver.active  == 1">
                                    <center>
                                        <span class="shadow-none badge badge-success text-center">Active</span></center>
                                </div>
                                <div class="col-6" v-else>
                                    <center> <span class="shadow-none badge badge-warning text-center">Deactive</span></center>
                                </div>
                            </div>
                        </ul>
                        <center>
                            <a :href="`/storage/documents/${driver.driver_document}`" class="btn btn-outline-warning" target="_blank">View</a>
                        </center>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


</template>

<script>
export default {
    data() {
        return {
            drivers: [],

        };
    },

    mounted() {

        this.fetchDrivers();

    },

    methods: {
        reset() {

            this.id = null;
            this.first_name = null;
            this.last_name = null;
            this.email = null;
            this.address = null;
            this.birthday = null;
            this.telephone = null;
            this.online_status = null;
            this.active = null;

        },

        fetchDrivers() {

            axios.get("/user/fetch/drivers").then(res => {
                if (res.status == 200) {
                    console.log(res);
                    this.drivers = res.data;
                }
            }).catch(err => {
                console.log("error:" + err);
            });

        },
    },
};
</script>
