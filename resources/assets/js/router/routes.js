const routes = [
    {
        path:'',
        component:()=>import('../pages/auth/login.vue'),
        name:'login',
        meta:{layout:'guest'}
    }
]

export default routes;
