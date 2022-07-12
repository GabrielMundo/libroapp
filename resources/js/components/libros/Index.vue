<template>
	<div class="container">
		<div class="row">
			<div class="col-9">
				<h1>Lista de libros</h1>
			</div>
			<div class="col-3 mb-4">
				<router-link :to='{name:"create"}' class="btn btn-success w-100">Agregar Libro</router-link>
			</div>
			<hr/>
			<div class="col-12">
				<!--- <table class="table table-striped">
					<thead>
						<tr>
							<th>Autor</th>
							<th>Titulo</th>
							<th>Edicion</th>
							<th>Datos Publicacion</th>
							<th>Tipo Contenido</th>
							<th>Restricciones</th>
							<th>Materia</th>
							<th>Proveedor</th>
							<th></th>
						</tr>
					</thead>
					<tbody>
						<tr v-for="libro in libros" :key="libro.id">
							<td>{{ libro.autor }}</td>
							<td>{{ libro.titulo }}</td>
							<td>{{ libro.edicion }}</td>
							<td>{{ libro.datos_publicacion }}</td>
							<td>{{ libro.tipo_contenido }}</td>
							<td>{{ libro.restricciones }}</td>
							<td>{{ libro.materia }}</td>
							<td>{{ libro.proveedor }}</td>
							<td> EDITAR ELIMINAR</td>
						</tr>
					</tbody>
				</table>
				--->
				<div class="row">
					<div class="col-6 pt-3" v-for="libro in libros" :key="libro.id">
						<div class="card">
						  <div class="card-body">
						    <h3 class="card-title">{{ libro.titulo }}</h3>
						    <h6 class="card-subtitle mb-2 text-muted">por {{ libro.autor }}</h6>
						    <p class="mb-0"><span class="fw-bold">Datos de Publicación:</span> {{ libro.datos_publicacion }}</p>
						    <p class="mb-0"><span class="fw-bold">Tipo de Contenido:</span> {{ libro.tipo_contenido }}</p>
						    <p class="mb-0"><span class="fw-bold">Restricciones:</span> {{ libro.restricciones }}</p>
						    <p class="mb-0"><span class="fw-bold">Materia:</span> {{ libro.materia }}</p>
						    <p class="mb-0"><span class="fw-bold">Proveedor:</span> {{ libro.proveedor }}</p>
						    <div class="row pt-3">
						    	<div class="col-6">
						    		<button class="btn btn-danger w-100" @click="del(libro.id, libro.titulo)">Eliminar</button>
						    	</div>
						    	<div class="col-6">
						    		<button class="btn btn-primary w-100" @click="edit(libro.id)">Editar</button>
						    	</div>
						    </div>
						  </div>
						</div>
					</div>
					<div class="col-6 pt-3" v-if="libros.length === 0 && !loading">
						<div class="card">
						  	<div class="card-body text-center">
						    	<h5 class="card-title">No se han encontrado libros en el sistema. Por favor agregue un libro.</h5>
							</div>
						</div>
					</div>
					<div class="col-6 pt-3" v-if="loading" >
						<div class="card">
						  	<div class="card-body text-center">
						    	<h5 class="card-title">Cargando...</h5>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	export default{
		name:"index",
		data(){
			return{
				libros:[],
				loading:false,
			}
		},
		mounted(){
			this.getLibros()
		},
		methods:{
			async getLibros(){
				this.loading = true;
				await this.axios.get('/api/libros')
					.then(res => {
						if(res.data.code === 200){
							this.libros = res.data.data
						}else{
							this.libros = [];
						}
					})
					.catch(err => {
						this.libros = [];
					});
				this.loading = false;
			},
			async del(id, titulo){
				if(confirm(`¿Desea borrar el libro "${titulo}"?`)){
					await this.axios.delete(`/api/libros/${id}`)
						.then( res => {
							this.getLibros()
						})
						.catch( err => {
							this.getLibros()
						})
				}
			},
			edit(id){
				this.$router.push(`/editar/${id}`);
			}
		}
	}
</script>