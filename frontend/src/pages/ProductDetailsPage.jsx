import React, { useEffect, useState } from "react";
import FooterDesktop from "../components/common/FooterDesktop";
import FooterMobile from "../components/common/FooterMobile";
import NavMenuDesktop from "../components/common/NavMenuDesktop";
import ProductDetails from "../components/ProductDetails/ProductDetails";
import NavMenuMobile from "../components/common/NavMenuMoblie";
import SuggestedProduct from "../components/ProductDetails/SuggestedProduct";
import { useParams } from "react-router";
import axios from "axios";
import AppURL from "../utils/AppURL";
import ToastMessages from "../toast-messages/toast";

const ProductDetailsPage = () => {
  const { productId } = useParams();
  const [productData, setProductData] = useState([]);
  const [message, setMessage] = useState("");
  const [error, setError] = useState(null); // State for errors
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    window.scroll(0, 0);

    // Fetch product details by product id
    const fetchProductDetails = async () => {
      try {
        const response = await axios.get(AppURL.ProductDetails(productId));
        if (response.data.message) {
          setMessage(response.data.message); // Set message if returned from backend
        }
        setProductData(response.data.product);
      } catch (error) {
        setError(
          ToastMessages.showError("Failed to load product deatils Information.")
        );
      } finally {
        setLoading(false);
      }
    };

    fetchProductDetails();
  }, [productId]); // Re-run the effect when the productId  changes

  return (
    <>
      <div className="Desktop">
        <NavMenuDesktop />
      </div>

      <div className="Mobile">
        <NavMenuMobile />
      </div>

      <ProductDetails productData = {productData}  message={message}/>
      <SuggestedProduct />

      <div className="Desktop">
        <FooterDesktop />
      </div>

      <div className="Mobile">
        <FooterMobile />
      </div>
    </>
  );
};

export default ProductDetailsPage;
