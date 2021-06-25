<template>
    <div class="overflow-auto">
     <div class="container">
        <div class="row mt-3">
          <div class="col-md-12">
            <div class="card">

              <div class="card-header">
                <h3 class="card-title">
                  Role 
                </h3> 
              </div>
              <div class="card-body">
                     <b-row class="p-20">
                <b-col>
                  <b-button variant="outline-success" size="sm" @click="openModal('save' , 'SAVE', $event.target)"> 
                  Add New <i class="fas fa-plus"></i>
                  </b-button>
                </b-col>
                 <b-col sm="4" md="2" class="my-1">
                  <b-form-group
                    label="Per page"
                    label-for="per-page-select"
                    label-cols-sm="8"
                    label-cols-md="8"
                    label-cols-lg="6"
                    label-align-sm="right"
                    label-size="sm"
                    class="mb-0"
                  >
                    <b-form-select
                      id="per-page-select"
                      v-model="perPage"
                      :options="pageOptions"
                      size="sm"
                    ></b-form-select>
                  </b-form-group>
                </b-col>
                <b-col lg="8" class="my-1">
                  <b-form-group
                    label="Filter"
                    label-for="filter-input"
                    label-cols-sm="3"
                    label-align-sm="right"
                    label-size="sm"
                    class="mb-0"
                  >
                    <b-input-group size="sm">
                      <b-form-input
                        id="filter-input"
                        v-model="filter"
                        type="search"
                        placeholder="Type to Search"
                      ></b-form-input>

                      <b-input-group-append>
                        <b-button :disabled="!filter" @click="filter = ''">Clear</b-button>
                      </b-input-group-append>
                    </b-input-group>
                  </b-form-group>
                </b-col>
              </b-row>
              <br>
              <b-table
                id="my-table"
                :items="items"
                :per-page="perPage"
                :current-page="currentPage"
                :filter="filter"
                :fields="fields"
                :head-variant="headvariant"
                primary-key="id"
                :tbody-transition-props="transProps"
                :sort-by.sync="sortBy"
                :sort-desc.sync="sortDesc"
                stacked="md"
                small striped hover responsive
              >
                <template #cell(no)="row">
                  {{ row.index + 1 }}
                </template>
                <template #cell(permissions)="row">
                    <div class="d-flex flex-column">
                      <span v-for="(permission,index) in row.item.permissions" :key="index">
                        {{ permission.name }}
                      </span>
                    </div>
                </template>
                <template #cell(actions)="row">
                  <b-button variant="outline-info" size="sm" @click="openModal('edit' , 'Edit ID : ' +row.item.id, $event.target, row.item)" class="mr-1">
                    <i class="fa fa-edit"></i>
                  </b-button>
                  <b-button variant="outline-danger" size="sm" @click="deleteRole(row.item.id)">
                   <i class="fa fa-trash"></i>
                  </b-button>
                </template>
              </b-table>
              <b-row>
                 <b-col class="my-1">
                  <b-pagination
                    v-model="currentPage"
                    :total-rows="rows"
                    :per-page="perPage"
                    align="right"
                    size="sm"
                    class="my-0"
                  ></b-pagination>
                </b-col>
              </b-row>

                <!-- Info modal -->
              <b-modal @shown="focusMyElement" ref="my-modal" :id="infoModal.id" :title="infoModal.title" @hide="resetInfoModal" hide-footer>
                <form @submit.prevent="editMode ? update() : store()" > 
                  <div class="modal-body">
                        <b-form-group id="example-input-group-1" label="Role" label-for="nama_role">
                          <b-form-input
                            id="nama_role"
                            name="nama_role"
                            ref="nama_roleReff"
                            v-model="$v.form.name.$model"
                            :state="validateState('name')"
                            aria-describedby="input-1-live-feedback"
                          ></b-form-input>

                          <b-form-invalid-feedback
                            id="input-1-live-feedback"
                          >This is a required field.
                          </b-form-invalid-feedback>
                        </b-form-group>

                        <b-form-group id="permissions" label="Permissions" label-for="Permissions">
                          <b-form-input
                            id="permissions"
                            name="permissions"
                            ref="permissionsReff"
                            placeholder="Permissions"
                            v-model="$v.form.permissions.$model"
                            :state="validateState('permissions')"
                            aria-describedby="input-1-live-feedback"
                          ></b-form-input>
                          <b-form-invalid-feedback
                            id="input-1-live-feedback"
                          >This is a required field.
                          </b-form-invalid-feedback>
                        </b-form-group>
                    </div>
                    <div class="modal-footer">
                      <button type="submit" v-show="!editMode" class="btn btn-primary">
                        Create
                      </button>
                      <button type="submit" v-show="editMode" class="btn btn-primary">
                        Update
                      </button>
                      <button type="button" class="btn btn-danger" @click="hideModal" >
                        Close
                      </button>
                    </div>
                </form>
              </b-modal>
              </div>
            </div>
          </div>
        </div>
     </div>
    </div>
