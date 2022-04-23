<template>

<div class="layout-px-spacing">
    <div class="row layout-top-spacing">
      <div class="row col-12">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
          <div class="widget-two">

            <div class="widget-content">
              <div class="w-numeric-value">
                <div class="w-content">
                  <span class="w-value">Driver Ratings View</span>
                  <span class="w-numeric-title">Go to columns for details.</span>
                </div>
              </div>
            </div>
            

            <div style="margin: 50px">
              <div class="widget-content">
                <div class="table-responsive">
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
                          <div class="th-content">Rating</div>
                        </th>
                        <th class="text-center">
                          <div class="th-content">Decription</div>
                        </th>
                          <th class="text-center">
                          <div class="th-content">Passenger Name</div>
                        </th>
                        <th class="text-center">
                          <div class="th-content">Driver Name</div>
                        </th>
                         <th class="text-center">
                          <div class="th-content">Active</div>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(driverRating, index) in driverRatings" :key="index">
                        <td class="text-center">{{ index + 1 }}</td>
                        <td class="text-center">{{ driverRating.id }}</td>
                        <td class="text-center">{{ driverRating.rating }}</td>
                        <td class="text-center">{{ driverRating.decription}}</td>
                        <td class="text-center">{{ driverRating.passenger_first_name}} {{ driverRating.passenger_last_name }}</td>
                        <td class="text-center">{{ driverRating.driver_first_name}} {{ driverRating.driver_last_name}}</td>
                         <td class="text-center">
                            <div v-if="driverRating.active  == 1">
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
            driverRatings:[],


    };
    },

 
     mounted(){

        this.fetchDriverratings();
        
    },

 methods : {
        reset(){

            this.id = null;
            this.rating = null;
            this.decription = null;
            this.active= null;

        },

     fetchDriverratings(){

          axios.get("/user/fetch/driver-ratings").then(res =>{
            if(res.status == 200){
              console.log(res);
              this.driverRatings =res.data;
            }
          }).catch(err =>{
            console.log("error:" + err);
          });

        },
        },
};
</script>