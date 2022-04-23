
<template>
  <div class="layout-px-spacing">
    <div class="row layout-top-spacing">
      <div class="row col-12">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
          <div class="widget-two">
            <div class="widget-content">
              <div class="w-numeric-value">
                <div class="w-content">
                  <span class="w-value">Vehicle Types</span>
                  <span class="w-numeric-title">Go to columns for details.</span><br /><br />
                  <button class="btn btn-primary" @click="show_create_form = !show_create_form">
                    <span v-if="show_create_form == 0">Show Create Form</span>
                    <span v-if="show_create_form == 1">Hide Create Form</span>
                  </button>
                </div>
                <div class="w-icon">
                  <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                    class="feather feather-dollar-sign">
                    <line x1="12" y1="1" x2="12" y2="23"></line>
                    <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                  </svg>
                </div>
              </div>
              <div class="w-chart">
                <div id="daily-sales"></div>
              </div>
            </div>
          </div>
        </div>

        <div class="row col-12" v-if="show_create_form == 1">
          <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
            <div class="widget-two">
              <div class="widget-content">
                <div class="w-numeric-value">
                  <div class="w-content">
                    <span class="w-value">Create Vehicle Types</span>
                  </div>
                  <div class="w-icon">
                    <svg
                      xmlns="http://www.w3.org/2000/svg"
                      width="24"
                      height="24"
                      viewBox="0 0 24 24"
                      fill="none"
                      stroke="currentColor"
                      stroke-width="2"
                      stroke-linecap="round"
                      stroke-linejoin="round"
                      class="feather feather-dollar-sign">
                      <line x1="12" y1="1" x2="12" y2="23"></line>
                      <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                    </svg>
                  </div>
                </div>

                <div style="margin: 50px">
                  <div class="widget-content">
                    <!-- Create Vehicle types Form Start -->

                    <form method="POST" enctype="multipart/form-data" @submit.prevent="createVehicleTypes">
                      <div style="margin: 50px">
                        <div class="row mb-4">
                          <div class="col">
                            <label for="exampleFormControlInput1">Name</label>
                            <input type="text" :class=" errors.name? 'form-control is-invalid' : 'form-control'" placeholder="Name" v-model="name"/>
                            <small v-if="errors.name" class="text-danger">{{ errors.name[0] }}</small>
                          </div>
                            <div class="col">
                            <label for="exampleFormControlInput1">Best Rate </label>
                            <input type="base " :class=" errors.base_rate ? 'form-control is-invalid': 'form-control'" placeholder="Best rate" v-model="base_rate"/>
                            <small v-if="errors.base_rate" class="text-danger">{{errors.base_rate[0]}}</small>
                          </div>
                          <div class="col">
                            <label for="exampleFormControlInput1">Additional Rate</label>
                            <input type=" additional_rate " :class=" errors.additional_rate ? 'form-control is-invalid': 'form-control'" placeholder="Best rate " v-model="additional_rate "/>
                            <small v-if="errors.additional_rate " class="text-danger">{{errors.additional_rate [0]}}</small>
                          </div>
                          <br>
                        </div>
                        <input type="submit" value="submit" class="btn btn-primary"/>
                      </div>
                    </form>
                    <!--- Create Vehicle Form End  -->
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
          <div class="widget-two">
            <div class="widget-content">
              <div class="w-numeric-value">
                <div class="w-content">
                  <span class="w-value">Vehicle Types View</span>
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
                          <div class="th-content">Name</div>
                        </th>
                        <th class="text-center">
                          <div class="th-content">Base Rate</div>
                        </th>
                        <th class="text-center">
                          <div class="th-content">Additional Rate</div>
                        </th>
                        <th class="text-center">
                          <div class="th-content">Active</div>
                        </th>
                          <th class="text-center">
                          <div class="th-content">Edit</div>
                        </th>
                        <th class="text-center">
                          <div class="th-content">Destroy</div>
                        </th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="(vehicleType, index) in vehicleTypes" :key="index">
                        <td class="text-center">{{ index + 1 }}</td>
                        <td class="text-center">{{ vehicleType.id }}</td>
                        <td class="text-center">{{ vehicleType.name }}</td>
                        <td class="text-center">{{ vehicleType.base_rate}}</td>
                        <td class="text-center">{{ vehicleType.additional_rate }}</td>
                         <td class="text-center">
                            <div v-if="vehicleType.active  == 1">
                                <span class="shadow-none badge badge-success">Active</span>
                             </div>
                            <div v-else>
                                <span class="shadow-none badge badge-warning">Deactive</span>
                            </div>
                         </td>
                        <td class="text-center">
                          <div class="btn-group" role="group" aria-label="Basic example">
                            <button class="btn btn-outline-primary mb-2 mx-4" @click="setToUpdate(vehicleType.id, vehicleType.name,vehicleType.base_rate,vehicleType.additional_rate, vehicleType.active)" data-toggle="modal" data-target="#editVehicleTypeModal">
                              <i class="fa fa-pencil" aria-hidden="true"></i>Edit
                            </button>
                          </div>
                        </td>
                        <td class="text-center">
                          <button class="btn btn-outline-danger mb-2" @click="destroyVehicleType(vehicleType.id)">
                            <i class="fa fa-pencil" aria-hidden="true"></i>Delete
                          </button>
                        </td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <!-- Modal -->
          <div class="modal fade bd-example-modal-lg" id="editVehicleTypeModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title">Edit VehicleTypes</h5>
                  <button type="button" lass="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                  </button>
                </div>

                <div class="modal-body">
                  <i class="flaticon-cancel-12 close" data-dismiss="modal"></i>
                  <div class="add-contact-box">
                    <div class="add-contact-content">
                      <form id="addContactModalTitle">
                        <div class="form-group row">
                          <label for="staticEmail" class="col-sm-4 col-form-label text-center">Name</label>
                          <div class="col-sm-8">
                            <input type="name" id="c-location" class="form-control" v-model="edit_name" >
                          </div>
                        </div>
                         <br> 
                        <div class="form-group row">
                          <label for="staticEmail" class="col-sm-4 col-form-label text-center">Best Rate</label>
                          <div class="col-sm-8">
                            <input type="name" id="c-location" class="form-control" v-model="edit_base_rate" />
                          </div>
                        </div>
                        <br>
                        <div class="form-group row">
                          <label for="staticEmail" class="col-sm-4 col-form-label text-center">Additional Rate</label>
                          <div class="col-sm-8">
                            <input type="" id="c-location" class="form-control" v-model="edit_additional_rate" />
                          </div>
                        </div>
                        <br>
                             <div class="form-group row">
                                <label for="staticEmail" class="col-sm-4 col-form-label text-center">Active State</label>
                                 <div class="col-sm-8">
                                  <select id="inputState" class="form-control" @change="get_select_active_state_edit($event)">
                                     <option :selected="active==1" value="1">Active</option>
                                     <option :selected="active==0" value="0">Deactive</option>
                                  </select>
                              </div>
                           </div>
                      </form>
                    </div>
                  </div>
                </div>
                <div class="modal-footer">
                  <button id="btn-edit" class="float-left btn btn-success" @click="editVehicleTypes" data-dismiss="modal">Edit</button>

                  <button class="btn btn-secondary" data-dismiss="modal">
                    <i class="flaticon-delete-1"></i> Cancel
                  </button>
                </div>
              </div>
            </div>
          </div>
          <!--  End Model -->
        </div>
      </div>
    </div>
  </div>
  
