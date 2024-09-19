import React from "react";
import { Routes, Route } from "react-router-dom";
import HomePage from "../pages/Home";
import UserLoginPage from "../pages/UserLoginPage";

const AppRoutes = () => {
  return (
    <Routes>
      <Route path="/" element={<HomePage />} />
      <Route path="/login" element={<UserLoginPage />} />
    </Routes>
  );
};

export default AppRoutes;
