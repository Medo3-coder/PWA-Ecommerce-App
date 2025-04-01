import axios from "axios";
import { createContext, useCallback, useEffect, useState } from "react";
import AppURL from "./AppURL";


export const CartContext = createContext();

export const CartProvider = ({ children }) => {
    const [cart, setCart] = useState([]);
    const [loading, setLoading] = useState(true);

    // Fetch cart items from API
    const fetchCart = useCallback(async () => {
        try {
            const response = await axios.get(AppURL.getCart);
            setCart(response.data);
        } catch (error) {
            console.error("Error fetching cart:", error);
        } finally {
            setLoading(false);
        }
    }, []);

    useEffect(() => {
        fetchCart();
    }, [fetchCart]);


    const addToCart = async (product, quantity) => {
        try {
            const response = await axios.post(AppURL.addToCart, {
                product_id: product.id,
                quantity,
            });
            setCart((prev) => [...prev, response.data]);
        } catch (error) {
            console.error("Error adding to cart:", error);
        }
    };


    const updateCart = async (id, quantity) => {
        try {
            await axios.post(AppURL.updateCart, { product_id: id, quantity });
            //...item: This is useful for immutability, ensuring we do not modify the original object directly.
            setCart((prev) => prev.map((item) => (item.product_id === id ? { ...item, quantity } : item)));
        } catch (error) {
            console.error("Error updating cart:", error);
        }
    };

    const removeFromCart = async (id) => {
        try{
            setCart((prev) => prev.filter((item) => item.id !== id))
            await axios.delete(`${AppURL.removeFromCart}/${id}`);
        } catch (error){
            console.error("Error removing from cart:", error);
            fetchCart(); // Reload if error occurs
        }
    };


    return (
        <CartContext.Provider value={{cart, addToCart, updateCart, removeFromCart, loading}}>
            {children}
        </CartContext.Provider>
    )
}