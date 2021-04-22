<template>
  <div class="overflow-auto">
     <div class="container">
        <div class="row mt-3">
          <div class="col-md-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">
                  Karyawan
                </h3>
                
              </div>
              <div class="card-body">
              <b-row class="p-20">
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
              <!-- <template #cell(created_at)="row">
                {{ row.item.created_at | formatDate}}
              </template>
              <template #cell(updated_at)="row">
                {{ row.item.updated_at | formatDate}}
              </template> -->
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
        pageOptions: [1, 5, 10, 15, { value: 100, text: "All" }],
        currentPage: 1,
        filter: "",
        value: '',
        items: [],
        fields: [
          {
            key: 'no',
            sortable: true,
            tdClass:'text-center',
            thClass:'text-center'
          },
          {
            key: 'nik',
            sortable: true
          },
          {
            key: 'nama',
            sortable: true
          },
           {
            key: 'tgl_lahir',
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
        /* sortBy: 'created_at', */
        sortBy: 'no',
        sortDesc: true,
        infoModal: {
          id: 'info-modal',
          title: '',
        },
        form: {
          id : '',
          nama : '',
          tgl_lahir : '',
        },
      }
    },
    validations: {
      form: {
        nama: {
          required,
          minLength: minLength(1)
        },
        tgl_lahir: {
          required,
          minLength: minLength(1)
        },
      }
    },
    mounted() {
      this.loadData();
    },
    methods: {
     loadData() {
        axios.get("api/karyawan").then((response) => {
          this.items = Object.values(response.data);
          //console.log(Object.values(response.data));
        }); 
      },
      focusMyElement()
      {
         this.$refs.namaReff.focus();
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