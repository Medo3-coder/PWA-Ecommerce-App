import React, { useEffect, useState } from "react";
import ProductDetails from "../components/ProductDetails/ProductDetails";
import { useParams } from "react-router";
import axios from "axios";
import AppURL from "../utils/AppURL";
import ToastMessages from "../toast-messages/toast";
import { ResponsiveLayout } from "../layouts/ResponsiveLayout";

const ProductDetailsPage = () => {
  const { productId } = useParams();
  const [productData, setProductData] = useState([]);
  const [message, setMessage] = useState("");
  const [error, setError] = useState(null);
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    window.scroll(0, 0);

    const fetchProductDetails = async () => {
      try {
        const response = await axios.get(AppURL.ProductDetails(productId));
        if (response.data.message) {
          setMessage(response.data.message);
        }
        setProductData(response.data);
      } catch (error) {
        setError(
          ToastMessages.showError("Failed to load product details Information.")
        );
      } finally {
        setLoading(false);
      }
    };

    fetchProductDetails();
  }, [productId]);

  return (
    <ResponsiveLayout>
      <ProductDetails productData={productData} message={message} />
    </ResponsiveLayout>
  );
};

export default ProductDetailsPage;
