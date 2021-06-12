import http from "../http";

export default {

    all() {
        return http.get(`/api/series`);
    },

    find(id) {
        return http.get(`/api/series/${id}`);
    },

    create(data) {
        return http.post('/api/series', data)
    },

    update(id, data) {
        return http.put(`/api/series/${id}`, data);
    },

    delete(id) {
        return http.delete(`/api/series/${id}`)
    },

    search(search) {
        return http.get(`/api/series/${search}`)
    },

};
