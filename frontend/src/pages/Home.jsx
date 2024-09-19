import React from "react";
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

const HomePage = () => {
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
