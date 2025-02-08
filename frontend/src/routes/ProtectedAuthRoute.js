import { useContext } from "react"
import { AuthContext } from "../utils/AuthContext"
import { Navigate, Outlet } from "react-router";

const ProtectedAuthRoute = ()=> {
    const {user , loading } = useContext(AuthContext);

    if(loading) return null ; // Wait until authentication status is loaded

    return user ? <Navigate to="/profile" replace /> : <Outlet />;
}

export default ProtectedAuthRoute;
