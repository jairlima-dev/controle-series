import axios from "axios";

export default {

    all(id) {
        return axios.get(`/api/seasons/${id}`)
    },

    create(data) {
        return axios.post('/api/seasons', data)
    }

}

