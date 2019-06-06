<template>
<div class="row">
    <div class="col-md-12">
         <div class="card">
                <div class="card-header">
                    Almacen Salidas
                </div>
                <!-- <select class="form-control" id="alm" name="alm" > -->
                <div class="col-md-3">
                    <!-- <div class="input-group"> -->
                            <multiselect
                                v-model="form.data"
                                :options="data"
                                id="almacen"
                                placeholder="Seleccionar Almacen"
                                select-label="Seleccionar"
                                deselect-label="Remover"
                                selected-label="Seleccionado"
                                label="name"
                                track-by="name"
                                @input="obtenerlista()"
                            >
                            </multiselect>
                    <!-- </div> -->
                    <!-- <a :href="'/rptIngresoAlm/'+form.data.id" v-if="form.data" class="btn btn-secondary">Excel</a> -->
                </div>

                <div class="card-body">
                    <vue-bootstrap4-table :rows="rows" :columns="columns" :config="config">
                        <template slot="sort-asc-icon">
                            <i class="fa fa-sort-asc"></i>
                        </template>
                        <template slot="sort-desc-icon">
                            <i class="fa fa-sort-desc"></i>
                        </template>
                        <template slot="no-sort-icon">
                            <i class="fa fa-sort"></i>
                        </template>

                        <template slot="option" slot-scope="props">

                            <!-- <i class="fa fa-pen text-primary" @click="edit(props.row)"></i> -->
                            <div class="btn-group" role="group" aria-label="Basic example">
                                <!-- <button type="button" class="btn btn-secondary">Left</button>
                                 -->
                                 <!-- <a :href="url+'/'+props.row.usr_id+'/edit'"><i class="material-icons ">edit</i></a> -->
                                <!-- <button type="button" class="btn btn-sm btn-secondary"></button> -->
                                <!-- <button type="button" class="btn btn-sm btn-secondary"><i class="material-icons" @click="edit(props.row)">edit</i></button> -->


                            </div>

                            <span>
                                <!-- <i class="material-icons text-info" @click="edit(props.row)">remove_red_eye</i>
                                <i class="material-icons text-primary" @click="edit(props.row)">edit</i> -->

                            </span>

                            <!-- <button class="btn btn-primary">
                            </button> -->


                            <!-- <v-icon @click="getDetail(props)" data-toggle="modal" data-target="#taskModalDetail"
                                small>
                                remove_red_eye
                            </v-icon> -->
                            <!-- <v-icon @click="edit(props)" data-toggle="modal" data-target="#taskModalExecuted"
                                small>

                            </v-icon> -->
                        </template>
                    </vue-bootstrap4-table>
                </div>
            </div>
    </div>
</div>
</template>
<script>
import VueBootstrap4Table from 'vue-bootstrap4-table';
export default {
    props:['data'],
    data: ()=>({
        form:{},
        title:'',
        rows: [],
        columns: [
            {
                label: "Almacen",
                name: "almacen",
                filter: {
                    type: "simple",
                    placeholder: "Almacen"
                },
                sort: true,
            },
             {
                label: "N° Salida",
                name: "num",
                filter: {
                    type: "simple",
                    placeholder: "Almacen"
                },
                sort: true,
            },  
            {
                label: "Codigo",
                name: "codigo",
                filter: {
                    type: "simple",
                    placeholder: "Almacen"
                },
                sort: true,
            },
            {
                label: "Articulo",
                name: "articulo",
                filter: {
                    type: "simple",
                    placeholder: "Almacen"
                },
                sort: true,
            },
             {
                label: "Cantidad",
                name: "cantidad",
                filter: {
                    type: "simple",
                    placeholder: "Almacen"
                },
                sort: true,
            },
            
            {
                label: "Cantidad Aprobado",
                name: "cantapro",
                filter: {
                    type: "simple",
                    placeholder: "Almacen"
                },
                sort: true,
            }
        ],
        config: {
			card_mode: false,
			checkbox_rows: false,
			rows_selectable: false,
			global_search:  {
					placeholder:  "Enter custom Search text",
					visibility: false,
					case_sensitive:  false
			},
			show_refresh_button:  false,
			show_reset_button:  false,
        },
        hasFile: false,

    }),
    mounted(){
        console.log(this.data);
        // this.rows = this.users;
        console.log(this.url);
    },
    methods:{
        edit(item){
            console.log(item);
        },
        obtenerlista(){
            console.log(this.form.data);
            if(this.form.data)
            {
                axios.get(`listalmacenesSal1/${this.form.data.id}`).then(response=>{
                        // this.form = response.data.article;
                        // console.log(response.data);
                        this.rows = response.data;
                        console.log(this.rows);
                });   
            }
        },
        changeItem: function changeItem(rowId, event) {
            this.selected = "rowId: " + rowId + ", target.value: " + event.target.value;
        }
    },
    components: {
        VueBootstrap4Table
    }
}
</script>
