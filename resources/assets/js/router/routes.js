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
            },
            {
                path: "/school",
                name: "school",
                component: () => import("../view/pages/School.vue")
            },
        ]
    },
    {
        path: "/",
        component: () => import("../view/pages/Login"),
        children: [
            {
                name: "login",
                path: "/login",
                component: () => import("../view/pages/Login"),
            },
            {
                name: "register",
                path: "/register",
                component: () => import("../view/pages/Login"),
            }
        ]
    },
]

export default routes;
