<template>
    <div class="row">
        <div class="col-md-10">

            <div class="card">
                <form id='formChange' method="post" :action="url" @submit.prevent="validateBeforeSubmit">
                    <div v-html='csrf'></div>
                <div class="card-body">
                    <h5 class="card-title">Solicitud de Cambio en Ingreso</h5>
                    <div class="row">
                        <div class="form-group  col-md-6">
                            <input type="text" name="article_income_id" :value="income.id">
                            <input type="text" name="type_id" v-if="form.type" :value="form.type.name" hidden>
                            <label for="tipo">Tipo</label>
                            <multiselect
                                v-model="form.type"
                                :options="types"
                                id="tipo"
                                placeholder="Seleccionar Tipo"
                                select-label="Seleccionar"
                                deselect-label="Remover"
                                selected-label="Seleccionado"
                                label="name"
                                track-by="name" >

                            </multiselect>
                            <div class="invalid-feedback">{{ errors.first("type") }}</div>
                        </div>
                        <div class="form-group col-md-12">
                            <label for="lbobservation">Descripcion</label>
                            <input type="text" class="form-control" id="observation" name="observation" v-model="form.observation" placeholder="Detalle el motivo de la Solicitud" v-validate="'required'">
                            <div class="invalid-feedback">{{ errors.first("observation") }}</div>
                        </div>
                        <input type="text" name="request_income_items" :value="JSON.stringify(items)">
                        <div class="col-md-6">
                            Numero de Ingreso: {{income.correlative}} <br>
                            Fecha de Ingreso: {{income.created_at}}
                        </div>
                        <div class="col-md-12">

                                <table class="table">
                                     <thead>
                                        <th scope="col">Nro</th>
                                        <th scope="col">Articulo</th>
                                        <th scope="col">Unidad</th>
                                        <th scope="col">Cantidad</th>
                                        <th scope="col">Nueva Cantidad</th>

                                     </thead>
                                    <tbody>
                                        <tr v-for="(item,index) in items" :key="index" >
                                            <td>{{index+1}}</td>
                                            <td>{{item.article.name}}</td>
                                            <td>{{item.article.unit.name}}</td>
                                            <td>{{item.quantity}}</td>
                                            <td>
                                                <input type="text" class="form-control" v-model="item.new_quantity" :disabled="isDeleted()" >
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <button type="button" class="btn btn-danger">Cancelar</button>
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </div>


                </div>
                </form>
            </div>
        </div>

    </div>
</template>
<script>
import { constants } from 'crypto';
export default {
     props:['url','csrf','income'],
    data:()=>({
        form:{},
        types:[{id:1,name:'Eliminacion'},{id:2,name:'Modificacion'}],
        items:[],
    }),
    mounted() {
        // console.log(this.income);
        this.items = this.income.article_income_items;
        console.log(this.items);
        console.log(this.url);
        // axios.get('../list_units')
        //      .then(response => {
        //          this.units = response.data;
        //          console.log(response.data)
        //      });

    },
    computed:{

    },
    methods:{
        validateBeforeSubmit() {
            this.$validator.validateAll().then((result) => {
                if (result) {
                let form = document.getElementById("formChange");
                    console.log(form);
                    form.submit();
                    return;
                }
                toastr.error('Debe completar la informacion correctamente')
            });
        },
        isDeleted()
        {
            let deleted = false;
            // console.log(this.form.type);
            if(this.form.type)
            {
                if(this.form.type.name=="Eliminacion"){
                    deleted = true;
                    this.items.forEach(item => {
                        item.new_quantity =0
                        return item;
                    });
                }
            }
            return deleted;
        }

    },
}
</script>
