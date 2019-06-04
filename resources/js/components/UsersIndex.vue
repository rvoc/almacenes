<template>
<div class="row">
    <div class="col-md-12">
         <div class="card">
                <div class="card-header">
                    Gestion de Usuarios
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
                            <span>
                                <i class="material-icons text-info" @click="edit(props.row)">remove_red_eye</i>
                                <i class="material-icons text-primary" @click="edit(props.row)">edit</i>

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
    props:['users'],
    data: ()=>({
        form:{},
        title:'',
        rows: [],
        columns: [
            {
                label: "Usuario",
                name: "usr_usuario",
                filter: {
                    type: "simple",
                    placeholder: "Usuario"
                },
                sort: true,
            },
            {
                label: "Nombres",
                name: "person.prs_nombres",
                filter: {
                    type: "simple",
                    placeholder: "Nombres"
                },
                sort: true,
            },
            {
                label: "Apellido Paterno",
                name: "person.prs_paterno",
                filter: {
                    type: "simple",
                    placeholder: "Parterno"
                },
                sort: true,
            },
            {
                label: "Apellido Materno",
                name: "person.prs_materno",
                filter: {
                    type: "simple",
                    placeholder: "Materno"
                },
                sort: true,
            },
            {
                label: "Opcion",
                name: "option",
                sort: false,
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
        console.log(this.users);
        this.rows = this.users;
    },
    methods:{
        edit(item){
            console.log(item);
        }
    },
    components: {
        VueBootstrap4Table
    }
}
</script>
