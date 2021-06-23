<template>
  <b-container>
    <b-card>
        <form>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="nama">Nama Penilai</label>
                    <input type="text" class="form-control" id="nama">
                </div>
                <div class="form-group col-md-8">
                    <b-form-group id="timGroup" label="Tim" label-for="tim">
                      <v-select v-model="selectedTim"  :options="tims">
                        <template #search="{attributes, events}">
                            <input
                              class="vs__search"
                              :required="!selectedTim"
                              v-bind="attributes"
                              v-on="events"
                              ref="timReff"
                            />
                          </template>
                      </v-select>
                    </b-form-group>
                </div>
            </div>
            <div class="form-row">
                <div class="col-md-4">
                    <b-form-group id="tanggalGroup" label="Tanggal" label-for="tgl">
                        <b-form-datepicker 
                            id="tgl" 
                            label="Pilih Tanggal" 
                            label-for="tanggal" 
                            class="mb-2" 
                            v-model="form.tanggal"
                        >
                        </b-form-datepicker>
                     </b-form-group>
                </div>
                <div class="col-md-8">
                    <b-form-group id="unitGroup" label="Unit Kerja" label-for="unit">
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
            </div>
        </form>
    </b-card>
    <b-card no-body>
        <b-tabs card>
            <b-tab title="P 1" active>
                <b-card-text>    
                    <table class="table">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <!--th>Kriteria</!--th-->
                                <th>Uraian</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item,index) in kriterias1" :key="item.id">
                                <td> {{ index+1 }}</td>
                                <!--td> {{ item.kriteria }}</!--td-->
                                <td> {{ item.sub_kriteria }}</td>
                                <td> 
                                    <b-row>
                                        <b-col sm="12">
                                            <b-form-input :id="form.nilai" type="number"></b-form-input>
                                        </b-col>
                                    </b-row>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </b-card-text>
            </b-tab>
            <b-tab title="P 2">
                <b-card-text>    
                    <table class="table">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Uraian</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item2,index2) in kriterias2" :key="item2.id">
                                <td> {{ index2+1 }}</td>
                                <td> {{ item2.sub_kriteria }}</td>
                                <td> 
                                    <b-row>
                                        <b-col sm="12">
                                            <b-form-input :id="form.nilai" type="number"></b-form-input>
                                        </b-col>
                                    </b-row>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </b-card-text>
            </b-tab>
            <b-tab title="P 3">
                <b-card-text>    
                    <table class="table">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Uraian</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item3,index3) in kriterias3" :key="item3.id">
                                <td> {{ index3+1 }}</td>
                                <td> {{ item3.sub_kriteria }}</td>
                                <td> 
                                    <b-row>
                                        <b-col sm="12">
                                            <b-form-input :id="form.nilai" type="number"></b-form-input>
                                        </b-col>
                                    </b-row>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </b-card-text>
            </b-tab>
            <b-tab title="P 4">
                <b-card-text>    
                    <table class="table">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <!--th>Kriteria</!--th-->
                                <th>Uraian</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item4,index4) in kriterias4" :key="item4.id">
                                <td> {{ index4+1 }}</td>
                                <!--td> {{ item4.kriteria }}</!--td-->
                                <td> {{ item4.sub_kriteria }}</td>
                                <td> 
                                    <b-row>
                                        <b-col sm="12">
                                            <b-form-input :id="form.nilai" type="number"></b-form-input>
                                        </b-col>
                                    </b-row>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </b-card-text>
            </b-tab>
            <b-tab title="P 5">
                <b-card-text>    
                    <table class="table">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>Uraian</th>
                                <th>Nilai</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item5,index5) in kriterias5" :key="item5.id">
                                <td> {{ index5+1 }}</td>
                                <td> {{ item5.sub_kriteria }}</td>
                                <td> 
                                    <b-row>
                                        <b-col sm="12">
                                            <b-form-input :id="form.nilai" type="number"></b-form-input>
                                        </b-col>
                                    </b-row>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </b-card-text>
            </b-tab>
        </b-tabs>
        
        <div class="text-right pr-4 pb-4 pt-0">
            <b-btn variant="success" >Simpan</b-btn>
        </div>
    </b-card>
  </b-container>
</template>

<script>
import { validationMixin } from "vuelidate";
import { required, minLength } from "vuelidate/lib/validators";

export default {
    mounted() {
      this.getTim();
      this.getUnit();
      this.getKriterias1();
      this.getKriterias2();
      this.getKriterias3();
      this.getKriterias4();
      this.getKriterias5();
    },
    data() {
        return {
            form: {
                tanggal: new Date(),
            },
            tims:[],
            units:[],
            kriterias1:[],
            kriterias2:[],
            kriterias3:[],
            kriterias4:[],
            kriterias5:[],
            selectedTim:"",
            selectedUnit:"",
        }
    },
    validations: {
      form: {
        tanggal:{
            required,
        },
      }
    },
    methods: {
        getUnit()
        {
            axios.get("/api/unit").then((response) => {
                this.units = Object.values(response.data);
                let unt=$.map(this.units,function(t){
                    return {label:t.nama,value:t.id}
                });
                //console.log(unt);
                this.units=unt;
            });
        },

        getTim(){
            axios.get("/api/tim").then((response) => {
            this.tims = Object.values(response.data.data);
            let tim=$.map(this.tims,function(t){
                return {label:t.nama_tim,value:t.id}
            });
            this.tims=tim;
            
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
        getKriterias1()
        {
            axios.get("/api/kriteria/P1/showkriteria").then((response) => {
                this.kriterias1= Object.values(response.data);
                //console.log(this.kriterias);
            });
        },
        
        getKriterias2()
        {
            axios.get("http://webhkr.test/api/kriteria/P2/showkriteria").then((response) => {
                this.kriterias2 = Object.values(response.data);
                //console.log(this.kriterias);
            });
        },
        getKriterias3()
        {
            axios.get("http://webhkr.test/api/kriteria/P3/showkriteria").then((response) => {
                this.kriterias3 = Object.values(response.data);
                //console.log(this.kriterias);
            });
        },

        getKriterias4()
        {
            axios.get("http://webhkr.test/api/kriteria/P4/showkriteria").then((response) => {
                this.kriterias4 = Object.values(response.data);
                //console.log(this.kriterias);
            });
        },

        getKriterias5()
        {
            axios.get("http://webhkr.test/api/kriteria/P5/showkriteria").then((response) => {
                this.kriterias5 = Object.values(response.data);
                //console.log(this.kriterias);
            });
        },
    },

}
</script>