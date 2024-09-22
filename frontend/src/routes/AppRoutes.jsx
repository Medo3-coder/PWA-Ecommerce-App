import React from "react";
import { Routes, Route } from "react-router-dom";
import HomePage from "../pages/Home";
import UserLoginPage from "../pages/UserLoginPage";
import ContactPage from "../pages/ContactPage";
import PurchasePage from "../pages/PurchasePage";
import RefundPage from "../pages/RefundPage";
import PrivacyPage from "../pages/PrivacyPage";
import ProductDetailsPage from "../pages/ProductDetailsPage";

const AppRoutes = () => {
  return (
    <Routes>
      <Route path="/" element={<HomePage />} />
      <Route path="/login" element={<UserLoginPage />} />
      <Route path="/contact" element={<ContactPage />} />
      <Route path="/purchase" element={<PurchasePage />} />
      <Route path="/privacy" element={<PrivacyPage />} />
      <Route path="/refund" element={<RefundPage />} />ProductDetails
      <Route path="/product-details" element={<ProductDetailsPage />} />
    </Routes>
  );
};

export default AppRoutes;
