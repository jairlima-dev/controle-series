import axios from "axios";

export default {

    all() {
        return axios.get(`/api/series`);
    },

    find(id) {
        return  axios.get(`/api/series/${id}`);
    },

    create(data) {
        return axios.post('/api/series', data)
    },

    update(id, data) {
        return axios.put(`/api/series/${id}`, data);
    },

    delete(id) {
        return axios.delete(`/api/series/${id}`)
    },


    search(data) {
        return axios.get(`/api/series/search`, data)

    }

};