</template>


<script>
export default {
    data() {
        return {
            vehicleTypes: [],

           
            name: null,
            base_rate: null,
            additional_rate: null,
            id: null,

            active:null,

            edit_id: null,
            edit_name: null,
            edit_base_rate:null,
            edit_additional_rate:null,
            edit_active: null,       
            edit_active: null,


            name: null,
            submitStatus: null,

            errors: [],

//============ TO show and hide create form ====================
            show_create_form: 0
        };
    },

    mounted() {
        this.fetchVehicleTypes();
        
    },

    methods: {
        reset() {
    //===========Add =====================     
            this.id = null;
            this.name = null;
            this.base_rate=null;
            this.additional_rate=null;
            this.active = null;

   //========= edit =====================         
            this.edit_id = null;
            this.edit_name = null;
            this.edit_base_rate=null;
            this.edit_additional_rate=null;
            this.edit_active = null;
        },

        setToUpdate(id, name, base_rate,additional_rate,active) {
            this.edit_id = id;
            this.edit_name = name;
            this.edit_base_rate= base_rate;
            this.edit_additional_rate= additional_rate;
            this.edit_active = active;
        },

        fetchVehicleTypes() {
            axios.get("/user/fetch/vehicleTypes")
                .then(res => {
                    if (res.status == 200) {
                        console.log(res);
                        this.vehicleTypes = res.data;
                    }
                })
                .catch(err => {
                    console.log("error:" + err);
                });
        },

        

//============create VehicleTypes method================================
        createVehicleTypes() {
            this.errors = [];

                axios.post("/user/create/vehicleTypes", {
                        name: this.name,
                        base_rate:this.base_rate,
                        additional_rate:this.additional_rate,

                }).then(res => {
                    if (res.status == 200 && res.data == 1) {
                        Swal.fire({
                          position: "top-end",
                            icon: "success",
                            title: "Successfully Insert a VehicleTypes",
                            showConfirmButton: false,
                            timer: 1500
                        });

                        this.reset();
                        this.fetchVehicleTypes();
                        this.hideform()

                        
                    }
                }).catch(err => {
                    if (err.response.status == 422) {
                        this.errors = err.response.data.errors;
                         Swal.fire(

                            "Oops.... Incorrect Values.....!",
                            "PLease Check The Input Fileds Again.",
                            "question"
                        );
                    }
                });
        },


        hideform(){
            this.show_create_form = 0;
        },

        get_select_active_state_edit(event) {
            this.edit_active = event.target.value;
        },

// ================== edit VehicleTypes method =============================================
       
        editVehicleTypes() {
            
                axios.put("/user/update/vehicleTypes", {
                        id: this.edit_id,
                        name: this.edit_name,
                        base_rate:this.edit_base_rate,
                        additional_rate:this.edit_additional_rate,
                        active: this.edit_active,
                        
                }).then(res => {
                    if (res.status == 200 && res.data == 1) {
                        Swal.fire(
                            "Success",
                            "VehicleTypes update Successfull!",
                            "success"
                        );
                        this.reset();
                        this.fetchVehicleTypes();

                        
                    } else {
                        Swal.fire(
                            "Error",
                            "VehicleTypes update unsuccessfull!",
                            "error"
                        );
                    }
                }).catch(err => {
                    if (err.response.status == 422)
                        
                        Swal.fire(
                            "Error",
                            "VehicleTypes update unsuccessfull!",
                            "error"
                        );
                });
        },
// ============================ delete VehicleTypes ====================================================
                destroyVehicleTypes(id) {
                    Swal.fire({
                        title: "(Delete a VehicleTypes)Are you sure?",
                        text: "You won't be able to revert this!",
                        icon: "warning",
                        showCancelButton: true,
                        confirmButtonColor: "#3085d6",
                        cancelButtonColor: "#d33",
                        confirmButtonText: "Yes, delete it!"


                    }).then(result => {
                        if (result.isConfirmed) {
                           

                    axios.post("/user/destroy/vehicleTypes", {
                            id: id
                        }).then(res => {
                            if (res.status == 200 && res.data == 1) {
                                Swal.fire(
                                    "Deleted!",
                                    "Your file has been deleted.",
                                    "success"
                                );

                                
                                this.fetchVehicleTypes();
                            } else {
                                Swal.fire(
                                    "Error",
                                    "VehicleTypes destroy unsuccessfull!",
                                    "error"
                                );
                            }
                        }).catch(err => {
                            if (err.response.status == 422) {
                               
                                Swal.fire(
                                    "Error",
                                    "VehicleTypes destroy unsuccessfull!",
                                    "error"
                                );
                            }
                        });
                     }
            });
        },
    },
};
</script>


