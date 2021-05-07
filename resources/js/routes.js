import SeriesIndex from "./views/series/SeriesIndex";
import SeriesEdit from "./views/series/SeriesEdit";
import SeriesCreate from "./views/series/SeriesCreate";
import SeasonsIndex from "./views/seasons/SeasonsIndex";
import MoviesIndex from "./views/MoviesIndex";
import DocumentariesIndex from "./views/DocumentariesIndex";
import About from "./views/About";
import NotFound from "./views/NotFound";
import SeriesDelete from "./views/series/SeriesDelete";
import EpisodesIndex from "./views/episodes/EpisodesIndex";

export default {

    mode: 'history',

    linkActiveClass: 'font-bold',

    routes: [

        {
            path: '/series',
            name: 'series.index',
            component: SeriesIndex
        },

        {
            path: '/movies',
            name: 'movies.index',
            component: MoviesIndex
        },

        {
            path: '/documentaries',
            name: 'documentaries.index',
            component: DocumentariesIndex
        },

        {
            path: '/series/create',
            name: 'series.create',
            component: SeriesCreate
        },

        {
            path: '/series/:id/edit',
            name: 'series.edit',
            component: SeriesEdit
        },

        {
            path: '/series/:id/delete',
            name: 'series.delete',
            component: SeriesDelete
        },

        {
            path: '/serie/:id/seasons',
            name: 'seasons.index',
            component: SeasonsIndex
        },

        {
            path: '/season/:id/episodes',
            name: 'season.episodes',
            component: EpisodesIndex
        },

        {
            path: '/about',
            name: 'about',
            component: About
        },

        {
            path: '/404',
            name: '404',
            component: NotFound
        },

        {
            path: '*',
            redirect: '/404'
        },

        {
            path: '/',
            redirect: '/series'
        }

    ]};
