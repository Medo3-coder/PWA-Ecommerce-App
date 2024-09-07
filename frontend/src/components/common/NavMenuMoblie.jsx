import React from "react";
import Container from "react-bootstrap/Container";
import { Link } from "react-router-dom";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";
import Button from "react-bootstrap/Button";
import Logo from "../../assets/images/logo.jpg";

const NavMenuMoblie = () => {
  return (
    <>
      <div className="TopSectionDown">
        <Container
          fluid={"true"}
          className="fixed-top shadow-sm p-2 mb-0 bg-white"
        >
          <Row>
            <Col lg={4} md={4} sm={12} xs={12}>
              <Button className="btn">
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
        <div className="sideNavOpen">
          <hr className="w-80" />
          <div className="list-group">
            <a
              className="list-group-item nav-font nav-itemmenu
                list-group-item-action"
              href="/">
              
              <i className="fa mr-2 fa-home"></i>Home
            </a>
          </div>
        </div>
   

   <div className="ContentOverlayOpen">

   </div>


      </div>
    </>
  );
};

export default NavMenuMoblie;
