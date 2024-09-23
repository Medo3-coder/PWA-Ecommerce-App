import React, { useState } from 'react'
import Container from "react-bootstrap/Container";
import { Link } from "react-router-dom";
import Navbar from "react-bootstrap/Navbar";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";
import Button from "react-bootstrap/Button";
import Logo from "../../assets/images/logo.jpg";
import MegaMenuDesktop from '../home/MegaMenuDesktop';
// import MegaMenuDesktop from '../home/MegaMenuDesktop';

const NavMenuDesktop = () => {
  
  const [sideNavState , setSideNavState] = useState("sideNavClose");
  const [contentOverState , setContentOverState] = useState("ContentOverlayClose");

  const sideNavOpenClose = () => {

    if(sideNavState === "sideNavOpen"){
       // If the side nav is currently open, close it and close the overlay
      setSideNavState("sideNavClose");
      setContentOverState("ContentOverlayClose");
    }else{
      // If the side nav is closed, open it and show the overlay
      setSideNavState("sideNavOpen");
      setContentOverState("ContentOverlayOpen");
    }
     
  }

  const menuBarClickHandler = () => {
    sideNavOpenClose();
  }

  const contentOverlayClickHandler = () => {
    sideNavOpenClose();
  }

  return (
    <>
      <div className="TopSectionDown">
        <Navbar className="navbar" fixed={"top"}>
          <Container
            fluid={"true"}
            className="fixed-top shadow-sm p-2 mb-0 bg-white"
          >
            <Row>
              <Col lg={4} md={4} sm={12} xs={12}>
              <Button onClick={menuBarClickHandler} className="btn">
                <i className="fa fa-bars"></i>
              </Button>   
                <Link to="/">
                  <img className="nav-logo" src={Logo} alt="logo" />
                </Link>
              </Col>

              <Col className="p-1 mt-1" lg={4} md={4} sm={12} xs={12}>
                <div className="input-group w-100">
                  <input type="text" className="form-control" />
                  <Button type="button" className="btn site-btn">
                    <i className="fa fa-search"> </i>
                  </Button>
                </div>
              </Col>

              <Col className="p-1 mt-1" lg={4} md={4} sm={12} xs={12}>


              <Link to="/" className="btn">
                  <i className="fa h4 fa-heart"></i>
                  <sup>
                    <span className="badge text-white bg-danger"> 3 </span>
                  </sup>
                </Link>


                <Link to="/" className="btn">
                  <i className="fa h4 fa-bell"></i>
                  <sup>
                    <span className="badge text-white bg-danger"> 5</span>
                  </sup>
                </Link>
                <a className="btn" href="test"> <i className="fa h4 fa-mobile-alt"></i></a>
                <Link to="/login" className="h4 btn">Login </Link>

                <Button className="cart-btn"><i className="fa fa-shopping-cart"></i> 3 Items</Button>
              </Col>
            </Row>
          </Container>
        </Navbar>
      </div>

      <div className={sideNavState}>
        <MegaMenuDesktop />
        </div>
   

        <div onClick={contentOverlayClickHandler} className={contentOverState}>

        </div>

    </>
  );
};

export default NavMenuDesktop;
