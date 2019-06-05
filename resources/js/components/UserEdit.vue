<template>

    <div class="row">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    Usuario: {{user.usr_usuario}}
                     <small class="float-sm-right">
                            <form id='formArticle' method="post" :action="url">
                                <div v-html='csrf'></div>
                                <button class="btn btn-secondary btn-sm"> <i class="fa fa-chevron-circle-left"></i> Regresar </button>
                                <input type="text" name="id" :value="user.usr_id" hidden>
                                <input type="text" name="permissions" :value="JSON.stringify(user_permissions)" hidden>
                                <input type="text" name="roles" :value="JSON.stringify(user_roles)" hidden>
                                <button  type="submit" class="btn btn-success btn-sm"> <i class="fa fa-user-edit"></i> Editar </button>
                            </form>
                    </small>
                </div>
                <div class="card-body">
                    <span>Nombre:</span> <strong> {{user.person.prs_nombres+' '+user.person.prs_paterno+' '+user.person.prs_materno}}</strong><br>
                    <span></span>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="card">
                <!-- <div class="card-header">

                </div> -->
                <div class="card-body">
                     <table class="table">
                        <thead>
                            <tr>
                                <th> Accesos a Sistemas</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(permision,index) in user_permissions" :key="index">
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
        <div class="col-md-7">
            <div class="card">
                <!-- <div class="card-header">

                </div> -->
                <div class="card-body">
                     <table class="table">
                        <thead>
                            <tr>
                                <th> Roles Asignados </th>
                                <th> Sistemas </th>
                                <th> </th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(role,index) in user_roles" :key="index">
                                <td>{{role.name}}</td>
                                <td>

                                    <span class="badge badge-secondary" v-for="(item,index) in role.permissions" :key="index">
                                        {{item.name}}
                                    </span>
                                </td>
                                <td>
                                    <switches v-model="role.enabled" theme="bootstrap" color="primary"></switches>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


</template>
<script>
import Switches from 'vue-switches';
export default {
    props:['user','roles','permissions','url','csrf'],
    data: ()=>({
        user_roles: [],
        user_permissions : []
    }),
    mounted()
    {
        this.user_roles = this.roles,
        this.user_permissions = this.permissions;
        console.log(this.user_roles);
        console.log(this.user_permissions);
        console.log(this.user);
    },
    methods:{

    },
    components: {
        Switches
    },
}
</script>
