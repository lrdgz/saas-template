import { useAuthStore } from "../stores";

export default ({ next }) => {
    const auth = useAuthStore();
    if(!auth.isAuthenticated) {
        next({name: 'auth.sign-in'});
    } else {
        next();
    }
}
