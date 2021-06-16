<template>
  <div class="overflow-auto">
     <div class="container">
        <div class="row mt-3">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  Penilaian
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
               <!-- <template #cell(category_id)="row">
                {{ row.item.category  }}
              </template> -->
              <template #cell(created_at)="row">
                {{ row.item.created_at | formatDate}}
              </template>
              <template #cell(updated_at)="row">
                {{ row.item.updated_at | formatDate}}
              </template>
                <template #cell(actions)="row">
                  <b-button variant="outline-info" size="sm" @click="openModal('edit' , 'Edit ID : ' +row.item.id, $event.target,row.item)" class="mr-1">
                    <i class="fa fa-edit"></i>
                  </b-button>
                  <b-button variant="outline-danger" size="sm" @click="deleteCategory(row.item.id)">
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
              <b-modal ref="my-modal" :id="infoModal.id" :title="infoModal.title" @hide="resetInfoModal" hide-footer>
                <form @submit.prevent="editMode ? update() : store()">
                  <div class="modal-body">
                    <b-form-datepicker id="example-datepicker" label="Choose a Date" label-for="tanggal" class="mb-2" v-model="$v.form.tanggal.$model"
                        :state="validateState('tanggal')"></b-form-datepicker>
                    <b-form-group id="timgroup" label="Tim" label-for="tim_id">
                      <v-select v-model="selected1"  :options="tims">
                        <template #search="{attributes, events}">
                            <input
                              class="vs__search"
                              :required="!selected1"
                              v-bind="attributes"
                              v-on="events"
                              ref="timReff"
                            />
                          </template>
                      </v-select>
                    </b-form-group>

                     <b-form-group id="karyawangroup" label="Nik" label-for="nik">
                      <v-select v-model="selected2"  :options="karyawans">
                        <template #search="{attributes, events}">
                            <input
                              class="vs__search"
                              :required="!selected2"
                              v-bind="attributes"
                              v-on="events"
                              ref="karyawanReff"
                            />
                          </template>
                      </v-select>
                    </b-form-group>

                    <b-form-group id="unitgroup" label="Unit ID" label-for="unit_id">
                      <v-select v-model="selected3"  :options="units">
                        <template #search="{attributes, events}">
                            <input
                              class="vs__search"
                              :required="!selected3"
                              v-bind="attributes"
                              v-on="events"
                              ref="unitReff"
                            />
                          </template>
                      </v-select>
                    </b-form-group>

                    <b-form-group id="example-input-group-1" label="Status" label-for="status">
                      <b-form-input
                        id="status"
                        name="status"
                        ref="statusReff"
                        v-model="$v.form.status.$model"
                        :state="validateState('status')"
                        aria-describedby="input-1-live-feedback"
                      ></b-form-input>
                      <b-form-invalid-feedback
                        id="input-1-live-feedback"
                      >This is a required field.
                      </b-form-invalid-feedback>
                    </b-form-group>

                     <b-form-group id="example-input-group-1" label="Rekomendasi" label-for="rekomendasi">
                      <b-form-input
                        id="rekomendasi"
                        name="rekomendasi"
                        ref="rekomendasiReff"
                        v-model="$v.form.rekomendasi.$model"
                        :state="validateState('rekomendasi')"
                        aria-describedby="input-1-live-feedback"
                      ></b-form-input>
                      <b-form-invalid-feedback
                        id="input-1-live-feedback"
                      >This is a required field.
                      </b-form-invalid-feedback>
                    </b-form-group>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-danger" @click="hideModal" >
                      Close
                    </button>
                    <button type="submit" v-show="editMode" class="btn btn-primary">
                      Update
                    </button>
                    <button type="submit" v-show="!editMode"  class="btn btn-primary">
                      Create
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
        loading:false,
        pageOptions: [5, 10, 15, { value: 100, text: "All" }],
        currentPage: 1,
        selected1:"",
        selected2:"",
        selected3:"",
        filter: "",
        items: [],
        karyawans:[],
        tims:[],
        units:[],
        fields: [
          {
            key: 'no',
            sortable: true,
            tdClass:'text-center',
            thClass:'text-center'
          },
          /* {
            key: 'id',
            sortable: true
          }, */
          {
            key: 'tanggal',
            sortable: true
          },
          {
            key: 'nik',
            sortable: true
          },
          {
            key: 'karyawan',
            label: 'Nama Karyawan',
            sortable: true
          },
          {
            key: 'tim_id',
            sortable: true
          },
          {
            key: 'nama_tim',
            label: 'Nama Tim',
            sortable: true
          },
          {
            key: 'unit_id',
            sortable: true
          },
          {
            key: 'unit',
            label: 'Nama Unit',
            sortable: true
          },
          {
            key: 'status',
            sortable: true
          },
          {
            key: 'rekomendasi',
            sortable: true
          },
          /* {
            key: 'created_at',
            sortable: true,
            tdClass:'text-right',
            thClass:'text-center'
          },
          {
            key: 'updated_at',
            sortable: true,
            tdClass:'text-right',
            thClass:'text-center'
          }, */
          {
            key: 'actions',
            label: 'Actions' ,
            tdClass:'text-center',
            thClass:'text-center'
          }
        ],
        headvariant:'dark',
        transProps: {
          name: 'flip-list'
        },
        sortBy: 'created_at',
        sortDesc: true,
        infoModal: {
          id: 'info-modal',
          title: '',
        },
        form: {
          id : '',
          tanggal:'',
          nik:'',
          tim_id:'',
          unit_id : '',
          status:'',
          rekomendasi:'',
        },
      }
    },
    validations: {
      form: {
        tanggal: {
        required,
        },
        nik: {
        required,
        },
        tim_id: {
        required,
        },
        unit_id: {
        required,
        },
        status: {
          required,
          minLength: minLength(3)
        },
        rekomendasi: {
          required,
          minLength: minLength(3)
        }
      }
    },
    mounted() {
      this.loadData();
      this.getKaryawan();
      this.getTim();
      this.getUnit();
    },
    methods: {

     loadData() {
        axios.get("api/penilaian").then((response) => {
          this.items = Object.values(response.data.data);
          //console.log(Object.values(response.data));
        });
      },
      getKaryawan()
      {
        axios.get("api/karyawan").then((response) => {
        this.karyawans = Object.values(response.data);
        let cat=$.map(this.karyawans,function(t){
          return {label:t.nik+' ( '+t.nama+' )',value:t.nik}
        });
        this.karyawans=cat;
        //console.log(this.karyawans);
        });
      },
      getTim()
      {
        axios.get("api/tim").then((response) => {
        this.tims = Object.values(response.data);
        let team=$.map(this.tims,function(t){
          return {label:t.nama_tim,value:t.id}
        });
        this.tims=team;
        });
      },
      getUnit()
      {
        axios.get("api/unit").then((response) => {
        this.units = Object.values(response.data);
        let unt=$.map(this.units,function(t){
          return {label:t.nama,value:t.id}
        });
        this.units=unt;
        //console.log(this.karyawans);
        });
      },

      openModal(tipe, title, button,item) {
        //console.log("openModal");
        if(tipe=="edit") {
          this.editMode = true;
          this.form.id =item.id;
          this.form.tanggal =item.tanggal;
          this.form.nik =item.nik;
          this.form.tim_id =item.tim_id;
          this.form.unit_id =item.unit_id;
          this.form.status =item.status;
          this.form.rekomendasi =item.rekomendasi;
          this.selected2={label:item.nik+' ( '+item.karyawan+' )',value:item.nik}
          this.selected1={label:item.nama_tim,value:item.tim_id}
          this.selected3={label:item.unit,value:item.unit_id}
        }
        else {
          this.editMode = false;
          this.selected2 ='';
          this.selected1 ='';
          this.selected3 ='';
          this.form.nik ='';
          this.form.tim_id ='';
          this.form.unit_id ='';

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
      validateState(tanggal) {
        const { $dirty, $error } = this.$v.form[tanggal];
        return $dirty ? !$error : null;
      },
      validateState(status) {
        const { $dirty, $error } = this.$v.form[status];
        return $dirty ? !$error : null;
      },
      validateState(rekomendasi) {
        const { $dirty, $error } = this.$v.form[rekomendasi];
        return $dirty ? !$error : null;
      },
      async store() {
         this.form.nik = this.selected2.value;
         this.form.tim_id = this.selected1.value;
         this.form.unit_id = this.selected3.value;
/*
          this.$v.form.$touch();
          if (this.$v.form.$anyError) {
            return;
          }   */
          try {

            let response =  await axios.post('api/penilaian',this.form)
             console.log(response);
              if(response.status==200){
                  this.form.tanggal = '';
                  this.form.tim_id = '';
                  this.form.nik = '';
                  this.form.unit_id = '';
                  this.form.status = '';
                  this.form.rekomendasi = '';
                  this.hideModal();
                  this.$swal({
                    icon: 'success',
                    title: 'Penilaian Added successfully'
                  });
                  this.loadData();
              }
          } catch (e) {
            console.log(e.response.data.errors);
          }
      },

      async update() {
        let id = this.form.id;
        this.form.tim_id = this.selected1.value;
        this.form.nik = this.selected2.value;
        this.form.unit_id = this.selected3.value;

        /* this.$v.form.$touch();
          if (this.$v.form.$anyError) {
            return;
          } */
          try {
            let updated = await axios.put('api/penilaian/'+id,this.form)
              if(updated.status==200){
                  this.form.tanggal = '';
                  this.form.status = '';
                  this.form.rekomendasi = '';
                  this.hideModal();
                  this.$swal({
                    icon: 'success',
                    title: 'Penilaian Updated successfully'
                  });
                  this.loadData();
              }
          } catch (e) {
             this.$swal({
                icon: 'Error',
                title: 'Penilaian Updated Failed '+e.response.data.errors
              });
            this.theErrors = e.response.data.errors ;
          }
      },
      focusMyElement()
      {
        //
      },

      deleteCategory(id) {
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
            axios.delete("api/penilaian/"+id).then(response => {
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
