import Cookies from "js-cookie";
export default {
    auth (to, from, next) {
        const token = Cookies.get('token');

        if (!token) {
            next({name: 'Login'});
        }

        next();
    }
}
