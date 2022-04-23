<template>
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div class="row col-12">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                    <div class="widget-two">
                        <div class="widget-content">
                            <div class="w-numeric-value">
                                <div class="w-content">
                                    <span class="w-value">Admins</span>
                                    <span class="w-numeric-title">Go to columns for details.</span><br /><br />
                                    <button class="btn btn-primary" @click="show_create_form = !show_create_form">
                                        <span v-if="show_create_form == 0">Show Create Form</span>
                                        <span v-if="show_create_form == 1">Hide Create Form</span>
                                    </button>
                                </div>
                                <div class="w-icon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign">
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
                                        <span class="w-value">Create an Admin</span>
                                    </div>
                                    <div class="w-icon">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-dollar-sign">
                                            <line x1="12" y1="1" x2="12" y2="23"></line>
                                            <path d="M17 5H9.5a3.5 3.5 0 0 0 0 7h5a3.5 3.5 0 0 1 0 7H6"></path>
                                        </svg>
                                    </div>
                                </div>

                                <div style="margin: 50px">
                                    <div class="widget-content widget-content-area">
                                        <!-- Create User Form Start -->

                                        <form method="POST" enctype="multipart/form-data" @submit.prevent="createUser">
                                            <div style="margin: 50px">
                                                <div class="form-row mb-4">
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleFormControlInput1">Name</label>
                                                        <input type="text" :class=" errors.name ? 'form-control is-invalid' : 'form-control' " placeholder="Full name" v-model="name"/>
                                                        <small v-if="errors.name" class="text-danger">{{errors.name[0]}}</small>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleFormControlInput1">Email</label>
                                                        <input type="email" :class="errors.email ? 'form-control is-invalid' : 'form-control'" placeholder="Email" v-model="email"/>
                                                        <small v-if="errors.email" class="text-danger">{{errors.email[0]}}</small>
                                                    </div>
                                                </div>

                                                 <div class="form-row mb-4">
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleFormControlInput1">Password</label>
                                                        <input type="password" class="form-control" :class=" errors.password ? 'form-control is-invalid'  : 'form-control' " placeholder="Password" v-model="password" />
                                                        <small v-if=" errors.password " class="text-danger" >{{errors.password[0]}}</small>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleFormControlInput1">Confirm Password</label>
                                                        <input type="password" class="form-control" placeholder="Confirm Password" v-model="password_confirmation"/>
                                                    </div>
                                                </div> 
                                                <input type="submit" value="submit" class="btn btn-primary"/>
                                            </div>
                                        </form>
                                        <!-- Create User Form End  -->
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
                                    <span class="w-value">Admins View</span>
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
                                                    <div class="th-content">
                                                        Count
                                                    </div>
                                                </th>
                                                <th class="text-center">
                                                    <div class="th-content">
                                                        Id
                                                    </div>
                                                </th>
                                                <th class="text-center">
                                                    <div class="th-content">
                                                        Name
                                                    </div>
                                                </th>
                                                <th class="text-center">
                                                    <div class="th-content">
                                                        Email
                                                    </div>
                                                </th>
                                                <th class="text-center">
                                                    <div class="th-content">
                                                        Edit
                                                    </div>
                                                </th>
                                                <th class="text-center">
                                                    <div class="th-content">
                                                        Destroy
                                                    </div>
                                                </th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(admin, index) in admins" :key="index">
                                                <td class="text-center">
                                                    {{ index + 1 }}
                                                </td>
                                                <td class="text-center">
                                                    {{ admin.id }}
                                                </td>

                                                <td class="text-center">
                                                    {{ admin.name }}
                                                </td>
                                                <td class="text-center">
                                                    {{ admin.email }}
                                                </td>
                                             
                                                <td class="text-center">
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <button class="btn btn-outline-primary mb-2 mx-4" @click="
                                                                setToUpdate(admin.id, admin.name, admin.email )" data-toggle="modal" data-target="#editAdminModal">
                                                            <i class="fa fa-pencil" aria-hidden="true"></i>Edit
                                                        </button>
                                                    </div>
                                                </td>

                                                <td class="text-center">
                                                    <button class="btn btn-outline-danger mb-2" @click="destroyAdmin(admin.id)">
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
                    <div class="modal fade bd-example-modal-lg" id="editAdminModal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
                        <!-- <div  class="modal fade modal-xl" id="editBrandModal" tabindex="-1" role="dialog" aria-labelledby="addContactModalTitle" aria-hidden="true"> -->
                        <!-- <div class="modal-dialog modal-dialog-centered" role="document"> -->
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Edit User</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <i class="flaticon-cancel-12 close" data-dismiss="modal"></i>
                                    <div class="add-contact-box">
                                        <div class="add-contact-content">
                                            <form id="addContactModalTitle">
                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-sm-4 col-form-label text-center">Full Name</label>
                                                    <div class="col-sm-8">
                                                        <input type="full_name" id="c-location" class="form-control" v-model="edit_name" placeholder="ex: john alex"/>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-sm-4 col-form-label text-center">Email</label>
                                                    <div class="col-sm-8">
                                                        <input type="email" id="c-location" class="form-control" v-model="edit_email" placeholder="ex: john@gmail.com"/>
                                                    </div>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button id="btn-edit" class="float-left btn btn-success" @click="editAdmin" data-dismiss="modal">
                                        Edit
                                    </button>

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
            admins: [],

            email: null,
            name: null,
            password: null,
            password_confirmation: null,
            id: null,

            active: null,

            edit_id: null,
            edit_name: null,
            edit_email: null,
            edit_active: null,

            edit_active: null,

            name: null,
            submitStatus: null,

            errors: [],

            //TO show and hide create form
            show_create_form: 0
        };
    },

    mounted() {
        this.fetchAdmin();
    },

    methods: {
        reset() {
           
            this.id = null;
            this.email = null;
            this.name = null;
         
            this.password = null,
            this.password_confirmation = null,
          

            //for edit purpose
            this.edit_id = null;
            this.edit_name = null;
            this.edit_email = null;
        },

        setToUpdate(id, name, email) {
            this.edit_id = id;
            this.edit_name = name;
            this.edit_email = email;
        },

        fetchAdmin() {
            axios
                .get("/user/fetch/admin")
                .then(res => {
                    if (res.status == 200) {
                        console.log(res);
                        this.admins = res.data;
                    }
                })
                .catch(err => {
                    console.log("error:" + err);
                });
        },

        //create user method
        createUser() {
            this.errors = [];

            axios.post("/user/create/admin", {
                   
                    name: this.name,
                    email: this.email,
                    password: this.password,
                    password_confirmation: this.password_confirmation,

                }).then(res => {
                    if (res.status == 200 && res.data == 1) {
                        Swal.fire(
                            "Success",
                            "Admin Create Successfull!",
                            "success"
                        );

                        this.reset();
                        this.fetchAdmin();

                    }
                }).catch(err => {
                    if (err.response.status == 422) {
                        this.errors = err.response.data.errors;
                    }
                });
        },

        get_select_active_state_edit(event) {
            this.edit_active = event.target.value;
        },

        editAdmin() {
           

            axios.put("/user/update/admin", {
                    id: this.edit_id,
                    name: this.edit_name,
                    email: this.edit_email,

                }).then(res => {
                    if (res.status == 200 && res.data == 1) {
                        Swal.fire(
                            "Success",
                            "Admin update Successfull!",
                            "success"
                        );
                        this.reset();
                        this.fetchAdmin();

                    } else {
                        Swal.fire(
                            "Error",
                            "Admin update unsuccessfull!",
                            "error"
                        );
                    }
                }).catch(err => {
                    if (err.response.status == 422)
                
                        Swal.fire(
                            "Error",
                            "Admin update unsuccessfull!",
                            "error"
                        );
                });
        },

        destroyAdmin(id) {
            Swal.fire({
                title: "(Delete a Admin)Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then(result => {
                if (result.isConfirmed) {
                
                    axios.post("/user/destroy/admin", {
                            id: id
                        }).then(res => {
                            if (res.status == 200 && res.data == 1) {
                                Swal.fire(
                                    "Deleted!",
                                    "Your file has been deleted.",
                                    "success"
                                );

                                this.fetchAdmin();
                            } else {
                                Swal.fire(
                                    "Error",
                                    "Admin destroy unsuccessfull!",
                                    "error"
                                );
                            }
                        }).catch(err => {
                            if (err.response.status == 422) {
                               
                                Swal.fire(
                                    "Error",
                                    "Admin destroy unsuccessfull!",
                                    "error"
                                );
                            }
                        });
                }
            });
        }
    }
};
</script>
