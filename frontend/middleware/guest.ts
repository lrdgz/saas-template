import {useAuthStore} from "../stores";

export default ({ next }) => {
    const auth = useAuthStore();
    if(auth.isAuthenticated) {
        next({name: 'home'});
    } else {
        next();
    }
}
