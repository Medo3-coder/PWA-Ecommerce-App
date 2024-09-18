import React from 'react';
import { Col, Container, Row } from 'react-bootstrap';
import { Link } from 'react-router-dom';
import Apple from '../../assets/images/apple.png';
import Google from '../../assets/images/google.png';

const FooterDesktop = () => {
  return (
    <div className="footerback m-0 mt-5 pt-3 shadow-sm">
      <Container>
        <Row className="px-0 my-5">
          <Col className="p-2" lg={3} md={3} sm={6} xs={12}>
            <h5 className="footer-menu-title">OFFICE ADDRESS</h5>
            <p>
              1635 Franklin Street Montgomery, Near Sherwood Mall. AL 36104
              <br />
              Email: Support@Mohamed.com
            </p>
            <h5 className="footer-menu-title">SOCIAL LINK</h5>
            <a href="/">
              <i className="fab m-1 h4 fa-facebook"></i>
            </a>
            <a href="/">
              <i className="fab m-1 h4 fa-instagram"></i>
            </a>
            <a href="/">
              <i className="fab m-1 h4 fa-twitter"></i>
            </a>
          </Col>

          <Col className="p-2" lg={3} md={3} sm={6} xs={12}>
            <h5 className="footer-menu-title">THE COMPANY</h5>
            <Link to="/" className="footer-link">About Us</Link><br />
            <Link to="/" className="footer-link">Company Profile</Link><br />
            <Link to="/" className="footer-link">Contact Us</Link><br />
          </Col>

          <Col className="p-2" lg={3} md={3} sm={6} xs={12}>
            <h5 className="footer-menu-title">MORE INFO</h5>
            <Link to="/" className="footer-link">How To Purchase</Link><br />
            <Link to="/" className="footer-link">Privacy Policy</Link><br />
            <Link to="/" className="footer-link">Refund Policy</Link><br />
          </Col>

          <Col className="p-2" lg={3} md={3} sm={6} xs={12}>
            <h5 className="footer-menu-title">DOWNLOAD APPS</h5>
            <a href="https://www.google.com/">
              <img src={Google} alt="Google Play Store" />
            </a><br />
            <a href="https://www.apple.com/">
              <img className="mt-2" src={Apple} alt="Apple App Store" />
            </a><br />
          </Col>
        </Row>
      </Container>

      <Container fluid={true} className="text-center m-0 pt-3 pb-1 bg-dark">
        <Container>
          <Row> 
            <h6 className="text-white">© Copyright 2024 , All Rights Reserved</h6>
          </Row>
        </Container>
      </Container>
    </div>
  );
};

export default FooterDesktop;
