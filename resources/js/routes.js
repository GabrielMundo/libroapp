const Index = () => import('./components/libros/Index.vue');
const Create = () => import('./components/libros/Create.vue');
const Edit = () => import('./components/libros/Edit.vue');
const NotFound = () => import('./components/libros/NotFound.vue');

export const routes = [
	{
		name: 'index',
		path: '/',
		component: Index,
	},
	{
		name: 'create',
		path: '/crear',
		component: Create,
	},
	{
		name: 'edit',
		path: '/editar/:id',
		component: Edit,
	},
	{
		name: 'not-found',
		path: '/404',
		component: NotFound,
	},
	{
		name: '404',
		path: '/:pathMatch(.*)*',
		component: NotFound,
	},
];