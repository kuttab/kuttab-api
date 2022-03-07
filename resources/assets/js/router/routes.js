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
            {
                path: "/users",
                name: "users",
                component: () => import("../view/pages/Users.vue"),
            },
            {
                path: "/users/add",
                name: "add-user",
                component: () => import("../view/pages/users/Add.vue"),
            },
            {
                path: "/users/edit/:id",
                name: "edit-user",
                component: () => import("../view/pages/users/Edit.vue"),
            },
            {
                path: "/users/show/:id",
                name: "show-user",
                component: () => import("../view/pages/users/Show.vue"),
            },
            {
                path: "/classes",
                name: "classes",
                component: () => import("../view/pages/Classes.vue")
            },
            {
                path: "/classes/add",
                name: "add-class",
                component: () => import("../view/pages/classes/Add.vue"),
            },
            {
                path: "/classes/show/:id",
                name: "show-class",
                component: () => import("../view/pages/classes/Show.vue"),
            },
            {
                path: "/families",
                name: "families",
                component: () => import("../view/pages/Families.vue")
            },
            {
                path: "/families/add",
                name: "add-family",
                component: () => import("../view/pages/families/Add.vue")
            },
            {
                path: "/families/show/:id",
                name: "show-family",
                component: () => import("../view/pages/families/Show.vue")
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
