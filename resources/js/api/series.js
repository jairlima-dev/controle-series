import axios from "axios";

export default {
    all() {
        return axios.get('/api/series');
    },

    find(id) {
        return  axios.get("/api/series/${id}");
    },

    update(id, data) {
        return axios.put('/api/series/${id}', data);
    },
};
