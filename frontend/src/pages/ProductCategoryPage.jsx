import React, { useEffect, useState } from "react";
import { useParams } from "react-router-dom";
import FooterDesktop from "../components/common/FooterDesktop";
import FooterMobile from "../components/common/FooterMobile";
import NavMenuDesktop from "../components/common/NavMenuDesktop";
import Category from "../components/ProductDetails/Category";
import axios from "axios";
import NavMenuMobile from "../components/common/NavMenuMoblie";
import AppURL from "../utils/AppURL";
import ToastMessages from "../toast-messages/toast";
import { Container } from "react-bootstrap";

const ProductCategoryPage = () => {
  const { category_id } = useParams(); // Get the category id from the route parameters
  const [productData, setProductData] = useState([]);
  const [error, setError] = useState(null); // State for errors
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    window.scroll(0, 0);

    // Fetch product data by category
    const fetchProductData = async () => {
      try {
        const response = await axios.get(AppURL.ProductByCategory(category_id));
        setProductData(response.data);
      } catch (error) {
        setError(
          ToastMessages.showError("Failed to load products Information.")
        );
      } finally {
        setLoading(false);
      }
    };

    fetchProductData();
  }, [category_id]); // Re-run the effect when the category id changes


  if(error){
    return (
      <Container className="text-center">
         <h4>{error}</h4>
      </Container>
    );
  }

  if(loading){
    return (
      <Container className="text-center">
        <h4>Loading Categories ...</h4>
      </Container>
    );
  }


  return (
    <>
      <div className="Desktop">
        <NavMenuDesktop />
      </div>

      <div className="Mobile">
        <NavMenuMobile />
      </div>

      <Category Category_id={category_id} ProductData={productData}/>

      <div className="Desktop">
        <FooterDesktop />
      </div>

      <div className="Mobile">
        <FooterMobile />
      </div>
    </>
  );
};

export default ProductCategoryPage;
