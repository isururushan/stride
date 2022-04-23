<template>
    <div class="layout-px-spacing">
        <div class="row layout-top-spacing">
            <div class="row col-12">
                <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
                    <div class="widget-two">
                        <div class="widget-content">
                            <div class="w-numeric-value">
                                <div class="w-content">
                                    <span class="w-value">Services</span>
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
                                        <span class="w-value">Create a Services</span>
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

                                        <form method="POST" enctype="multipart/form-data" @submit.prevent="create">
                                            <div style="margin: 50px">
                                                <div class="form-row mb-4">
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleFormControlInput1">Title</label>
                                                        <input type="text" :class="errors.title ? 'form-control is-invalid': 'form-control' " placeholder="Title" v-model="title"/>
                                                        <small v-if="errors.title" class="text-danger" >{{ errors.title[0] }}</small>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleFormControlInput1">Description</label>
                                                        <input type="text" :class=" errors.description ? 'form-control is-invalid' : 'form-control'" placeholder="Description" v-model="description"/>
                                                        <small v-if=" errors.description " class="text-danger">{{ errors.description[0]}}</small>
                                                    </div>
                                                </div>

                                                <!-- <div class="form-row mb-4">
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleFormControlInput1">Amount</label>
                                                        <input type="text" :class="errors.amount ? 'form-control is-invalid' : 'form-control'" placeholder="Amount" v-model="amount"/>
                                                        <small v-if="errors.amount" class="text-danger">{{errors.amount[0]}}</small>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="exampleFormControlInput1">Comment</label>
                                                        <input type="text" :class="errors.comment ? 'form-control is-invalid'  : 'form-control' " placeholder="Comment" v-model="comment" />
                                                        <small v-if="errors.comment" class="text-danger">{{errors.comment[0] }}</small>
                                                    </div>
                                                </div> -->

                                                <div class="form-row mb-4">
                                                   <!-- <div class="form-group col-lg-6">
                                                        <label for="exampleFormControlInput1">Category</label>
                                                            <select class="form-control" :class=" errors.category ? 'form-control is-invalid' : 'form-control' " v-model="category">
                                                            <option value="null">Select Category</option>
                                                            <option value="Graphics_Design">Graphics & Design</option>
                                                            <option value="Digital_Marketing">Digital Marketing</option>
                                                            <option value="Writing_Translation">Writing & Translation</option>
                                                            <option value="Video_Animation">Video & Animation</option>
                                                            <option value="Programming_Tech">Programming & Tech</option>
                                                            <option value="Business">Business</option>
                                                            <option value="Fun_Lifestyle">Fun & Lifestyle</option>
                                                            <option value="Music_Audio">Music & Audio</option>
                                                        </select>
                                                        <small v-if=" errors.category " class="text-danger">{{errors.category[0]}}</small>
                                                    </div> -->
                                                    <div class="form-group col-md-12">
                                                        <label for="exampleFormControlInput1">Choose Image</label>
                                                        <div class="custom-file mb-4">
                                                            <input type="file" :class="errors.image ? 'form-control custom-file-input is-invalid':'form-control custom-file-input'"  id="customFile" @change="onImageChange" >
                                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                                            <small v-if="errors.image" class="text-danger">{{errors.image[0]}}</small>
                                                        </div>

                                                        <div v-if="imagepreview" style="margin-top: -5px; margin-buttom:50px">
                                                            <img :src="imagepreview"  style="border-radius: 50%;" alt="" width="150px" height="150px">
                                                        </div><br>
                                                    </div>
                                                </div>

                                                <!-- <div class="form-row mb-4">
                                                    <div class="form-group col-lg-12">
                                                        <label for="exampleFormControlInput1">Status</label>
                                                         <select class="form-control" :class=" errors.status ? 'form-control is-invalid' : 'form-control' " v-model="status">
                                                            <option value="null">Select Status</option>
                                                            <option value="credit_payment">Credit Payment</option>
                                                            <option value="advance_payment_done">Advance Payment Done</option>
                                                            <option value="delivered_to_air_cargo">Dilivered to Air Cargo</option>
                                                            <option value="shipping_payment_pending">Shipment payment pending</option>
                                                        </select>
                                                        <small v-if=" errors.status " class="text-danger">{{errors.status[0]}}</small>
                                                    </div>
                                                </div> -->

                                                <!-- <div class="form-row mb-4">
                                                    <div class="form-group col-md-6" >
                                                        <label for="exampleFormControlInput1">Select Payment</label>
                                                        <select id="inputState" class="form-control" @change="set_payment_name($event)">
                                                            <option value="null">Please Select Payment</option>
                                                            <option v-for="(payment,index) in payments" :key="index" :value="payment.id">{{payment.name}}</option>
                                                        </select>
                                                        <small v-if="errors.payment" class="text-danger">{{errors.payment[0]}}</small>
                                                    </div>
                                                    <div class="form-group col-md-6" >
                                                        <label for="exampleFormControlInput1">Select Order</label>
                                                        <select id="inputState" class="form-control" @change="set_order_name($event)">
                                                            <option value="null">Please Select Order</option>
                                                            <option v-for="(order,index) in orders" :key="index" :value="order.id">{{order.name}}</option>
                                                        </select>
                                                        <small v-if="errors.order" class="text-danger">{{errors.order[0]}}</small>
                                                    </div>
                                                </div> -->

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
                                    <span class="w-value">Services View</span>
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
                                                        Id
                                                    </div>
                                                </th>
                                                <th class="text-center">
                                                    <div class="th-content">
                                                        Image
                                                    </div>
                                                </th>
                                                <th class="text-center">
                                                    <div class="th-content">
                                                        Title
                                                    </div>
                                                </th>
                                                <th class="text-center">
                                                    <div class="th-content">
                                                        Description
                                                    </div>
                                                </th>
                                                <!-- <th class="text-center"><div class="th-content">Active</div></th> -->
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
                                            <tr v-for="(invoice, index) in invoices" :key="index">
                                                <td class="text-center">
                                                    {{ invoice.id }}
                                                </td>
                                                <td>
                                                    <img :src="`/storage/services/${invoice.image}`" class="rounded-circle" width="80px" height="80px" alt srcset/>
                                                </td>
                                                <td class="text-center">
                                                    {{ invoice.title }}
                                                </td>
                                                <td class="text-center">
                                                    {{ invoice.description }}
                                                </td>
                                                 <!-- <td class="text-center">
                                                    {{ invoice.amount }}
                                                </td>
                                                 <td class="text-center">
                                                    {{ invoice.date }}
                                                </td>
                                                 <td class="text-center">
                                                    {{ invoice.comment }}
                                                </td>
                                                 <td class="text-center">
                                                    {{ invoice.status }}
                                                </td> -->
                                                <!-- <td class="text-center">
                                                    <div v-if="shipping_agent.active == 1">
                                                        <span class="shadow-none badge badge-primary">Active</span>
                                                    </div>
                                                    <div v-else>
                                                        <span class="shadow-none badge badge-warning">Deactive</span>
                                                    </div>
                                                </td> -->

                                                <td class="text-center">
                                                    <div class="btn-group" role="group" aria-label="Basic example">
                                                        <button class="btn btn-primary mb-2 mx-4" @click="setToUpdate(
                                                                    invoice.id,
                                                                    invoice.title,
                                                                    invoice.description,)"
                                                            data-toggle="modal" data-target="#editAdminModal">
                                                            <i class="fa fa-pencil" aria-hidden="true"></i>Edit</button>
                                                    </div>
                                                </td>

                                                <td class="text-center">
                                                    <button class="btn btn-danger mb-2" @click=" destroy(invoice.id)">
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
                                    <h5 class="modal-title">Edit Services</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body">
                                    <i class="flaticon-cancel-12 close" data-dismiss="modal"></i>
                                    <div class="add-contact-box">
                                        <div class="add-contact-content">
                                            <form id="addContactModalTitle">

                                                <!-- <div class="form-group row">
                                                    <label for="staticEmail" class="col-sm-4 col-form-label text-center">Select Image</label>
                                                    <div class="col-sm-8">
                                                        <div class="custom-file mb-4">
                                                            <input type="file" :class="errors.image ? 'form-control custom-file-input is-invalid':'form-control custom-file-input'"  id="customFile" @change="onImageChange" >
                                                            <label class="custom-file-label" for="customFile">Choose file</label>
                                                            <small v-if="errors.image" class="text-danger">{{errors.image[0]}}</small>
                                                        </div>


                                                        <div v-if="imagepreview" style="margin-top: -5px; margin-buttom:50px">
                                                            <img :src="imagepreview" alt="" width="150px" height="150px">
                                                        </div><br>
                                                    </div>
                                                </div> -->

                                                <div class="form-group row">
                                                    <label for="staticEmail" class="col-sm-4 col-form-label text-center">Name</label>
                                                    <div class="col-sm-8">
                                                        <input type="full_name" id="c-location" class="form-control" v-model="edit_title" placeholder="ex: john alex"/>
                                                    </div>
                                                </div>

                                                <div class="form-group row">
                                                    <label  for="staticEmail" class="col-sm-4 col-form-label text-center">Email</label>
                                                    <div class="col-sm-8">
                                                        <input type="email" id="c-location" class="form-control" v-model="edit_description" placeholder="ex: john@gmail.com"/>
                                                    </div>
                                                </div>

                                                <!-- <div class="form-group row">
                                                    <label for="staticEmail" class="col-sm-4 col-form-label text-center">Address</label>
                                                    <div class="col-sm-8">
                                                        <input type="address" id="c-location" class="form-control" v-model="edit_address" placeholder="ex: john alex"/>
                                                    </div>
                                                </div> -->

                                                <!-- <div class="form-group row">
                                                    <label for="staticEmail" class="col-sm-4 col-form-label text-center">City</label>
                                                    <div class="col-sm-8">
                                                        <input type="full_name" id="c-location" class="form-control" v-model="edit_city" placeholder="ex: john alex"/>
                                                    </div>
                                                </div> -->

                                                <!-- <div class="form-group row">
                                                    <label for="staticEmail" class="col-sm-4 col-form-label text-center">Country</label>
                                                    <div class="col-sm-8">
                                                        <input type="full_name" id="c-location" class="form-control" v-model="edit_country" placeholder="ex: john alex"/>
                                                    </div>
                                                </div> -->

                                                <!-- <div class="form-group row">
                                                    <label for="staticEmail" class="col-sm-4 col-form-label text-center">Telephone</label>
                                                    <div class="col-sm-8">
                                                        <input type="full_name" id="c-location" class="form-control" v-model="edit_telephone" placeholder="ex: john alex"/>
                                                    </div>
                                                </div> -->

                                                <!-- <div class="form-group row">
                                                    <label for="staticEmail" class="col-sm-4 col-form-label text-center">Comment</label>
                                                    <div class="col-sm-8">
                                                        <input type="full_name" id="c-location" class="form-control" v-model="edit_comment" placeholder="ex: john alex"/>
                                                    </div>
                                                </div> -->

                                                <!-- <div class="form-group row">
                                                    <label for="staticEmail" class="col-sm-4 col-form-label text-center">Active State</label>

                                                    <div class="col-sm-8">
                                                        <select id="inputState" class="form-control" @change="get_select_active_state_edit($event)">

                                                                    <option :selected="active==1" value="1">Active</option>
                                                                    <option :selected="active==0" value="0">Deactive</option>
                                                        </select>
                                                    </div>
                                                </div> -->
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button id="btn-edit" class="float-left btn btn-success" @click="edit" data-dismiss="modal">Edit</button>

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
            invoices: [],
            payments: [],
            orders: [],
            errors: [],

            id: null,
            title: null,
            description: null,
            // category:null,

            edit_id: null,
            edit_title: null,
            edit_description: null,


            // pro_image: null,
            image: null,
            imagepreview: null,


            //TO show and hide create form
            show_create_form: 0
        };
    },

    mounted() {
        this.fetchData();
    },

    methods: {
        reset() {

            this.id = null;
            this.title = null;
            this.description = null;
            this.category = null;


            this.image = null;
            this.imagepreview = null;

            //for edit purpose
            this.edit_id = null;
            this.edit_title = null;
            this.edit_description = null;

            this.edit_image = null;
            this.imagepreview_edit = null;
        },

        setToUpdate(id, title, description) {
            this.edit_id = id;
            this.edit_title = title;
            this.edit_description = description;

        },

        fetchData() {
            axios.get("/admin/fetch/service").then(res => {
                    if (res.status == 200) {
                        console.log(res);
                        this.invoices = res.data;
                    }
                }).catch(err => {
                    console.log("error:" + err);
                });
        },



        //create user method
        create() {
            this.errors = [];

            axios.post("/admin/create/service", {
                    title: this.title,
                    description: this.description,
                    image: this.image,
                    // category: this.category,
                }).then(res => {
                    if (res.status == 200 && res.data == 1) {
                        Swal.fire({
                            position: "top-end",
                            icon: "success",
                            title: "Successfully Insert a Post",
                            showConfirmButton: false,
                            timer: 1500
                        });

                        this.reset();
                        this.fetchData();

                        // this.$router.push('/admin/view-admins');
                    }
                })
                .catch(err => {
                    if (err.response.status == 422) {
                        this.errors = err.response.data.errors;
                    }
                });
        },

        //image click proccess and image preview
        onImageChange(e) {
            this.image = e.target.files[0];
            let reader = new FileReader();
            reader.readAsDataURL(this.image);
            reader.onload = e => {
                this.imagepreview = e.target.result;
            };

            let files = e.target.files || e.dataTransfer.files;

            if (!files.length) return;

            this.createImage(files[0]);
        },

        //image click proccess and image preview
        createImage(file) {
            let reader = new FileReader();
            let vm = this;
            reader.onload = e => {
                vm.image = e.target.result;
            };
            reader.readAsDataURL(file);
        },

        get_select_active_state_edit(event) {
            this.edit_active = event.target.value;
        },

        set_payment_name(event){
            this.payment = event.target.value;
        },

        set_order_name(event){
            this.order = event.target.value;
        },

        edit() {
            // if(this.edit_active == null){
            //     this.edit_active = this.active;
            // }

            axios.put("/admin/update/service", {
                    id: this.edit_id,
                    // image: this.image,
                    title: this.edit_title,
                    description: this.edit_description,
                })
                .then(res => {
                    if (res.status == 200 && res.data == 1) {
                        Swal.fire(
                            "Success",
                            "Post update Successfull!",
                            "success"
                        );
                        this.reset();
                        this.fetchData();

                        // $("#update_close_btn").click();
                    } else {
                        Swal.fire(
                            "Error",
                            "Post update unsuccessfull!",
                            "error"
                        );
                    }
                })
                .catch(err => {
                    if (err.response.status == 422)
                        // this.uerrors = err.response.data.errors;
                        Swal.fire(
                            "Error",
                            "Post update unsuccessfull!",
                            "error"
                        );
                });
        },

        destroy(id) {
            Swal.fire({
                title: "(Delete this Post)Are you sure?",
                text: "You won't be able to revert this!",
                icon: "warning",
                showCancelButton: true,
                confirmButtonColor: "#3085d6",
                cancelButtonColor: "#d33",
                confirmButtonText: "Yes, delete it!"
            }).then(result => {
                if (result.isConfirmed) {
                    // Swal.fire(
                    // 'Deleted!',
                    // 'Your file has been deleted.',
                    // 'success'
                    // )

                    axios.post("/admin/destroy/service", {
                            id: id
                        })
                        .then(res => {
                            if (res.status == 200 && res.data == 1) {
                                Swal.fire(
                                    "Deleted!",
                                    "Post has been deleted.",
                                    "success"
                                );

                                this.reset();
                                this.fetchData();
                            } else {
                                Swal.fire(
                                    "Error",
                                    "Post destroy unsuccessfull!",
                                    "error"
                                );
                            }
                        })
                        .catch(err => {
                            if (err.response.status == 422) {
                                // this.errors = err.response.data.errors;
                                Swal.fire(
                                    "Error",
                                    "Post destroy unsuccessfull!",
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
