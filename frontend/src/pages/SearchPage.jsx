import React, { useEffect, useState, lazy, Suspense } from "react";
import { useParams } from "react-router-dom";
import axios from "axios";
import { Container } from "react-bootstrap";
import AppURL from "../utils/AppURL";
import ToastMessages from "../toast-messages/toast";

// Lazy load components
const NavMenuDesktop = lazy(() => import("../components/common/NavMenuDesktop"));
const NavMenuMobile = lazy(() => import("../components/common/NavMenuMoblie"));
const FooterDesktop = lazy(() => import("../components/common/FooterDesktop"));
const FooterMobile = lazy(() => import("../components/common/FooterMobile"));
const SearchList = lazy(() => import("../components/common/SearchList"));

// Loading component
const LoadingFallback = () => (
  <div className="text-center p-5">
    <div className="spinner-border text-primary" role="status">
      <span className="visually-hidden">Loading...</span>
    </div>
  </div>
);

const SearchPage = () => {
  const { searchKey } = useParams();
  const [searchState, setSearchState] = useState({
    products: [],
    isLoading: true,
    error: null
  });

  useEffect(() => {
    const fetchProducts = async () => {
      try {
        setSearchState(prev => ({ ...prev, isLoading: true, error: null }));
        const response = await axios.get(AppURL.ProductBySearch(searchKey));
        setSearchState({
          products: response.data,
          isLoading: false,
          error: null
        });
      } catch (error) {
        setSearchState({
          products: [],
          isLoading: false,
          error: error.response?.data?.message || "Failed to fetch products"
        });
        ToastMessages.showError(error.response?.data?.message || "Failed to fetch products");
      }
    };

    // Scroll to top and fetch products
    window.scrollTo({
      top: 0,
      behavior: "smooth"
    });
    fetchProducts();
  }, [searchKey]);

  // Render navigation
  const renderNavigation = () => (
    <>
      <div className="Desktop">
        <Suspense fallback={<LoadingFallback />}>
          <NavMenuDesktop />
        </Suspense>
      </div>
      <div className="Mobile">
        <Suspense fallback={<LoadingFallback />}>
          <NavMenuMobile />
        </Suspense>
      </div>
    </>
  );

  // Render footer
  const renderFooter = () => (
    <>
      <div className="Desktop">
        <Suspense fallback={<LoadingFallback />}>
          <FooterDesktop />
        </Suspense>
      </div>
      <div className="Mobile">
        <Suspense fallback={<LoadingFallback />}>
          <FooterMobile />
        </Suspense>
      </div>
    </>
  );

  // Render error state
  if (searchState.error) {
    return (
      <>
        {renderNavigation()}
        <Container className="text-center py-5">
          <h4 className="text-danger">{searchState.error}</h4>
        </Container>
        {renderFooter()}
      </>
    );
  }

  return (
    <>
      {renderNavigation()}
      
      <Suspense fallback={<LoadingFallback />}>
        <SearchList 
          SearchKey={searchKey} 
          ProductData={searchState.products}
          isLoading={searchState.isLoading}
        />
      </Suspense>

      {renderFooter()}
    </>
  );
};

export default SearchPage;