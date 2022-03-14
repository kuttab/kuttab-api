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
                path: "/add/user",
                name: "add-user",
                component: () => import("../view/pages/users/Add.vue"),
            },
            {
                path: "/users/:id",
                name: "edit-user",
                component: () => import("../view/pages/users/Edit.vue"),
            },
            {
                path: "/users/:id",
                name: "show-user",
                component: () => import("../view/pages/users/Show.vue"),
            },
            {
                path: "/classes",
                name: "classes",
                component: () => import("../view/pages/Classes.vue")
            },
            {
                path: "/add/class",
                name: "add-class",
                component: () => import("../view/pages/classes/Add.vue"),
            },
            {
                path: "/classes/:id",
                name: "show-class",
                component: () => import("../view/pages/classes/Show.vue"),
            },
            {
                path: "/classes/:id/add/students",
                name: "class-addStudents",
                component: () => import("../view/pages/classes/addStudents.vue"),
            },
            {
                path: "/families",
                name: "families",
                component: () => import("../view/pages/Families.vue")
            },
            {
                path: "/add/family",
                name: "add-family",
                component: () => import("../view/pages/families/Add.vue")
            },
            {
                path: "/family/:id",
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
