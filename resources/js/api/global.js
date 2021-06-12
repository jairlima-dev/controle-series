import http from "../http";

export default {

    paginate(page) {
        return http.get(`${page}`);
    },

};
