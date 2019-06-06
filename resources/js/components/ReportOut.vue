<template>
<div class="row">
    <div class="col-md-12">
         <div class="card">
                <div class="card-header">
                    Almacen Ingresos
                     <!-- <a :href=""  class="btn btn-secondary">Excel</a> -->
                     <button type="button" class="btn btn-sm btn-secondary"></button>
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
                label: "N° Ingreso",
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
                label: "Costo",
                name: "costo",
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
                axios.get(`listalmacenesSal/${this.form.data.id}`).then(response=>{
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
