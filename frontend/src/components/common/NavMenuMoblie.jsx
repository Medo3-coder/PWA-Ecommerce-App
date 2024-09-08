import React, { useState } from "react";
import Container from "react-bootstrap/Container";
import { Link } from "react-router-dom";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";
import Button from "react-bootstrap/Button";
import Logo from "../../assets/images/logo.jpg";

const NavMenuMoblie = () => {

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

              <Button className="cart-btn">
                <i className="fa fa-shopping-cart"></i> 3 Items
              </Button>
            </Col>
          </Row>
        </Container>
        <div className={sideNavState}>
          
        </div>
   

        <div onClick={contentOverlayClickHandler} className={contentOverState}>

        </div>


      </div>
    </>
  );
};

export default NavMenuMoblie;
