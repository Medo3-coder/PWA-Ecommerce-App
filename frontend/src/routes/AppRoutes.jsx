import React from "react";
import { Routes, Route } from "react-router-dom";
import HomePage from "../pages/Home";
import UserLoginPage from "../pages/UserLoginPage";
import ContactPage from "../pages/ContactPage";

const AppRoutes = () => {
  return (
    <Routes>
      <Route path="/" element={<HomePage />} />
      <Route path="/login" element={<UserLoginPage />} />
      <Route path="/contact" element={<ContactPage />} />
    </Routes>
  );
};

export default AppRoutes;
