import React, { useEffect } from "react";
import FeaturedProducts from "../components/home/FeaturedProducts";
import Categories from "../components/home/Categories";
import Collection from "../components/home/Collection";
import NewArrival from "../components/home/NewArrival";
import NavMenuDesktop from "../components/common/NavMenuDesktop";
import NavMenuMobile from "../components/common/NavMenuMoblie";
import HomeTopMobile from "../components/home/HomeTopMobile";
import HomeTop from "../components/home/HomeTop";
import FooterDesktop from "../components/common/FooterDesktop";
import FooterMobile from "../components/common/FooterMobile";
import axios from "axios";
import AppURL from "../utils/AppURL";

const HomePage = () => {
  useEffect(() => {
    window.scroll(0, 0);

    // Function to track the visitor
    const trackVisitor = async () => {
      try {
        const response = await axios.get(AppURL.BaseURL + "/track-visitor");
        console.log(response.data.message);
      } catch (err) {
        console.error("Error tracking visitor:", err);
      }
    };

    trackVisitor();
  }, []); // Empty dependency array to run only once

  return (
    <>
      <div className="Desktop">
        <NavMenuDesktop />
        <HomeTop />
      </div>

      <div className="Mobile">
        <NavMenuMobile />
        <HomeTopMobile />
      </div>

      <FeaturedProducts />
      <NewArrival />
      <Categories />
      <Collection />

      <div className="Desktop">
        <FooterDesktop />
      </div>

      <div className="Mobile">
        <FooterMobile />
      </div>
    </>
  );
};

export default HomePage;
