const routes = [
    {
        path: "/",
        redirect: "/dashboard",
        component: () => import("../view/layout/Layout"),
        children: [
            {
                path: "/dashboard",
                name: "dashboard",
                component: () => import("../view/pages/Dashboard.vue")
            }
        ]
    },
    {
        path: "/",
        component: () => import("../view/pages/auth/login"),
        children: [
            {
                name: "login",
                path: "/login",
                component: () => import("../view/pages/auth/login"),
            },
            {
                name: "register",
                path: "/register",
                component: () => import("../view/pages/auth/login"),
            }
        ]
    },
]

export default routes;
