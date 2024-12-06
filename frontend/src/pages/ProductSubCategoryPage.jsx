import React, { useState, useEffect, Fragment } from "react";
import FooterDesktop from "../components/common/FooterDesktop";
import FooterMobile from "../components/common/FooterMobile";
import NavMenuDesktop from "../components/common/NavMenuDesktop";
import axios from "axios";
import SubCategory from "../components/ProductDetails/SubCategory";
import { useParams } from "react-router-dom";
import ToastMessages from "../toast-messages/toast";
import { Container } from "react-bootstrap";
import AppURL from "../utils/AppURL";
import NavMenuMobile from "../components/common/NavMenuMoblie";

const ProductSubCategoryPage = () => {
  const { category_slug, subCategory_slug } = useParams(); // Get params from the URL
  const [productData, setProductData] = useState([]); // State for product data
  const [message, setMessage] = useState("");
  const [error, setError] = useState(null); // State for errors
  const [loading, setLoading] = useState(true);

  useEffect(() => {
    window.scrollTo(0, 0); // Scroll to top on component mount
    // Fetch product data based on category and subcategory
    const fetchProductData = async () => {
      try {
        const response = await axios.get(
          AppURL.ProductBySubCategory(category_slug, subCategory_slug)
        );
        console.log(response);
        if (response.data.message) {
          setMessage(response.data.message); // Set message if returned from backend
        }
        setProductData(response.data.products || []); // Set product data, which could be empty
      } catch (error) {
        setError(
          ToastMessages.showError("Failed to load products Information.")
        );
      } finally {
        setLoading(false);
      }
    };

    fetchProductData();
  }, [category_slug, subCategory_slug]); // Dependency array ensures this runs when category or subcategory changes

  if (error) {
    return (
      <Container className="text-center">
        <h4>{error}</h4>
      </Container>
    );
  }

  if (loading) {
    return (
      <Container className="text-center">
        <h4>Loading Categories ...</h4>
      </Container>
    );
  }

  return (
    <Fragment>
      <div className="Desktop">
        <NavMenuDesktop />
      </div>

      <div className="Mobile">
        <NavMenuMobile />
      </div>

      <SubCategory
        category_slug={category_slug}
        SubCategory_slug={subCategory_slug}
        ProductData={productData}
        message={message}
      />

      <div className="Desktop">
        <FooterDesktop />
      </div>

      <div className="Mobile">
        <FooterMobile />
      </div>
    </Fragment>
  );
};

export default ProductSubCategoryPage;