</template>

<script>
import { validationMixin } from "vuelidate";
import { required, minLength } from "vuelidate/lib/validators";

  export default {
    mixins: [validationMixin],
    
    data() {
      return {
        perPage: 10,
        editMode:false,
        pageOptions: [1, 5, 10, 15, { value: 100, text: "All" }],
        currentPage: 1,
        filter: "",
        items: [],
        fields: [
          {
            key: 'no',
            sortable: true,
            tdClass:'text-center',
            thClass:'text-center'
          },
          {
            key: 'name',
            sortable: true
          },
           {
            key: 'permissions',
            sortable: true
          },
          { 
            key: 'actions', 
            label: 'Actions' ,
            tdClass:'text-center',
            thClass:'text-center',
            sortable:false,
          }
        ],
        headvariant:'dark',
        transProps: {
          name: 'flip-list'
        },
        sortBy: 'id',
        sortDesc: false,
        infoModal: {
          id: 'info-modal',
          title: '',
        },
        form: {
          id : '',
          name : '',
          permissions:'',
        },
      }
    },
    validations: {
      form: {
        name: {
          required,
          minLength: minLength(1)
        },
        permissions: {
          required,
        }
      }
    },
    mounted() {
      this.loadData();
    },
    methods: {
     loadData() {
        axios.get("api/role").then((response) => {
          this.items = Object.values(response.data.role);
          //console.log(Object.values(response.data));
        }); 
      },   
      focusMyElement()
      {
        // this.detailMode ? this.$refs.karyawanReff.focus():  this.$refs.nama_timReff.focus();
      },
      openModal(tipe, title, button,item) {
        if(tipe=="edit") {
          this.editMode = true;
          this.form.id =item.id;
          this.form.name =item.name
        }
        else {
          this.editMode = false;
          this.form.name ='';
        }
        this.infoModal.title = title
        this.$root.$emit('bv::show::modal', this.infoModal.id, button)
      },
      resetInfoModal() {
        this.infoModal.title = ''
          this.$nextTick(() => {
          this.$v.$reset();
        });
      },
      hideModal() {
        this.$refs['my-modal'].hide()
      },
      validateState(name) {
        const { $dirty, $error } = this.$v.form[name];
        return $dirty ? !$error : null;
      },
      async store() {
         this.$v.form.$touch();
          if (this.$v.form.$anyError) {
            return;
          }
          try {
            let response =  await axios.post('api/role',this.form)
             //console.log(response.status);
              if(response.status==200){
                  this.form.name= '';
                  this.hideModal();
                  this.$swal({
                    icon: 'success',
                    title: 'Role Added successfully'
                  });
                  this.loadData();
              }
          } catch (e) {
            console.log(e.response.data.errors);
          }
      },
      async update() {
        this.$v.form.$touch();
          if (this.$v.form.$anyError) {
            return;
          }
          try {
            let id = this.form.id;
            let updated = await axios.put('api/role/'+id,this.form)
            console.log(updated.status);
              if(updated.status==200){
                  this.form.name = '';
                  this.hideModal();
                  this.$swal({
                    icon: 'success',
                    title: 'Role Updated successfully'
                  });
                  this.loadData();
              }
          } catch (e) {
             this.$swal({
                icon: 'Error',
                title: 'Role Updated Failed '+e.response.data.errors
              });
            this.theErrors = e.response.data.errors ;
          }
      },
      deleteRole(id) { 
        this.$swal({
          title: 'Are you sure?',
          text: "You won't be able to revert this!",
          icon: 'warning',
          showCancelButton: true,
          confirmButtonColor: '#3085d6',
          cancelButtonColor: '#d33',
          confirmButtonText: 'Yes, delete it!'
        }).then((result) => {
          if (result.isConfirmed) {
            axios.delete("api/role/"+id).then(response => {
              this.$swal(
                  'Deleted!',
                  'Your file has been deleted.',
                  'success'
              )
              this.loadData();
            });
            
          }
        })
      },

    },
    computed: {
      rows() {
        return this.items.length
      }
    },
  }
</script>
<style>
table#my-table .flip-list-move {
  transition: transform 1s;
}
</style>