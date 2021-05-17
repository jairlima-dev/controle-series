import SeriesIndex from "./views/series/SeriesIndex";
import SeriesEdit from "./views/series/SeriesEdit";
import SeriesCreate from "./views/series/SeriesCreate";
import SeriesDelete from "./views/series/SeriesDelete";
import SeasonsIndex from "./views/seasons/SeasonsIndex";
import SeasonsCreate from "./views/seasons/SeasonsCreate";
import EpisodesIndex from "./views/episodes/EpisodesIndex";
import EpisodesCreate from "./views/episodes/EpisodesCreate";
import EpisodesEdit from "./views/episodes/EpisodesEdit";
import EpisodesDelete from "./views/episodes/EpisodesDelete";
import MoviesIndex from "./views/MoviesIndex";
import DocumentariesIndex from "./views/DocumentariesIndex";
import EpisodesFormEdit from "./views/episodes/EpisodesFormEdit";
import About from "./views/About";
import NotFound from "./views/NotFound";

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
            path: '/series/:id/edit/:data',
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
            path: '/serie/:id/create',
            name: 'seasons.create',
            component: SeasonsCreate
        },

        {
            path: '/season/:id/episodes',
            name: 'season.episodes',
            component: EpisodesIndex
        },

        {
            path: '/episodes/:id/create',
            name: 'episodes.create',
            component: EpisodesCreate
        },

        {
            path: '/episodes/:id/edit/:data',
            name: 'episodes.edit',
            component: EpisodesEdit
        },

        {
            path: '/episodes/:id/edit',
            name: 'episodesform.edit',
            component: EpisodesFormEdit
        },

        {
            path: '/episodes/:id/delete',
            name: 'episodes.delete',
            component: EpisodesDelete
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
