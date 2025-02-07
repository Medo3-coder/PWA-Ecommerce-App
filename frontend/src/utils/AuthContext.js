import axios from "axios";
import { createContext, useEffect, useState } from "react";
import AppURL from "./AppURL";

//createContext is a feature in React that allows you to create a context for sharing data (like state, functions, or other values) 
// across your component tree without having to pass props manually at every leve
export const AuthContext = createContext();

export const AuthProvider = ({ children }) => {
    const [token, setToken] = useState(localStorage.getItem("token"));
    const [user, setUser] = useState(null);
    const [loading, setLoading] = useState(true); // Add loading state



    const fetchUserData = async () => {
        if (token) {
            try {
                const response = await axios.get(AppURL.UserProfile, {
                    headers: { Authorization: `Bearer ${token}` },
                });
                
                setUser(response.data)
            } catch (error) {
                console.error("Error fetching user data:", error);
                logout(); // Clear token if it's invalid
            }finally {
                setLoading(false); // Stop loading
              }
        }else {
            setLoading(false); // Stop loading if no token
        }
    };

    const login = (newToken) => {
        localStorage.setItem("token", newToken);
        setToken(newToken);
        fetchUserData();
    };

    // Function to handle logout

    const logout = () => {
        localStorage.removeItem("token");
        setToken(null);
        setUser(null);
    };

    useEffect(() => {
        fetchUserData();
    }, [token]);

    return (
        <AuthContext.Provider value={{ token, user, login, logout , loading }}>
            {children}
        </AuthContext.Provider>
    );
};

