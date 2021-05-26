import axios from "axios";

export default {

    paginate(page) {
        return axios.get(`${page}`);
    },

};
