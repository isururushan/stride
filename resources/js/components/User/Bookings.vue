<template>

<div class="layout-px-spacing">
    <div class="row layout-top-spacing">
      <div class="row col-12">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
          <div class="widget-two">

            <div class="widget-content">
              <div class="w-numeric-value">
                <div class="w-content">
                  <span class="w-value">Bookings View</span>
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
                          <div class="th-content">Time</div>
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
                        <!-- <th class="text-center">
                          <div class="th-content">Canceled Reason</div>
                        </th>-->
                         <th class="text-center">
                          <div class="th-content">Payment Methods</div>
                        </th>
                         <th class="text-center">
                          <div class="th-content">Payment Success</div>
                        </th>
                         <th class="text-center">
                          <div class="th-content">Start / Arrived Status</div>
                        </th>
                         <th class="text-center">
                          <div class="th-content">Active</div>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(booking, index) in bookings" :key="index">
                        <td class="text-center">{{ index + 1 }}</td>
                        <td class="text-center">{{ booking.id }}</td>
                        <td class="text-center">{{ booking.start_location}}</td>
                        <td class="text-center">{{ booking.stop_location}}</td>
                        <td class="text-center">{{ booking.distance}}</td>
                        <td class="text-center">{{ booking.price}}</td>
                        <td class="text-center">{{ booking.rating}}</td>
                        <td class="text-center">{{ booking.time}}</td>
                        <td class="text-center">{{ booking.passenger_first_name}} {{ booking.passenger_last_name }}</td>
                        <td class="text-center">{{ booking.driver_first_name}} {{ booking.driver_last_name}}</td>
                         <td class="text-center">
                            <div v-if="booking.accepted  == 1">
                                <span class="shadow-none badge badge-primary">Accepted</span>
                             </div>
                            <div v-else-if="booking.rejected  == 1">
                                <span class="shadow-none badge badge-danger">Rejected</span>
                            </div>
                             <div v-else-if="booking.canceled == 1">
                                <span class="shadow-none badge badge-danger">Canceled</span>
                            </div>
                             <div v-else>
                                <span class="shadow-none badge badge-warning">Pending</span>
                            </div>
                         </td>      
                          <!--<td class="text-center">
                          <button type="button" class="btn btn-dark rounded bs-tooltip" data-toggle="tooltip" data-html="true" title="<em>Tooltip</em> <u>with</u> <b>HTML</b>">
                                                  Tooltip with HTML
                            </button>
                          </td>-->
                         <td class="text-center">
                            <div v-if="booking.payment_method  == 1">
                                <span class="shadow-none badge badge-primary">Cash on Delivery</span>
                             </div>
                            <div v-else>
                                <span class="shadow-none badge badge-success">Card Payment</span>
                            </div>
                         </td>
                         <td class="text-center">
                            <div v-if="booking.payment_success  == 1">
                                <span class="shadow-none badge badge-primary">Success</span>
                             </div>
                            <div v-else>
                                <span class="shadow-none badge badge-warning">Not Success</span>
                            </div>
                         </td>
                         <td class="text-center">
                            <div v-if="booking.started  == 1">
                                <span class="shadow-none badge badge-primary">Started</span>
                             </div>
                            <div v-else>
                                <span class="shadow-none badge badge-success">Arrived</span>
                            </div>
                         </td>
                         <td class="text-center">
                            <div v-if="booking.active == 1">
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
        bookings:[],


    };
    },

 
     mounted(){

        this.fetchBookings();
        
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
            this.time=null;
            this.payment_success =null;
            this.started =null;
            this.active= null;

        },

     fetchBookings(){

          axios.get("/user/fetch/bookings").then(res =>{
            if(res.status == 200){
              console.log(res);
              this.bookings =res.data;
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