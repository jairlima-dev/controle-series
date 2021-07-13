import http from "../http";

export default {

    all(id) {
        return http.get(`/api/season/${id}`)
    },

    find(id) {
        return http.get(`/api/episodes/${id}`)
    },

    watch(id, data) {
        return http.post(`/api/episodes/${id}`, data)
    },

    create(data) {
        return http.post('/api/episodes', data)
    },

    update(id, data) {
        return http.put(`/api/episodes/${id}`, data)
    },

    delete(id) {
        return http.delete(`/api/episodes/${id}`)
    },

}
