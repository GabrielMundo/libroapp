<template>
	<div class="container text-center">
		
				<h5>No se ha encontrado el recurso solicitado.</h5>
			
			<hr/>
			<button class="btn btn-primary" @click="goBack">Regresar a Inicio</button>
		
	</div>
</template>

<script>
	export default{
		name:"not-found",
		methods:{
			goBack(){
				this.$router.push('/');
			}
		}
	}
</script>