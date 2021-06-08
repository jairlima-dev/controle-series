import axios from "axios";

export default {

    create(data) {
        return axios.post('/api/register', data)
    }

}
