import React from "react";
import { Routes, Route } from "react-router-dom";
import HomePage from "../pages/HomePage";
import ProductDetailsPage from "../pages/ProductDetailsPage";
import ProductCategoryPage from "../pages/ProductCategoryPage";
import ProductSubCategoryPage from "../pages/ProductSubCategoryPage";
import SearchPage from "../pages/SearchPage";
import ProfilePage from "../pages/ProfilePage";
import ProtectedAuthRoute from "./ProtectedAuthRoute";
import ContentPageWrapper from "../components/content/ContentPageWrapper";
import UserLogin from "../components/Auth/Login";
import Register from "../components/Auth/Register";
import ForgetPassword from "../components/Auth/ForgetPassword";
import ResetPassword from "../components/Auth/ResetPassword";
import Notification from "../components/common/Notification";
import Contact from "../components/common/Contact";
import Cart from "../components/Cart/Cart";
import Favourite from "../components/common/Favourite";

const AppRoutes = () => {
  return (
    <Routes>
      <Route path="/" element={<HomePage />} />
      <Route path="/contact" element={<Contact />} />
      <Route path="/content/:type" element={<ContentPageWrapper />} />
      <Route path="/product-details/:productId" element={<ProductDetailsPage />} />
      <Route path="/notification" element={<Notification />} />
      <Route path="/favourite" element={<Favourite />} />
      <Route path="/cart" element={<Cart />} />
      <Route path="/:slug" element={<ProductCategoryPage />} />
      <Route path="/:category_slug/:subCategory_slug" element={<ProductSubCategoryPage />} />
      <Route path="/search/:searchKey" element={<SearchPage />} />

      {/* 🔒 Protect login and register pages */}
      <Route element={<ProtectedAuthRoute />}>
        <Route path="/login" element={<UserLogin />} />
        <Route path="/register" element={<Register />} />
      </Route>
      <Route path="/forgot-password" element={<ForgetPassword />} />
      <Route path="/password-reset/:token" element={<ResetPassword />} />
      <Route path="/profile" element={<ProfilePage />} />
    </Routes>
  );
};

export default AppRoutes;
