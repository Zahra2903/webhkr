<template>
  <div class="overflow-auto">
     <div class="container">
        <div class="row mt-3">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                 <i class="fas fa-users-cog" ></i>Tim
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
                <template #row-details="row">
                  <b-card>
                    <div class="ml-5 pr-5">
                      <table class="table">
                        <thead>
                          <tr>
                              <th>No</th>
                              <th>Nama</th>
                              <th>Unit Kerja</th>
                              <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="(value, key) in row.item.tim_detail" :key="key">
                            <td>{{key + 1 }}</td>
                            <td>{{value.nik+" - "+value.karyawan }}</td>
                            <td>{{value.unit }}</td>
                            <td>
                              <b-button variant="outline-danger" size="sm" @click="deleteTimDetail(value.id)">
                                <i class="fa fa-trash"></i>
                                </b-button>
                              </td>

                          </tr>
                        </tbody>
                      </table>
                      <table class="table">
                        <thead>
                          <tr>
                              <th>No</th>
                              <th>Nama Unit</th>
                              <th>Action</th>
                          </tr>
                        </thead>
                        <tbody>
                          <tr v-for="(value, key) in row.item.unit_detail" :key="key">
                            <td>{{key + 1 }}</td>
                            <td>{{value.unit }}</td>
                            <td>
                              <b-button variant="outline-danger" size="sm" @click="deleteUnitDetail(value.id)">
                                <i class="fa fa-trash"></i>
                                </b-button>
                              </td>

                          </tr>
                        </tbody>
                      </table>
                    </div>
                   <!--  {{
                      row.item.tim_detail
                    }} -->
                  </b-card>
                </template>
                <template #cell(no)="row">
                  {{ row.index + 1 }}
                </template>
                <template #cell(actions)="row">
                   <b-button variant="outline-info" size="sm" @click="row.toggleDetails" class="mr-1">
                    <i class='fa fa-eye'></i>
                  </b-button>
                   <b-button variant="outline-success" size="sm" @click="openModal('tambahdetail' , 'Tambah Tim', $event.target,row.item)" class="mr-1">
                    <i class="fa fa-plus"></i>
                  </b-button>
                  <b-button variant="outline-warning" size="sm" @click="openModal('edit' , 'Edit ID : ' +row.item.id, $event.target, row.item)" class="mr-1">
                    <i class="fa fa-edit"></i>
                  </b-button>
                  <b-button variant="outline-danger" size="sm" @click="deleteTim(row.item.id)">
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
                <div v-if="!detailMode && (!editMode || editMode)">
                <form @submit.prevent="editMode ? update() : store()" > 
                  <div class="modal-body">
                        <b-form-group id="example-input-group-1" label="Nama Tim" label-for="nama_tim">
                          <b-form-input
                            id="nama_tim"
                            name="nama_tim"
                            ref="nama_timReff"
                            v-model="$v.form.nama_tim.$model"
                            :state="validateState('nama_tim')"
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
                </div>

                <div v-else-if>
                <form @submit.prevent="store2()" > 
                  <div class="modal-body">
                    <b-form-group id="karyawangroup" label="NIK" label-for="nik">
                    <v-select v-model="selectedKaryawan"  :options="karyawans">
                      <template #search="{attributes, events}">
                          <input
                            class="vs__search"
                            :required="!selectedKaryawan"
                            v-bind="attributes"
                            v-on="events"
                            ref="karyawanReff"
                          />
                        </template>
                    </v-select>
                    </b-form-group>
                  </div>
                  <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">
                    Add
                  </button>
                  <button type="button" class="btn btn-danger" @click="hideModal" >
                    Close
                  </button>
                  </div>
                </form>
                </div>

                <div v-else-if>
                <form @submit.prevent="store3()" > 
                  <div class="modal-body">
                  <b-form-group id="unitgroup" label="Unit" label-for="unit_id">
                      <v-select v-model="selectedUnit"  :options="units">
                        <template #search="{attributes, events}">
                            <input
                              class="vs__search"
                              :required="!selectedUnit"
                              v-bind="attributes"
                              v-on="events"
                              ref="unitReff"
                            />
                          </template>
                      </v-select>
                    </b-form-group>
                </div>
                <div class="modal-footer">
                  <button type="submit" class="btn btn-primary">
                    Add
                  </button>
                  <button type="button" class="btn btn-danger" @click="hideModal" >
                    Close
                  </button>
                </div>
                </form>
                </div>
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
        detailMode:false,
        loading:false,
        pageOptions: [1, 5, 10, 15, { value: 100, text: "All" }],
        currentPage: 1,
        filter: "",
        items: [],
        selectedKaryawan:"",
        karyawans:[],
        selectedUnit:"",
        units:[],
        fields: [
          {
            key: 'no',
            sortable: true,
            tdClass:'text-center',
            thClass:'text-center'
          },
          {
            key: 'nama_tim',
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
        sortBy: 'nama_tim',
        sortDesc: false,
        infoModal: {
          id: 'info-modal',
          title: '',
        },
        form: {
          id : '',
          nama_tim : '',
        },
        form2: {
          nik:'',
          tim_id : '',
          unit_id : '',
        },
      }
    },
    validations: {
      form: {
        nama_tim: {
          required,
          minLength: minLength(1)
        },
      }
    },
    mounted() {
      this.loadData();
      this.getKaryawan();
      this.getUnit();
    },
    methods: {
     loadData() {
        axios.get("api/tim").then((response) => {
          this.items = Object.values(response.data.data);
          //console.log(Object.values(response.data.data));
        }); 
      },
      getKaryawan(){
        axios.get("api/karyawan").then((response) => {
        this.karyawans = Object.values(response.data);
        let cat=$.map(this.karyawans,function(t){
          return {label:t.nik+' - '+t.nama,value:t.nik}
        });
        this.karyawans=cat;
        //console.log(this.karyawans);
        });
      },
      getUnit(){
        axios.get("api/unit").then((response) => {
        this.units = Object.values(response.data);
        let unt=$.map(this.units,function(t){
          return {label:t.nama,value:t.unit_id}
        });
        this.units=unt;
        //console.log(this.units);
        });
      },
      focusMyElement()
      {
         this.detailMode ? this.$refs.karyawanReff.focus():  this.$refs.nama_timReff.focus();
      },
      openModal(tipe, title, button,item) {
        if(tipe=="edit") {
          this.editMode = true;
          this.detailMode = false;
          this.form.id =item.id;
          this.form.nama_tim =item.nama_tim
        }
        else if(tipe=="tambahdetail")
        {
          this.editMode = false;
          this.detailMode = true;
          this.form2.tim_id = item.id;
          this.form2.nik ='';
          this.form2.unit_id ='';
          this.selectedKaryawan ='';
          this.selectedUnit ='';
        }
        else {
          this.editMode = false;
          this.detailMode = false;
          this.form.nama_tim ='';
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
      validateState(nama_tim) {
        const { $dirty, $error } = this.$v.form[nama_tim];
        return $dirty ? !$error : null;
      },
      async store() {
         this.$v.form.$touch();
          if (this.$v.form.$anyError) {
            return;
          }
          try {
            let response =  await axios.post('api/tim',this.form)
             //console.log(response.status);
              if(response.status==200){
                  this.form.nama_tim= '';
                  this.hideModal();
                  this.$swal({
                    icon: 'success',
                    title: 'Tim Added successfully'
                  });
                  this.loadData();
              }
          } catch (e) {
            console.log(e.response.data.errors);
          }
      },
      async store2() {
         this.form2.nik = this.selectedKaryawan.value;
          let cek = await axios.get('api/tim_detail/'+this.form2.nik);
          //console.log(cek.data.success);
          if(cek.data.success==false){
             this.$swal({
                icon: 'error',
                title: 'Data Sudah Ada ! ! !'
              });
          }
          else {
             try {
              let response =  await axios.post('api/tim_detail',this.form2)
              //console.log(response);
                if(response.status==200){
                    this.form2.nik = '';
                    this.form2.tim_id = '';
                
                    this.hideModal();
                    this.$swal({
                      icon: 'success',
                      title: 'Tim Detail Added successfully'
                    });
                    this.loadData();
                }
            } catch (e) {
              console.log(e.response.data.errors);
            }
          }
         
      },
      async store3() {
         this.form2.unit_id = this.selectedUnit.value;
          let cek = await axios.get('api/unit_detail/'+this.form2.unit_id);
          //console.log(cek.data.success);
          if(cek.data.success==false){
             this.$swal({
                icon: 'error',
                title: 'Data Sudah Ada ! ! !'
              });
          }
          else {
             try {
              let response =  await axios.post('api/unit_detail',this.form2)
              //console.log(response);
                if(response.status==200){
                    this.form2.unit_id = '';
                    this.form2.tim_id = '';
                
                    this.hideModal();
                    this.$swal({
                      icon: 'success',
                      title: 'Unit Detail Added successfully'
                    });
                    this.loadData();
                }
            } catch (e) {
              console.log(e.response.data.errors);
            }
          }
         
      },
      async update() {
        this.$v.form.$touch();
          if (this.$v.form.$anyError) {
            return;
          }
          try {
            let id = this.form.id;
            let updated = await axios.put('api/tim/'+id,this.form)
              if(updated.status==200){
                  this.form.nama_tim = '';
                  this.hideModal();
                  this.$swal({
                    icon: 'success',
                    title: 'Tim Updated successfully'
                  });
                  this.loadData();
              }
          } catch (e) {
             this.$swal({
                icon: 'Error',
                title: 'Tim Updated Failed '+e.response.data.errors
              });
            this.theErrors = e.response.data.errors ;
          }
      },
      deleteTim(id) { 
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
            axios.delete("api/tim/"+id).then(response => {
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
      deleteTimDetail(id) { 
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
            axios.delete("api/tim_detail/"+id).then(response => {
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
      deleteUnitDetail(id) { 
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
            axios.delete("api/unit_detail/"+id).then(response => {
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