<template>
   <div >
		<div class="modal fade" id="ProviderModal" tabindex="-1" role="dialog" aria-labelledby="ProviderModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg" role="document">
                <form id='formOperation' method="post" :action="url" @submit.prevent="validateBeforeSubmit">

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
							<!-- <input type="text" name="action_short_term_id" v-model="action_short_term.id" hidden> -->

							<div class="row">
								<div class="col-md-12">
                                    <v-chip color="bg-success" text-color="white">
                                        <v-avatar class="green darken-3">
                                            <v-icon >fa-flag</v-icon>
                                        </v-avatar>
                                            Meta:
                                    </v-chip>
                                    <v-chip color="bg-info" text-color="white">
                                        <v-avatar class="cyan darken-3">
                                            <v-icon >fa-percentage</v-icon>
                                        </v-avatar>
                                            Ponderacion Disponible:
                                    </v-chip>
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
export default {
    props:['url','csrf'],
    data:()=>({
        form:{},
        title:'',
    }),


}
</script>
