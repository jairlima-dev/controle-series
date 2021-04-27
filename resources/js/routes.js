import About from "./views/About";
import SeriesIndex from "./views/SeriesIndex";
import SeriesEdit from "./views/SeriesEdit";
import PageNotFound from "./views/PageNotFound";

export default {

    mode: 'history',

    linkActiveClass: 'font-bold',

    routes: [

        // {
        //     path: '*',
        //     component: PageNotFound
        // },

        // {
        //     path: '/',
        //     name: 'home',
        //     component: Home
        // },

        {
            path: '/',
            name: 'series.index',
            component: SeriesIndex
        },

        {
            path: '/about',
            name: 'about',
            component: About
        },

        {
            path: '/series/:id/edit',
            name: 'series.edit',
            component: SeriesEdit
        }

    ]};
