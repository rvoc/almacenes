<template>
   <div >
		<div class="modal fade" id="RoleModal" tabindex="-1" role="dialog" aria-labelledby="RoleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <form id='formArticle' method="post" :action="url" @submit.prevent="validateBeforeSubmit">

                    <div class="modal-content">
                        <div v-html='csrf'></div>
						<input type="text" name="id" :value="form.id" v-if="form.id" hidden>
                        <div class="modal-header laravel-modal-bg">
                            <h5 class="modal-title" >{{title}}</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">

							<div class="row">
                                <div class="form-group col-md-12">
                                    <label for="lbname">Nombre</label>
                                    <input type="text" class="form-control" id="name" name="name" v-model="form.name" placeholder="Nombre" v-validate="'required'">
                                    <div class="invalid-feedback">{{ errors.first("name") }}</div>
                                </div>

							</div>
                            <input type="text" name="permissions" :value="JSON.stringify(role_permissions)" hidden>
                            <div class="row">
                                <div class="col-md-12">
                                    <table class="table">
                                        <thead>
                                            <tr>
                                                <th>Sistema</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr v-for="(permision,index) in role_permissions" :key="index">
                                                <td>{{permision.name}}</td>
                                                <td>
                                                    <switches v-model="permision.enabled" theme="bootstrap" color="primary"></switches>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal" >Cancelar</button>
                            <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

    </div>
</template>
<script>
import Switches from 'vue-switches';

export default {
    props:['url','csrf'],
    data:()=>({
        form:{},
        role_permissions:[],
        enabled:false,
        title:'',
    }),
    mounted() {
        console.log('Componente Edit Role iniciado')
        // console.log(this.permissions);

        // axios.get('../list_storages')
        //      .then(response => {
        //          this.storages = response.data;
        //          console.log(response.data)
        //      });




        $('#RoleModal').on('show.bs.modal',(event)=> {
            var button = $(event.relatedTarget) // Button that triggered the modal
            var role = button.data('json') // Extract info from data-* attributes
            this.title ='Nuevo Rol ';
            console.log(role);
            if(role!=null)
            {
                this.title='Editar '+role.name;

                axios.get(`get_permission_role/${role.id}`).then(response=>{
                        console.log('seteando');
                        this.form = response.data.role;
                        this.role_permissions = response.data.permissions;
                        console.log(this.form);
                });

                // this.form = article;
            }else
            {
                this.form={};
                axios.get(`get_permission_role/0`).then(response=>{
                        // this.form = response.data.role;
                        console.log('obteniendo lista ');
                        console.log(response.data);
                        this.role_permissions = response.data.permissions;

                });

            }


        })
	},
    methods:{
        validateBeforeSubmit() {
            this.$validator.validateAll().then((result) => {
                if (result) {
                let form = document.getElementById("formArticle");

                    form.submit();
                    return;
                }
                toastr.error('Debe completar la informacion correctamente')
            });
        },

    },
    components: {
        Switches
    },


}
</script>
