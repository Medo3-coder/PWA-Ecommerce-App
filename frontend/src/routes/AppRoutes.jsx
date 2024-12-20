import React from "react";
import { Routes, Route } from "react-router-dom";
import HomePage from "../pages/HomePage";
import UserLoginPage from "../pages/UserLoginPage";
import ContactPage from "../pages/ContactPage";
import PurchasePage from "../pages/PurchasePage";
import RefundPage from "../pages/RefundPage";
import PrivacyPage from "../pages/PrivacyPage";
import ProductDetailsPage from "../pages/ProductDetailsPage";
import NotificationPage from "../pages/NotificationPage";
import FavouritePage from "../pages/FavouritePage";
import CartPage from "../pages/CartPage";
import AboutPage from "../pages/AboutPage";
import ProductCategoryPage from "../pages/ProductCategoryPage";
import ProductSubCategoryPage from "../pages/ProductSubCategoryPage";

const AppRoutes = () => {
  return (
    <Routes>
      <Route path="/" element={<HomePage />} />
      <Route path="/login" element={<UserLoginPage />} />
      <Route path="/contact" element={<ContactPage />} />
      <Route path="/purchase" element={<PurchasePage />} />
      <Route path="/privacy" element={<PrivacyPage />} />
      <Route path="/refund" element={<RefundPage />} />
      <Route path="/product-details" element={<ProductDetailsPage />} />
      <Route path="/notification" element={<NotificationPage />} />
      <Route path="/favourite" element={<FavouritePage />} />
      <Route path="/cart" element={<CartPage />} />
      <Route path="/about" element={<AboutPage />} />
      <Route path="/:slug" element={<ProductCategoryPage />} />   {/* productsBySlugInCategory */}
      <Route path="/:category_slug/:subCategory_slug" element={<ProductSubCategoryPage />} />   {/* productsBySlugInSubCategory */}

      
      
      
    </Routes>
  );
};

export default AppRoutes;
