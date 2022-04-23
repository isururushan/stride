<template>

<div class="layout-px-spacing">
    <div class="row layout-top-spacing">
      <div class="row col-12">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
          <div class="widget-two">

            <div class="widget-content">
              <div class="w-numeric-value">
                <div class="w-content">
                  <span class="w-value">Trips View</span>
                  <span class="w-numeric-title">Go to columns for details.</span>
                </div>
              </div>
            </div>
            

            <div style="margin:50px">
              <div class="widget-content">
                <div class="table-responsive table-wrapper">
                  <table class="table">
                    <thead>
                      <tr>
                        <th class="text-center">
                          <div class="th-content">Count</div>
                        </th>
                        <th class="text-center">
                          <div class="th-content">Id</div>
                        </th>
                          <th class="text-center">
                          <div class="th-content">Start Location </div>
                        </th>
                        <th class="text-center">
                          <div class="th-content">Stop Location</div>
                        </th>
                          <th class="text-center">
                          <div class="th-content">Distance</div>
                        </th>
                        <th class="text-center">
                          <div class="th-content">Price</div>
                        </th> 
                         <th class="text-center">
                          <div class="th-content">Rating</div>
                        </th>
                         <th class="text-center">
                          <div class="th-content">Driver Name</div>
                        </th>
                         <th class="text-center">
                          <div class="th-content">Passenger Name</div>
                        </th>
                         <th class="text-center">
                          <div class="th-content">Request status</div>
                        </th>
                         <th class="text-center">
                          <div class="th-content">Payment Methods</div>
                        </th>
                         <th class="text-center">
                          <div class="th-content">Payment Success</div>
                        </th>
                         <th class="text-center">
                          <div class="th-content">Start Status</div>
                        </th>
                         <th class="text-center">
                          <div class="th-content">Arrived Status</div>
                        </th>
                         <th class="text-center">
                          <div class="th-content">Active</div>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(trip, index) in trips" :key="index">
                        <td class="text-center">{{ index + 1 }}</td>
                        <td class="text-center">{{ trip.id }}</td>
                        <td class="text-center">{{ trip.start_location}}</td>
                        <td class="text-center">{{ trip.stop_location}}</td>
                        <td class="text-center">{{ trip.distance}}</td>
                        <td class="text-center">{{ trip.price}}</td>
                        <td class="text-center">{{ trip.rating}}</td>
                        <td class="text-center">{{ trip.passenger_first_name}} {{ trip.passenger_last_name }}</td>
                        <td class="text-center">{{ trip.driver_first_name}} {{ trip.driver_last_name}}</td>
                         <td class="text-center">
                            <div v-if="trip.accepted  == 1">
                                <span class="shadow-none badge badge-primary">Accepted</span>
                             </div>
                            <div v-else-if="trip.rejected  == 1">
                                <span class="shadow-none badge badge-danger">Rejected</span>
                            </div>
                             <div v-else-if="trip.canceled  == 1">
                                <span class="shadow-none badge badge-danger">Canceled</span>
                            </div>
                             <div v-else>
                                <span class="shadow-none badge badge-danger">Pending</span>
                            </div>
                         </td>
                        

                         <td class="text-center">
                            <div v-if="trip.payment_method  == 1">
                                <span class="shadow-none badge badge-primary">Cash on Delivery</span>
                             </div>
                            <div v-else>
                                <span class="shadow-none badge badge-success">Card Payment</span>
                            </div>
                         </td>
                         <td class="text-center">
                            <div v-if="trip.payment_success  == 1">
                                <span class="shadow-none badge badge-primary">Success</span>
                             </div>
                            <div v-else>
                                <span class="shadow-none badge badge-warning">Not Success</span>
                            </div>
                         </td>
                         <td class="text-center">
                            <div v-if="trip.started  == 1">
                                <span class="shadow-none badge badge-primary">Started</span>
                             </div>
                            <div v-else>
                                <span class="shadow-none badge badge-warning">Not Start</span>
                            </div>
                         </td>
                          <td class="text-center">
                            <div v-if="trip.arrived  == 1">
                                <span class="shadow-none badge badge-success">Arrived</span>
                             </div>
                            <div v-else>
                                <span class="shadow-none badge badge-warning">Not Arrived</span>
                            </div>
                         </td>
                         <td class="text-center">
                            <div v-if="trip.active == 1">
                                <span class="shadow-none badge badge-primary">Active</span>
                             </div>
                            <div v-else>
                                <span class="shadow-none badge badge-warning">Deactive</span>
                            </div>
                         </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
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
        trips:[],


    };
    },

 
     mounted(){

        this.fetchTrips();
        
    },

 methods : {
        reset(){

            this.id = null;
            this.start_location = null;
            this.stop_location = null;
            this.distance= null;
            this.price =null;
            this.payment_method =null;
            this.rating =null;
            this.payment_success =null;
            this.started =null;
            this.active= null;

        },

     fetchTrips(){

          axios.get("/user/fetch/trips").then(res =>{
            if(res.status == 200){
              console.log(res);
              this.trips =res.data;
            }
          }).catch(err =>{
            console.log("error:" + err);
          });

        },
        },
};
</script>

<style>
.table-wrapper{
  display: block;
  overflow-x: auto;
  height: 400px;
  white-space: noerap;

}
</style>