import React from 'react';
import { Col, Container, Row } from 'react-bootstrap';
import Apple from '../../assets/images/apple.png';
import Google from '../../assets/images/google.png';

const FooterMobile = () => {
  return (
    <div className="footerback m-0 mt-5 pt-3 shadow-sm">
      <Container className="text-center">
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
            <h5 className="footer-menu-title">DOWNLOAD APPS</h5>
            <a href="/">
              <img src={Google} alt="Google Play Store" />
            </a>
            <br />
            <a href="/">
              <img className="mt-2" src={Apple} alt="Apple App Store" />
            </a>
            <br />
          </Col>
        </Row>
      </Container>

      <Container fluid={true} className="text-center m-0 pt-3 pb-1 bg-dark">
        <Container>
          <Row>
            <h6 className="text-white">
              © Copyright 2024, All Rights Reserved
            </h6>
          </Row>
        </Container>
      </Container>
    </div>
  );
};

export default FooterMobile;
