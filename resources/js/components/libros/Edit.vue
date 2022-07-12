<template>
	<div class="container">
		<div class="row">
			<div class="col-12">
				<h1>Editar Libro</h1>
			</div>
			<hr/>
			<div class="col-12">
				<form @submit.prevent="edit" class="row">
					<div class="col-6 mb-2">
						<label class="form-label">Autor</label>
						<input type="text" class="form-control" :class="{'is-invalid':errors.autor}" 
							v-model="libro.autor" @change="deleteError('autor')">
						<span v-for="error in errors.autor" class="error">{{ error }}</span>
					</div>
					<div class="col-6 mb-2">
						<label class="form-label">Titulo</label>
						<input type="text" class="form-control" :class="{'is-invalid':this.errors.titulo}" 
							v-model="libro.titulo" @change="deleteError('titulo')">
						<span v-for="error in errors.titulo" class="error">{{ error }}</span>
					</div>
					<div class="col-6 mb-2">
						<label class="form-label">Edición</label>
						<input type="text" class="form-control" :class="{'is-invalid':errors.edicion}" 
							v-model="libro.edicion" @change="deleteError('edicion')">
						<span v-for="error in errors.edicion" class="error">{{ error }}</span>
					</div>
					<div class="col-6 mb-2">
						<label class="form-label">Datos de publicación</label>
						<input type="text" class="form-control" :class="{'is-invalid':errors.datos_publicacion}" 
							v-model="libro.datos_publicacion" @change="deleteError('datos_publicacion')">
						<span v-for="error in errors.datos_publicacion" class="error">{{ error }}</span>
					</div>
					<div class="col-6 mb-2">
						<label class="form-label">Tipo de contenido</label>
						<input type="text" class="form-control" :class="{'is-invalid':errors.tipo_contenido}" 
							v-model="libro.tipo_contenido" @change="deleteError('tipo_contenido')">
						<span v-for="error in errors.tipo_contenido" class="error">{{ error }}</span>
					</div>
					<div class="col-6 mb-2">
						<label class="form-label">Restricciones</label>
						<input type="text" class="form-control" :class="{'is-invalid':errors.restricciones}" 
							v-model="libro.restricciones" @change="deleteError('restricciones')">
						<span v-for="error in errors.restricciones" class="error">{{ error }}</span>
					</div>
					<div class="col-6 mb-2">
						<label class="form-label">Materia</label>
						<input type="text" class="form-control" :class="{'is-invalid':errors.materia}" 
							v-model="libro.materia" @change="deleteError('materia')">
						<span v-for="error in errors.materia" class="error">{{ error }}</span>
					</div>
					<div class="col-6 mb-2">
						<label class="form-label">Proveedor</label>
						<input type="text" class="form-control" :class="{'is-invalid':errors.proveedor}" 
							v-model="libro.proveedor" @change="deleteError('proveedor')">
						<span v-for="error in errors.proveedor" class="error">{{ error }}</span>
					</div>
					<div class="col-6 pt-3">
						<button type="button" class="btn btn-danger w-100" @click="regresar">Regresar</button>
					</div>
					<div class="col-6 pt-3">
						<button type="submit" class="btn btn-primary w-100">Editar</button>
					</div>
					
				</form>
			</div>
		</div>
	</div>
</template>

<script>
	export default{
		name:"create",
		data(){
			return{
				libro: {
					autor:"",
					titulo:"",
					edicion:"",
					datos_publicacion:"",
					tipo_contenido:"",
					restricciones:"",
					materia:"",
					proveedor:"",
				},
				errors:[]
			}
		},
		mounted(){
			this.getInfo()
		},
		methods:{
			async getInfo(){
				await this.axios.get(`/api/libros/${this.$route.params.id}`)
					.then(res => {
						if(res.data.code === 200){
							this.libro = res.data.data;
							console.log(res.data);
						}else{
							this.errors = res.data.errors;
						}
					})
					.catch(err => {
						this.$router.push('/404');
					});
			},
			async edit(){
				await this.axios.put(`/api/libros/${this.$route.params.id}`, this.libro)
					.then(res => {
						if(res.data.code === 200){
							this.$router.push('/');
						}else{
							this.errors = res.data.errors;
						}
					})
					.catch(err => {
						console.log(err);
					});
			},
			deleteError(field){
				delete this.errors[field];
			},
			regresar(){
				this.$router.push('/');
			}
		},
		
	}
</script>