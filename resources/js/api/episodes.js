import axios from "axios";

export default {

    all(id) {
        return axios.get(`/api/season/${id}`)
    },

    find(id) {
        return axios.get(`/api/episodes/${id}`)
    },

    create(data) {
        return axios.post('/api/episodes', data)
    },

    update(id, data) {
        return axios.put(`/api/episodes/${id}`, data)
    },

    delete(id) {
        return axios.delete(`/api/episodes/${id}`)
    },

}
