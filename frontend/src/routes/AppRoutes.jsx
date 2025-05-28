import React from "react";
import { Routes, Route } from "react-router-dom";
import HomePage from "../pages/HomePage";
import UserLoginPage from "../pages/UserLoginPage";
import ContactPage from "../pages/ContactPage";
import ProductDetailsPage from "../pages/ProductDetailsPage";
import NotificationPage from "../pages/NotificationPage";
import FavouritePage from "../pages/FavouritePage";
import CartPage from "../pages/CartPage";
import ProductCategoryPage from "../pages/ProductCategoryPage";
import ProductSubCategoryPage from "../pages/ProductSubCategoryPage";
import SearchPage from "../pages/SearchPage";
import RegisterPage from "../pages/RegisterPage";
import ForgetPasswordPage from "../pages/ForgetPasswordPage";
import ResetPasswordPage from "../pages/ResetPasswordPage";
import ProfilePage from "../pages/ProfilePage";
import ProtectedAuthRoute from "./ProtectedAuthRoute";
import ContentPageWrapper from "../components/content/ContentPageWrapper";

const AppRoutes = () => {
  return (
    <Routes>
      <Route path="/" element={<HomePage />} />
      <Route path="/contact" element={<ContactPage />} />
      <Route path="/content/:type" element={<ContentPageWrapper />} />
      <Route path="/product-details/:productId" element={<ProductDetailsPage />} />
      <Route path="/notification" element={<NotificationPage />} />
      <Route path="/favourite" element={<FavouritePage />} />
      <Route path="/cart" element={<CartPage />} />
      <Route path="/:slug" element={<ProductCategoryPage />} />
      <Route path="/:category_slug/:subCategory_slug" element={<ProductSubCategoryPage />} />
      <Route path="/search/:searchKey" element={<SearchPage />} />

      {/* 🔒 Protect login and register pages */}
      <Route element={<ProtectedAuthRoute />}>
        <Route path="/login" element={<UserLoginPage />} />
        <Route path="/register" element={<RegisterPage />} />
      </Route>
      <Route path="/forgot-password" element={<ForgetPasswordPage />} />
      <Route path="/password-reset/:token" element={<ResetPasswordPage />} />
      <Route path="/profile" element={<ProfilePage />} />
    </Routes>
  );
};

export default AppRoutes;
