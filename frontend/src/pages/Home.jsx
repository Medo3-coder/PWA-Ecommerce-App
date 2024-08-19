import React, { Component } from "react";
import FeaturedProducts from "../components/home/FeaturedProducts";
import Categories from "../components/home/Categories";

export class Home extends Component {
  render() {
    return (
      <>
        <FeaturedProducts />
        <Categories />
      </>
    );
  }
}

export default Home;
