import React, { Component } from "react";
import FeaturedProducts from "../components/home/FeaturedProducts";
import Categories from "../components/home/Categories";
import Collection from "../components/home/Collection";
import NewArrival from "../components/home/NewArrival";

export class Home extends Component {
  render() {
    return (
      <>
        <FeaturedProducts />
        <NewArrival />
        <Collection />
        <Categories />
      </>
    );
  }
}

export default Home;
