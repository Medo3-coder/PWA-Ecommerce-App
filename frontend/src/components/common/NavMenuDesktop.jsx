import React, { useState } from "react";
import Container from "react-bootstrap/Container";
import { Link, useNavigate } from "react-router-dom"; // Added useNavigate for navigation
import Navbar from "react-bootstrap/Navbar";
import Row from "react-bootstrap/Row";
import Col from "react-bootstrap/Col";
import Button from "react-bootstrap/Button";
import Logo from "../../assets/images/logo.jpg";
import MegaMenuDesktop from "../home/MegaMenuDesktop";
import Bars from "../../assets/images/bars.png";


const NavMenuDesktop = () => {
  const [sideNavState, setSideNavState] = useState("sideNavClose");
  const [contentOverState, setContentOverState] = useState(
    "ContentOverlayClose"
  );
  const [searchKey, setSearchKey] = useState(""); // State for search input
  const navigate = useNavigate(); // Hook for navigation

  const sideNavOpenClose = () => {
    if (sideNavState === "sideNavOpen") {
      setSideNavState("sideNavClose");
      setContentOverState("ContentOverlayClose");
    } else {
      setSideNavState("sideNavOpen");
      setContentOverState("ContentOverlayOpen");
    }
  };


  const handleSearch = async () => {
    if (searchKey.trim().length > 0) {
      navigate(`/search/${encodeURIComponent(searchKey)}`); // Pass the searchKey in the URL
    } else {
      alert("Please enter a search term");
    }
  };

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
                <img
                  onClick={sideNavOpenClose}
                  className="bar-img"
                  alt="bar"
                  src={Bars}
                />
                <Link to="/">
                  <img className="nav-logo" src={Logo} alt="logo" />
                </Link>
              </Col>

              <Col className="p-1 mt-1" lg={4} md={4} sm={12} xs={12}>
                <div className="input-group w-100">
                  <input
                    type="text"
                    className="form-control"
                    placeholder="Search here..."
                    value={searchKey}
                    onChange={(e) => setSearchKey(e.target.value)} // Update search input
                  />
                  <Button
                    type="button"
                    className="btn site-btn"
                    onClick={handleSearch}
                  >
                    <i className="fa fa-search"></i>
                  </Button>
                </div>
              </Col>

              <Col className="p-1 mt-1" lg={4} md={4} sm={12} xs={12}>
                <Link to="/favourite" className="btn">
                  <i className="fa h4 fa-heart"></i>
                  <sup>
                    <span className="badge text-white bg-danger"> 3 </span>
                  </sup>
                </Link>

                <Link to="/notification" className="btn">
                  <i className="fa h4 fa-bell"></i>
                  <sup>
                    <span className="badge text-white bg-danger"> 5</span>
                  </sup>
                </Link>
                <a className="btn" href="test">
                  <i className="fa h4 fa-mobile-alt"></i>
                </a>
                <Link to="/login" className="h4 btn">
                  Login
                </Link>

                <Link to="/cart">
                  <Button className="cart-btn">
                    <i className="fa fa-shopping-cart"></i> 3 Items
                  </Button>
                </Link>
              </Col>
            </Row>
          </Container>
        </Navbar>
      </div>

      <div className={sideNavState}>
        <MegaMenuDesktop />
      </div>

      <div onClick={sideNavOpenClose} className={contentOverState}></div>
    </>
  );
};

export default NavMenuDesktop;
