import React, { Component } from "react";
import FeaturedProducts from "../components/home/FeaturedProducts";
import Categories from "../components/home/Categories";
import Collection from "../components/home/Collection";
import NewArrival from "../components/home/NewArrival";
import NavMenuDesktop from "../components/common/NavMenuDesktop";
import NavMenuMoblie from "../components/common/NavMenuMoblie";
import HomeTopMobile from "../components/home/HomeTopMobile";
import HomeTop from "../components/home/HomeTop";
import FooterDesktop from "../components/common/FooterDesktop";

export class Home extends Component {
  render() {
    return (
      <>
        <div className="Desktop">
          <NavMenuDesktop />
          <HomeTop />
        </div>

        <div className="Mobile">
          <NavMenuMoblie />
          <HomeTopMobile />
        </div>

        <FeaturedProducts />
        <NewArrival />
        <Categories />
        <Collection />
        <FooterDesktop />
      </>
    );
  }
}

export default Home;
