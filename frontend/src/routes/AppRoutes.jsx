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
import SearchPage from "../pages/SearchPage";
import RegisterPage from "../pages/RegisterPage";
import ForgetPasswordPage from "../pages/ForgetPasswordPage";
import ResetPasswordPage from "../pages/ResetPasswordPage";
import ProfilePage from "../pages/ProfilePage";

const AppRoutes = () => {
  return (
    <Routes>
      <Route path="/" element={<HomePage />} />
      <Route path="/login" element={<UserLoginPage />} />
      <Route path="/contact" element={<ContactPage />} />
      <Route path="/purchase" element={<PurchasePage />} />
      <Route path="/privacy" element={<PrivacyPage />} />
      <Route path="/refund" element={<RefundPage />} />
      <Route path="/product-details/:productId" element={<ProductDetailsPage />} />
      <Route path="/notification" element={<NotificationPage />} />
      <Route path="/favourite" element={<FavouritePage />} />
      <Route path="/cart" element={<CartPage />} />
      <Route path="/about" element={<AboutPage />} />
      <Route path="/:slug" element={<ProductCategoryPage />} />   {/* productsBySlugInCategory */}
      <Route path="/:category_slug/:subCategory_slug" element={<ProductSubCategoryPage />} />   {/* productsBySlugInSubCategory */}
      <Route path="/search/:searchKey" element={<SearchPage />} /> 
      <Route path="/register" element={<RegisterPage />} /> 
      <Route path="/forgot-password" element={<ForgetPasswordPage />} /> 
      <Route path="/reset/:id" element={<ResetPasswordPage />} /> 
      <Route path="/profile" element={<ProfilePage />} /> 





      

      


      
      
      
    </Routes>
  );
};

export default AppRoutes;
