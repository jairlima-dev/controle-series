import Vue from "vue";
import VueRouter from "vue-router";

import Login from "../../views/login/Login";
import Register from "../../views/register/Register";

import SeriesIndex from "../../views/series/SeriesIndex";
import SeriesEdit from "./SeriesEdit";
import SeriesCreate from "../../views/series/SeriesCreate";
import SeriesDelete from "./SeriesDelete";

import SeasonsIndex from "../../views/seasons/SeasonsIndex";
import SeasonsCreate from "../../views/seasons/SeasonsCreate";

import EpisodesIndex from "../../views/episodes/EpisodesIndex";
import EpisodesCreate from "../../views/episodes/EpisodesCreate";
import EpisodesEdit from "./EpisodesEdit";
import EpisodesDelete from "./EpisodesDelete";
import EpisodesFormEdit from "./EpisodesFormEdit";

import MoviesIndex from "../../views/movies/MoviesIndex";

import DocumentariesIndex from "../../views/documentaries/DocumentariesIndex";

import About from "../../views/register/About";
import NotFound from "../../views/NotFound";

Vue.use(VueRouter)

export default {

    mode: 'history',
    linkActiveClass: 'font-bold',

    routes: [

        {
            path: '/login',
            name: 'login',
            component: Login,
            meta: {
                public: true
            }
        },

        {
            path: '/register',
            name: 'register',
            component: Register
        },

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
            path: '/series/:id/edit/:nome',
            name: 'series.edit',
            component: SeriesEdit
        },

        {
            path: '/series/:id/delete',
            name: 'series.delete',
            component: SeriesDelete
        },

        {
            path: '/seasons/:id/:nome',
            name: 'seasons.index',
            component: SeasonsIndex
        },

        {
            path: '/seasons/:id/create',
            name: 'seasons.create',
            component: SeasonsCreate
        },

        {
            path: '/season/:id/episodes/:numero/:nome',
            name: 'season.episodes',
            component: EpisodesIndex
        },

        {
            path: '/episodes/:id/create/:numero',
            name: 'episodes.create',
            component: EpisodesCreate
        },

        {
            path: '/episodes/:id/edit/:nome',
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
            redirect: '/series'
        },

        {
            path: '/',
            redirect: '/series'
        },
    ]
}


